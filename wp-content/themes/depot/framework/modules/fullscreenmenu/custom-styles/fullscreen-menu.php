<?php

if (!function_exists('depot_mikado_fullscreen_menu_general_styles')) {
	function depot_mikado_fullscreen_menu_general_styles() {
		$text_alignment          = depot_mikado_options()->getOptionValue('fullscreen_alignment');
		$text_alignment_selector = array(
			'nav.mkd-fullscreen-menu ul li',
			'.mkd-fullscreen-above-menu-widget-holder',
			'.mkd-fullscreen-below-menu-widget-holder'
		);
		
		if (!empty($text_alignment)) {
			echo depot_mikado_dynamic_css($text_alignment_selector, array(
				'text-align' => $text_alignment
			));
		}
		
		$background_color         = depot_mikado_options()->getOptionValue('fullscreen_menu_background_color');
		$background_transparency  = depot_mikado_options()->getOptionValue('fullscreen_menu_background_transparency');
		$background_image         = depot_mikado_options()->getOptionValue('fullscreen_menu_background_image');
		$background_pattern_image = depot_mikado_options()->getOptionValue('fullscreen_menu_pattern_image');
		
		$fullscreen_background_color        = !empty($background_color) ? depot_mikado_hex2rgb($background_color) : '';
		$fullscreen_background_transparency = $background_transparency !== '' ? $background_transparency : 0.9;

		if (!empty($fullscreen_background_color)) {
			echo depot_mikado_dynamic_css('.mkd-fullscreen-menu-holder', array(
				'background-color' => 'rgba(' . $fullscreen_background_color[0] . ',' . $fullscreen_background_color[1] . ',' . $fullscreen_background_color[2] . ',' . $fullscreen_background_transparency . ')'
			));
		}

		if (!empty($background_image)) {
			echo depot_mikado_dynamic_css('.mkd-fullscreen-menu-holder', array(
				'background-image' => 'url(' . esc_url($background_image) . ')',
				'background-position' => 'center 0',
				'background-repeat' => 'no-repeat'
			));
		}

		if (!empty($background_pattern_image)) {
			echo depot_mikado_dynamic_css('.mkd-fullscreen-menu-holder', array(
				'background-image' => 'url(' . esc_url($background_pattern_image) . ')',
				'background-repeat' => 'repeat',
				'background-position' => '0 0'
			));
		}
	}

	add_action('depot_mikado_style_dynamic', 'depot_mikado_fullscreen_menu_general_styles');
}

if (!function_exists('depot_mikado_fullscreen_menu_first_level_style')) {
	function depot_mikado_fullscreen_menu_first_level_style()	{
		$first_menu_style = depot_mikado_get_typography_styles('fullscreen_menu');
		
		$first_menu_selector = array(
			'nav.mkd-fullscreen-menu > ul > li > a'
		);
		
		echo depot_mikado_dynamic_css($first_menu_selector, $first_menu_style);
		

		$first_menu_hover_style = array();

		if (depot_mikado_options()->getOptionValue('fullscreen_menu_hover_color') !== '') {
			$first_menu_hover_style['color'] = depot_mikado_options()->getOptionValue('fullscreen_menu_hover_color');
		}

		if (!empty($first_menu_hover_style)) {
			echo depot_mikado_dynamic_css('nav.mkd-fullscreen-menu > ul > li > a:hover', $first_menu_hover_style);
		}

		$first_menu_active_style = array();

		if (depot_mikado_options()->getOptionValue('fullscreen_menu_active_color') !== '') {
			$first_menu_active_style['color'] = depot_mikado_options()->getOptionValue('fullscreen_menu_active_color');
		}

		if (!empty($first_menu_active_style)) {
			echo depot_mikado_dynamic_css('nav.mkd-fullscreen-menu > ul > li.mkd-active-item > a', $first_menu_active_style);
		}
	}

	add_action('depot_mikado_style_dynamic', 'depot_mikado_fullscreen_menu_first_level_style');
}

if (!function_exists('depot_mikado_fullscreen_menu_second_level_style')) {
	function depot_mikado_fullscreen_menu_second_level_style() {
		$second_menu_style = depot_mikado_get_typography_styles('fullscreen_menu', '_2nd');
		
		$second_menu_selector = array(
			'nav.mkd-fullscreen-menu ul li ul li a'
		);
		
		echo depot_mikado_dynamic_css($second_menu_selector, $second_menu_style);
		

		$second_menu_hover_style = array();

		if (depot_mikado_options()->getOptionValue('fullscreen_menu_hover_color_2nd') !== '') {
			$second_menu_hover_style['color'] = depot_mikado_options()->getOptionValue('fullscreen_menu_hover_color_2nd');
		}

		if (!empty($second_menu_hover_style)) {
			echo depot_mikado_dynamic_css('nav.mkd-fullscreen-menu ul li ul li a:hover, nav.mkd-fullscreen-menu ul li ul li.current-menu-ancestor > a, nav.mkd-fullscreen-menu ul li ul li.current-menu-item > a', $second_menu_hover_style);
		}
	}

	add_action('depot_mikado_style_dynamic', 'depot_mikado_fullscreen_menu_second_level_style');
}

if (!function_exists('depot_mikado_fullscreen_menu_third_level_style')) {
	function depot_mikado_fullscreen_menu_third_level_style()	{
		$third_menu_style = depot_mikado_get_typography_styles('fullscreen_menu', '_3rd');
		
		$third_menu_selector = array(
			'nav.mkd-fullscreen-menu ul li ul li ul li a'
		);
		
		echo depot_mikado_dynamic_css($third_menu_selector, $third_menu_style);
		

		$third_menu_hover_style = array();

		if (depot_mikado_options()->getOptionValue('fullscreen_menu_hover_color_3rd') !== '') {
			$third_menu_hover_style['color'] = depot_mikado_options()->getOptionValue('fullscreen_menu_hover_color_3rd');
		}

		if (!empty($third_menu_hover_style)) {
			echo depot_mikado_dynamic_css('nav.mkd-fullscreen-menu ul li ul li ul li a:hover, nav.mkd-fullscreen-menu ul li ul li ul li.current-menu-ancestor > a, nav.mkd-fullscreen-menu ul li ul li ul li.current-menu-item > a', $third_menu_hover_style);
		}
	}

	add_action('depot_mikado_style_dynamic', 'depot_mikado_fullscreen_menu_third_level_style');
}

if (!function_exists('depot_mikado_fullscreen_menu_icon_styles')) {
	function depot_mikado_fullscreen_menu_icon_styles() {
		$icon_color       = depot_mikado_options()->getOptionValue('fullscreen_menu_icon_color');
		$icon_hover_color = depot_mikado_options()->getOptionValue('fullscreen_menu_icon_hover_color');
		
		$icon_hover_selector = array(
			'.mkd-fullscreen-menu-opener:hover',
			'.mkd-fullscreen-menu-opener.mkd-fm-opened'
		);
			
		if (!empty($icon_color)) {
			echo depot_mikado_dynamic_css('.mkd-fullscreen-menu-opener', array(
				'background-color' => $icon_color
			));
		}

		if (!empty($icon_hover_color)) {
			echo depot_mikado_dynamic_css($icon_hover_selector, array(
				'background-color' => $icon_hover_color
			));
		}
	}

	add_action('depot_mikado_style_dynamic', 'depot_mikado_fullscreen_menu_icon_styles');
}