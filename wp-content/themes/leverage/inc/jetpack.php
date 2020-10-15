<?php
/**
 * @package Leverage
 */
function leverage_jetpack_setup() { 

	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'main',
			'render'    => 'leverage_infinite_scroll_render',
			'footer'    => 'page',
		)
	);

	add_theme_support( 'jetpack-responsive-videos' );

	add_theme_support(
		'jetpack-content-options',
		array(
			'post-details' => array(
				'stylesheet' => 'leverage-style',
				'date'       => '.posted-on',
				'categories' => '.cat-links',
				'tags'       => '.tags-links',
				'author'     => '.byline',
				'comment'    => '.comments-link',
			),
			'featured-images' => array(
				'archive' => true,
				'post'    => true,
				'page'    => true,
			),
		)
	);
}
add_action( 'after_setup_theme', 'leverage_jetpack_setup' );

function leverage_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', 'post' );
	}
}