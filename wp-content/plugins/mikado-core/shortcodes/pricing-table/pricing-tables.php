<?php
namespace MikadoCore\CPT\Shortcodes\PricingTables;

use MikadoCore\Lib;

class PricingTables implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkd_pricing_tables';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map(
			array(
				'name' => esc_html__('Mikado Pricing Tables', 'mkd-core'),
				'base' => $this->base,
				'as_parent' => array('only' => 'mkd_pricing_table'),
				'content_element' => true,
				'category' => esc_html__('by MIKADO', 'mkd-core'),
				'icon' => 'icon-wpb-pricing-tables extended-custom-icon',
				'show_settings_on_create' => true,
				'js_view' => 'VcColumnView',
				'params' => array(
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Number of Columns', 'mkd-core'),
						'param_name' => 'columns',
						'value' => array(
							esc_html__('One', 'mkd-core') => 'mkd-one-column',
							esc_html__('Two', 'mkd-core') => 'mkd-two-columns',
							esc_html__('Three', 'mkd-core') => 'mkd-three-columns',
							esc_html__('Four', 'mkd-core') => 'mkd-four-columns',
							esc_html__('Five', 'mkd-core') => 'mkd-five-columns',
						)
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'space_between_columns',
						'heading'    => esc_html__('Space Between Columns', 'mkd-core'),
						'value'      => array(
							esc_html__('Normal', 'mkd-core') => 'normal',
							esc_html__('Small', 'mkd-core') => 'small',
							esc_html__('Tiny', 'mkd-core') => 'tiny',
							esc_html__('No Space', 'mkd-core') => 'no'
						)
					)
				)
			)
		);
	}

	public function render($atts, $content = null) {
		$args = array(
			'columns'         	    => 'mkd-two-columns',
			'space_between_columns' => 'normal'
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);

		$holder_class = '';
		
		if (!empty($columns)) {
			$holder_class .= ' '.$columns;
		}

		if (!empty($space_between_columns)) {
			$holder_class .= ' mkd-pt-'.$space_between_columns.'-space';
		}
		
		$html = '<div class="mkd-pricing-tables clearfix '.esc_attr($holder_class).'">';
			$html .= '<div class="mkd-pt-wrapper">';
				$html .= do_shortcode($content);
			$html .= '</div>';
		$html .= '</div>';

		return $html;
	}
}