<?php
  /*-----------------------------------------------------------------------------
    Register Widget areas
  -----------------------------------------------------------------------------*/
  function prelude_widgets_init() {
    register_sidebar(
      array(
        'name'          => __( 'Sidebar', 'theme-slug' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
      ) );
    register_sidebar(
      array(
        'name'          => __( 'Footer Area 1', 'theme-slug' ),
        'id'            => 'footer-widget',
        'description'   => 'Appears in the first footer area',
        'before_widget' => '<aside id="footer-widget" class="footer-widget">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
      ) );
    register_sidebar(
      array(
        'name'          => __( 'Footer Area 2', 'theme-slug' ),
        'id'            => 'footer-widget-2',
        'description'   => 'Appears in the second footer area',
        'before_widget' => '<aside id="footer-widget-2" class="footer-widget">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
      ) );
    register_sidebar(
      array(
        'name'          => __( 'Footer Area 3', 'theme-slug' ),
        'id'            => 'footer-widget-3',
        'description'   => 'Appears in the third footer area',
        'before_widget' => '<aside id="footer-widget-3" class="footer-widget">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
      ) );
    register_sidebar(
      array(
        'name'          => __( 'Footer Area 4', 'theme-slug' ),
        'id'            => 'footer-widget-4',
        'description'   => 'Appears in the fourth footer area',
        'before_widget' => '<aside id="footer-widget-4" class="footer-widget">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
      ) );

    unregister_widget( 'WP_Widget_Calendar' );
    unregister_widget( 'WP_Widget_Links' );
    unregister_widget( 'WP_Widget_Meta' );
    unregister_widget( 'WP_Widget_Search' );
    unregister_widget( 'WP_Widget_Recent_Comments' );
  }
  add_action( 'widgets_init', 'prelude_widgets_init' );
