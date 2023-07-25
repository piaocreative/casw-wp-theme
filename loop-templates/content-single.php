<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<!--
	<header class="entry-header">
	
		<div class="<?php echo esc_attr( $container ); ?>">

			<?php the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>
		
		</div>

	</header>--><!-- .entry-header -->
	
	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="entry-content">
			
			<div class="post-thumbnail">
				<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
			</div>			
			
			<?php the_title( '<h2 class="post-title">', '</h2>' ); ?>

			<div class="post-content">
				<?php the_content(); ?>
			</div>
			
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			?>

		</div><!-- .entry-content -->
		
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
