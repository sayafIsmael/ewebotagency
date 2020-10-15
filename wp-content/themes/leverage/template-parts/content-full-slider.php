<?php
/**
 * Template part for displaying a slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */

 $slides = get_sub_field( 'slides' );

if ( $slides ) :
	$object = get_sub_field_object( 'slides' );
	$count  = ( count( $object['value'] ) ); 
?>

<section id="slider" class="p-0 <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?>">
	<div class="swiper-container <?php if ( $count == 1 ) { echo esc_attr( 'no-slider' ); } else { echo esc_attr( 'full-slider' ); } ?> <?php if ( get_sub_field( 'enable_outline' ) ) { echo esc_attr( 'featured' ); } ?> animation slider-h-<?php if ( get_sub_field( 'height' ) ) { echo get_sub_field( 'height' ); } else { echo '100'; } ?>">
		<div class="swiper-wrapper">

		<?php
		$slides = get_sub_field( 'slides' );
		
		if ( $slides ) :
			foreach( $slides as $slide ) : 
			
				if ( $slide['media_type'] == 'full-image' ) {
					$image = $slide['image']['sizes']['leverage-full-image'];

				} elseif ( $slide['media_type'] == 'hero-image' ) {
					$image = $slide['image']['sizes']['leverage-hero-image'];
				}
				
				if ( $slide['enable_dark_mode'] ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} ?>

			<div class="swiper-slide slide-center <?php if ( $slide['enable_dark_mode'] ) { echo esc_attr( 'odd' ); } ?>" <?php if ( $slide['background_color'] ) { echo 'style="background-color:'.esc_attr( $slide['background_color'] ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>

				<?php if ( $slide['enable_image'] ) : ?>

					<?php if ( $slide['media_type'] == 'full-video' ) : ?>

						<video type="video/mp4" class="full-image mask" src="<?php echo esc_url( $slide['video'] ); ?>" autoplay muted loop alt="<?php echo esc_attr( $slide['video']['alt'] ); ?>"></video>

					<?php elseif ( $slide['media_type'] == 'particles' ) : 
    					enqueue_script( 'particles', 'js/vendor/particles.min.js' );						
						enqueue_script( 'particles-'.$slide['particle'], 'js/vendor/particles.'.$slide['particle'].'.min.js' ); ?>

						<div id="particles-js" class="full-image mask"></div>
						
					<?php else : ?>

					<img data-aos="<?php if ( $slide['media_type'] == 'hero-image' ) { echo esc_attr( 'zoom-out-up' ); } ?>" data-aos-delay="800" src="<?php echo esc_url( $image ); ?>" class="<?php echo esc_attr( $slide['media_type'] ); ?> <?php if ( $slide['enable_dark_mode'] ) { echo esc_attr( 'mask' ); } ?>" alt="<?php echo esc_attr( $slide['image']['alt'] ); ?>">

					<?php endif; ?>
				<?php endif; ?>

				<div class="slide-content row">
					<div class="col-12 d-flex inner">
						<div class="<?php if ( $slide['slide_align'] == 'Left' ) {  echo esc_attr( 'left align-self-left text-center text-md-left' ); } else { echo esc_attr( 'center align-self-center text-center' ); } ?>">

							<?php if ( $slide['enable_title'] ) : ?>
							<h1 data-aos="zoom-out-up" data-aos-delay="400" class="title effect-static-text"><?php echo esc_html( $slide['title'] ); ?></h1>
							<?php endif; ?>

							<?php if ( $slide['enable_description'] ) : ?>
							<p data-aos="zoom-out-up" data-aos-delay="800" class="description <?php if ( $slide['slide_align'] == 'Center' ) { echo esc_attr( 'ml-auto mr-auto' ); } ?>"><?php echo esc_html( $slide['description'] ); ?></p>
							<?php endif; ?>

							<?php
							if ( $slide['enable_button'] ) :

								$target = $slide['button_target'];
							
								switch ( $target ) {
									case 'Anchor Link':
										$url = $slide['button_url'];
									break;

									case 'External Link':
										$url = $slide['button_url'];
									break;

									case 'Inner Page':
										$url = $slide['button_page'];
									break;

									case 'Inner Post';
										$url = $slide['button_post'];
									break;
								}
							?>

							<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> data-aos="zoom-out-up" data-aos-delay="1200" class="<?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?> ml-auto mr-auto <?php if ( $slide['slide_align'] == 'Left' ) { echo esc_attr( 'ml-md-0' ); } ?> mt-4 btn primary-button">

								<?php if ( $slide['button_icon'] ) : ?>
								<i class="icon-<?php echo esc_attr( $slide['button_icon'] ); ?>"></i>
								<?php endif; ?>

								<?php echo esc_html( $slide['button_label'] ); ?>
							</a>

							<?php endif; ?>

						</div>
					</div>
				</div> 
			</div>

			<?php
			endforeach;
		endif; ?>

		</div>
		<div class="swiper-pagination"></div>		
	</div>
</section>

<?php else : get_template_part( 'template-parts/content', 'no-slider' ); endif; ?>