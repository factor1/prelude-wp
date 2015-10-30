<?php
/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );

/**
 * Add shortcode support
 */
include( get_template_directory().'/shortcode_maker.php' );

/**
 * Load jQuery
 */
if ( ! is_admin() ) {
   wp_deregister_script( 'jquery' );
   wp_register_script( 'jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"), false );
   wp_enqueue_script( 'jquery' );
}

/**
 * Customize the WordPress logo on the login screen
 */
function custom_login_logo() {
    echo '<style type="text/css">
        h1 a {
        	height: 100% !important;
        	width: 100% !important;
        	background-image: url('.get_bloginfo( 'template_directory' ).'/images/logo-login.png) !important;
        	background-postion-x: center !important;
        	background-size: 100% !important;
        	margin-bottom: 10px !important;
        }

        h1 {
        	width: 320px !important;
        	height: 120px !important;
        }
    </style>';
}

add_action( 'login_head', 'custom_login_logo' );

/**
 * Customize the footer text in the admin area
 */
function modify_footer_admin () {
	echo 'Created by <a href="http://factor1studios.com"><strong>factor1</strong></a>. ';
	echo 'Powered by<a href="http://WordPress.org">WordPress</a>.';
}

add_filter( 'admin_footer_text', 'modify_footer_admin' );

/**
 * Customize the Yoast SEO columns
 */
add_filter( 'wpseo_use_page_analysis', '__return_false' );

/**
 * Stop automatically hyperlinking images to themselves
 */
$image_set = get_option( 'image_default_link_type' );

if ( ! $image_set == 'none' ) {
    update_option( 'image_default_link_type', 'none' );
}

/**
 * Add theme supports and navigation menus
 */
function f1_setup() {
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );
    add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'start_post_rel_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link' );

	register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'f1' ),
        'footer'  => __( 'Footer Navigation', 'f1' ),
        'social'  => __( 'Social Media Navigation', 'f1' ),
        'mobile'  => __( 'Mobile Navigation', 'f1' ),
	) );
}

add_action( 'after_setup_theme', 'f1_setup' );

/**
 * Add page excerpts
 */
function page_excerpt() {
    add_post_type_support( 'page', array( 'excerpt' ) );
}

add_action( 'init', 'page_excerpt' );

/**
 * Add custom widget areas
 */
function f1_widgets_init() {
    unregister_widget( 'WP_Widget_Calendar' );
    unregister_widget( 'WP_Widget_Links' );
    unregister_widget( 'WP_Widget_Meta' );
    unregister_widget( 'WP_Widget_Search' );
    unregister_widget( 'WP_Widget_Recent_Comments' );

    register_sidebar( array(
        'name'          => __( 'Sidebar', 'f1' ),
        'id'            => 'sidebar',
        'description'   => __( 'The primary widget area on the right side', 'f1' ),
        'before_widget' => '<aside id="%1$s" class="widget-container %2$s" role="complementary">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}

add_action( 'widgets_init', 'f1_widgets_init', 1 );

/**
 * Customize the default read more link
 */
function f1_continue_reading_link() {
    return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'f1' ) . '</a>';
}

/**
 * Customize the default ...
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
