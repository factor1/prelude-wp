</main><!-- close Main -->

<footer class="footer"><!-- Footer -->
  <section class="footer-top">
    <div class="row">
      <div class="medium-3 columns">
        <?php if ( is_active_sidebar( 'footer-widget' ) ) {
          dynamic_sidebar( 'footer-widget' );
        } ?>
      </div>
      <div class="medium-3 columns">
        <?php if ( is_active_sidebar( 'footer-widget-2' ) ) {
          dynamic_sidebar( 'footer-widget-2' );
        } ?>
      </div>
      <div class="medium-3 columns">
        <?php if ( is_active_sidebar( 'footer-widget-3' ) ) {
          dynamic_sidebar( 'footer-widget-3' );
        } ?>
      </div>
      <div class="medium-3 columns">
        <?php if ( is_active_sidebar( 'footer-widget-4' ) ) {
          dynamic_sidebar( 'footer-widget-4' );
        } ?>
      </div>
    </div>
  </section>

  <section class="footer-bottom">
    <a class="copyright" href="http://factor1studios.com" target="_blank">Site
      by <strong>factor1</strong></a>
  </section>
</footer>

<?php wp_footer(); ?>
</body>
</html>
