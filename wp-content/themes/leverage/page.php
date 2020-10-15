<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */

get_header();

if ( function_exists( 'ACF' ) ) {
	if ( have_rows( 'hero_section' ) ) {
		while( have_rows( 'hero_section' ) ) {
			the_row();

			if ( get_row_layout() == 'slider' ) {
				get_template_part( 'template-parts/content', 'full-slider' );
			}
		}

	} else {
		get_template_part( 'template-parts/content', 'no-slider' );
	} 

}  else {
	get_template_part( 'template-parts/content', 'no-slider' );
} ?>

<?php
global $post;
$content = $post->post_content;

if ( ! empty( $content ) || leverage_check_is_elementor() ) : ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="row content">

			<?php
			if ( function_exists( 'ACF' ) ) {
				$disable_sidebar = get_field( 'disable_sidebar' );
			} else {
				$disable_sidebar = '';
			}

			if ( is_active_sidebar( 'page-sidebar' ) && ! $disable_sidebar ) {
				$col = 'col-lg-8';
			} else {
				$col = 'col-lg-12';
			}
			?>

			<main class="col-12 p-0 <?php echo esc_attr( $col ); ?>">

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

<?php endif; ?>

<?php
if ( function_exists( 'ACF' ) ) :
	if ( have_rows( 'content_section' ) ) :
		while( have_rows( 'content_section' ) ) : the_row();

			if ( get_row_layout() == 'carousel' ) : 
			
				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} ?>

				<section id="carousel" class="<?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> carousel showcase" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr(get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>

						<div class="swiper-container slider-mid items">
							<div class="swiper-wrapper">

								<?php
								$items = get_sub_field( 'item' );

								if ( $items ) :
									foreach( $items as $item ) : 
									
										$target = $item['target'];

										switch ( $target ) {
											case 'Anchor Link':
												$url = $item['url'];
											break;
									
											case 'Internal Link':
												$url = $item['url'];
											break;
									
											case 'External Link':
												$url = $item['url'];
											break;
									
											case 'Inner Page':
												$url = $item['page'];
											break;
									
											case 'Inner Post';
												$url = $item['post'];
											break;
										}
									?>

									<div class="swiper-slide slide-center item">
										<div class="row card p-0 text-center">
											<div class="image-over">
												<img src="<?php echo esc_url( $item['image']['sizes']['leverage-grid-image'] ); ?>" alt="<?php echo esc_attr( $item['image']['alt'] ); ?>"/>
											</div>
											<div class="card-caption col-12 p-0">
												<div class="card-body">
													<a href="<?php echo esc_url( $url ); ?>" <?php if ( $item['target'] == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="<?php if ( $item['target'] == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?>">
														<h4 class="m-0"><?php echo esc_html( $item['title'] ); ?></h4>
													</a>
												</div>
												<div class="card-footer d-lg-flex align-items-center justify-content-center">
													<p><?php echo strip_tags( $item['description'], '<br />' ); ?></p>
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
					</div>
				</section>	

			<?php
			elseif ( get_row_layout() == 'about' ) : 

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} ?>

				<section id="about" class="<?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> highlights <?php if ( get_sub_field( 'image_position' ) == 'Left' ) { echo esc_attr( 'image-left' ); } else { echo esc_attr( 'image-right' ); } ?>" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container">
						<div class="row">
							<div class="col-12 col-md-6 align-self-center text-center text-md-left <?php if ( get_sub_field( 'image_position' ) == 'Left' ) { echo esc_attr( 'pl-md-5 order-2' ); } ?>">
								
								<div class="row intro">
									<div class="col-12 p-0">
										<h2 class="featured alt"><?php the_sub_field( 'title' ); ?></h2>
										<?php the_sub_field( 'description' ); ?>
									</div>
								</div>

								<div class="row items">
									<div class="col-12 p-0">

									<?php
									$items = get_sub_field( 'item' );
									
									if ( $items ) :
										foreach( $items as $item ) : ?>

										<div data-aos="fade-right" data-aos-delay="100" class="row item">
											<div class="col-12 col-md-2 align-self-center">
												
												<?php if ( $item['icon'] ) : ?>
												<i class="icon icon-<?php echo esc_attr( $item['icon'] ); ?>"></i>
												<?php endif; ?>

											</div>
											<div class="col-12 col-md-9 align-self-center">
												<h4><?php echo esc_html( $item['title'] ); ?></h4>
												<p><?php echo strip_tags( $item['description'], '<br />' ); ?></p>
											</div>  
										</div>

										<?php
										endforeach;
									endif; ?>

									</div>
								</div>
							</div>

							<div class="gallery col-12 col-md-6">

								<?php
								$image = get_sub_field( 'image' );
								if ( $image ) : ?>

								<a href="<?php if ( get_sub_field( 'enable_video' ) ) { echo esc_url( get_sub_field( 'video_url' ) ); } else { echo esc_url( $image['url'] ); } ?>">

									<?php if ( get_sub_field( 'enable_video' ) ) : ?>

									<i class="play-video icon-control-play"></i>
									<div class="mask-radius"></div>

									<?php endif; ?>

									<img src="<?php echo esc_url( $image['sizes']['leverage-about-image'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" class="fit-image"/>
								</a>

								<?php endif; ?>

							</div>
						</div>
					</div>
				</section>

			<?php
			elseif ( get_row_layout() == 'video' ) :

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} ?>

				<section id="video" class="<?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> highlights image-center" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container short">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>

						<div class="row text-center">
							<div class="col-12 gallery">

								<?php
								$image = get_sub_field( 'image' );
								if ( $image ) : ?>

								<a href="<?php echo esc_url( get_sub_field( 'video_url' ) ); ?>" class="square-image d-flex justify-content-center align-items-center">
									<i class="icon bigger icon-control-play"></i>
									<img src="<?php echo esc_url( $image['sizes']['leverage-video-image'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" class="fit-image"/>
								</a>

								<?php endif; ?>
							</div>
						</div>
					</div>
				</section>

			<?php
			elseif ( get_row_layout() == 'features' ) :

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} ?>

				<section id="features" class="<?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> offers" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container">
						<div class="row justify-content-center text-center items">

						<?php
						$items = get_sub_field( 'item' );
						
						if ( $items ) :
							foreach( $items as $item ) : ?>


							<div class="col-12 col-md-6 col-lg-4 item">
								<div class="card no-hover">

									<?php if ( $item['icon'] ) : ?>
									<i class="icon icon-<?php echo esc_attr( $item['icon'] ); ?>"></i>
									<?php endif; ?>

									<h4><?php echo esc_html( $item['title'] ); ?></h4>
									<p><?php echo strip_tags( $item['description'], '<br />' ); ?></p>

								</div>
							</div>

							<?php
							endforeach;
						endif; ?>

						</div>
					</div>
				</section>		

			<?php
			elseif ( get_row_layout() == 'services' ) :

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} ?>

				<section id="services" class="<?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> offers" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>

						<div class="row justify-content-center text-center items">

							<?php
							$items = get_sub_field( 'item' );
							
							if ( $items ) :
								foreach( $items as $item ) :
									
									$target = $item['target'];

									switch ( $target ) {
										case 'Anchor Link':
											$url = $item['url'];
										break;
								
										case 'Internal Link':
											$url = $item['url'];
										break;
								
										case 'External Link':
											$url = $item['url'];
										break;
								
										case 'Inner Page':
											$url = $item['page'];
										break;
								
										case 'Inner Post';
											$url = $item['post'];
										break;
									}
								?>

								<div class="col-12 col-md-6 col-lg-4 item">
									<div class="card featured" <?php if ( $item['card_bg_color'] ) { echo 'style="background-color:'.esc_attr( $item['card_bg_color'] ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>

										<?php if ( $item['icon'] ) : ?>
										<i class="icon icon-<?php echo esc_attr( $item['icon'] ); ?>"></i>
										<?php endif; ?>

										<h4><?php echo esc_html( $item['title'] ); ?></h4>
										<p><?php echo strip_tags( $item['description'], '<br />' ); ?></p>

										<a href="<?php echo esc_url( $url ); ?>" <?php if ( $item['target'] == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="<?php if ( $item['target'] == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?>">
											<i class="btn-icon icon-arrow-right-circle"></i>
										</a>

									</div>
								</div>

								<?php 
								endforeach; 
							endif; ?>

						</div>
					</div>
				</section>

			<?php
			elseif ( get_row_layout() == 'portfolio' ) : 

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} ?>

				<section id="portfolio" class="<?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> offers secondary" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>
						
						<div class="row justify-content-center text-center items">
							
							<?php
							$items = get_sub_field( 'item' );
							
							if ( $items ) :
								foreach( $items as $item ) : 
								
									$target = $item['target'];

									switch ( $target ) {
										case 'Anchor Link':
											$url = $item['url'];
										break;
								
										case 'Internal Link':
											$url = $item['url'];
										break;
								
										case 'External Link':
											$url = $item['url'];
										break;
								
										case 'Inner Page':
											$url = $item['page'];
										break;
								
										case 'Inner Post';
											$url = $item['post'];
										break;
								
										case 'This Image';
											$url = $item['image']['url'];
										break;
									}
								?>

								<div class="col-12 col-md-6 col-lg-4 item">
									<div class="card featured" <?php if ( $item['card_bg_color'] ) { echo 'style="background-color:'.esc_attr( $item['card_bg_color'] ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>

										<h4><?php echo esc_html( $item['title'] ); ?></h4>
										<p><?php echo strip_tags( $item['description'], '<br />' ); ?></p>								
										
										<?php if ( $target === 'This Image' ) : ?><div class="gallery"><?php endif; ?>		

											<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="<?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?>">
												<img src="<?php echo esc_url( $item['image']['sizes']['leverage-portfolio-image'] ); ?>" alt="<?php echo esc_attr( $item['image']['alt'] ); ?>"/>
											</a>
										<?php if ( $target === 'This Image' ) : ?></div><?php endif; ?>
									</div>
								</div>

								<?php
								endforeach;
							endif; ?>

						</div>
					</div>
				</section>

			<?php
			elseif ( get_row_layout() == 'portfolio_grid' ) : 

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} ?>

				<section id="portfolio-2" class="<?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> showcase portfolio blog-grid" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>
						
						<div class="row justify-content-center items">
							
							<?php
							$items = get_sub_field( 'item' );
							
							if ( $items ) :
								foreach( $items as $item ) : 
								
									$target = $item['target'];

									switch ( $target ) {
										case 'Anchor Link':
											$url = $item['url'];
										break;
								
										case 'Internal Link':
											$url = $item['url'];
										break;
								
										case 'External Link':
											$url = $item['url'];
										break;
								
										case 'Inner Page':
											$url = $item['page'];
										break;
								
										case 'Inner Post';
											$url = $item['post'];
										break;
								
										case 'This Image';
											$url = $item['image']['url'];
										break;
									}
								?>

								<div class="col-12 col-md-6 col-lg-4 item">
									<div class="row card p-0 text-center">
										<?php if ( $target === 'This Image' ) : ?><div class="gallery"><?php endif; ?>
											<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="image-over <?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?>">
												<img src="<?php echo esc_url( $item['image']['sizes']['leverage-grid-image'] ); ?>" alt="<?php echo esc_attr( $item['image']['alt'] ); ?>"/>
											</a>
											<?php if ( $target === 'This Image' ) : ?></div><?php endif; ?>
										<div class="card-caption col-12 p-0">
											<div class="card-body">
												<h4 class="m-0"><?php echo esc_html( $item['title'] ); ?></h4>
											</div>
											<div class="card-footer d-lg-flex align-items-center justify-content-center">
												<p><?php echo strip_tags( $item['description'], '<br />' ); ?></p>
											</div>
										</div>
									</div>
								</div>

								<?php
								endforeach;
							endif; ?>

						</div>
					</div>
				</section>

			<?php
			elseif ( get_row_layout() == 'team' ) : 

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} ?>

				<section id="team" class="<?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> carousel" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>
						
						<div class="swiper-container slider-mid items">
							<div class="swiper-wrapper">
							
							<?php
							$items = get_sub_field( 'item' );
							
							if ( $items ) :
								foreach( $items as $item ) : ?>

								<div class="swiper-slide slide-center text-center item">
									<div class="row card" <?php if ( $item['card_bg_color'] ) { echo 'style="background-color:'.esc_attr( $item['card_bg_color'] ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
										<div class="col-12">
										
											<img src="<?php echo esc_url( $item['photo']['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $item['photo']['alt'] ); ?>" class="person"/>

											<h4><?php echo esc_html( $item['name'] ); ?></h4>
												<p><?php echo strip_tags( $item['biography'], '<br />' ); ?></p>

											<ul class="navbar-nav social share-list ml-auto">

											<?php 
											$social_networks = $item['social_networks'];

											if ( $social_networks ) :
												foreach( $social_networks as $social_network) : ?>

													<li class="nav-item">
														<a href="<?php echo esc_url( $social_network['url'] ); ?>" target="_blank" class="nav-link">
															<i class="icon-social-<?php echo esc_attr( $social_network['acf_fc_layout'] ); ?>"></i>
														</a>
													</li>

												<?php
												endforeach;
											endif; ?>

											</ul>
										</div>
									</div>
								</div>

								<?php
								endforeach;
							endif; ?>

							</div>
							<div class="swiper-pagination"></div>
						</div>
					</div>
				</section>

			<?php
			elseif ( get_row_layout() == 'testimonials' ) : 

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} ?>

				<section id="testimonials" class="<?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> carousel" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>
						
						<div class="swiper-container slider-mid items">
							<div class="swiper-wrapper">
							
							<?php
							$items = get_sub_field( 'item' );
							
							if ( $items ) :
								foreach( $items as $item ) : ?>

								<div class="swiper-slide slide-center text-center item">
									<div class="row card" <?php if ( $item['card_bg_color'] ) { echo 'style="background-color:'.esc_attr( $item['card_bg_color'] ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
										<div class="col-12">
										
											<img src="<?php echo esc_url( $item['photo']['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $item['photo']['alt'] ); ?>" class="person"/>

											<h4><?php echo esc_html( $item['name'] ); ?></h4>
											<p><?php echo strip_tags( $item['testimonial'], '<br />' ); ?></p>

											<ul class="navbar-nav social share-list ml-auto">

											<?php 
											for( $x = 1; $x <= $item['rating']; $x++) : ?>
												<li class="nav-item">
													<a href="#" class="nav-link"><i class="icon-star ml-2 mr-2"></i></a>
												</li>
											<?php endfor; ?>

											</ul>
										</div>
									</div>
								</div>

								<?php
								endforeach;
							endif; ?>

							</div>
							<div class="swiper-pagination"></div>
						</div>
					</div>
				</section>

			<?php
			elseif ( get_row_layout() == 'partners' ) : 

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} ?>

				<!-- Partners -->
				<section id="partner" class="<?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> logos" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container">
						<div class="swiper-container slider-min">
							<div class="swiper-wrapper">

								<?php
								$items = get_sub_field( 'item' );
								
								if ( $items ) :
									foreach( $items as $item ) : ?>

									<div class="swiper-slide slide-center item">
										<a <?php if ( $item['enable_url'] ) { echo 'href="' . esc_url( $item['url'] ) . '" target="_blank"'; } ?>>
											<img src="<?php echo esc_url( $item['logo']['url'] ); ?>" alt="<?php echo esc_attr( $item['logo']['alt'] ); ?>" class="fit-image w-85"/>
										</a>
									</div>

									<?php
									endforeach;
								endif; ?>

							</div>
						</div>
					</div>
				</section>

			<?php
			elseif ( get_row_layout() == 'pricing' ) :

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} ?>

				<section id="pricing" class="<?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> plans" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>

						<div class="row justify-content-center text-center items">

							<?php
							$items = get_sub_field( 'item' );
							
							if ( $items ) :
								foreach( $items as $item ) : ?>

								<div class="col-12 col-md-6 col-lg-4 align-self-center text-center item">
									<div class="card" <?php if ( $item['card_bg_color'] ) { echo 'style="background-color:'.esc_attr( $item['card_bg_color'] ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>

										<?php if ( $item['icon'] ) : ?>
										<i class="icon icon-<?php echo esc_attr( $item['icon'] ); ?>"></i>
										<?php endif; ?>

										<h4><?php echo esc_html( $item['title'] ); ?></h4>

										<span class="price"><i><?php echo esc_html( $item['currency'] ); ?></i><?php echo esc_html( $item['price'] ); ?></span>

										<ul class="list-group list-group-flush">

										<?php
										$features = $item['features'];
										
										if ( $features ) :
											foreach( $features as $feature ) : ?>

											<li class="list-group-item d-flex justify-content-between align-items-center text-left">
												<span><?php echo esc_html( $feature['feature'] ); ?></span>
												<i class="icon-min m-0 icon-check text-right"></i>
											</li>

											<?php 
											endforeach; 
										endif; ?>

										</ul>

										<a href="<?php echo esc_url( $item['button_url'] ); ?>" <?php if ( $item['button_target'] == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="<?php if ( $item['button_target'] == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?> btn mx-auto primary-button">
											<i class="icon-arrow-right-circle"></i><?php echo esc_html( $item['button_label'] ); ?></a>
										</a>

									</div>
								</div>

								<?php 
								endforeach; 
							endif; ?>

						</div>
					</div>
				</section>

			<?php
			elseif ( get_row_layout() == 'custom_feature' ) :

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} ?>

				<section id="custom" class="<?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> custom" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container">

						<?php
						if ( get_sub_field( 'enable_title' ) ) {
							get_template_part( 'template-parts/content', 'section-intro' );
						} ?>

						<div class="row">
							<div class="col-12">
								<?php the_sub_field( 'custom' ); ?>
							</div>

						</div>
					</div>
				</section>

			<?php
			endif;
		endwhile; 
	endif;
endif; ?>		

<?php get_footer();