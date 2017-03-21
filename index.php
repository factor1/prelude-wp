<?php
  /**
   * The default blog / index template.
   */
  get_header();

  if ( have_posts() ) : while ( have_posts() ) : the_post();

    the_content();

  endwhile;
      the_posts_pagination( array('mid_size' => 2) );
  else :
    echo '<h2>Sorry, no posts have been found</h2>';
  endif;

  get_footer();
