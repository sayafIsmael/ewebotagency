<?php
/**
 * @package Leverage
 */
function get_breadcrumb() {

	echo '<li class="breadcrumb-item"><a href="'.home_url().'" rel="nofollow">'.esc_html__( 'Home', 'leverage' ).'</a></li>';
	
    if ( is_category() || is_tag() || is_author() ) {
		the_archive_title( '<li class="breadcrumb-item active">', '</li>' );

	} elseif ( is_single() && !is_attachment() ) {

		echo '<li class="breadcrumb-item">';
		the_category( ', ' );
		echo '</li>';

		echo '<li class="breadcrumb-item active">'.get_the_title().'</li>';

	} elseif ( is_page() || is_attachment() ) {

		echo '<li class="breadcrumb-item active">'.get_the_title().'</li>';

    } elseif ( is_search() ) {
		echo '<li class="breadcrumb-item active">'.get_search_query().'</li>';
    }
}