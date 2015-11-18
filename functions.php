<?php

if ( ! function_exists( 'f1_features' ) ) {

    // Register Theme Features
    function f1_features() {

    	// Add theme support for Automatic Feed Links
    	add_theme_support( 'automatic-feed-links' );

    	// Add theme support for Post Formats
    	add_theme_support( 'post-formats', array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside' ) );

    	// Add theme support for Featured Images
    	add_theme_support( 'post-thumbnails' );

    	// Add theme support for Custom Header
    	$header_args = array(
    		'default-image'          => '#',
    		'width'                  => 1200,
    		'height'                 => 600,
    		'flex-width'             => true,
    		'flex-height'            => true,
    		'uploads'                => true,
    		'random-default'         => false,
    		'header-text'            => true,
    		'default-text-color'     => '#ffffff',
    		'wp-head-callback'       => '',
    		'admin-head-callback'    => '',
    		'admin-preview-callback' => '',
    	);
    	add_theme_support( 'custom-header', $header_args );

    	// Add theme support for HTML5 Semantic Markup
    	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

    	// Add theme support for document Title tag
    	add_theme_support( 'title-tag' );

        // Add theme support for post types
    	add_theme_support( 'post-formats', array(
    		'aside',
    		'image',
    		'video',
    		'quote',
    		'link',
    	) );

        // Add theme support for custom menus
        add_theme_support( 'menus' );

        // Create theme menus
    	register_nav_menus( array(
    		'primary' => esc_html__( 'Primary Menu', 'factor1_blankwp' ),
    		'footer' => esc_html__( 'Footer Menu', 'factor1_blankwp' ),
    		'social' => esc_html__( 'Social Menu', 'factor1_blankwp' ),
    	) );

        // Set up the WordPress core custom background feature.
    	add_theme_support( 'custom-background', apply_filters( 'factor1_blankwp_custom_background_args', array(
    		'default-color' => 'ffffff',
    		'default-image' => '',
    	) ) );

    	// Add theme support for custom CSS in the TinyMCE visual editor
    	add_editor_style( 'editor.css' );

        // Clean up the default WordPress head section
        remove_action( 'wp_head', 'rsd_link' );
        remove_action( 'wp_head', 'wlwmanifest_link' );
        remove_action( 'wp_head', 'wp_generator' );
        remove_action( 'wp_head', 'start_post_rel_link' );
        remove_action( 'wp_head', 'index_rel_link' );
        remove_action( 'wp_head', 'adjacent_posts_rel_link' );
    }
    add_action( 'after_setup_theme', 'f1_features' );
}

/**
 * Link to all theme CSS files
 */
function f1_theme_css() {
    wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'theme-css', get_template_directory_uri() . '/css/theme.min.css' );
}
add_action( 'wp_enqueue_scripts', 'f1_theme_css' );

/**
 * Link to all theme JS filesg
 */
function f1_theme_js() {
    wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/js/main.min.js', array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'f1_theme_js' );

/**
 * Removes the jQuery version that ships with WordPress and add our own
 */
// if ( ! is_admin() ) {
//    wp_deregister_script( 'jquery' );
//    wp_register_script( 'jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"), false );
//    wp_enqueue_script( 'jquery' );
// }

/**
 * Set the maximun content width for the theme
 */
function f1_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'f1_content_width', 1200 );
}
add_action( 'after_setup_theme', 'f1_content_width', 0 );

/**
 * Register widget area.
 */
function f1_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'f1_' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

    unregister_widget( 'WP_Widget_Calendar' );
    unregister_widget( 'WP_Widget_Links' );
    unregister_widget( 'WP_Widget_Meta' );
    unregister_widget( 'WP_Widget_Search' );
    unregister_widget( 'WP_Widget_Recent_Comments' );
}
add_action( 'widgets_init', 'f1_widgets_init' );

/*
 * Social media icon menu as per http://justintadlock.com/archives/2013/08/14/social-nav-menus-part-2
 */
function f1_social_menu() {
    if ( has_nav_menu( 'social' ) ) {
    	wp_nav_menu(
    		array(
    			'theme_location'  => 'social',
    			'container'       => 'nav',
    			'container_id'    => 'menu-social',
    			'container_class' => 'menu-social',
    			'menu_id'         => 'menu-social-items',
    			'menu_class'      => 'menu-items',
    			'depth'           => 1,
    			'link_before'     => '<span class="screen-reader-text">',
    			'link_after'      => '</span>',
    			'fallback_cb'     => '',
    		)
    	);
    }
}

/**
 * WordPress customizations
 */
