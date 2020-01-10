<?php
/*
Plugin Name: Responsive Media
Plugin URI:  https://github.com/jeroenoomsNL/wordpress-responsive-media
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class F1ResponsiveMedia {
    public $providers = array();
    public $default_options = array();

	/**
	 * Add Wordpress hook for oEmbed content
	 */
	function __construct() {
	    $this->providers = array(
            ['youtube', 'Youtube', ['#http://((m|www)\.)?youtube\.com/watch.*#i', '#https://((m|www)\.)?youtube\.com/watch.*#i', '#http://((m|www)\.)?youtube\.com/playlist.*#i', '#https://((m|www)\.)?youtube\.com/playlist.*#i', '#http://youtu\.be/.*#i', '#https://youtu\.be/.*#i']],
            ['vimeo', 'Vimeo', ['#https?://(.+\.)?vimeo\.com/.*#i']],
            ['wordpresstv', 'Wordpress.tv', ['#https?://wordpress.tv/.*#i']],
            ['soundcloud', 'Soundcloud', ['#https?://(www\.)?soundcloud\.com/.*#i']],
            ['slideshare', 'Slideshare', ['#https?://(.+?\.)?slideshare\.net/.*#i']],
            ['ted', 'TED', ['#https?://(www\.|embed\.)?ted\.com/talks/.*#i']],
            ['kickstarter', 'Kickstarter', ['#https?://(www\.)?kickstarter\.com/projects/.*#i','#https?://kck\.st/.*#i']],
            ['videopress', 'Videopress', ['#https?://videopress.com/v/.*#']],
            ['speakerdeck', 'Speakerdeck', ['#https?://(www\.)?speakerdeck\.com/.*#i']],
            ['vine', 'Vine', ['#https?://vine.co/v/.*#i']],
            ['flickr', 'Flickr', ['#https?://(www\.)?flickr\.com/.*#i','#https?://flic\.kr/.*#i']]
        );

        // set default settings
        foreach ( $this->providers as $provider ) {
            $slug = $provider[0];
            $this->default_options[$slug] = 'on';
        }

        load_plugin_textdomain('responsive-media', false, basename( dirname( __FILE__ ) ) . '/languages' );

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );

        add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( $this, 'plugin_settings_link' ) );

        if( !is_admin() ) {
		    add_filter('wp_head', array($this, 'add_responsive_style') );
		    add_filter('embed_oembed_html', array($this, 'add_reponsive_container'), 10, 3);
		}

        if( !get_option( 'responsive_media_option' ) ) {
            add_option( 'responsive_media_option', $this->default_options );
        }
	}


    /**
     * Get dimensions and add responsive container with calculated aspect ratio
     */
	public function add_reponsive_container( $html, $url ) {
        $inline_css = '';
        $attr = array();
        $options = get_option( 'responsive_media_option' );

        foreach ( $this->providers as $provider ) {
            $slug = $provider[0];
            $name = $provider[1];
            $patterns = $provider[2];

            if( $options[$slug] != 'off' ) {
                foreach ( $patterns as &$pattern ) {
                    if ( preg_match( $pattern, $url ) ) {

                        $doc = new DOMDocument;
                        @$doc->loadHTML($html);
                        $xpath = new DOMXPath($doc);
                        $entries = $xpath->query("//iframe");
                        foreach ($entries as $entry) {
                          $attr['height'] = $entry->getAttribute("height");
                          $attr['width'] = $entry->getAttribute("width");
                        }

                        if(isset($attr['height']) && isset($attr['width'])) {
                            $inline_css = ' style="padding-bottom: '. ($attr['height'] / $attr['width']) * 100 .'%"';
                        }

                        $F1ResponsiveMedia = '<p class="responsive-media"'.$inline_css.'>'.$html.'</p>';
                        return $F1ResponsiveMedia;
                    }
                }
            }
        }

		return $html;
	}


    /**
     * Admin menu
     */
	function admin_menu() {
        add_options_page(
            'Responsive Media',
            'Responsive Media',
            'manage_options',
            'responsive_media_options',
            array(
                $this,
                'settings_page'
            )
        );
    }


    /**
     * Admin menu
     */
    function  settings_page() {
        // Set class property
        //$this->options = get_option( 'responsive_media_option' );
        ?>
        <div class="wrap">
            <h2>My Settings</h2>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'responsive_media_options' );
                do_settings_sections( 'responsive_media_settings' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }


    /**
     * Register and add settings
     */
    public function page_init() {
        register_setting(
            'responsive_media_options',
            'responsive_media_option',
            array( $this, 'sanitize' )
        );

        add_settings_section(
            'repsonsive_media_settings_section',
            'Responsive Media settings',
            array( $this, 'print_section_info' ),
            'responsive_media_settings'
        );

        foreach ( $this->providers as $provider ) {
            add_settings_field(
                $provider[0], // ID
                $provider[1], // Title
                array( $this, 'option_callback' ),
                'responsive_media_settings',
                'repsonsive_media_settings_section',
                array($provider[0]) // Arguments
            );
        }
    }


    /**
     * Add settings link for plugin overview page
     */
    function plugin_settings_link($links) {
        $url = get_admin_url() . 'options-general.php?page=responsive_media_options';
        $settings_link = '<a href="'.$url.'">' . __( 'Settings', 'responsive-media' ) . '</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }


    /**
     * Get the settings option array and print one of its values
     */
    public function option_callback($args) {
        $options = get_option( 'responsive_media_option' );

        echo '<input type="checkbox" id="'.$args[0].'" name="responsive_media_option['.$args[0].']" value="on"' . checked( 'on', $options[$args[0]], false ) . ' />';
    }


    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ) {
        $new_input = array();

        $input = !$input ? array() : $input;

        foreach ( $this->providers as $provider ) {
            $slug = $provider[0];
            $new_input[$slug] = array_key_exists($slug, $input) ? 'on' : 'off';
        }

        return $new_input;
    }


    /**
     * Print the Section text
     */
    public function print_section_info() {
        esc_html_e( 'Select the media that should be responsive:', 'responsive-media' );
    }


    /**
     * Add inline CSS with default 16:9 aspect ratio
     */
	public function add_responsive_style() {
	    echo "
	        <style>
            .responsive-media {
                position: relative;
                padding-bottom: 56.25%;
                height: 0;
            }
            .responsive-media iframe,
            .responsive-media > a > img {
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100% !important;
            }
            </style>";
	}
}

$responsive_media = new F1ResponsiveMedia();
