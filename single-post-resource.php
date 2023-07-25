<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-wrapper">
	
	<?php while ( have_posts() ) :
		the_post(); 
		
		// ACF Fields
		$resources_page = get_field( 'resources_page', 'option' );	
		$related_posts = get_field( 'related_posts', get_the_ID() );
		?>

		<div class="wrapper" id="single-post">

			<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

				<div class="row">

					<div class="col-12" id="main">

						<?php get_template_part( 'loop-templates/content', 'single-resource' ); ?>

					</div>

				</div><!-- .row -->

				<?php if ( $resources_page ) : ?>
					<div class="row">
						<div class="col-12 text-center">
						<?php
							$link_url = $resources_page['url'];
							$link_title = $resources_page['title'];
							$link_target = $resources_page['target'] ? $resources_page['target'] : '_self';
							?>
							<a class="btn btn-secondary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						</div>
					</div>
				<?php endif; ?>

			</div><!-- #content -->

		</div><!-- #single-post -->
		
		<?php if ( $related_posts ) : ?>
			
			<div id="related-posts">
				
				<div class="<?php echo esc_attr( $container ); ?>">
				
					<h2 class="text-center">Related Posts</h2>
					
					<div class="row resources">
						<?php foreach ( $related_posts as $post ) : 
							setup_postdata( $post );
							?>
							
							<div class="col-lg-4 col-md-12">
								<?php get_template_part( 'loop-templates/content', 'resource' ); ?>
							</div>
							
						<?php endforeach; ?>
					</div>
					
				</div>
				
			</div>
			
		<?php endif; ?>

	<?php endwhile; ?>
	
</div><!-- #single-wrapper -->

<?php
get_footer();
