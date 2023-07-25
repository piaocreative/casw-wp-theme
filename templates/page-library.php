<?php

/**
 * Template Name: Library Page Template
 * Description: The template for displaying Library page.
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

// ACF Fields
$hero_section = get_field( 'hero_section' );
$resources_section = get_field( 'resources_section' );
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
          </div>
        </div><!-- .row -->
      </div><!-- #container -->
    </section><!-- #page-section -->
  <?php endif; ?>

  <!-- Resources Section -->
  <?php if ( $resources_section ) : ?>
    <section id="resource_section" class="section">
      <div class="<?php echo esc_attr( $container ); ?>">
        <h2 class="text-center">Library</h2>
        <div class="search-filter">
          <?php if ( $resources_section['search_form_shortcode'] ) : ?>
            <?php echo do_shortcode( $resources_section['search_form_shortcode'] ); ?>
          <?php endif; ?>
          <div class="view-options">
            <a href="javascript:void(0);" class="active" data-view="card">
              <span class="card-view-icon icon"></span>
              Card View
            </a>
            <a href="javascript:void(0);" data-view="list">
              <span class="list-view-icon icon"></span>
              List View
            </a>
          </div>
        </div>
        <div class="row resources">          
          <?php
          $args = array( 'post_type' => 'post-resource' );
          $args['search_filter_id'] = 300;
          $query = new WP_Query( $args );

          if ( $query->have_posts() ) :
            while ( $query->have_posts() ) :
              $query->the_post();
              ?>

              <div class="col-lg-4 col-md-6">
                <?php get_template_part( 'loop-templates/content', 'resource' ); ?>
              </div>

              <?php
              // endif;
            endwhile;
          endif;

          wp_reset_postdata();
          ?>
        </div>
      </div><!-- .container-{fluid} -->
    </section><!-- #page-section -->
  <?php endif; ?>

<?php
get_footer();