<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div id="error-404-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main">

					<section class="error-404 not-found">

						<header class="page-header">

							<h2 class="text-center mb-0"><?php esc_html_e( 'Page not Found.', 'casw' ); ?></h2>

						</header><!-- .page-header -->

						<div class="page-content text-center">

							<p class="mb-5"><?php esc_html_e( 'Sorry, the page you are looking for doesn’t exist or has been removed. Keep exploring out site:', 'casw' ); ?></p>

							<?php get_search_form(); ?>

						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</main>

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php
get_footer();
