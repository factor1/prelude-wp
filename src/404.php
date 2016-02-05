<?php
  /**
   * The 404 Not Found template.
   * 
   * Used when WordPress encounters an unknown URL.
   */
  get_header();
?>

  <section class="error-404">
    <h1>Hmm, that page does not exist...</h1>
    <p>Maybe you can find what you are looking for <a
        href="<?php echo esc_url( home_url( '/' ) ); ?>">here</a>.</p>
    <p>Or try searching below...</p>
    <?php get_search_form(); ?>
  </section>

<?php
  get_sidebar();
  get_footer();
