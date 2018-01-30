<?php
namespace MikadoCore\CPT\Shortcodes\ElementsHolder;

use MikadoCore\Lib;

class ElementsHolder implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkd_elements_holder';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Mikado Elements Holder', 'mkd-core'),
			'base' => $this->base,
			'icon' => 'icon-wpb-elements-holder extended-custom-icon',
			'category' => esc_html__('by MIKADO', 'mkd-core'),
			'as_parent' => array('only' => 'mkd_elements_holder_item'),
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'       => 'colorpicker',
					'param_name' => 'background_color',
					'heading'    => esc_html__('Background Color', 'mkd-core')
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'number_of_columns',
					'heading'    => esc_html__('Columns', 'mkd-core'),
					'value'      => array(
						esc_html__('1 Column', 'mkd-core')  => 'one-column',
						esc_html__('2 Columns', 'mkd-core') => 'two-columns',
						esc_html__('3 Columns', 'mkd-core') => 'three-columns',
						esc_html__('4 Columns', 'mkd-core') => 'four-columns',
						esc_html__('5 Columns', 'mkd-core') => 'five-columns',
						esc_html__('6 Columns', 'mkd-core') => 'six-columns'
					)
				),
				array(
					'type'       => 'checkbox',
					'param_name' => 'items_float_left',
					'heading'    => esc_html__('Items Float Left', 'mkd-core'),
					'value'      => array('Make Items Float Left?' => 'yes')
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'switch_to_one_column',
					'heading'    => esc_html__('Switch to One Column', 'mkd-core'),
					'value'      => array(
						esc_html__('Default', 'mkd-core')   	=> '',
						esc_html__('Below 1280px', 'mkd-core') 	=> '1280',
						esc_html__('Below 1024px', 'mkd-core')  => '1024',
						esc_html__('Below 768px', 'mkd-core')   => '768',
						esc_html__('Below 600px', 'mkd-core')   => '600',
						esc_html__('Below 480px', 'mkd-core')   => '480',
						esc_html__('Never', 'mkd-core')    		=> 'never'
					),
					'description' => esc_html__('Choose on which stage item will be in one column', 'mkd-core'),
					'save_always' => true
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'alignment_one_column',
					'heading'    => esc_html__('Choose Alignment In Responsive Mode', 'mkd-core'),
					'value'      => array(
						esc_html__('Default', 'mkd-core') => '',
						esc_html__('Left', 'mkd-core') 	  => 'left',
						esc_html__('Center', 'mkd-core')  => 'center',
						esc_html__('Right', 'mkd-core')   => 'right'
					),
					'description' => esc_html__('Alignment When Items are in One Column', 'mkd-core'),
					'save_always' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'number_of_columns' 	=> '',
			'switch_to_one_column'	=> '',
			'alignment_one_column' 	=> '',
			'items_float_left' 		=> '',
			'background_color' 		=> ''
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html = '';

		$elements_holder_classes = array();
		$elements_holder_classes[] = 'mkd-elements-holder';
		$elements_holder_style = '';

		if($number_of_columns != ''){
			$elements_holder_classes[] .= 'mkd-'.$number_of_columns ;
		}

		if($switch_to_one_column != ''){
			$elements_holder_classes[] = 'mkd-responsive-mode-' . $switch_to_one_column ;
		} else {
			$elements_holder_classes[] = 'mkd-responsive-mode-768' ;
		}

		if($alignment_one_column != ''){
			$elements_holder_classes[] = 'mkd-one-column-alignment-' . $alignment_one_column ;
		}

		if($items_float_left !== ''){
			$elements_holder_classes[] = 'mkd-ehi-float';
		}

		if($background_color != ''){
			$elements_holder_style .= 'background-color:'. $background_color . ';';
		}

		$elements_holder_class = implode(' ', $elements_holder_classes);

		$html .= '<div ' . depot_mikado_get_class_attribute($elements_holder_class) . ' ' . depot_mikado_get_inline_attr($elements_holder_style, 'style'). '>';
			$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;
	}
}
