<?php

if(!function_exists('mkd_core_include_portfolio_shortcodes')) {
	function mkd_core_include_portfolio_shortcodes() {
		include_once MIKADO_CORE_CPT_PATH.'/portfolio/shortcodes/portfolio-list.php';
		include_once MIKADO_CORE_CPT_PATH.'/portfolio/shortcodes/portfolio-project-info.php';
		include_once MIKADO_CORE_CPT_PATH.'/portfolio/shortcodes/portfolio-slider.php';
	}
	
	add_action('mkd_core_action_include_shortcodes_file', 'mkd_core_include_portfolio_shortcodes');
}

if(!function_exists('mkd_core_add_portfolio_shortcodes')) {
	function mkd_core_add_portfolio_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\Portfolio\PortfolioList',
			'MikadoCore\CPT\Shortcodes\Portfolio\PortfolioProjectInfo',
			'MikadoCore\CPT\Shortcodes\Portfolio\PortfolioSlider'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('mkd_core_filter_add_vc_shortcode', 'mkd_core_add_portfolio_shortcodes');
}