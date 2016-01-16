<?php
  /**
   * Content area that displays a hero image and the page title.
   * This file is meant to be included into other template files, and will only display a hero image if the post has a
   * featured image
   */
?>


<?php
  if ( has_post_thumbnail() ) :
    if ( have_posts() ) :
      while ( have_posts() ) :
        the_post();
        $thumbId  = get_post_thumbnail_id();
        $thumbUrl = wp_get_attachment_image_src( $thumbId, true );
        ?>
        <section class="hero" style="background: url('<?php echo $thumbUrl[ 0 ]; ?>') center center no-repeat">
          <h1 class="page-title"><?php the_title(); ?></h1>
        </section>
      <?php endwhile;
    endif;
  else : ?>
    <section class="banner">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </section>
  <?php endif; ?>