// Customize the login logo
function f1_login_logo() {
    echo '<style type="text/css">
        .login h1 a {
            width: 100% !important;
            height: 100% !important;
        	background-image: url( ' . get_template_directory_uri() . '/images/factor1.png ) !important;
            background-position: center !important;
            background-size: 100% !important;
            margin-bottom: 0.625rem !important;
        }

        .login h1 {
        	width: 320px !important;
        	height: 120px !important;
        }
    </style>';
}
add_action( 'login_head', 'f1_login_logo' );

// Customize the URL of login logo
function f1_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'f1_login_logo_url' );

// Customize the login logo hover text
function f1_logo_url_title() {
  return 'Made with love by factor1';
}
add_filter( 'login_headertitle', 'f1_logo_url_title' );

// Change the admin footer text
function f1_change_footer_admin() {
    echo 'Created by <a href="http://factor1studios.com"><strong>factor1</strong></a>. ';
	echo 'Powered by<a href="http://WordPress.org">WordPress</a>.';
}
add_filter('admin_footer_text', 'f1_change_footer_admin');

// Add a custom WordPress dashboard widget
function f1_dashboard_widgets() {
    wp_add_dashboard_widget( 'wp_dashboard_widget', 'Keep In Touch With factor1', 'f1_theme_info' );
}
add_action( 'wp_dashboard_setup', 'f1_dashboard_widgets' );

function f1_theme_info() {
    echo '<ul>
        <li><strong>factor1 Studios</strong></li>
        <li><a href="http://factor1studios.com">factor1studios.com</a></li>
        <li><a href="mailto:sayhello@factor1studios.com ">sayhello@factor1studios.com</a></li>
        <li>602-334-4806</li>
        <li><address>3923 S. McClintock Dr. Ste. 401
            <br>Tempe, AZ 85282<address>
        </li>
    </ul>';
}

/**
 * Add page excerpts
 */
function f1_page_excerpt() {
    add_post_type_support( 'page', array( 'excerpt' ) );
}
add_action( 'init', 'f1_page_excerpt' );

/**
 * Customize the default read more link
 */
function f1_continue_reading_link() {
    return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'f1' ) . '</a>';
}

/**
 * Customize the default ellipsis (...)
 */
function f1_auto_excerpt_more( $more ) {
    return ' &hellip;' . f1_continue_reading_link();
}
add_filter( 'excerpt_more', 'f1_auto_excerpt_more' );

/**
 * Remove the default gallery styling
 */
function f1_remove_gallery_css( $css ) {
    return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'f1_remove_gallery_css' );

/**
 * Remove the default recent comments styling
 */
function f1_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'f1_remove_recent_comments_style' );

/**
 * Ensure only admin users receive update notifications
 */
global $user_login;

get_currentuserinfo();

if ( ! current_user_can( 'update_plugins' ) ) {
    add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
    add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

/**
 * Customize which dashboard widgets show
 */
function f1_remove_dashboard_boxes() {
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' ); // Right Now Overview Box
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' ); // Incoming Links Box
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' ); // Quick Press Box
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' ); // Plugins Box
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' ); // Recent Drafts Box
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); // Recent Comments
    remove_meta_box( 'dashboard_primary', 'dashboard', 'core' ); // WordPress Development Blog
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' ); // Other WordPress News
}
add_action( 'admin_menu', 'f1_remove_dashboard_boxes' );

/**
 * Remove meta boxes from default posts screen
 */
function f1_remove_default_post_metaboxes() {
    remove_meta_box( 'postcustom','post','normal' ); // Custom Fields Metabox
    remove_meta_box( 'postexcerpt','post','normal' ); // Excerpt Metabox
    remove_meta_box( 'commentstatusdiv','post','normal' ); // Comments Metabox
    remove_meta_box( 'trackbacksdiv','post','normal' ); // Talkback Metabox
    remove_meta_box( 'authordiv','post','normal' ); // Author Metabox
}
add_action('admin_menu','f1_remove_default_post_metaboxes');

/**
 * Remove meta boxes from default pages screen
 */
function f1_remove_default_page_metaboxes() {
    remove_meta_box( 'postcustom','page','normal' ); // Custom Fields Metabox
    remove_meta_box( 'commentstatusdiv','page','normal' ); // Discussion Metabox
    remove_meta_box( 'authordiv','page','normal' ); // Author Metabox
}
add_action( 'admin_menu','f1_remove_default_page_metaboxes' );

/**
 * Stop automatically hyperlinking images to themselves
 */
$image_set = get_option( 'image_default_link_type' );

if ( ! $image_set == 'none' ) {
    update_option( 'image_default_link_type', 'none' );
}

/**
 * Customize the Yoast SEO columns
 */
add_filter( 'wpseo_use_page_analysis', '__return_false' );

/**
 * Add shortcode support
 */
include( get_template_directory() . '/shortcode_maker.php' );
