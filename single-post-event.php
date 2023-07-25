<?php
/**
 * The template for displaying all single event posts
 *
 * @package CASW
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper" id="single-wrapper">

	<main class="site-main" id="main">

		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'loop-templates/content', 'single-event' );
		}
		?>

	</main>
	
</div><!-- #single-wrapper -->

<?php
get_footer();
