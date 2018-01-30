<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Mkd_Vertical_Split_Slider extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Mkd_Vertical_Split_Slider_Left_Panel extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Mkd_Vertical_Split_Slider_Right_Panel extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Mkd_Vertical_Split_Slider_Content_Item extends WPBakeryShortCodesContainer {}
}

if(!function_exists('mkd_core_add_vertical_split_screen_slider_shortcodes')) {
	function mkd_core_add_vertical_split_screen_slider_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\VerticalSplitSlider\VerticalSplitSlider',
			'MikadoCore\CPT\Shortcodes\VerticalSplitSliderContentItem\VerticalSplitSliderContentItem',
			'MikadoCore\CPT\Shortcodes\VerticalSplitSliderLeftPanel\VerticalSplitSliderLeftPanel',
			'MikadoCore\CPT\Shortcodes\VerticalSplitSliderRightPanel\VerticalSplitSliderRightPanel'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('mkd_core_filter_add_vc_shortcode', 'mkd_core_add_vertical_split_screen_slider_shortcodes');
}