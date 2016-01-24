<?php
  /**
   * Template file for displaying the navigation between paginated blog posts
   *
   * Can be used in place of the_posts_pagination();
   */
?>

<nav class="post-nav">
  <div class="post-next">
    <?php next_posts_link( '&laquo; Older Entries' ); ?>
  </div>
  <div class="post-prev">
    <?php previous_posts_link( 'Newer Entries &raquo;' ); ?>
  </div>
</nav>
