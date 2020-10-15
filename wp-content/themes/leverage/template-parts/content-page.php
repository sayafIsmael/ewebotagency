<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */
?>

<div class="row intro">
	<div class="col-12 align-self-center text-center text-sm-left">

		<?php
		if ( have_posts() ) :

			while ( have_posts() ) : 

				the_post(); the_content(); 
				
				wp_link_pages(array(
					'before' => '<div class="clearfix"></div><div class="ml-0 page-links">',
					'after'  => '</div>',
				));
				
			endwhile; 
			endif; 
		?>
	</div>
</div>