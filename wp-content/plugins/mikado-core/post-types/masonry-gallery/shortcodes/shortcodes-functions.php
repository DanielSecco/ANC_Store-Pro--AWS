<?php

if(!function_exists('mkd_core_include_masonry_gallery_shortcodes')) {
	function mkd_core_include_masonry_gallery_shortcodes() {
		include_once MIKADO_CORE_CPT_PATH.'/masonry-gallery/shortcodes/masonry-gallery.php';
	}
	
	add_action('mkd_core_action_include_shortcodes_file', 'mkd_core_include_masonry_gallery_shortcodes');
}

if(!function_exists('mkd_core_add_masonry_gallery_shortcodes')) {
	function mkd_core_add_masonry_gallery_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\MasonryGallery\MasonryGallery'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('mkd_core_filter_add_vc_shortcode', 'mkd_core_add_masonry_gallery_shortcodes');
}