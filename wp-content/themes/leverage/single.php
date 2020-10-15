<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Leverage
 */

get_header(); ?>

<?php get_template_part( 'template-parts/content', 'no-slider' ); ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="row content">

			<?php
			if ( function_exists( 'ACF' ) ) {
				$disable_sidebar = get_field( 'disable_sidebar' );
			} else {
				$disable_sidebar = '';
			}

			if ( is_active_sidebar( 'blog-sidebar' ) && ! $disable_sidebar ) {
				$col = 'col-lg-8';
			} else {
				$col = 'col-lg-12';
			}
			?>

			<main class="col-12 <?php echo esc_attr( $col ); ?> p-0">

				<?php
				get_template_part( 'template-parts/content', 'single' ); 

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif; ?>

			</main>

			<?php get_sidebar(); ?>
			
		</div>
	</div>
</section>

<?php get_footer();