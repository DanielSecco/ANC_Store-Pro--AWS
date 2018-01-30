<?php
namespace MikadoCore\CPT\Shortcodes\VerticalSplitSlider;

use MikadoCore\Lib;

class VerticalSplitSlider implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkd_vertical_split_slider';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Mikado Vertical Split Slider', 'mkd-core'),
			'base' => $this->base,
			'icon' => 'icon-wpb-vertical-split-slider extended-custom-icon',
			'category' => esc_html__('by MIKADO', 'mkd-core'),
			'as_parent'	=> array('only' => 'mkd_vertical_split_slider_left_panel, mkd_vertical_split_slider_right_panel'),
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'       => 'dropdown',
					'param_name' => 'custom_sidebar',
					'heading'    => esc_html__('Custom Sidebar', 'mkd-core'),
					'description'=> esc_html__('Choose custom sidebar to be displayed over Vertical Split slider', 'mkd-core'),
					'value'      => depot_mikado_get_custom_sidebars(true)
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'custom_sidebar'	=> '',
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);

		$params['content'] = $content;

//		$html .= '<div class="mkd-vertical-split-slider">';
//		if($custom_sidebar !== ''){
//			$html .= '<div class="mkd-vertical-split-slider-widget-area">';
//			$html .= dynamic_sidebar($custom_sidebar);
//			$html .= '</div>';
//		}
//		$html .= do_shortcode($content);
//		$html .= '</div>';

		$html = mkd_core_get_shortcode_module_template_part('templates/vertical-split-slider-template', 'vertical-split-slider', '', $params);

		return $html;
	}
}
