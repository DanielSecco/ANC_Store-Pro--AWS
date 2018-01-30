<?php
namespace MikadoCore\CPT\Shortcodes\IconListItem;

use MikadoCore\Lib;

class IconListItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkd_icon_list_item';
		
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	
	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Mikado Icon List Item', 'mkd-core'),
			'base' => $this->base,
			'icon' => 'icon-wpb-icon-list-item extended-custom-icon',
			'category' => esc_html__('by MIKADO', 'mkd-core'),
			'params' => array_merge(
				array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'item_margin',
						'heading'     => esc_html__('Icon List Item Bottom Margin (px)', 'mkd-core'),
						'description' => esc_html__('Set bottom margin for your Icon List Item element. Default value is 8', 'mkd-core')
					)
				),
				\DepotMikadoIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
						'type'       => 'textfield',
						'param_name' => 'icon_size',
						'heading'    => esc_html__('Icon Size (px)', 'mkd-core')
					),
					array(
						'type'       => 'colorpicker',
						'param_name' => 'icon_color',
						'heading'    => esc_html__('Icon Color', 'mkd-core')
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'title',
						'heading'    => esc_html__('Title', 'mkd-core')
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'title_size',
						'heading'    => esc_html__('Title Size (px)', 'mkd-core'),
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'       => 'colorpicker',
						'param_name' => 'title_color',
						'heading'    => esc_html__('Title Color', 'mkd-core'),
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'title_padding',
						'heading'     => esc_html__('Title Left Padding (px)', 'mkd-core'),
						'description' => esc_html__('Set left padding for your text element to adjust space between icon and text. Default value is 13', 'mkd-core'),
						'dependency'  => Array('element' => 'title', 'not_empty' => true)
					)
				)
			)
		) );
	}
	
	public function render($atts, $content = null) {
		$args = array(
			'item_margin'   => '',
            'icon_size'     => '',
            'icon_color'    => '',
            'title'         => '',
            'title_color'   => '',
            'title_size'    => '',
			'title_padding' => ''
        );

        $args = array_merge($args, depot_mikado_icon_collections()->getShortcodeParams());
		
        $params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);
		$iconPackName = depot_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		
		$params['holder_styles']  = $this->getHolderStyles($params);
		$params['icon'] = $params[$iconPackName];
		$params['icon_attributes']['style'] =  $this->getIconStyles($params);
		$params['title_styles'] =  $this->getTitleStyles($params);

		//Get HTML from template
		$html = mkd_core_get_shortcode_module_template_part('templates/icon-list-item-template', 'icon-list-item', '', $params);
		
		return $html;
	}
	
	/**
	 * Generates holder styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getHolderStyles($params){
		$styles = array();
		
		if(!empty($params['item_margin'])) {
			$styles[] = 'margin-bottom: '.depot_mikado_filter_px($params['item_margin']).'px';
		}
		
		return implode(';', $styles);
	}
	
	 /**
     * Generates icon styles
     *
     * @param $params
     *
     * @return array
     */
	private function getIconStyles($params){
		$styles = array();
		
		if(!empty($params['icon_color'])) {
			$styles[] = 'color: '.$params['icon_color'];
		}

		if (!empty($params['icon_size'])) {
			$styles[] = 'font-size: '.depot_mikado_filter_px($params['icon_size']).'px';
		}
		
		return implode(';', $styles);
	}
	
	 /**
     * Generates title styles
     *
     * @param $params
     *
     * @return array
     */
	private function getTitleStyles($params){
		$styles = array();
		
		if(!empty($params['title_color'])) {
			$styles[] = 'color: '.$params['title_color'];
		}

		if (!empty($params['title_size'])) {
			$styles[] = 'font-size: '.depot_mikado_filter_px( $params['title_size']).'px';
		}
		
		if(!empty($params['title_padding'])) {
			$styles[] = 'padding-left: '.depot_mikado_filter_px($params['title_padding']).'px';
		}
		
		return implode(';', $styles);
	}
}