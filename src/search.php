<?php
  /**
   * The search results template.
   *
   * Used when a search is performed.
   */
  get_header();

  if( have_posts() ):

    while( have_posts() ): the_post();

    endwhile;

    the_posts_pagination( array('mid_size' => 2) );

  endif;

  get_footer();
