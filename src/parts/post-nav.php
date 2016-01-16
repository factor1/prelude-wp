<?php
  /**
   * Template file for displaying the navigation between paginated blog posts
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
