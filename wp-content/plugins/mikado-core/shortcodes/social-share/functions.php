<?php

if(!function_exists('mkd_core_add_social_share_shortcodes')) {
	function mkd_core_add_social_share_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\SocialShare\SocialShare'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('mkd_core_filter_add_vc_shortcode', 'mkd_core_add_social_share_shortcodes');
}

if(!function_exists('depot_mikado_get_social_share_html')) {
	/**
	 * Calls button shortcode with given parameters and returns it's output
	 * @param $params
	 *
	 * @return mixed|string
	 */
	function depot_mikado_get_social_share_html($params = array()) {
        if(depot_mikado_core_plugin_installed())
		    return depot_mikado_execute_shortcode('mkd_social_share', $params);
	}
}

if (!function_exists('depot_mikado_the_excerpt_max_charlength')) {
	/**
	 * Function that sets character length for social share shortcode
	 * @param $charlength string original text
	 * @return string shortened text
	 */
	function depot_mikado_the_excerpt_max_charlength($charlength) {

		if (depot_mikado_options()->getOptionValue('twitter_via')) {
			$via = ' via ' . esc_attr(depot_mikado_options()->getOptionValue('twitter_via'));
		} else {
			$via = '';
		}

		$excerpt = esc_html(get_the_excerpt());
		$charlength = 139 - (mb_strlen($via) + $charlength);

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength);
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				return mb_substr( $subex, 0, $excut );
			} else {
				return $subex;
			}
		} else {
			return $excerpt;
		}
	}
}