<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Leverage
 */
?>

<?php
if ( function_exists( 'ACF' ) ) {
	if ( get_field( 'override_general_settings' ) ) {
		
		// News
		$enable_news_front_page = get_field( 'enable_news' );
		$enable_news_pages      = get_field( 'enable_news' );
		$enable_news_posts      = get_field( 'enable_news' );
		
		// Subscribe
		$enable_subscribe_front_page = get_field( 'enable_subscribe' );
		$enable_subscribe_pages      = get_field( 'enable_subscribe' );
		$enable_subscribe_posts      = get_field( 'enable_subscribe' );
		
		// Form
		$enable_form_front_page = get_field( 'enable_form' );
		$enable_form_pages      = get_field( 'enable_form' );
		$enable_form_posts      = get_field( 'enable_form' );
		
		// Custom
		$enable_custom_front_page = get_field( 'enable_custom' );
		$enable_custom_pages      = get_field( 'enable_custom' );
		$enable_custom_posts      = get_field( 'enable_custom' );

	} else {
		
		// News
		$enable_news_front_page = get_field( 'enable_news_on_front_page', 'option' );
		$enable_news_pages      = get_field( 'enable_news_on_pages', 'option' );
		$enable_news_posts      = get_field( 'enable_news_on_posts', 'option' );
		
		// Subscribe
		$enable_subscribe_front_page = get_field( 'enable_subscribe_on_front_page', 'option' );
		$enable_subscribe_pages      = get_field( 'enable_subscribe_on_pages', 'option' );
		$enable_subscribe_posts      = get_field( 'enable_subscribe_on_posts', 'option' );
		
		// Form
		$enable_form_front_page = get_field( 'enable_form_on_front_page', 'option' );
		$enable_form_pages      = get_field( 'enable_form_on_pages', 'option' );
		$enable_form_posts      = get_field( 'enable_form_on_posts', 'option' );
		
		// Custom
		$enable_custom_front_page = get_field( 'enable_custom_on_front_page', 'option' );
		$enable_custom_pages      = get_field( 'enable_custom_on_pages', 'option' );
		$enable_custom_posts      = get_field( 'enable_custom_on_posts', 'option' );
	}

	// Enable News
	if ( is_front_page() && $enable_news_front_page ) {
		get_template_part( 'template-parts/content', 'news' );

	} elseif ( is_page() && $enable_news_pages ) {
		get_template_part( 'template-parts/content', 'news' );

	} elseif ( is_single() && $enable_news_posts ) {
		get_template_part( 'template-parts/content', 'news' );
	} 

	// Enable Subscribe
	if ( is_front_page() && $enable_subscribe_front_page ) {
		get_template_part( 'template-parts/content', 'subscribe' );

	} elseif ( is_page() && $enable_subscribe_pages ) {
		get_template_part( 'template-parts/content', 'subscribe' );

	} elseif ( is_single() && $enable_subscribe_posts ) {
		get_template_part( 'template-parts/content', 'subscribe' );
	} 

	// Enable Form
	if ( is_front_page() && $enable_form_front_page ) {
		get_template_part( 'template-parts/content', 'form' );

	} elseif ( is_page() && $enable_form_pages ) {
		get_template_part( 'template-parts/content', 'form' );

	} elseif ( is_single() && $enable_form_posts ) {
		get_template_part( 'template-parts/content', 'form' );
	} 

	// Enable Custom
	if ( is_front_page() && $enable_custom_front_page ) {
		get_template_part( 'template-parts/content', 'custom' );

	} elseif ( is_page() && $enable_custom_pages ) {
		get_template_part( 'template-parts/content', 'custom' );

	} elseif ( is_single() && $enable_custom_posts ) {
		get_template_part( 'template-parts/content', 'custom' );
		
	} 

	// Enable Dark Mode
	if ( get_field( 'enable_dark_mode', 'option' ) ) {
		$suggested_color = '#111111';
	} else {
		$suggested_color = '#111111';
	}
}

if ( function_exists( 'ACF' ) && function_exists( 'leverage_theme_settings' ) ) : ?>

