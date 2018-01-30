<?php

if(!function_exists('depot_mikado_get_button_html')) {
    /**
     * Calls button shortcode with given parameters and returns it's output
     * @param $params
     *
     * @return mixed|string
     */
    function depot_mikado_get_button_html($params) {
        $button_html = depot_mikado_execute_shortcode('mkd_button', $params);
        $button_html = str_replace("\n", '', $button_html);
        return $button_html;
    }
}

if(!function_exists('mkd_core_add_button_shortcodes')) {
	function mkd_core_add_button_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\Button\Button'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('mkd_core_filter_add_vc_shortcode', 'mkd_core_add_button_shortcodes');
}