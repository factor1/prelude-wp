<?php
  /**
   * The default blog / index template.
   */
  get_header();
?>

  <section class="main-content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php
          if ( has_post_thumbnail() ) {
            the_post_thumbnail();
          }
          get_template_part( 'parts/meta' );
          the_content();
        ?>
      </article>
      <?php
    endwhile;
      the_posts_pagination( array('mid_size' => 2) );
    else :
      ?>
      <h2>Sorry, no posts have been found</h2>
    <?php endif; ?>
  </section>

<?php
  get_footer();
