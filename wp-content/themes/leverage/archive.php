<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */

get_header(); 
get_template_part( 'template-parts/content', 'no-slider' );
get_template_part( 'template-parts/content', 'showcase' );
get_footer();