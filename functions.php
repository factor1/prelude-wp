<?php

  define( 'THEME_VERSION', '0.0.1' );

  /**
   * Load tweaks
   */
  require get_template_directory() . '/inc/tweaks.php';

  /**
   * Load CSS and JavaScript Enqueues
   */
  require get_template_directory() . '/inc/enqueues.php';

  /**
   * Load menus
   */
  require get_template_directory() . '/inc/menus.php';

  /**
   * Load custom post types
   */
  require get_template_directory() . '/inc/custom-post-types.php';

  /**
   * Load widgets
   */
  require get_template_directory() . '/inc/widgets.php';

  /**
   * Load thumbnail support and sizes
   */
  require get_template_directory() . '/inc/thumbnails.php';

  /**
   * Load shortcodes
   */
  require get_template_directory() . '/inc/shortcodes.php';
