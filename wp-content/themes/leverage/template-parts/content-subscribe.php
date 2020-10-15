<?php
/**
 * Template part for displaying a subscribe section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */

if ( get_field( 'subscribe_enable_dark_mode', 'option' ) ) {
	$suggested_color = '#111111';
} else {
	$suggested_color = '#F5F5F5';
}

if ( get_field( 'override_general_settings' ) ) {

    if ( get_field( 'subscribe_background_color' ) ) {
        $subscribe_background_color = get_field( 'subscribe_background_color' );
    } else {
        $subscribe_background_color = $suggested_color;
    }

    $subscribe_enable_dark_mode      = get_field( 'subscribe_enable_dark_mode' );
    $subscribe_enable_separator_line = get_field( 'subscribe_enable_separator_line' );

} else {

    if ( get_field( 'subscribe_background_color', 'option' ) ) {
        $subscribe_background_color = get_field( 'subscribe_background_color', 'option' );
    } else {
        $subscribe_background_color = $suggested_color;
    }

    $subscribe_enable_dark_mode      = get_field( 'subscribe_enable_dark_mode', 'option' );
    $subscribe_enable_separator_line = get_field( 'subscribe_enable_separator_line', 'option' );
} 
?>

<section class="<?php if ( $subscribe_enable_dark_mode ) { echo esc_attr( 'odd' ); } ?> <?php if ( $subscribe_enable_separator_line ) { echo esc_attr( 'featured' ); } ?> subscription" <?php echo 'style="background-color:'.esc_attr( $subscribe_background_color ).'"'; ?>>
	<div class="container smaller">

        <div class="row intro">
            <div class="col-12 text-center">
				<h2><?php if ( get_field( 'subscribe_title', 'option' ) ) { the_field( 'subscribe_title', 'option' ); } else { esc_html_e( 'Newsletter', 'leverage' ); } ?></h2>
                <?php if ( get_field( 'subscribe_description', 'option' ) ) { the_field( 'subscribe_description', 'option' ); } else { esc_html_e( 'Subscribe to our Newsletter to stay informed firsthand.', 'leverage' ); } ?>
            </div>            
        </div>

		<div class="row">
			<div class="col-12 p-0">
				<form action="<?php echo admin_url( 'admin-ajax.php' ) ; ?>" id="leverage-subscribe" class="row m-auto items">

					<?php wp_nonce_field( 'leverage_subscribe' ); ?>
					<input type="hidden" name="action" value="leverage_contact_form">
					<input type="hidden" name="section" value="leverage_subscribe">

					<div class="col-12 col-lg-5 m-lg-0 input-group align-self-center item">
						<input type="text" name="name" minlength="3" class="form-control" placeholder="<?php esc_attr_e( 'Name', 'leverage' ); ?>" required>
					</div>
					<div class="col-12 col-lg-5 m-lg-0 input-group align-self-center item">
						<input type="email" name="email" minlength="3" class="form-control" placeholder="<?php esc_attr_e( 'Email', 'leverage' ); ?>" required>
					</div>
					<div class="col-12 col-lg-2 m-lg-0 input-group align-self-center item">
						<button class="btn primary-button w-100" data-success="<?php esc_attr_e( 'SENT', 'leverage' ); ?>">
							<i class="icon-note"></i>
							<?php esc_html_e( 'SUBSCRIBE', 'leverage' ); ?>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>