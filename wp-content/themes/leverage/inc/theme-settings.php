<?php
/**
 * @package Leverage
 */

add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );
 
function my_acf_json_save_point( $path ) {
    
	$path = get_template_directory() . '/inc/acf-json';
	
    return $path;
}

add_filter( 'acf/settings/load_json', 'my_acf_json_load_point' );

function my_acf_json_load_point( $paths ) {

	$paths = array( get_template_directory() . '/inc/acf-json' );    
    
	if ( is_child_theme() ) {
		$paths[] = get_stylesheet_directory() . '/inc/acf-json';
	}

	return $paths;    
}

if ( function_exists( 'acf_add_options_page' ) && function_exists( 'acf_add_options_sub_page' ) ) {

	acf_add_options_page(array(
		'page_title' => esc_html__( 'Theme Settings', 'leverage' ),
		'menu_title' => esc_html__( 'Theme Settings', 'leverage' ),
		'menu_slug' => 'theme-settings',
		'capability' => 'edit_posts',
		'icon_url' => get_template_directory_uri().'/assets/images/dash-icon.png'
	) );

	acf_add_options_sub_page(array(
		'page_title' => esc_html__( 'Branding', 'leverage' ),
		'menu_title' => esc_html__( 'Branding', 'leverage' ),
		'menu_slug' => 'theme-settings-branding',
		'parent_slug' => 'theme-settings'
	) );

	acf_add_options_sub_page(array(
		'page_title' => esc_html__( 'Typography', 'leverage' ),
		'menu_title' => esc_html__( 'Typography', 'leverage' ),
		'menu_slug' => 'theme-settings-typography',
		'parent_slug' => 'theme-settings'
	) );

	acf_add_options_sub_page(array(
		'page_title' => esc_html__( 'Design & Color', 'leverage' ),
		'menu_title' => esc_html__( 'Design & Color', 'leverage' ),
		'menu_slug' => 'theme-settings-design',
		'parent_slug' => 'theme-settings'
	) );
}