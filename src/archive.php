<?php
  /**
   * The archive template.
   *
   * Used when a category, author, or date is queried.
   */
  get_header();

  if( have_posts() ):
    while( have_posts() ):
      the_post();

      // do your thing

    endwhile;
  endif;

  get_footer();
