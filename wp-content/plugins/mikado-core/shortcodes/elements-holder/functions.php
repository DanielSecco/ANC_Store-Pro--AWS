<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Mkd_Elements_Holder extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Mkd_Elements_Holder_Item extends WPBakeryShortCodesContainer {}
}

if(!function_exists('mkd_core_add_elements_holder_shortcodes')) {
	function mkd_core_add_elements_holder_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\ElementsHolder\ElementsHolder',
			'MikadoCore\CPT\Shortcodes\ElementsHolderItem\ElementsHolderItem'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('mkd_core_filter_add_vc_shortcode', 'mkd_core_add_elements_holder_shortcodes');
}