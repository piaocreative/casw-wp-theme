<?php
/**
 * The template for newsletter post type
 *
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$published_date = get_field( 'published_date', get_the_ID() );
$newsletter_link = get_field( 'newsletter_link', get_the_ID() );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <div class="entry-content">
        <h3 class="post-date"><?php echo date( 'F Y', strtotime( $published_date ) ); ?></h3>
        <div class="post-content"><?php echo get_the_content(); ?></div>
        
        <?php if ( $newsletter_link ) : ?>
            <a class="btn btn-secondary" href="<?php echo esc_url( $newsletter_link ); ?>" target="blank">View</a>
        <?php endif; ?>
    </div>
    
    <div class="post-thumbnail">
        <?php echo get_the_post_thumbnail(); ?>
    </div>
    
</article><!-- #post-<?php the_ID(); ?> -->