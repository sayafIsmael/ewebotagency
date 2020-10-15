<?php
/*
Plugin Name: Leverage Extra
Plugin URI: https://leverage.codings.dev
Author: Codings
Author URI: https://codings.dev
Description: This plugin includes additional settings, widgets and forms in Leverage Theme
Text Domain: leverage-extra
Domain Path: /languages
Version: 1.0.4

== Copyright 2020 Codings ==

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301 USA
*/

$leverage_get_theme = wp_get_theme();

if ( in_array( $leverage_get_theme->get( 'TextDomain' ), array( 'leverage', 'leverage-child' ) ) ) {

    add_action( 'plugins_loaded', 'leverage_extra_load_plugin_textdomain' );

	function leverage_extra_load_plugin_textdomain() {
		load_plugin_textdomain( 'leverage-extra', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

    require_once( plugin_dir_path( __FILE__ ) . 'widgets.php' );
    require_once( plugin_dir_path( __FILE__ ) . 'ajax-request.php' );

    function leverage_theme_settings() {

        if ( function_exists( 'acf_add_options_page' ) && function_exists( 'acf_add_options_sub_page' ) ) {

            acf_add_options_sub_page( array(
                'page_title' => esc_html__( 'Header & Menu', 'leverage-extra' ),
                'menu_title' => esc_html__( 'Header & Menu', 'leverage-extra' ),
                'menu_slug' => 'theme-settings-header',
                'parent_slug' => 'theme-settings'
            ) );

            acf_add_options_sub_page( array(
                'page_title' => esc_html__( 'Footer Section', 'leverage-extra' ),
                'menu_title' => esc_html__( 'Footer Section', 'leverage-extra' ),
                'menu_slug' => 'theme-settings-footer',
                'parent_slug' => 'theme-settings'
            ) );

            acf_add_options_sub_page( array(
                'page_title' => esc_html__( 'General Settings', 'leverage-extra' ),
                'menu_title' => esc_html__( 'General Settings', 'leverage-extra' ),
                'menu_slug' => 'theme-settings-general',
                'parent_slug' => 'theme-settings'
            ) );

            acf_add_options_sub_page( array(
                'page_title' => esc_html__( 'Advanced', 'leverage-extra' ),
                'menu_title' => esc_html__( 'Advanced', 'leverage-extra' ),
                'menu_slug' => 'theme-settings-advanced',
                'parent_slug' => 'theme-settings'
            ) );

            acf_add_options_sub_page( array(
                'page_title' => esc_html__( 'Support', 'leverage-extra' ),
                'menu_title' => esc_html__( 'Support', 'leverage-extra' ),
                'menu_slug' => 'theme-settings-support',
                'parent_slug' => 'theme-settings'
            ) );
        }
    }
    add_action( 'init', 'leverage_theme_settings' );

} else {

    function leverage_admin_notice() { ?>

        <div class="notice notice-error">
            <p>
                <strong><?php esc_html_e( '"Leverage Extra" plugin is not supported by this theme. ', 'leverage-extra' ); ?></strong>
                <?php esc_html_e( 'Please use this plugin with Leverage Theme, or deactivate it.', 'leverage-extra' ); ?>
            </p>
        </div>

    <?php 
    }
    add_action( 'admin_notices', 'leverage_admin_notice' );
}