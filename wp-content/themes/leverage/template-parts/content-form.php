<?php
/**
 * The template part for displaying a contact form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Leverage
 */

if (get_field( 'form_enable_dark_mode', 'option' ) ) {
	$suggested_color = '#111111';
} else {
	$suggested_color = '#F5F5F5';
}

if ( get_field( 'override_general_settings' ) ) {

    if ( get_field( 'form_background_color' ) ) {
        $form_background_color = get_field( 'form_background_color' );
    } else {
        $form_background_color = $suggested_color;
    }

    $form_enable_dark_mode      = get_field( 'form_enable_dark_mode' );
    $form_enable_separator_line = get_field( 'form_enable_separator_line' );

} else {

    if ( get_field( 'form_background_color', 'option' ) ) {
        $form_background_color = get_field( 'form_background_color', 'option' );
    } else {
        $form_background_color = $suggested_color;
    }

    $form_enable_dark_mode      = get_field( 'form_enable_dark_mode', 'option' );
    $form_enable_separator_line = get_field( 'form_enable_separator_line', 'option' );
} 
?>

<?php
if ( have_rows( 'steps', 'option' ) ) : ?>

<section id="contact" class="<?php if ( $form_enable_dark_mode ) { echo esc_attr( 'odd' ); } ?> <?php if ( $form_enable_separator_line ) { echo esc_attr( 'featured' ); } ?> form" <?php echo 'style="background-color:'.esc_attr( $form_background_color ).'"'; ?>>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 align-self-start text-center text-md-left">

				<div class="row success message">
					<div class="col-12 p-0">
						<i class="icon bigger icon-check"></i>
						<h3><?php the_field( 'success_message', 'option' ); ?></h3>						
						<a href="" class="btn mx-auto primary-button">
							<i class="icon-refresh"></i>
							<?php esc_html_e( 'REFRESH', 'leverage' ); ?>
						</a>
					</div>
				</div>

				<div class="row intro">
					<div class="col-12 p-0">

						<?php
						if ( have_rows( 'steps', 'option' ) ) :
							while( have_rows( 'steps', 'option' ) ) : the_row(); ?>

							<div class="step-title">
								<h2 class="featured alt"><?php the_sub_field( 'step_title' ); ?></h2>
								<?php the_sub_field( 'step_description' ); ?>
							</div>

							<?php 
							endwhile;
						endif;
						?>

					</div>
				</div>

				<div class="row text-center">
					<div class="col-12 p-0">
                        <form action="<?php echo admin_url( 'admin-ajax.php' ) ; ?>" id="leverage-form" class="multi-step-form">

							<?php wp_nonce_field( 'leverage_form' ); ?>
							<input type="hidden" name="action" value="leverage_contact_form">
							<input type="hidden" name="section" value="leverage_form">

							<ul class="progressbar">

								<?php
								if ( have_rows( 'steps', 'option' ) ) :
									while( have_rows( 'steps', 'option' ) ) : the_row(); ?>

									<li>
										<?php the_sub_field( 'step_progressbar_title' ); ?>
									</li>

									<?php 
									endwhile;
								endif;
								?>
								
							</ul>							

							<?php
							if ( have_rows( 'steps', 'option' ) ) : $step = 1;
								while( have_rows( 'steps', 'option' ) ) : the_row(); $step++; ?>

								<fieldset class="step-group">

									<?php
									if ( have_rows( 'step_fields' ) ) :
										while( have_rows( 'step_fields' ) ) : the_row();

											if ( get_row_layout() == 'text_field' ) : ?>

											<div class="row">
												<div class="col-12 input-group p-0">
													<input type="text" name="<?php echo sanitize_title( get_sub_field( 'field' ) ); ?>" data-minlength="3" class="form-control" placeholder="<?php the_sub_field( 'field' ); ?>" required>
												</div>
											</div>

											<?php
											elseif ( get_row_layout() == 'text_area_field' ) : ?>

											<div class="row">
												<div class="col-12 input-group p-0">
													<textarea name="<?php echo sanitize_title( get_sub_field( 'field' ) ); ?>" data-minlength="3" class="form-control" placeholder="<?php the_sub_field( 'field' ); ?>" required></textarea>
												</div>
											</div>

											<?php
											elseif ( get_row_layout() == 'email_field' ) : ?>

											<div class="row">
												<div class="col-12 input-group p-0">
													<input type="email" name="email" data-minlength="3" class="form-control" placeholder="<?php the_sub_field( 'field' ); ?>" required>
												</div>
											</div>

											<?php
											elseif ( get_row_layout() == 'number_field' ) : ?>

											<div class="row">
												<div class="col-12 input-group p-0">
													<input type="number" name="<?php echo sanitize_title( get_sub_field( 'field' ) ); ?>" data-minlength="3" class="form-control" placeholder="<?php the_sub_field( 'field' ); ?>" required>
												</div>
											</div>

											<?php
											elseif ( get_row_layout() == 'select_field' ) : ?>

											<div class="row">
												<div class="col-12 input-group p-0">
													<i class="icon-arrow-down"></i>
													<select name="<?php echo sanitize_title( get_sub_field( 'field' ) ); ?>" data-minlength="1" class="form-control" required>
													
                                                   		<option value="" selected disabled><?php the_sub_field( 'info_option' ); ?></option>

														<?php
														$options = preg_split( '/\r\n|\r|\n/', get_sub_field( 'field' ) );

														foreach( $options as $option ) : ?>
															<option><?php echo esc_html( $option ); ?></option>
														<?php
														endforeach;
														?>

													</select>
												</div>
											</div>

											<?php
											endif;
										endwhile;
									endif;
									?>

									<div class="col-12 input-group p-0 d-flex justify-content-center justify-content-md-start">

										<?php if ( $step > 2 ) : ?>
										<a class="step-prev btn primary-button mr-4">
											<i class="icon-arrow-left-circle"></i>
											<?php echo esc_html_e( 'PREV', 'leverage' ); ?>
										</a>
										<?php endif; ?>

										<a class="step-next btn primary-button">
											<?php echo esc_html_e( 'NEXT', 'leverage' ); ?>
											<i class="icon-arrow-right-circle left"></i>
										</a>
									</div>

								</fieldset>

								<?php 
								endwhile;
							endif;
							?>

						</form>
					</div>
				</div>
			</div>

			<div class="gallery col-12 col-md-6 pl-md-5 d-none d-md-block">

				<?php
				if ( have_rows( 'steps', 'option' ) ) :
					while( have_rows( 'steps', 'option' ) ) : the_row();
							
						$image = get_sub_field( 'step_image' );
						if ( $image ) : ?>

							<a href="<?php if ( get_sub_field( 'enable_video' ) ) { echo esc_url( get_sub_field( 'video_url' ) ); } else { echo esc_url( $image['url'] ); } ?>" class="step-image">

							<?php if ( get_sub_field( 'enable_video' ) ) : ?>

							<i class="play-video icon-control-play"></i>
							<div class="mask-radius"></div>

							<?php endif; ?>

							<img src="<?php echo esc_url( $image['sizes']['leverage-about-image'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" class="fit-image"/>
						</a>

						<?php 
						endif;
					endwhile;
				endif;
				?>

				<?php
				$image = get_field( 'success_image', 'option' );
				if ( $image ) : ?>

				<a class="step-image" href="<?php echo esc_url( $image['sizes']['leverage-about-image'] ); ?>">
					<img src="<?php echo esc_url( $image['sizes']['leverage-about-image'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" class="fit-image"/>
				</a>
				
				<?php endif; ?>

			</div>
		</div>
	</div>
</section>

<?php endif;