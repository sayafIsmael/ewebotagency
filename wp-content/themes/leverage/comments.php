<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */

if ( post_password_required() ) {
	return;
} ?>

<div class="row comments">
	<div class="col-12 align-self-center">

		<?php
		if ( have_comments() ) : ?>

			<?php
			if ( '1' === get_comments_number() ) {

				echo '<h3>1 ' . esc_html( 'Comment' ) . ' </h3>';

			} else {

				echo '<h3>' . get_comments_number() . ' ' . esc_html( 'Comments' ) . ' </h3>';
			}
			?>

			<ol class="comment-list">
				<?php
				wp_list_comments( array(
					'avatar_size' => 60, 
					'style'       => 'ul', 
					'callback'    => 'leverage_comments', 
					'type'        => 'all'
				) );
				?>
			</ol>

			<?php
			the_comments_pagination( array(
				'prev_text' => 'PREV',
				'next_text' => 'NEXT'
			) );

			if ( ! comments_open() ) : ?>
			
			<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'leverage' ); ?></p>
				
			<?php endif;

		endif; ?>

	</div>
</div>


<div class="row comments">
	<div class="col-12 align-self-center">

		<?php comment_form(); ?>

	</div>
</div>