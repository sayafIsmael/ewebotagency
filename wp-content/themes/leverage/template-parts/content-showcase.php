<?php
/**
 * Template part for displaying showcase
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */

enqueue_script( 'bricklayer', 'js/vendor/bricklayer.min.js' ); ?>

<section id="blog" class="showcase blog-grid masonry">
	<div class="container">
		<div class="row content blog-grid masonry">
			<main class="col-12 p-0">
				<div class="<?php if( ! have_posts() ) { echo 'row items justify-content-center'; } else { echo 'bricklayer items'; } ?>">

					<?php
					$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

					if ( is_tag() ) {
						$taxonomy = 'tag';
						$object   = $wp_query->queried_object->slug;

					} elseif ( is_category() ) {
						$taxonomy = 'cat';
						$object   = $wp_query->queried_object->term_id;

					} elseif ( is_author() ) {
						$taxonomy = 'author';
						$object   = $wp_query->queried_object->ID;
						
					} elseif ( is_search() ) {
						$taxonomy = 's';
						$object   = get_search_query();
						
					} else {
						$taxonomy = null;
						$object   = null;
					}

					$args = array(
						'post_status' => 'publish',
						'post_type'   => 'post',
						$taxonomy     => $object,
						'paged'       => $paged,
						'order'       => 'DESC'
					);
					
                    $query = new WP_Query( $args);

					if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post();
                            
							get_template_part( 'template-parts/content', 'post' );

                        endwhile;
                        wp_reset_postdata();

					else :
						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
		
				</div>
                
                <?php
                $pagination = paginate_links( array(
                    'current'   => $paged
                ) );                            
                
                if ( $pagination ) : ?>

				<div class="row">
					<div class="col-12">
						<nav>
							<?php 
								echo paginate_links( array(
									'current'   => $paged,
									'total'     => $query->max_num_pages,
									'end_size'  => 3,
									'mid_size'  => 3,
									'prev_text' => '<i class="icon-arrow-left"></i>',
									'next_text' => '<i class="icon-arrow-right"></i>',
									'type'      => 'list'
								) );  
							?>
						</nav>
					</div>
                </div>
                
				<?php endif; ?>
				
			</main>			
		</div>
	</div>
</section>