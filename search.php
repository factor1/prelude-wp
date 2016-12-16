<?php
  /**
   * The search results template.
   *
   * Used when a search is performed.
   */
  get_header();
?>

  <section class="main-content">
    <?php if ( have_posts() ) : ?>
      <h2>Search Results</h2>

      <?php the_posts_pagination( array('mid_size' => 2) ); ?>

      <?php while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <h2><?php the_title(); ?></h2>
          <?php
            get_template_part( 'parts/meta' );
            the_excerpt();
          ?>
        </div>
        <?php
      endwhile;
      the_posts_pagination( array('mid_size' => 2) );
    else : ?>
      <h2>Sorry, no posts have been found.</h2>
    <?php endif; ?>
  </section>

<?php
  get_footer();
