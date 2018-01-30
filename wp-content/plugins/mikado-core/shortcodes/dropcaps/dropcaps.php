<?php
namespace MikadoCore\CPT\Shortcodes\Dropcaps;

use MikadoCore\Lib;

class Dropcaps implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkd_dropcaps';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/*
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'type' => '',
			'color' => '',
			'background_color' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['letter'] = $content;
		$params['dropcaps_style'] = $this->getDropcapsStyles($params);
		$params['dropcaps_class'] = $this->getDropcapsClass($params);

		//Get HTML from template
		$html = mkd_core_get_shortcode_module_template_part('templates/dropcaps-template', 'dropcaps', '', $params);

		return $html;
	}

	/**
	 * Return Style for Dropcaps
	 *
	 * @param $params
	 * @return string
	 */
	private function getDropcapsStyles($params) {
		$styles = array();

		if ($params['color'] !== '') {
			$styles[] = 'color: '.$params['color'];
		}

		if ($params['type'] !== 'normal' && $params['background_color'] !== '') {
			$styles[] = 'background-color: '.$params['background_color'];
		}

		return implode(';', $styles);
	}

	/**
	 * Return Class for Dropcaps
	 *
	 * @param $params
	 * @return string
	 */
	private function getDropcapsClass($params) {
		return ($params['type'] !== '') ? 'mkd-'.$params['type'] : '';
	}
}