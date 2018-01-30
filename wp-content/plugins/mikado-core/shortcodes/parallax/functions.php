<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Mkd_Parallax extends WPBakeryShortCodesContainer {}
}

if(!function_exists('mkd_core_add_parallax_shortcodes')) {
	function mkd_core_add_parallax_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\Parallax\Parallax'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('mkd_core_filter_add_vc_shortcode', 'mkd_core_add_parallax_shortcodes');
}