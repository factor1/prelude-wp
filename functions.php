<?php
/**
 * Set up the theme and its base settings
 * This wrapper makes it possible for child themes to overrite these functions
 */
if ( ! function_exists('f1_features') ) {

    // Register Theme Features
    function f1_features()  {

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

        // Add custom menus
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
    }
    add_action( 'after_setup_theme', 'f1_features' );
}

/**
 * Link to all theme CSS files
 */
function f1_theme_css() {
    // Add FontAwesome
    wp_enqueue_style( 'font_awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
    // Link to theme.min.css
    wp_enqueue_style( 'theme_css', get_template_directory_uri() . '/css/theme.min.css' );
}
add_action( 'wp_enqueue_scripts', 'f1_theme_css' );

/**
 * Link to all theme JS files
 */
function f1_theme_js() {
    // Add theme JS in the footer
    wp_enqueue_script( 'theme_js', get_template_directory_uri() . '/js/main.min.js', array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'f1_theme_js' );

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
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'f1_widgets_init' );
