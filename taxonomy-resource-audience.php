<?php

/**
 * Template Name: Resources Page
 * Description: The template for displaying resources page.
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

// Container
$container = get_theme_mod( 'understrap_container_type' );

$hero_section = get_field( 'hero_section', 316 );

// Query object
$queried_object = get_queried_object();
?>

<div class="wrapper" id="page-wrapper">

  <!-- Hero Section -->
  <section class="hero">
    <div class="<?php echo esc_attr($container); ?>">
      <div class="row">
        <div class="col-12 text-center">
          <h1><?php echo $hero_section['title']; ?></h1>
          <div class="content text-center">
            <?php echo $hero_section['content']; ?>
          </div>
        </div>
      </div><!-- .row -->
    </div><!-- #container -->
  </section><!-- #page-section -->

  <!-- Resources Section -->
  <section id="resource_section" class="section">
    <div class="<?php echo esc_attr( $container ); ?>">
      <div class="section-header">
          <h2 class="text-center">Library</h2>
          <span>Topic: <span id="search-results-count"><em><?php echo $queried_object->name; ?></em></span></span>
        </div>
      <div class="search-filter">        
        <?php echo do_shortcode( '[searchandfilter id="300"]' ); ?>
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
        $args = array( 
          'post_type' => 'post-resource',
          'tax_query' => array(
            array(
              'taxonomy' => 'resource-audience',
              'field' => 'term_id',
              'terms' => $queried_object->term_id
            )
          )
        );
        $query = new WP_Query( $args );

        if ( $query->have_posts() ) :
          while ( $query->have_posts() ) :
            $query->the_post();
            ?>

            <div class="resource col-lg-4 col-md-6">
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

<?php
get_footer();