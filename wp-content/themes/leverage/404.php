<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Leverage
 */

get_header();
get_template_part( 'template-parts/content', 'no-slider' ); ?>

<section>
	<div class="container">
		<div class="row items justify-content-center">
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		</div>
	</div>
</section>

<?php get_footer();