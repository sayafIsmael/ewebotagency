<?php
/**
 * Leverage functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Leverage
 */

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

if ( defined( 'JETPACK__VERSION' ) ) {
	require_once ( get_template_directory() . '/inc/jetpack.php' );
}

require_once ( get_template_directory() . '/inc/register-required-plugins.php' );
require_once ( get_template_directory() . '/inc/import-demos.php' );

require_once ( get_template_directory() . '/inc/theme-settings.php' );
require_once ( get_template_directory() . '/inc/enqueue-assets.php' );
require_once ( get_template_directory() . '/inc/navwalker.php' );
require_once ( get_template_directory() . '/inc/breadcrumb.php' );
require_once ( get_template_directory() . '/inc/comment-callback.php' );

require_once ( get_template_directory() . '/inc/template-tags.php' );
require_once ( get_template_directory() . '/inc/template-functions.php' );
require_once ( get_template_directory() . '/inc/customizer.php' );

if ( ! function_exists( 'leverage_support' ) ) {
	
	function leverage_support() {

		load_theme_textdomain( 'leverage', get_template_directory() . '/languages' );

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'leverage' ),
		) );

		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 120,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'leverage-full-image', 1920, 943, true );
		add_image_size( 'leverage-hero-image', 637, 943, true );
		add_image_size( 'leverage-grid-image', 500, 650, true );
		add_image_size( 'leverage-listing-image', 500, 222, true );
		add_image_size( 'leverage-about-image', 600, 600, true );
		add_image_size( 'leverage-video-image', 900, 400, true );
		add_image_size( 'leverage-portfolio-image', 300, 230, true );
	}

} 
add_action( 'after_setup_theme', 'leverage_support' );

function leverage_content_width() {

	$GLOBALS['content_width'] = apply_filters( 'leverage_content_width', 780 );
} 
add_action( 'after_setup_theme', 'leverage_content_width', 0 );

function leverage_widgets_init() {

	register_sidebar( 
		array(
			'name'          => esc_html__( 'Blog Sidebar', 'leverage' ),
			'id'            => 'blog-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'leverage' ),
			'before_widget' => '<div id="%1$s" class="row item"><div class="col-12 align-self-center">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Page Sidebar', 'leverage' ),
			'id'            => 'page-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'leverage' ),
			'before_widget' => '<div id="%1$s" class="row item"><div class="col-12 align-self-center">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'leverage_widgets_init' );
 
function remove_thumbnail_width_height( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_width_height', 10, 5 );

function leverage_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'leverage_excerpt_length', 999 );

function leverage_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'leverage_excerpt_more' );

function leverage_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
  
    return $title;
}
add_filter( 'get_the_archive_title', 'leverage_archive_title' );

function leverage_time_ago() {
	return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__( 'ago', 'leverage' );
}

function leverage_check_is_elementor() {

	if ( did_action( 'elementor/loaded' ) ) {

    	global $post;
		return \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);
		
	} else {
		return false;
	}
}