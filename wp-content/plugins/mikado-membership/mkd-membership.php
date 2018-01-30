<?php
/**
 * Plugin Name: Mikado Membership
 * Description: Plugin that adds social login and user dashboard page
 * Author: Mikado Themes
 * Version: 1.1
 */

require_once 'load.php';

if ( ! function_exists( 'mkd_membership_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function mkd_membership_text_domain() {
		load_plugin_textdomain( 'mkd_membership', false, MIKADO_MEMBERSHIP_REL_PATH . '/languages' );
	}

	add_action( 'plugins_loaded', 'mkd_membership_text_domain' );
}

if ( ! function_exists( 'mkd_membership_scripts' ) ) {
	/**
	 * Loads plugin scripts
	 */
	function mkd_membership_scripts() {

		wp_enqueue_style( 'mkd_membership_style', plugins_url( MIKADO_MEMBERSHIP_REL_PATH . '/assets/css/membership.min.css' ) );
		wp_enqueue_style( 'mkd_membership_responsive_style', plugins_url( MIKADO_MEMBERSHIP_REL_PATH . '/assets/css/membership-responsive.min.css' ) );

		$array_deps = array(
			'underscore',
			'jquery-ui-tabs'
		);
		if ( mkd_membership_theme_installed() ) {
			$array_deps[] = 'depot_mikado_modules';
		}
		wp_enqueue_script( 'mkd_membership_script', plugins_url( MIKADO_MEMBERSHIP_REL_PATH . '/assets/js/membership.min.js' ), $array_deps, false, true );
	}

	add_action( 'wp_enqueue_scripts', 'mkd_membership_scripts' );
}