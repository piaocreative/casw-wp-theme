<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

// ACF Fields
$form_shortcode = get_field( 'form_shortcode', 'option' );
$copyrights = get_field( 'copyrights', 'option' );
?>
<!-- Footer Section -->

<footer id="wrapper-footer" class="wrapper">

  <div class="<?php echo esc_attr( $container ); ?>">

    <div class="row" id="footer-main">

      <div class="col-lg-6 col-xl-3 mb-5 mb-xl-0">
        <?php if ( is_active_sidebar( 'footer-widget-1' ) ) : ?>
          <?php dynamic_sidebar( 'footer-widget-1' ); ?>
        <?php endif; ?>
      </div>

      <div class="col-lg-12 col-xl-3 mb-5 mb-xl-0">
        <?php if ( is_active_sidebar( 'footer-widget-2' ) ) : ?>
          <?php dynamic_sidebar( 'footer-widget-2' ); ?>
        <?php endif; ?>
      </div><!--col end -->

      <div class="col-lg-6 col-xl-6 mb-5 mb-xl-0">
        <?php if ( is_active_sidebar( 'footer-widget-3' ) ) : ?>
          <?php dynamic_sidebar( 'footer-widget-3' ); ?>
        <?php endif; ?>
        <?php if ( $form_shortcode ) : ?>
          <div class="form-wrapper">
            <?php echo do_shortcode( $form_shortcode ); ?>
          </div>
        <?php endif; ?>
      </div>

    </div><!-- #footer-main -->

    <div class="row" id="footer-bottom">
      <div class="col-12 text-center">
        <?php if ( $copyrights ) : ?>
          <div class="copyrights">© <?php echo date('Y');?>. <?php echo $copyrights; ?></div>
        <?php endif; ?>
      </div>
    </div><!-- #footer-bottom -->

  </div><!-- container end -->

</footer><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

<script type="text/javascript" src="//app.pageproofer.com/embed/2a107d1b-8236-575b-9215-d19b963ec96e" async="true"></script>
</body>

</html>