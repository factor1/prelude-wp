<?php
  /*-----------------------------------------------------------------------------
    Register Custom Menus
  -----------------------------------------------------------------------------*/
  function custom_menus() {
    register_nav_menus(
      array(
        'primary' => __( 'Primary Menu', 'theme-slug' ),
        'footer'  => __( 'Footer Menu', 'theme-slug' ),
        'social'  => __( 'Social Menu', 'theme-slug' ),
        'long'    => __( 'Long Test Menu', 'theme-slug' ), // exists only for testing
        'short'   => __( 'Short Test Menu', 'theme-slug' ), // exists only for testing
      ) );
  }
  add_action( 'init', 'custom_menus' );

  // Social media icon menu as per http://justintadlock.com/archives/2013/08/14/social-nav-menus-part-2
  function social_menu() {
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