<footer class="<?php if ( get_field( 'enable_dark_mode', 'option' ) ) { echo esc_attr( 'odd' ); } ?>" <?php if ( get_field( 'background_color', 'option' ) ) { echo 'style="background-color:'.esc_attr( get_field( 'background_color', 'option' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>

	<?php if ( get_field( 'enable_footer', 'option' ) ) : ?>

	<section id="footer" class="footer">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-3 p-3 text-center text-lg-left">
					<div class="brand">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">

							<?php 
							if ( get_field( 'brand_type', 'option' ) == 'Text' ) {
								echo esc_html(get_field( 'text', 'option' ) );

							} else {
								$image = get_field( 'logo', 'option' );
								$invert = get_field( 'footer_logo_filter', 'option' );

								if ( $invert ) {
									$invert = 'invert';
								} else {
									$invert = '';
								}

								echo '<img src="' . esc_url( $image['url'] ) . '" alt="'.esc_attr( $image['alt'] ).'" class="'.esc_attr( $invert ).'"/>';

							} ?>
						</a>
					</div>
					
					<p><?php echo esc_html( get_field( 'description', 'option' ) ); ?></p>

					<ul class="navbar-nav social share-list mt-0 ml-auto">

						<?php 
						if ( get_field( 'footer_social_icons', 'option' ) ) :
							if ( have_rows( 'social_networks', 'option' ) ) :
								while( have_rows( 'social_networks', 'option' ) ) :
									the_row();

									// Facebook
									if ( get_row_layout() == 'facebook' ) : ?>

									<li class="nav-item social">
										<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
											<i class="icon-social-facebook"></i>
										</a>
									</li>

									<?php 
									// Instagram
									elseif ( get_row_layout() == 'instagram' ) : ?>

									<li class="nav-item social">
										<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
											<i class="icon-social-instagram"></i>
										</a>
									</li>

									<?php 
									// Twitter
									elseif ( get_row_layout() == 'twitter' ) : ?>

									<li class="nav-item social">
										<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
											<i class="icon-social-twitter"></i>
										</a>
									</li>

									<?php 
									// Youtube
									elseif ( get_row_layout() == 'youtube' ) : ?>

									<li class="nav-item social">
										<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
											<i class="icon-social-youtube"></i>
										</a>
									</li>

									<?php 
									// Linkedin
									elseif ( get_row_layout() == 'linkedin' ) : ?>

									<li class="nav-item social">
										<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
											<i class="icon-social-linkedin"></i>
										</a>
									</li>

									<?php 
									// Pinterest
									elseif ( get_row_layout() == 'pinterest' ) : ?>

									<li class="nav-item social">
										<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
											<i class="icon-social-pinterest"></i>
										</a>
									</li>

									<?php 
									// Tumblr
									elseif ( get_row_layout() == 'tumblr' ) : ?>

									<li class="nav-item social">
										<a href="<?php the_field( 'url' ); ?>" target="_blank" class="nav-link">
											<i class="icon-social-tumblr"></i>
										</a>
									</li>

									<?php 
									// Dribbble
									elseif ( get_row_layout() == 'dribbble' ) : ?>

									<li class="nav-item social">
										<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
											<i class="icon-social-dribbble"></i>
										</a>
									</li>

									<?php 
									endif;
								endwhile;
							endif;
						endif; ?>
					</ul>
				</div>
						
				<?php
				if ( have_rows( 'columns', 'option' ) ) :
					while( have_rows( 'columns', 'option' ) ) : the_row(); ?>

						<?php
						if ( get_row_layout() == 'items' ) : ?>

							<div class="col-12 col-lg-3 p-3 text-center">
								<ul class="navbar-nav">

									<?php	
									$links = get_sub_field( 'links', 'option' );

									if ( $links ) :
										foreach( $links as $link ) : ?>

										<li class="nav-item">
											<a href="<?php echo esc_url( $link['url'] ); ?>" class="nav-link">

												<?php if ( $link['icon'] ) : ?>
													<i class="icon-<?php echo esc_attr( $link['icon'] ); ?> mr-2"></i>
												<?php endif; ?>
												
												<?php echo esc_html( $link['label'] ); ?>
											</a>
										</li>

										<?php
										endforeach;
									endif;
									?>							

								</ul>
							</div>

							<?php
							elseif ( get_row_layout() == 'custom' ) : ?>

								<div class="col-12 col-lg-3 p-3 text-center">

										<?php	
										the_sub_field( 'custom', 'option' ); ?>				

									</ul>
								</div>

							<?php endif; ?>
						
					<?php
					endwhile;
				endif; 
				?>

			</div>
		</div>
	</section>

	<?php endif;
	
	if ( get_field( 'enable_copyright', 'option' ) ) : ?>

	<section id="copyright" class="p-3 copyright">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-6 p-3 text-center text-lg-left">
					<p><?php the_field( 'copyright_left_text', 'option' ); ?></p>
				</div>
				<div class="col-12 col-md-6 p-3 text-center text-lg-right">
					<p><?php the_field( 'copyright_right_text', 'option' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<?php endif; ?>

	<?php if ( ! get_field( 'enable_footer', 'option' ) && ! get_field( 'enable_copyright', 'option' ) ) : ?>

	<section id="copyright" class="p-3 copyright">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<p><?php echo esc_html( get_bloginfo( 'name' ) ).' - '.esc_html( get_bloginfo( 'description', 'display' ) ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<?php endif; ?>

</footer>

<?php else : ?>

<footer class="odd">
	<section id="copyright" class="p-3 copyright">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<p><?php echo esc_html( get_bloginfo( 'name' ) ).' - '.esc_html( get_bloginfo( 'description', 'display' ) ); ?></p>
				</div>
			</div>
		</div>
	</section>
</footer>

<?php endif; ?>

<div id="search" class="p-0 modal fade" role="dialog" aria-labelledby="search" aria-hidden="true" style="<?php if ( is_admin_bar_showing() ) { echo esc_attr( 'margin-top: 32px' ); } ?>">
	<div class="modal-dialog modal-dialog-slideout" role="document">
		<div class="modal-content full">
			<div class="modal-header" data-dismiss="modal">
				<?php esc_html_e( 'Search', 'leverage' ); ?> <i class="icon-close"></i>
			</div>
			<div class="modal-body">
				<form role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="GET" class="row">
					<div class="col-12 p-0 align-self-center">
						<div class="row">
							<div class="col-12 p-0 pb-3">

								<?php if ( function_exists( 'ACF' ) ) : ?>

								<h2><?php 
									if(get_field( 'search_title', 'option' )) { 
										the_field( 'search_title', 'option' ); 
									} else { 
										echo esc_html__( 'Search', 'leverage' );
									} 
									?>
								</h2>

								<p><?php the_field( 'search_description', 'option' ); ?></p>

								<?php else : ?>

								<h2><?php echo esc_html__( 'Search', 'leverage' ); ?></h2>

								<?php endif; ?>

							</div>
						</div>
						<div class="row">
							<div class="col-12 p-0 input-group">
								<input type="text" name="s" class="form-control" placeholder="<?php esc_attr_e( 'Enter Keywords', 'leverage' ); ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-12 p-0 input-group align-self-center">
								<button class="btn primary-button"><i class="icon-magnifier"></i><?php esc_html_e( 'SEARCH', 'leverage' ); ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="menu" class="p-0 modal fade" role="dialog" aria-labelledby="menu" aria-hidden="true">
	<div class="modal-dialog modal-dialog-slideout" role="document">
		<div class="modal-content full">
			<div class="modal-header" data-dismiss="modal">
				<?php esc_html_e( 'Menu Options', 'leverage' ); ?> <i class="icon-close"></i>
			</div>
			<div class="menu modal-body">
				<div class="row w-100">
					<div class="items p-0 col-12 text-center">
						<!-- Append [navbar] -->
					</div>
					<div class="contacts p-0 col-12 text-center">
						<!-- Append [navbar] -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="scroll-to-top" class="scroll-to-top">
	<a href="#slider" class="smooth-anchor">
		<i class="icon-arrow-up"></i>
	</a>
</div>

<?php wp_footer(); ?>
</body>
</html>