<?php
/**
 * Partial template for content in page.php
 *
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
