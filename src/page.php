<?php
  /**
   * The default page template.
   *
   * Used when a default template individual page is queried.
   */
  get_header();
?>

  <section class="main-content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" class="post">
        <?php if ( has_post_thumbnail() ) {
          the_post_thumbnail();
        } ?>
        <h1><?php the_title(); ?></h1>
        <?php
          the_content();
          edit_post_link( 'Edit this entry.', '<hr><p>', '</p>' );
        ?>
      </article>
    <?php endwhile; endif; ?>
  </section>

<?php
  get_footer();
