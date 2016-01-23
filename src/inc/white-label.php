<?php
  /*-----------------------------------------------------------------------------
    Custom Theme White Labeling
  -----------------------------------------------------------------------------*/
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
    return esc_url( home_url( '/' ) );
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
    echo 'Powered by <a href="http://WordPress.org">WordPress</a>.';
  }

  add_filter( 'admin_footer_text', 'f1_change_footer_admin' );

  // Add a custom WordPress dashboard widget
  function f1_dashboard_widgets() {
    wp_add_dashboard_widget(
      'wp_dashboard_widget', 'Keep In Touch With factor1', 'f1_theme_info' );
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
