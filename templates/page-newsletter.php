<?php

/**
 * Template Name: Newsletter Page Template
 * Description: The template for displaying Newsletter page.
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

// ACF Fields
$hero_section = get_field( 'hero_section' );
$newsletters_section = get_field( 'newsletters_section' );
?>

<div class="wrapper" id="page-wrapper">

  <!-- Hero Section -->
  <?php if ( $hero_section ) : ?>
    <section class="hero">
      <div class="<?php echo esc_attr($container); ?>">
        <div class="row">
          <div class="col-12 text-center">
            <?php if ( $hero_section['title'] ) : ?>
              <h1><?php echo $hero_section['title']; ?></h1>
            <?php endif; ?>
            <?php if ( $hero_section['content'] ) : ?>
              <div class="content text-center">
                <?php echo $hero_section['content']; ?>
              </div>
            <?php endif; ?>
            <?php if ( $hero_section['form_shortcode'] ) : ?>
              <div class="form-wrapper">
                <?php echo do_shortcode( $hero_section['form_shortcode'] ); ?>
              </div>
            <?php endif; ?>
          </div>
        </div><!-- .row -->
      </div><!-- #container -->
    </section><!-- #page-section -->
  <?php endif; ?>

  <!-- Newsletters Section -->
  <section id="newsletters_section" class="section">
    <div class="<?php echo esc_attr( $container ); ?>">
      <h2 class="text-center">Past Newsletters</h2>
      <div class="row newsletters">
        <?php
        $args = array(
          'post_type' => 'post-newsletter',
          'posts_per_page' => 8,
          'orderby' => 'date',
          'order' => 'ASC',
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ):
          while ( $query->have_posts() ):
            $query->the_post();
            ?>

            <div class="col-lg-6">
              <?php get_template_part( 'loop-templates/content', 'newsletter' ); ?>
            </div>

            <?php
            // endif;
          endwhile;
        endif;

        wp_reset_postdata();
        ?>
      </div>

      <div class="text-center">
        <a class="btn btn-secondary" href="#">Search Our Library</a>
      </div>

    </div><!-- .container-{fluid} -->
  </section><!-- #page-section -->

<?php
get_footer();