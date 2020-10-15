<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */
?>

<div class="col-8 text-center">
	<h2><?php esc_html_e( 'Try Again', 'leverage' ); ?></h2>
	<p class="text-max-800 mb-5">
	
	<?php
	if ( is_home() && current_user_can( ' publish_posts' ) ) :

		printf(
			wp_kses(
				__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'leverage' ),
				array(
					'a' => array(
						'href' => array(),
					),
				)
			),
			esc_url( admin_url( 'post-new.php' ) )
		);

	elseif ( is_search()) : 

		esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'leverage' );

		get_search_form();

	else : 
		
		esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'leverage' );

		get_search_form();

	endif; ?>

	</p>
</div>

