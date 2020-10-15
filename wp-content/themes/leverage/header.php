<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until content
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Leverage
 */
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

	<!-- ==============================================
	Basic Page Needs
	=============================================== -->
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->	
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header>
	<nav data-aos="zoom-out" data-aos-delay="800" class="navbar navbar-expand" style="<?php if ( is_admin_bar_showing() ) { echo esc_attr( 'margin-top: 32px' ); } ?>">
		<div class="container header">

			<?php
			if ( has_custom_logo() ) {
				
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$logo           = wp_get_attachment_image_src( $custom_logo_id , 'full' );

				if ( function_exists( 'ACF' ) ) {
					if ( get_field( 'override_general_settings' ) ) {
						$logo_filter = get_field( 'logo_filter' );

					} else {
						$logo_filter = get_field( 'logo_filter', 'option' );
					}

					$invert = $logo_filter;
					if ( $invert ) {
						$invert = 'invert';
					} else {
						$invert = '';
					}
				
				} else {
					$invert = '';
				}

				echo '<a class="navbar-brand" href="'.esc_url( home_url( '/' ) ).'"><img src="'.esc_url( $logo[0] ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" class="' . esc_attr( $invert) . '"/></a>';

			} else {
				echo '<a class="navbar-brand" href="'.esc_url( home_url( '/' ) ).'">'. esc_attr( get_bloginfo( 'name' ) ) .'</a>';
			} ?>

			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary',
					'container'      => false,
					'menu_class'     => 'navbar-nav items ml-auto',
					'fallback_cb'    => 'navwalker::fallback',
					'walker'         => new navwalker()
				) );
			}
			?>

			<?php 
			if ( function_exists( 'ACF' ) ) : ?>
				
				<?php 
				if ( get_field( 'search_icon', 'option' ) ) : ?>

				<ul class="navbar-nav icons ml-auto m-xl-0">
					<li class="nav-item">
						<a href="#" class="nav-link" data-toggle="modal" data-target="#search">
							<i class="icon-magnifier"></i>
						</a>
					</li>
				</ul>

				<?php endif;
				
				if ( get_field( 'social_icons', 'option' ) ) : ?>

				<ul class="navbar-nav icons ml-auto m-xl-0">

					<?php
					if ( have_rows( 'social_networks', 'option' ) ) :
						while( have_rows( 'social_networks', 'option' ) ) :
							the_row();

							// Facebook
							if ( get_row_layout() == 'facebook' ) : ?>

							<li class="nav-item social">
								<a href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-facebook"></i>
								</a>
							</li>

							<?php 
							// Instagram
							elseif ( get_row_layout() == 'instagram' ) : ?>

							<li class="nav-item social">
								<a href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-instagram"></i>
								</a>
							</li>

							<?php 
							// Twitter
							elseif ( get_row_layout() == 'twitter' ) : ?>

							<li class="nav-item social">
								<a href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-twitter"></i>
								</a>
							</li>

							<?php 
							// Youtube
							elseif ( get_row_layout() == 'youtube' ) : ?>

							<li class="nav-item social">
								<a href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-youtube"></i>
								</a>
							</li>

							<?php 
							// Linkedin
							elseif ( get_row_layout() == 'linkedin' ) : ?>

							<li class="nav-item social">
								<a href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-linkedin"></i>
								</a>
							</li>

							<?php 
							// Pinterest
							elseif ( get_row_layout() == 'pinterest' ) : ?>

							<li class="nav-item social">
								<a href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-pinterest"></i>
								</a>
							</li>

							<?php 
							// Tumblr
							elseif ( get_row_layout() == 'tumblr' ) : ?>

							<li class="nav-item social">
								<a href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-tumblr"></i>
								</a>
							</li>

							<?php 
							// Dribbble
							elseif ( get_row_layout() == 'dribbble' ) : ?>

							<li class="nav-item social">
								<a href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-dribbble"></i>
								</a>
							</li>

							<?php 
							endif;
						endwhile;
					endif;
				endif; ?>

				</ul>

			<?php else : ?>

				<ul class="navbar-nav icons ml-auto m-xl-0">
					<li class="nav-item">
						<a href="#" class="nav-link" data-toggle="modal" data-target="#search">
							<i class="icon-magnifier"></i>
						</a>
					</li>
				</ul>	
			
			<?php 
			endif;
			
			if ( has_nav_menu( 'primary' ) ) : ?>

			<ul class="navbar-nav toggle">
				<li class="nav-item">
					<a href="#" class="nav-link" data-toggle="modal" data-target="#menu">
						<i class="icon-menu m-0"></i>
					</a>
				</li>
			</ul>

			<?php endif; ?>

			<?php
			if ( function_exists( 'ACF' ) ) :
				if ( get_field( 'custom_action', 'option' ) ) :

					$target = get_field( 'custom_target', 'option' );
				
					switch ( $target ) {
						case 'Anchor Link':
							$url = get_field( 'custom_url', 'option' );
						break;

						case 'External Link':
							$url = get_field( 'custom_url', 'option' );
						break;

						case 'Inner Page':
							$url = get_field( 'custom_page', 'option' );
						break;

						case 'Inner Post';
							$url = get_field( 'custom_post', 'option' );
						break;
					}		
				?>

				<ul class="navbar-nav custom">
					<li class="nav-item">
						<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="nav-link <?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?>">
							
							<?php if ( get_field( 'custom_icon', 'option' ) ) : ?>
								<i class="icon-<?php echo esc_attr( get_field( 'custom_icon', 'option' ) ); ?>"></i>
							<?php endif; ?>
						</a>
					</li>
				</ul>

				<?php endif; ?>

				<?php
				if ( get_field( 'enable_button', 'option' ) ) :

					$target = get_field( 'button_target', 'option' );
				
					switch ( $target ) {
						case 'Anchor Link':
							$url = get_field( 'button_url', 'option' );
						break;

						case 'External Link':
							$url = get_field( 'button_url', 'option' );
						break;

						case 'Inner Page':
							$url = get_field( 'button_page', 'option' );
						break;

						case 'Inner Post';
							$url = get_field( 'button_post', 'option' );
						break;
					}
				?>

				<ul class="navbar-nav action">
					<li class="nav-item ml-3">
						<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="<?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?> btn ml-lg-auto primary-button">
							
							<?php if ( get_field( 'button_icon', 'option' ) ) : ?>
							<i class="icon-<?php echo esc_attr( get_field( 'button_icon', 'option' ) ); ?>"></i>
							<?php endif; ?>

							<?php the_field( 'button_label', 'option' ); ?>
						</a>
					</li>
				</ul>

				<?php 
				endif;
			endif;
			?>

		</div>
	</nav>
</header>