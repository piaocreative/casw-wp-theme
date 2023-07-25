<?php
/**
 * The template for featured post
 *
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'featured-post' ); ?> id="post-<?php the_ID(); ?>" style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>)">
    <div class="entry-content">
        <h3 class="post-title"><?php echo get_the_title(); ?></h3>
        <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="btn btn-dark text-uppercase post-permalink">More</a>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->