<?php
/**
 * @package Leverage
 */

require_once ( get_template_directory() . '/inc/tgm-plugin-activation.php' );

function leverage_register_required_plugins() {

	$plugins = array(

		array(
			'name'               => 'Leverage Extra',
			'slug'               => 'leverage-extra',
			'source'             => 'https://leverage.codings.dev/plugins/leverage-extra.zip',
			'required'           => true,
			'version'            => '1.0.1',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'Advanced Custom Fields PRO',
			'slug'               => 'advanced-custom-fields-pro',
			'source'             => 'https://leverage.codings.dev/plugins/advanced-custom-fields-pro.zip',
			'required'           => true,
			'version'            => '5.8.11',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'One Click Demo Import',
			'slug'               => 'one-click-demo-import',
			'source'             => 'https://leverage.codings.dev/plugins/one-click-demo-import.zip',
			'required'           => true,
			'version'            => '2.5.2',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'Envato Market',
			'slug'               => 'envato-market',
			'source'             => 'https://leverage.codings.dev/plugins/envato-market.zip',
			'required'           => true,
			'version'            => '2.0.3',
			'force_activation'   => false,
			'force_deactivation' => false
		),
	);

	$config = array(
		'id'           => 'leverage',
		'default_path' => '',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'leverage_register_required_plugins' );