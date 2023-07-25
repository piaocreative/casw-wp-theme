<?php

/**
 * Template Name: Events Page Template
 * Description: The template for displaying Events page.
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

// ACF Fields
$hero_section = get_field( 'hero_section' );

$today = date('Y-m-d');
?>

<div class="wrapper" id="page-wrapper">

  <!-- Hero Section -->
  <?php if ( $hero_section ) : ?>
    <section id="hero_section" class="hero">
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

  <!-- Upcoming Events Section -->
  <section id="upcoming_events_section" class="section">
    <div class="<?php echo esc_attr( $container ); ?>">
      <h2 class="text-center">Upcoming Events</h2>
      <div class="row" id="upcoming_events">
        <?php
        $args = array(
          'post_type'         => 'post-event',
          'posts_per_page'    => -1,
          'post_status'       => array('publish'),
          'orderby'           => 'meta_value',
          'meta_key'          => 'event_date',
          'order'             => 'ASC',
          'meta_query'        => array(
            array(
              'key'           => 'event_date',
              'value'         => $today,
              'type'          => 'DATE',
              'compare'       => '>='
            )
          )
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ):
          while ( $query->have_posts() ):
            $query->the_post();
            ?>

            <div class="col-lg-6">
              <?php get_template_part( 'loop-templates/content', 'event' ); ?>
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

  <!-- Past Events Section -->
  <section id="upcoming_events_section" class="section">
    <div class="<?php echo esc_attr( $container ); ?>">
      <h2 class="text-center">Past Events</h2>
      <div class="row" id="upcoming_events">
        <?php
        $args = array(
          'post_type'         => 'post-event',
          'posts_per_page'    => -1,
          'post_status'       => array('publish'),
          'orderby'           => 'meta_value',
          'meta_key'          => 'event_date',
          'order'             => 'DESC',
          'meta_query'        => array(
            array(
              'key'           => 'event_date',
              'value'         => $today,
              'type'          => 'DATE',
              'compare'       => '<'
            )
          )
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ):
          while ( $query->have_posts() ):
            $query->the_post();
            ?>

            <div class="col-lg-6">
              <?php get_template_part( 'loop-templates/content', 'event' ); ?>
            </div>

            <?php
            // endif;
          endwhile;
        endif;

        wp_reset_postdata();
        ?>
      </div>

      <!-- <div class="text-center">
        <a class="btn btn-secondary" href="#">Explore Past Events</a>
      </div> -->

    </div><!-- .container-{fluid} -->
  </section><!-- #page-section -->

<?php
get_footer();