<?php
  /**
   * The single post template.
   * 
   * Used when a single post is queried.
   */
  get_header();
?>

  <section class="main-content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1><?php the_title(); ?></h1>
        <?php
          get_template_part( 'parts/meta' );
          if ( has_post_thumbnail() ) {
            the_post_thumbnail();
          }
          the_content();
          wp_link_pages(
            array(
              'before' => 'Pages: ', 'next_or_number' => 'number'
            ) );
          the_tags( 'Tags: ', ', ', '' );
          edit_post_link( 'Edit this entry', '', '.' );
        ?>
      </article>
      <?php
      comments_template();
    endwhile; endif; ?>
  </section>

<?php
  get_footer();
