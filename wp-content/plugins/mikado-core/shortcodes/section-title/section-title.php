<?php
namespace MikadoCore\CPT\Shortcodes\SectionTitle;

use MikadoCore\Lib;

class SectionTitle implements Lib\ShortcodeInterface {
	private $base; 
	
	function __construct() {
		$this->base = 'mkd_section_title';

		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
	* Returns base for shortcode
	* @return string
	 */
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Mikado Section Title', 'mkd-core'),
			'base' => $this->base,
			'category' => esc_html__('by MIKADO', 'mkd-core'),
			'icon' => 'icon-wpb-section-title extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' =>	array(
				array(
					'type'       => 'dropdown',
					'param_name' => 'position',
					'heading'    => esc_html__('Horizontal Position', 'mkd-core'),
					'value'      => array(
                        esc_html__('Center', 'mkd-core') => 'center',
						esc_html__('Left', 'mkd-core') => 'left',
						esc_html__('Right', 'mkd-core') => 'right'
					),
					'save_always' => true
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'holder_padding',
					'heading'    => esc_html__('Holder Side Padding (px or %)', 'mkd-core')
				),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'title',
                    'heading'    => esc_html__('Title', 'mkd-core'),
					'admin_label' => true
                ),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'title_tag',
					'heading'     => esc_html__('Title Tag', 'mkd-core'),
					'value'       => array_flip(depot_mikado_get_title_tag(true)),
					'save_always' => true,
					'dependency'  => array('element' => 'title', 'not_empty' => true)
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'title_color',
					'heading'    => esc_html__('Title Color', 'mkd-core'),
					'dependency' => array('element' => 'title', 'not_empty' => true)
				),
				array(
					'type'       => 'textarea',
					'param_name' => 'text',
					'heading'    => esc_html__('Text', 'mkd-core')
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'text_color',
					'heading'    => esc_html__('Text Color', 'mkd-core'),
					'dependency' => array('element' => 'text', 'not_empty' => true)
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'text_font_size',
					'heading'    => esc_html__('Text Font Size (px)', 'mkd-core'),
					'dependency' => array('element' => 'text', 'not_empty' => true)
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'text_line_height',
					'heading'    => esc_html__('Text Line Height (px)', 'mkd-core'),
					'dependency' => array('element' => 'text', 'not_empty' => true)
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'text_font_weight',
					'heading'     => esc_html__('Text Font Weight', 'mkd-core'),
					'value'       => array_flip(depot_mikado_get_font_weight_array(true)),
					'save_always' => true
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'text_margin',
					'heading'    => esc_html__('Text Top Margin (px)', 'mkd-core'),
					'dependency' => array('element' => 'text', 'not_empty' => true)
				),
            )
		) );
	}

	public function render($atts, $content = null) {
		$args = array(
			'position'         => 'center',
			'holder_padding'   => '',
			'title'            => '',
			'title_tag'        => 'h2',
			'title_color'      => '',
			'text'             => '',
			'text_color'       => '',
			'text_font_size'   => '',
			'text_line_height' => '',
			'text_font_weight' => '',
			'text_margin'      => ''
        );
		$params = shortcode_atts($args, $atts);
		
		$params['holder_styles'] = $this->getHolderStyles($params);
		$params['title_tag'] = !empty($title_tag) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles'] = $this->getTitleStyles($params);
		$params['text_styles'] = $this->getTextStyles($params);

		$html = mkd_core_get_shortcode_module_template_part('templates/section-title', 'section-title', '', $params);
		
		return $html;
	}
	
	private function getHolderStyles($params) {
		$styles = array();
		
		if (!empty($params['holder_padding'])) {
			$styles[] = 'padding: 0 '.$params['holder_padding'];
		}
		
		if (!empty($params['position'])) {
			$styles[] = 'text-align: '.$params['position'];
		}
		
		return implode(';', $styles);
	}
	
	private function getTitleStyles($params) {
		$styles = array();
		
		if (!empty($params['title_color'])) {
			$styles[] = 'color: '.$params['title_color'];
		}
		
		return implode(';', $styles);
	}
	
	private function getTextStyles($params) {
		$styles = array();
		
		if (!empty($params['text_color'])) {
			$styles[] = 'color: '.$params['text_color'];
		}
		
		if (!empty($params['text_font_size'])) {
			$styles[] = 'font-size: '.depot_mikado_filter_px($params['text_font_size']).'px';
		}
		
		if (!empty($params['text_line_height'])) {
			$styles[] = 'line-height: '.depot_mikado_filter_px($params['text_line_height']).'px';
		}
		
		if (!empty($params['text_font_weight'])) {
			$styles[] = 'font-weight: '.$params['text_font_weight'];
		}
		
		if (!empty($params['text_margin'])) {
			$styles[] = 'margin-top: '.depot_mikado_filter_px($params['text_margin']).'px';
		}
		
		return implode(';', $styles);
	}
}