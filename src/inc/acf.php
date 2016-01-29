<?php
  /*-----------------------------------------------------------------------------
    Custom Advanced Custom Fields
  -----------------------------------------------------------------------------*/
  // Add ACF theme options panel
  if ( function_exists( 'acf_add_options_page' ) ) {
    $page = acf_add_options_page(
      array(
        'page_title' => 'Theme Settings', 'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-settings', 'capability' => 'edit_posts',
        'redirect'   => false
      )
    );
  }
