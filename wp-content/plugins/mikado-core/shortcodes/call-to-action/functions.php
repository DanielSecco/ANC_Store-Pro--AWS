<?php

if(!function_exists('mkd_core_add_call_to_action_shortcodes')) {
	function mkd_core_add_call_to_action_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\CallToAction\CallToAction'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('mkd_core_filter_add_vc_shortcode', 'mkd_core_add_call_to_action_shortcodes');
}