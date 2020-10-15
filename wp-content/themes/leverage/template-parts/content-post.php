<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */

if ( ! has_post_thumbnail() ) { $has_image = 'no-image'; } else $has_image = ''; ?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'card p-0 text-center item '.$has_image ); ?>>
    
    <?php 
    if ( has_post_thumbnail() ) : ?>
        <div class="image-over">
            <?php echo get_the_post_thumbnail( $post->ID, 'grid-image', array( 'class' => 'card-img-top' ) ); ?>
        </div>
    <?php endif; ?>

    <div class="card-caption col-12 p-0">
        <div class="card-body">
            <a href="<?php the_permalink(); ?>">
                <?php if ( is_sticky() ) : ?>
                <i class="icon icon-pin mb-4"></i>
                <?php endif; ?>
                <h4><?php the_title(); ?></h4>
                <?php the_excerpt(); ?>
            </a>
        </div>
        <div class="card-footer d-lg-flex align-items-center justify-content-center">
            <a href="<?php the_permalink(); ?>" class="d-lg-flex align-items-center">
                <i class="icon-user"></i>
                <?php echo get_the_author_meta( 'display_name' ); ?>
            </a>
            <a href="<?php the_permalink(); ?>" class="d-lg-flex align-items-center">
                <i class="icon-clock"></i>
                <?php echo leverage_time_ago(); ?>
            </a>
        </div>
    </div>
</div> 