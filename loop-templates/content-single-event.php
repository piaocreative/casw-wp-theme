<?php
/**
 * The template for resource post type
 *
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

// ACF Fields
$event_date = get_field( 'event_date', get_the_ID() );
$event_time = get_field( 'event_time', get_the_ID() );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <header class="entry-header">
        
        <div class="<?php echo esc_attr( $container ); ?>">

            <?php the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>
            <p class="text-center"><?php echo $event_date; ?><?php echo $event_time ? ' / ' . $event_time . ' EST' : ''; ?></p>
        
        </div>

    </header><!-- .entry-header -->

    <div class="<?php echo esc_attr( $container ); ?>">

        <div class="entry-content">
            
            <div class="post-thumbnail">
                <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
            </div>
            
            <?php the_title( '<h3 class="post-title">', '</h3>' ); ?>
            
            <h3 class="event-date"><?php echo $event_date; ?><?php echo $event_time ? ' / ' . $event_time . ' EST' : ''; ?></h3>

            <div class="post-content">
                <?php the_content(); ?>
            </div>            

        </div><!-- .entry-content -->
        
    </div>

</article><!-- #post-<?php the_ID(); ?> -->