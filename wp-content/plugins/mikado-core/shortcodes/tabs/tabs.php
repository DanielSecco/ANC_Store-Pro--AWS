<?php
namespace MikadoCore\CPT\Shortcodes\Tabs;

use MikadoCore\Lib;

class Tabs implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkd_tabs';
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
			'name' => esc_html__('Mikado Tabs', 'mkd-core'),
			'base' => $this->getBase(),
			'as_parent' => array('only' => 'mkd_tab'),
			'content_element' => true,
			'category' => esc_html__('by MIKADO', 'mkd-core'),
			'icon' => 'icon-wpb-tabs extended-custom-icon',
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'       => 'dropdown',
					'param_name' => 'type',
					'heading'    => esc_html__('Type', 'mkd-core'),
					'value'      => array(
						esc_html__('Standard', 'mkd-core') => 'standard',
						esc_html__('Boxed', 'mkd-core')    => 'boxed',
						esc_html__('Simple', 'mkd-core')   => 'simple',
						esc_html__('Vertical', 'mkd-core') => 'vertical'
					)
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'type' => 'standard'
		);

        $params  = shortcode_atts($args, $atts);
		extract($params);
		
		// Extract tab titles
		preg_match_all('/title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$tab_titles = array();

		/**
		 * get tab titles array
		 */
		if (isset($matches[0])) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach($tab_titles as $tab) {
			preg_match('/title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['tabs_titles']    = $tab_title_array;
		$params['content']        = $content;
		
		$output = '';
		
		$output .= mkd_core_get_shortcode_module_template_part('templates/tab-template','tabs', '', $params);
		
		return $output;
	}
	
	/**
	 * Generates holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getHolderClasses($params){
		$holder_classes = array();
		
		$holder_classes[] = !empty($params['type']) ? 'mkd-tabs-'.esc_attr($params['type']) : 'mkd-tabs-standard';
		
		return implode(' ', $holder_classes);
	}
}