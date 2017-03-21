<?php
  /**
   * The default page template.
   *
   * Used when a default template individual page is queried.
   */
  get_header();
?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>

    <?php endwhile; endif;

  get_footer();
