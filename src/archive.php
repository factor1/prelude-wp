<?php
  /**
   * The archive template.
   *
   * Used when a category, author, or date is queried.
   */
  get_header();
?>

  <section>
    <?php if ( have_posts() ) : ?>
      <?php $post = $posts[ 0 ]; ?>

      <div>
        <?php if ( is_category() ) : ?>
          <h2>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
        <?php elseif ( is_tag() ) : ?>
          <h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
        <?php elseif ( is_day() ) : ?>
          <h2>Archive for <?php the_time( 'F jS, Y' ); ?></h2>
        <?php elseif ( is_month() ) : ?>
          <h2>Archive for <?php the_time( 'F, Y' ); ?></h2>
        <?php elseif ( is_year() ) : ?>
          <h2 class="pagetitle">Archive for <?php the_time( 'Y' ); ?></h2>
        <?php elseif ( is_author() ) : ?>
          <h2 class="pagetitle">Author Archive</h2>
        <?php elseif ( isset($_GET[ 'paged' ]) && !empty($_GET[ 'paged' ]) ) : ?>
          <h2 class="pagetitle">Blog Archives</h2>
        <?php endif; ?>

        <?php while ( have_posts() ) : the_post(); ?>
          <div <?php post_class(); ?>>
            <h2 id="post-<?php the_ID(); ?>"><a
                href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php
              get_template_part( 'parts/meta' );
              the_content();
            ?>
          </div>
        <?php endwhile; ?>

        <?php the_posts_pagination( array('mid_size' => 2) ); ?>
      </div>
    <?php else : ?>
      <h2>Nothing found</h2>
    <?php endif; ?>
  </section>

<?php
  get_footer();
