<?php

if(!function_exists('mkd_core_include_team_shortcodes')) {
	function mkd_core_include_team_shortcodes() {
		include_once MIKADO_CORE_CPT_PATH.'/team/shortcodes/team-list.php';
		include_once MIKADO_CORE_CPT_PATH.'/team/shortcodes/team-member.php';
		include_once MIKADO_CORE_CPT_PATH.'/team/shortcodes/team-slider.php';
	}
	
	add_action('mkd_core_action_include_shortcodes_file', 'mkd_core_include_team_shortcodes');
}

if(!function_exists('mkd_core_add_team_shortcodes')) {
	function mkd_core_add_team_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\Team\TeamList',
			'MikadoCore\CPT\Shortcodes\Team\TeamMember',
			'MikadoCore\CPT\Shortcodes\Team\TeamSlider'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('mkd_core_filter_add_vc_shortcode', 'mkd_core_add_team_shortcodes');
}