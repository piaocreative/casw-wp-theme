<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<?php
while ( have_posts() ) {
  the_post();
  ?>

  	<div class="page-title">
	  	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
  			<h1 class="title text-center"><?php the_title(); ?></h1>
		</div>
	</div>

	<div class="wrapper" id="page-wrapper">
		<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
			<div class="row">
				<div class="col-md-12 content-area" id="primary">
					<main class="site-main" id="main">
						<?php get_template_part( 'loop-templates/content', 'page' ); ?>
					</main>
				</div>
			</div><!-- .row -->
		</div><!-- #content -->
	</div><!-- #page-wrapper -->

<?php } ?>

<?php
get_footer();
