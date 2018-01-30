<?php

if(!function_exists('mkd_core_add_section_title_shortcodes')) {
	function mkd_core_add_section_title_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\SectionTitle\SectionTitle'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('mkd_core_filter_add_vc_shortcode', 'mkd_core_add_section_title_shortcodes');
}