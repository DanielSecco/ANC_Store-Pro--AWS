<?php
namespace MikadoCore\CPT\Shortcodes\Accordion;

use MikadoCore\Lib;

class Accordion implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkd_accordion';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return	$this->base;
	}

	public function vcMap() {
		vc_map( array(
			'name' =>  esc_html__('Mikado Accordion', 'mkd-core'),
			'base' => $this->base,
			'as_parent' => array('only' => 'mkd_accordion_tab'),
			'content_element' => true,
			'category' => esc_html__('by MIKADO', 'mkd-core'),
			'icon' => 'icon-wpb-accordion extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'       => 'textfield',
					'param_name' => 'el_class',
					'heading'    => esc_html__('Custom CSS Class', 'mkd-core')
				),
                array(
					'type'       => 'dropdown',
					'param_name' => 'style',
					'heading'    => esc_html__('Style', 'mkd-core'),
					'value'      => array(
						esc_html__('Accordion', 'mkd-core') => 'accordion',
						esc_html__('Toggle', 'mkd-core') => 'toggle'
					)
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'layout',
					'heading'    => esc_html__('Layout', 'mkd-core'),
					'value'      => array(
						esc_html__('Boxed', 'mkd-core') => 'boxed',
						esc_html__('Simple', 'mkd-core') => 'simple'
					)
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'background_skin',
					'heading'    => esc_html__('Background Skin', 'mkd-core'),
					'value' => array(
						esc_html__('Default', 'mkd-core') => '',
						esc_html__('White', 'mkd-core') => 'white'
					),
					'dependency'  => array('element' => 'layout', 'value' => array('boxed'))
				)
			)
		) );
	}
	
	public function render($atts, $content = null) {
		$default_atts=(array(
			'el_class'        => '',
			'title'           => '',
			'style'           => 'accordion',
			'layout'          => 'boxed',
			'background_skin' => ''
		));
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);

		$params['acc_class'] = $this->getAccordionClasses($params);
		$params['content'] = $content;

		$output = '';

		$output .= mkd_core_get_shortcode_module_template_part('templates/accordion-holder-template','accordions', '', $params);

		return $output;
	}

	/**
	   * Generates accordion classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getAccordionClasses($params){

		$acc_class = 'mkd-ac-default';

		switch($params['style']) {
            case 'toggle':
                $acc_class .= ' mkd-toggle';
                break;
            default:
                $acc_class .= ' mkd-accordion';
                break;
        }
		
		if (!empty($params['layout'])) {
			$acc_class .= ' mkd-ac-'.esc_attr($params['layout']);
		}
		
		if (!empty($params['background_skin'])) {
			$acc_class .= ' mkd-'.esc_attr($params['background_skin']).'-skin';
		}

		if (!empty($params['el_class'])) {
			$acc_class .= ' '.esc_attr($params['el_class']);
		}

        return $acc_class;
	}
}
