<?php

/**
 * Template Name: Home Page
 * Description: The template for displaying landing page.
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

// ACF Fields
$hero_section = get_field( 'hero_section' );
$resources_section = get_field( 'resources_section' );
$featured_content = get_field( 'featured_content' );
$events_section = get_field( 'events_section' );
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
            <?php if ( $hero_section['search_form_shortcode'] ) : ?>
              <div class="search-form">
                <?php echo do_shortcode( $hero_section['search_form_shortcode'] ); ?>
              </div>
            <?php endif; ?>
            <h2 class="">Quick Links</h2>
            <?php if ( $hero_section['quick_links'] ) : ?>
              <ul class="quick-links">
                <?php foreach ( $hero_section['quick_links'] as $item ) : ?>
                  <li>
                  <?php                   
                  if ( $item['link'] ) : 
                    $link_url = $item['link']['url'];
                    $link_title = $item['link']['title'];
                    $link_target = $item['link']['target'] ? $item['link']['target'] : '_self';
                    ?>
                    <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                  <?php endif; ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <?php if ( $hero_section['search_library_link'] ) :
              $link_url = $hero_section['search_library_link']['url'];
              $link_title = $hero_section['search_library_link']['title'];
              $link_target = $hero_section['search_library_link']['target'] ? $hero_section['search_library_link']['target'] : '_self';
              ?>
              <a class="btn btn-secondary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>              
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
        <?php if ( $resources_section['title'] ) : ?>
          <h2 class="text-center"><?php echo $resources_section['title']; ?></h2>
        <?php endif; ?>
        <div class="row resources">
          <?php
          $args = array(
            'post_type' => 'post-resource',
            'post_status' => 'publish',
            'posts_per_page' => $resources_section['resources_count'],
            'orderby' => 'date',
            'order' => 'desc',
          );

          $custom_query = new WP_Query( $args );

          if ( $custom_query->have_posts() ) :
            while ( $custom_query->have_posts() ) :
              $custom_query->the_post();
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

  <!-- Featured Content -->
  <?php if ( $featured_content ) : ?>
    <section id="featured_content" class="section">
      <div class="<?php echo esc_attr($container); ?>">
        <div class="row">
          <div class="col-12">
            <div class="featured-header">
              <?php if ( $featured_content['title'] ) : ?>
                <h2 class="text-white"><?php echo $featured_content['title']; ?></h2>
              <?php endif; ?>
              <div class="slider-arrows">
                <a href="javascript:void(0);" class="prev">
                  <svg width="33" height="27" viewBox="0 0 33 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.75565 11.75L32.5 11.75L32.5 15.25L8.75565 15.25L7.53936 15.25L8.40399 16.1054L16.1244 23.7437L13.6389 26.2905L0.71092 13.5L13.6389 0.709511L16.1244 3.25632L8.40399 10.8946L7.53936 11.75L8.75565 11.75Z" fill="white" stroke="#1C3D6F"/>
                  </svg>
                </a>
                <a href="javascript:void(0);" class="next">
                  <svg width="33" height="27" viewBox="0 0 33 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.2444 15.25H0.5V11.75H24.2444H25.4606L24.596 10.8946L16.8756 3.25632L19.3611 0.709514L32.2891 13.5L19.3611 26.2905L16.8756 23.7437L24.596 16.1054L25.4606 15.25H24.2444Z" fill="white" stroke="#1C3D6F"/>
                  </svg>
                </a>
              </div>
            </div>
            <?php if ( $featured_content['posts'] ) : ?>
              <div class="featured-posts">
                <?php
                foreach ( $featured_content['posts'] as $post ) :
                  setup_postdata($post);
                  ?>
                  <div class="slider-post-item">
                    <?php get_template_part( 'loop-templates/content', 'featured-post' ); ?>
                  </div>
                  <?php
                endforeach;
                ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- Events Section -->
  <?php if ( $events_section ) : ?>
    <section id="events_section" class="section">
      <div class="<?php echo esc_attr($container); ?>">
        <div class="row">
          <div class="col-12">
            <?php if ( $events_section['title'] ) : ?>
              <h2 class="text-center"><?php echo $events_section['title']; ?></h2>
            <?php endif; ?>
            <?php if ( $events_section['embed_code'] ) : ?>
              <?php echo $events_section['embed_code']; ?>
            <?php endif; ?>
            <div class="row" id="upcoming_events">
              <?php
              $today = date('Y-m-d');
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
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- Resource post modal -->
  <!-- <div id="resource-modal" class="mfp-hide">
    <div class="modal-banner">
      <i class="fa fa-address-book mx-3"></i>
    </div>
    <div class="modal-content-wapper">
      <img src="" alt="modal-image">
      <div class="modal-content">
        <h2 class="post-title"></h2>
        <p class="resource-content"></p>
        <p class="resource-organization"></p>

        <a href="" class="btn btn-secondary post-permalink mx-auto">VISIT <i class="fa fa-link mx-3"></i></a>
      </div>
    </div>
  </div> -->

<?php
get_footer();