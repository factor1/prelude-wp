<?php
	
// Lets make some shortcodes
include(get_template_directory().'/shortcode_maker.php');

// Strip P and BR tags for shortcodes
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12);

	
// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"), false);
	   wp_enqueue_script('jquery');
	}
	
//Customize Wordpress Admin

	// add login logo
	function custom_loginlogo() {
	echo '<style type="text/css">
	h1 a {
		height: 100% !important; 
		width:100% !important;
		background-image: url('.get_bloginfo('template_directory').'/images/logo-login.png) !important;
		background-postion-x: center !important;
		background-size:100% !important; 
		margin-bottom:10px !important; }
	
	h1 {
		width: 320px !important; 
		Height: 120px !important}
		
	</style>';
	}
	
	add_action('login_head', 'custom_loginlogo');
	
	
	// add custom footer text
	function modify_footer_admin () {
		echo 'Created by <a href="http://factor1studios.com"><strong>factor1</strong></a>. ';
		echo 'Powered by<a href="http://WordPress.org">WordPress</a>.';
		}

	add_filter('admin_footer_text', 'modify_footer_admin');

/// Dump the yoast SEO columns that are ugly and messy
add_filter( 'wpseo_use_page_analysis', '__return_false' );
	
// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    
// Remove WP version from html header  
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
   
    
//  Stop automatically hyperlinking images to themselves
$image_set = get_option( 'image_default_link_type' );
    if (!$image_set == 'none') {
        update_option('image_default_link_type', 'none');
    }
        
// add theme supports and nav menus
	add_action( 'after_setup_theme', 'f1_setup' );
	function f1_setup() {
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );

	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'start_post_rel_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link' );

	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'f1' ),
	) );
}



// add page excerpts
	function page_excerpt() {
	add_post_type_support('page', array('excerpt'));
	}
	add_action('init', 'page_excerpt');
	


// register widget areas
	add_action( 'widgets_init', 'f1_widgets_init', 1 );
	function f1_widgets_init() {
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Recent_Comments' );

	register_sidebar( array(
		'name' => __( 'Sidebar', 'f1' ),
		'id' => 'sidebar',
		'description' => __( 'The primary widget area on the right side', 'f1' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

}

// change default "read more" link
	function f1_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'f1' ) . '</a>';
	}

// change default [...]
	add_filter( 'excerpt_more', 'f1_auto_excerpt_more' );
	function f1_auto_excerpt_more( $more ) {
	return ' &hellip;' . f1_continue_reading_link();
	}

// remove the gallery style that is automatically added
	add_filter( 'gallery_style', 'f1_remove_gallery_css' );
	function f1_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
	}

// remove the recent comments style that is automatically added
	add_action( 'widgets_init', 'f1_remove_recent_comments_style' );
	function f1_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'  ) );
	}

// remove update notifications for everybody except admin users
	global $user_login;
	get_currentuserinfo();
	if ( ! current_user_can( 'update_plugins' ) ) { // checks to see if current user can update plugins 
	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
	add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
	}

// remove dashboard boxes
	add_action( 'admin_menu', 'f1_remove_dashboard_boxes' );
	function f1_remove_dashboard_boxes() {
        // remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' ); // Right Now Overview Box
        // remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' ); // Incoming Links Box
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' ); // Quick Press Box
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' ); // Plugins Box
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' ); // Recent Drafts Box
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); // Recent Comments
        remove_meta_box( 'dashboard_primary', 'dashboard', 'core' ); // WordPress Development Blog
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' ); // Other WordPress News
}

// remove meta boxes from default posts screen
	add_action('admin_menu','f1_remove_default_post_metaboxes');
	function f1_remove_default_post_metaboxes() {
        remove_meta_box( 'postcustom','post','normal' ); // Custom Fields Metabox
        remove_meta_box( 'postexcerpt','post','normal' ); // Excerpt Metabox
        remove_meta_box( 'commentstatusdiv','post','normal' ); // Comments Metabox
        remove_meta_box( 'trackbacksdiv','post','normal' ); // Talkback Metabox
        //remove_meta_box( 'authordiv','post','normal' ); // Author Metabox
}

// remove meta boxes from default pages screen
	add_action('admin_menu','f1_remove_default_page_metaboxes');
	function f1_remove_default_page_metaboxes() {
	remove_meta_box( 'postcustom','page','normal' ); // Custom Fields Metabox
	//remove_meta_box( 'commentstatusdiv','page','normal' ); // Discussion Metabox
	//remove_meta_box( 'authordiv','page','normal' ); // Author Metabox
}

?>