<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Mkd_Accordion extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Mkd_Accordion_Tab extends WPBakeryShortCodesContainer {}
}

if(!function_exists('mkd_core_add_accordion_shortcodes')) {
	function mkd_core_add_accordion_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\Accordion\Accordion',
			'MikadoCore\CPT\Shortcodes\AccordionTab\AccordionTab'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('mkd_core_filter_add_vc_shortcode', 'mkd_core_add_accordion_shortcodes');
}