<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php endif; ?>
  <?php if (is_search()) { ?>
   <meta name="robots" content="noindex, nofollow" />
	<?php } ?>

  <meta property="og:title" content="<?php the_title(); ?>" />
  <meta property="og:site_name" content="<?php bloginfo('name') ?>">

  <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

  <header><!-- Header -->
    <h1 class="logo">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
    </h1>
    <nav class="main-nav">
      <?php wp_nav_menu( array('theme_location' => 'primary') ); ?>
    </nav>
    <?php get_search_form(); ?>
  </header>

  <?php // Main Content ?>
  <main>
