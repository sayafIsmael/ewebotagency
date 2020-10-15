<?php
/**
 * @package Leverage
 */

function leverage_google_fonts_url() {

    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
    */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'leverage' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Poppins:300,400,500,600,700' ), '//fonts.googleapis.com/css' );
    }

    return $font_url;
}

function leverage_enqueue_assets() {

    function enqueue_style( $id, $file ) {
        wp_enqueue_style( $id, get_template_directory_uri() . '/assets/' . $file, array(), wp_get_theme()->get( 'Version' ) );
	} 

	wp_enqueue_style( 'poppins', leverage_google_fonts_url(), array(), wp_get_theme()->get( 'Version' ) );	
	wp_enqueue_style( 'gilroy', 'https://cdn.rawgit.com/mfd/09b70eb47474836f25a21660282ce0fd/raw/e06a670afcb2b861ed2ac4a1ef752d062ef6b46b/Gilroy.css', array(), wp_get_theme()->get( 'Version' ) );

	if ( is_rtl() ) {
		enqueue_style( 'bootstrap-rtl', 'css/support/bootstrap.rtl.min.css' );
	} else {
		enqueue_style( 'bootstrap', 'css/vendor/bootstrap.min.css' );
	}

	enqueue_style( 'slider', 'css/vendor/slider.min.css' );
	wp_enqueue_style('main', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ));

	if( is_child_theme() ) {
		wp_enqueue_style('child', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ));
	}

	enqueue_style( 'icons', 'css/vendor/icons.min.css' );
	
	if(is_page()) {
		enqueue_style( 'gallery', 'css/vendor/gallery.min.css' );
	}

    enqueue_style( 'animation', 'css/vendor/animation.min.css' );
    enqueue_style( 'default', 'css/default.css' );
	enqueue_style( 'wordpress', 'css/support/wordpress.css' );

	if ( class_exists( 'WooCommerce' ) ) {
		enqueue_style( 'woocommerce', 'css/support/woocommerce.css' );
	}

	if ( is_rtl() ) {
		enqueue_style( 'main-rtl', 'css/support/main.rtl.css' );
	}

	if ( function_exists( 'ACF' ) ) {
		$theme_color = get_field( 'theme_color', 'option' );

		if ( $theme_color != 'default' && $theme_color != 'custom-color' ) {
			enqueue_style( 'theme-color', $theme_color);
		}
	}

    function enqueue_script( $id, $file ) {
        wp_enqueue_script( $id, get_template_directory_uri() . '/assets/' . $file, array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
    } 
    
    enqueue_script( 'jquery-easing', 'js/vendor/jquery.easing.min.js' );
    enqueue_script( 'ponyfill', 'js/vendor/ponyfill.min.js' );
    enqueue_script( 'popper', 'js/vendor/popper.min.js' );

	if ( is_rtl() ) {
		enqueue_script( 'bootstrap-rtl', 'js/support/bootstrap.rtl.min.js' );
	} else {
		enqueue_script( 'bootstrap', 'js/vendor/bootstrap.min.js' );
	}
    
	enqueue_script( 'slider', 'js/vendor/slider.min.js' );

	if(is_page()) {
		enqueue_script( 'gallery', 'js/vendor/gallery.min.js' );
	}

    enqueue_script( 'animation', 'js/vendor/animation.min.js' );
	enqueue_script( 'main', 'js/main.js' );
	
	if ( ! is_admin() ) {
        if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
    }
}
add_action( 'wp_enqueue_scripts', 'leverage_enqueue_assets' );

function leverage_enqueue_assets_admin_area() {

	wp_enqueue_style( 'icons', get_template_directory_uri() . '/assets/' . 'css/vendor/icons.min.css', array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'admin', get_template_directory_uri() . '/assets/' . 'css/support/admin.css', array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_script( 'admin', get_template_directory_uri() . '/assets/' . 'js/support/admin.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), 'in_footer' );
}
add_action( 'admin_head', 'leverage_enqueue_assets_admin_area' );

if ( function_exists( 'ACF' ) ) {

	function leverage_add_inline_style() {
		
		// Root open
		$inline_style =':root {';

		// Typography 
		$font_size = get_field( 'font_size', 'option' );
		if ( $font_size ) {

			$inline_style .= esc_attr( '--h1-size: '.$font_size['h1_size'].'rem;' );
			$inline_style .= esc_attr( '--h2-size: '.$font_size['h2_size'].'rem;' );
			$inline_style .= esc_attr( '--p-size: '.$font_size['p_size'].'rem;' );			
		}

		$font_weight = get_field( 'font_weight', 'option' );
		if ( $font_weight ) {

			$inline_style .= esc_attr( '--h1-weight: '.$font_weight['h1_weight'].';' );
			$inline_style .= esc_attr( '--h2-weight: '.$font_weight['h2_weight'].';' );
			$inline_style .= esc_attr( '--p-weight: '.$font_weight['p_weight'].';' );				
		}

		// Brand
		$nav_brand_height = get_field( 'logo_height', 'option' );
		if ( $nav_brand_height ) {
			$inline_style .= esc_attr( '--nav-brand-height: '.$nav_brand_height.'px;' );
		}

		// Page Settings
		if ( get_field( 'override_general_settings' ) ) {

			if ( is_search() ) {
				$header_bg_color = get_field( 'header_bg_color', 'option' );
				$nav_item_color  = get_field( 'nav_item_color', 'option' );
				$hero_bg_color   = get_field( 'hero_bg_color', 'option' );
				
			} else {
				$header_bg_color = get_field( 'header_bg_color' );
				$nav_item_color  = get_field( 'nav_item_color' );
				$hero_bg_color   = get_field( 'hero_bg_color' );
			}
			
		} else {
			
			$header_bg_color = get_field( 'header_bg_color', 'option' );
			$nav_item_color  = get_field( 'nav_item_color', 'option' );
			$hero_bg_color   = get_field( 'hero_bg_color', 'option' );
		}

		if ( $header_bg_color && $nav_item_color && $hero_bg_color ) {

			$inline_style .= esc_attr( '--header-bg-color: '.$header_bg_color.';' );
			$inline_style .= esc_attr( '--nav-item-color: '.$nav_item_color.';' );
			$inline_style .= esc_attr( '--hero-bg-color: '.$hero_bg_color.';' );
		}

		// Theme Color
		$theme_color     = get_field( 'theme_color', 'option' );
		$primary_color   = get_field( 'primary_color', 'option' );
		$secondary_color = get_field( 'secondary_color', 'option' );

		if ( $theme_color == 'custom-color' ) {

			$inline_style .= esc_attr( '--primary-color: '.$primary_color.';' );
			$inline_style .= esc_attr( '--secondary-color: '.$secondary_color.';' );
		}

		// Root close
		$inline_style .='} ';

		// Custom CSS
		if ( get_field( 'custom_css', 'option' ) ) {
			$inline_style .= get_field( 'custom_css', 'option' );
		}

		wp_add_inline_style( 'default', $inline_style );
	}
	add_action( 'wp_enqueue_scripts', 'leverage_add_inline_style' );

	// Custom JS
	if ( get_field( 'custom_js', 'option' ) ) {

		function leverage_add_inline_scripts() {
			
			$inline_script = get_field( 'custom_js', 'option' );
			wp_add_inline_script('custom', $inline_script, 'after');
		}
		add_action('wp_enqueue_scripts', 'leverage_add_inline_scripts');
	}
}