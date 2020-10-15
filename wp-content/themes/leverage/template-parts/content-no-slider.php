<?php
/**
 * Template part for displaying a no-slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */

$enable_dark_mode = true;
if ( function_exists( 'ACF' ) ) {
	if ( get_field( 'override_general_settings' ) ) {
		$enable_dark_mode = get_field( 'enable_dark_mode' );

	} else {
		$enable_dark_mode = get_field( 'enable_dark_mode', 'option' );
	}
}
?>

<section id="slider" class="p-0 featured <?php if ( $enable_dark_mode === true ) { echo esc_attr( 'odd' ); } ?>">
	<div class="swiper-container no-slider slider-h-auto">
		<div class="swiper-wrapper">

			<div class="swiper-slide slide-center">

					<?php 
					if ( is_page() || is_single() ) {
						echo get_the_post_thumbnail( $post->ID, 'full-image', array( 'class' => 'full-image mask' ) ); 
					}
					?>

				<div class="slide-content row text-center">
					<div class="col-12 mx-auto inner">

						<h1 data-aos="zoom-out-up" data-aos-delay="400" class="title effect-static-text">

							<?php if ( is_sticky() && is_single() ) : ?>
							<i class="icon icon-pin"></i>
							<?php endif; ?>

							<?php
							if ( is_page() || is_single() ) {
								the_title();

							}  elseif ( is_category() || is_tag() || is_author() ) {
								the_archive_title();

							} elseif ( is_search() ) {
								printf( esc_html__( 'Searching for: %s', 'leverage' ), '<em>' . get_search_query() . '</em>' );
							
							} elseif ( is_404() ) {
								printf( esc_html__( '404 %s', 'leverage' ), '<em>'.esc_html__( 'Nothing Found', 'leverage' ).'</em>' );
							
							} else {
								printf( esc_html__( 'Our Blog', 'leverage' ));								
							}
							?>
						</h1>

						<?php if ( ! is_front_page() ) : ?>

						<nav data-aos="zoom-out-up" data-aos-delay="800" aria-label="breadcrumb">
							<ol class="breadcrumb"><?php get_breadcrumb(); ?></ol>
						</nav>
						
						<?php endif; ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>