<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */
?>

<div class="row">
	<div class="col-12 align-self-center">

		<?php
		if ( have_posts() ) :
			while( have_posts() ) :
				the_post(); the_content();	
				
				wp_link_pages( array(
					'before' => '<div class="clearfix"></div><div class="ml-0 page-links">',
					'after'  => '</div>',
				) );

			endwhile; 
		endif; 
		?>

		<?php if( is_single() ) : ?>

		<div class="clearfix"></div>
		<ul class="post-holder">
			<li class="post-meta-item">
				<time class="date"><?php echo leverage_posted_on(); ?>.</time>
			</li>
		</ul>

		<?php if ( get_the_tags() ) : ?>

		<ul class="post-holder">
			<li class="post-meta-item">
				<?php the_tags(); ?>
			</li>
		</ul>

		<?php endif; ?>

		<?php endif; ?>
	</div>
</div>