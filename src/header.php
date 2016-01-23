<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php endif; ?>

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

  <header><!-- Header -->
    <h1 class="logo">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo(
          'name' ); ?></a>
    </h1>
    <nav class="main-nav">
      <?php wp_nav_menu( array('theme_location' => 'primary') ); ?>
    </nav>
    <?php get_search_form(); ?>
  </header>

  <main><!-- Main -->
