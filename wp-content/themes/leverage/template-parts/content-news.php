<?php
/**
 * Template part for displaying a news
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */

if ( get_field( 'news_enable_dark_mode', 'option' ) ) {
	$suggested_color = '#111111';
} else {
	$suggested_color = '#F5F5F5';
}

if ( get_field( 'override_general_settings' ) ) {

    if ( get_field( 'news_background_color' ) ) {
        $news_background_color = get_field( 'news_background_color' );
    } else {
        $news_background_color = $suggested_color;
    }

    $news_enable_dark_mode      = get_field( 'news_enable_dark_mode' );
    $news_enable_separator_line = get_field( 'news_enable_separator_line' );

} else {

    if ( get_field( 'news_background_color', 'option' ) ) {
        $news_background_color = get_field( 'news_background_color', 'option' );
    } else {
        $news_background_color = $suggested_color;
    }

    $news_enable_dark_mode      = get_field( 'news_enable_dark_mode', 'option' );
    $news_enable_separator_line = get_field( 'news_enable_separator_line', 'option' );
} 
?>

<section id="news" class="<?php if ( $news_enable_dark_mode ) { echo esc_attr( 'odd' ); } ?> <?php if ( $news_enable_separator_line ) { echo esc_attr( 'featured' ); } ?> carousel showcase" <?php echo 'style="background-color:'.esc_attr( $news_background_color ).'"'; ?>>
	<div class="container">

        <div class="row intro">
            <div class="col-12 <?php if ( get_field( 'enable_news_button', 'option' ) != false ) { echo esc_attr( 'col-md-9 align-self-center text-md-left' ); } ?> text-center">
            
                <h2 class="<?php if ( get_field( 'enable_news_button', 'option' ) != false ) { echo esc_attr( 'featured' ); } ?>"><?php if ( get_field( 'news_title', 'option' ) ) { the_field( 'news_title', 'option' ); } else { esc_html_e( 'Latest News', 'leverage' ); } ?></h2>
                <?php if ( get_field( 'news_description', 'option' ) ) { the_field( 'news_description', 'option' ); } else { esc_html_e( 'These are the latest posts from our Blog.', 'leverage' ); } ?>
            </div>

            <?php
            if ( get_field( 'enable_news_button', 'option' ) ) :

                $target = get_field( 'news_button_target', 'option' );
            
                switch ( $target ) {
                    case 'Anchor Link':
                        $url = get_field( 'news_button_url', 'option' );
                    break;

                    case 'Internal Link':
                        $url = get_field( 'news_button_url', 'option' );
                    break;

                    case 'External Link':
                        $url = get_field( 'news_button_url', 'option' );
                    break;

                    case 'Inner Page':
                        $url = get_field( 'news_button_page', 'option' );
                    break;

                    case 'Inner Post';
                        $url = get_field( 'news_button_post', 'option' );
                    break;
                }
            ?>

            <div class="col-12 col-md-3 align-self-end">

                <a href="<?php echo esc_url( $url ); ?>" <?php if ( get_field( 'news_button_target', 'option' ) == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="<?php if ( get_field( 'news_button_target', 'option' ) == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?> btn mx-auto mr-md-0 ml-md-auto primary-button">

                    <?php if ( get_field( 'news_button_icon', 'option' ) ) : ?>
                    <i class="icon-<?php echo esc_attr( get_field( 'news_button_icon', 'option' ) ); ?>"></i>
                    <?php endif; ?>

                    <?php the_field( 'news_button_label', 'option' ); ?>
                </a>
            </div>

            <?php endif; ?>
            
        </div>

		<div class="swiper-container slider-mid items">
			<div class="swiper-wrapper">

            <?php
            $args = array(
                'post_status'    => 'publish',
                'post_type'      => 'post',
                'order'          => 'DESC'
            );
            
            $query = new WP_Query( $args );

            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) : $query->the_post(); ?>
                    
                <div class="swiper-slide slide-center item">
                    <div class="row card p-0 text-center">
                        <div class="image-over">
                            <?php 
                                if ( has_post_thumbnail() ) {
                                    echo get_the_post_thumbnail( $post->ID, 'grid-image', array( 'class' => 'card-img-top' ) );
                                } else {
                                    echo '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.esc_attr__( 'No Image', 'leverage' ).'" class="card-img-top"/>';
                                }
                            ?>
                        </div>
                        <div class="card-caption col-12 p-0">
                            <div class="card-body">
                                <a href="<?php the_permalink(); ?>">
                                    <h4><?php the_title(); ?></h4>
                                    <?php the_excerpt(); ?>
                                </a>
                            </div>
                            <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                <a href="<?php the_permalink(); ?>" class="d-lg-flex align-items-center"><i class="icon-user"></i><?php echo get_the_author_meta( 'display_name' ); ?></a>
                                <a href="<?php the_permalink(); ?>" class="d-lg-flex align-items-center"><i class="icon-clock"></i><?php echo leverage_time_ago(); ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                endwhile;
                wp_reset_postdata();

            endif; ?>

			</div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
</section>