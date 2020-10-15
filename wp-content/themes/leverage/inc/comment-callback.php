<?php
/**
 * @package Leverage
 */
function leverage_comments( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	    
		<div class="comment-wrap">
			<div class="comment-img">
				<?php 
					echo get_avatar(
						$comment,
						$args['avatar_size'],
						null,
						null,
						array( 'class' => array(
							'img-responsive', 
							'img-circle'
							) 
						)
					);
				?>
			</div>
			<div class="comment-body">
				<h4 class="comment-author"><?php echo get_comment_author_link(); ?></h4>

				<span class="comment-date">
					<?php printf(__( '%1$s at %2$s', 'leverage' ), get_comment_date(),  get_comment_time() ) ?>
				</span>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					
					<em><?php esc_html_e( 'Comment awaiting approval', 'leverage' ); ?></em>
					
				<?php endif; ?>

				<?php comment_text(); ?>

				<span class="comment-reply"> 
					<?php comment_reply_link( array_merge(
							$args,
							array( 'reply_text' => __( 'Reply', 'leverage' ), 
							'depth' => $depth, 
							'max_depth' => $args['max_depth']
							)
						), $comment->comment_ID);
					?>
				</span>
			</div>
		</div>
<?php }