<?php
/**
 * @package Leverage
 */

if ( ! function_exists( 'leverage_posted_on' ) ) :
	
	function leverage_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="posted-on">' . sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'leverage' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		) . '</span>';
	}
endif;

if ( ! function_exists( 'leverage_posted_by' ) ) :

	function leverage_posted_by() {

		echo '<span class="byline"> ' . sprintf(
			esc_html_x( 'by %s', 'post author', 'leverage' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		) . '</span>';
	}
endif;

if ( ! function_exists( 'leverage_entry_footer' ) ) :

	function leverage_entry_footer() {

		if ( 'post' === get_post_type() ) {
			if ( get_the_category_list( esc_html__( ', ', 'leverage' ) ) ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'leverage' ) . '</span>', get_the_category_list( esc_html__( ', ', 'leverage' ) ) );
			}

			if ( get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'leverage' ) ) ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'leverage' ) . '</span>', get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'leverage' ) ) );
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'leverage' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					__( 'Edit <span class="screen-reader-text">%s</span>', 'leverage' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'leverage_post_thumbnail' ) ) :
	
	function leverage_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif;
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;