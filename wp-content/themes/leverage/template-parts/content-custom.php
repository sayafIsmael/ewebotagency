<?php
/**
 * The template part for displaying a custom section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */

if ( get_field( 'custom_enable_dark_mode', 'option' ) ) {
	$suggested_color = '#111111';
} else {
	$suggested_color = '#F5F5F5';
}

if ( get_field( 'override_general_settings' ) ) {

    if ( get_field( 'custom_background_color' ) ) {
        $custom_background_color = get_field( 'custom_background_color' );
    } else {
        $custom_background_color = $suggested_color;
    }

    $custom_enable_dark_mode      = get_field( 'custom_enable_dark_mode' );
    $custom_enable_separator_line = get_field( 'custom_enable_separator_line' );

} else {

    if ( get_field( 'custom_background_color', 'option' ) ) {
        $custom_background_color = get_field( 'custom_background_color', 'option' );
    } else {
        $custom_background_color = $suggested_color;
    }

    $custom_enable_dark_mode      = get_field( 'custom_enable_dark_mode', 'option' );
    $custom_enable_separator_line = get_field( 'custom_enable_separator_line', 'option' );
} 
?>

<section id="custom" class="<?php if ( $custom_enable_dark_mode ) { echo esc_attr( 'odd' ); } ?> <?php if ( $custom_enable_separator_line ) { echo esc_attr( 'featured' ); } ?> custom" <?php echo 'style="background-color:'.esc_attr( $subscribe_background_color ).'"'; ?>>
	<div class="container">

		<?php
		if ( get_field( 'enable_custom_title', 'option' ) ) : ?>

        <div class="row intro">
            <div class="col-12 text-center">
                <h2><?php the_field( 'custom_title', 'option' ); ?></h2>
                <?php the_field( 'custom_description', 'option' ); ?>
            </div>            
        </div>

		<?php endif; ?>

		<div class="row">
			<div class="col-12">
				<?php the_field( 'custom', 'option' ); ?>
			</div>

		</div>
	</div>
</section>