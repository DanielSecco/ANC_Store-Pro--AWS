<?php

if(!function_exists('mkd_core_include_shortcodes_file')) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function mkd_core_include_shortcodes_file() {
		foreach(glob(MIKADO_CORE_SHORTCODES_PATH.'/*/load.php') as $shortcode_load) {
			include_once $shortcode_load;
		}
		
		do_action('mkd_core_action_include_shortcodes_file');
	}
	
	add_action('init', 'mkd_core_include_shortcodes_file', 6); // permission 6 is set to be before vc_before_init hook that has permission 9
}

if(!function_exists('mkd_core_load_shortcodes')) {
	function mkd_core_load_shortcodes() {
		include_once MIKADO_CORE_ABS_PATH.'/lib/shortcode-loader.php';
		
		MikadoCore\Lib\ShortcodeLoader::getInstance()->load();
	}
	
	add_action('init', 'mkd_core_load_shortcodes', 7); // permission 7 is set to be before vc_before_init hook that has permission 9 and after mkd_core_include_shortcodes_file hook
}