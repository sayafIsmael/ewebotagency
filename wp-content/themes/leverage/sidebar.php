<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Leverage
 */

if ( function_exists( 'ACF' ) ) {
	$disable_sidebar = get_field( 'disable_sidebar' );
} else {
	$disable_sidebar = '';
}

if ( is_single() && is_active_sidebar( 'blog-sidebar' ) && ! $disable_sidebar ) : ?>

<aside class="col-12 col-lg-4 pl-lg-5 p-0 float-right sidebar">
	<?php dynamic_sidebar( 'blog-sidebar' ); ?>
</aside>

<?php endif;

if ( is_page() && is_active_sidebar( 'page-sidebar' ) && ! $disable_sidebar ) : ?>

<aside class="col-12 col-lg-4 pl-lg-5 p-0 float-right sidebar">
	<?php dynamic_sidebar( 'page-sidebar' ); ?>
</aside>

<?php endif; ?>