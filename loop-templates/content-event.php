<?php
/**
 * The template for event post type
 *
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$event_date = get_field( 'event_date', get_the_ID() );
$event_time = get_field( 'event_time', get_the_ID() );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <div class="entry-content">
        <?php the_title( '<h3 class="post-title">', '</h3>' ); ?>
        <h3 class="event-date"><?php echo $event_date; ?><?php echo $event_time ? ' / ' . $event_time . ' EST' : ''; ?></h3>
        <div class="post-content"><?php echo get_the_excerpt(); ?></div>        
    </div>
    
    <div class="post-thumbnail">
        <?php echo get_the_post_thumbnail(); ?>
    </div>
    
</article><!-- #post-<?php the_ID(); ?> -->