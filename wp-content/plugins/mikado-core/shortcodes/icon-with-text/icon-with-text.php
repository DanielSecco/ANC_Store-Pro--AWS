<?php
namespace MikadoCore\CPT\Shortcodes\IconWithText;

use MikadoCore\Lib;

class IconWithText implements Lib\ShortcodeInterface {
    private $base;
	
    public function __construct() {
        $this->base = 'mkd_icon_with_text';

        add_action('vc_before_init', array($this, 'vcMap'));
    }
	
    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name' => esc_html__('Mikado Icon With Text', 'mkd-core'),
            'base' => $this->base,
            'icon' => 'icon-wpb-icon-with-text extended-custom-icon',
            'category' => esc_html__('by MIKADO', 'mkd-core'),
            'allowed_container_element' => 'vc_row',
            'params' => array_merge(
                array(
	                array(
		                'type'       => 'dropdown',
		                'param_name' => 'type',
		                'heading'    => esc_html__('Type', 'mkd-core'),
		                'value'      => array(
                            esc_html__('Default', 'mkd-core') => '',
			                esc_html__('Icon Left From Text', 'mkd-core')  => 'icon-left',
			                esc_html__('Icon Left From Title', 'mkd-core') => 'icon-left-from-title',
			                esc_html__('Icon Top', 'mkd-core')             => 'icon-top'
		                )
	                )
                ),
                depot_mikado_icon_collections()->getVCParamsArray(),
                array(
                    array(
                        'type'       => 'attach_image',
                        'param_name' => 'custom_icon',
                        'heading'    => esc_html__('Custom Icon', 'mkd-core')
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'icon_type',
                        'heading'    => esc_html__('Icon Type', 'mkd-core'),
                        'value'      => array(
						    esc_html__('Normal', 'mkd-core') => 'mkd-normal',
						    esc_html__('Circle', 'mkd-core') => 'mkd-circle',
						    esc_html__('Square', 'mkd-core') => 'mkd-square'
                        ),
                        'group'       => esc_html__('Icon Settings', 'mkd-core')
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'icon_size',
                        'heading'    => esc_html__('Icon Size', 'mkd-core'),
                        'value'      => array(
	                        esc_html__('Medium', 'mkd-core')     => 'mkd-icon-medium',
	                        esc_html__('Tiny', 'mkd-core')       => 'mkd-icon-tiny',
						    esc_html__('Small', 'mkd-core')      => 'mkd-icon-small',
						    esc_html__('Large', 'mkd-core')      => 'mkd-icon-large',
						    esc_html__('Very Large', 'mkd-core') => 'mkd-icon-huge'
                        ),
                        'group'       => esc_html__('Icon Settings', 'mkd-core')
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'custom_icon_size',
                        'heading'    => esc_html__('Custom Icon Size (px)', 'mkd-core'),
                        'group'      => esc_html__('Icon Settings', 'mkd-core')
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'shape_size',
                        'heading'    => esc_html__('Shape Size (px)', 'mkd-core'),
                        'group'      => esc_html__('Icon Settings', 'mkd-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'icon_color',
                        'heading'    => esc_html__('Icon Color', 'mkd-core'),
                        'group'      => esc_html__('Icon Settings', 'mkd-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'icon_hover_color',
                        'heading'    => esc_html__('Icon Hover Color', 'mkd-core'),
                        'group'      => esc_html__('Icon Settings', 'mkd-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'icon_background_color',
                        'heading'    => esc_html__('Icon Background Color', 'mkd-core'),
                        'dependency' => array('element' => 'icon_type', 'value' => array('mkd-square', 'mkd-circle')),
                        'group'      => esc_html__('Icon Settings', 'mkd-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'icon_hover_background_color',
                        'heading'    => esc_html__('Icon Hover Background Color', 'mkd-core'),
                        'dependency' => array('element' => 'icon_type', 'value' => array('mkd-square', 'mkd-circle')),
                        'group'      => esc_html__('Icon Settings', 'mkd-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'icon_border_color',
                        'heading'    => esc_html__('Icon Border Color', 'mkd-core'),
                        'dependency' => array('element' => 'icon_type', 'value' => array('mkd-square', 'mkd-circle')),
                        'group'      => esc_html__('Icon Settings', 'mkd-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'icon_border_hover_color',
                        'heading'    => esc_html__('Icon Border Hover Color', 'mkd-core'),
                        'dependency' => array('element' => 'icon_type', 'value' => array('mkd-square', 'mkd-circle')),
                        'group'      => esc_html__('Icon Settings', 'mkd-core')
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'icon_border_width',
                        'heading'    => esc_html__('Border Width (px)', 'mkd-core'),
                        'dependency' => array('element' => 'icon_type', 'value' => array('mkd-square', 'mkd-circle')),
                        'group'      => esc_html__('Icon Settings', 'mkd-core')
                    ),
	                array(
		                'type'        => 'dropdown',
		                'param_name'  => 'icon_animation',
		                'heading'     => esc_html__('Icon Animation', 'mkd-core'),
		                'value'       => array_flip(depot_mikado_get_yes_no_select_array(false)),
		                'group'       => esc_html__('Icon Settings', 'mkd-core')
	                ),
	                array(
		                'type'       => 'textfield',
		                'param_name' => 'icon_animation_delay',
		                'heading'    => esc_html__('Icon Animation Delay (ms)', 'mkd-core'),
		                'dependency' => array('element' => 'icon_animation', 'value' => array('yes')),
		                'group'      => esc_html__('Icon Settings', 'mkd-core')
	                ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'title',
                        'heading'    => esc_html__('Title', 'mkd-core')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'title_tag',
                        'heading'     => esc_html__('Title Tag', 'mkd-core'),
                        'value'       => array_flip(depot_mikado_get_title_tag(true)),
						'save_always' => true,
                        'dependency'  => array('element' => 'title', 'not_empty' => true),
                        'group'       => esc_html__('Text Settings', 'mkd-core')
                    ),
	                array(
		                'type'       => 'colorpicker',
		                'param_name' => 'title_color',
		                'heading'    => esc_html__('Title Color', 'mkd-core'),
		                'dependency' => array('element' => 'title', 'not_empty' => true),
		                'group'      => esc_html__('Text Settings', 'mkd-core')
	                ),
	                array(
		                'type'       => 'textfield',
		                'param_name' => 'title_top_margin',
		                'heading'    => esc_html__('Title Top Margin (px)', 'mkd-core'),
		                'dependency' => array('element' => 'title', 'not_empty' => true),
		                'group'      => esc_html__('Text Settings', 'mkd-core')
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
                        'dependency' => array('element' => 'text', 'not_empty' => true),
                        'group'      => esc_html__('Text Settings', 'mkd-core')
                    ),
	                array(
		                'type'       => 'textfield',
		                'param_name' => 'text_top_margin',
		                'heading'    => esc_html__('Text Top Margin (px)', 'mkd-core'),
		                'dependency' => array('element' => 'text', 'not_empty' => true),
		                'group'      => esc_html__('Text Settings', 'mkd-core')
	                ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'link',
                        'heading'     => esc_html__('Link', 'mkd-core'),
                        'description' => esc_html__('Set link around icon and title', 'mkd-core')
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'target',
                        'heading'    => esc_html__('Target', 'mkd-core'),
                        'value'      => array_flip(depot_mikado_get_link_target_array()),
                        'dependency' => array('element' => 'link', 'not_empty' => true),
                    ),
	                array(
		                'type'        => 'textfield',
		                'param_name'  => 'text_padding',
		                'heading'     => esc_html__('Text Padding (px)', 'mkd-core'),
		                'description' => esc_html__('Set left or top padding dependence of type for your text holder. Default value is 13 for left type and 25 for top icon with text type', 'mkd-core'),
		                'dependency'  => array('element' => 'type', 'value' => array('icon-left', 'icon-top')),
		                'group'       => esc_html__('Text Settings', 'mkd-core')
	                )
                )
            )
        ));
    }

    /**
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'type'                        => 'icon-top',
            'custom_icon'                 => '',
            'icon_type'                   => 'mkd-normal',
            'icon_size'                   => 'mkd-icon-medium',
            'custom_icon_size'            => '',
            'shape_size'                  => '',
            'icon_color'                  => '',
            'icon_hover_color'            => '',
            'icon_background_color'       => '',
            'icon_hover_background_color' => '',
            'icon_border_color'           => '',
            'icon_border_hover_color'     => '',
            'icon_border_width'           => '',
            'icon_animation'              => '',
            'icon_animation_delay'        => '',
            'title'                       => '',
            'title_tag'                   => 'h4',
            'title_color'                 => '',
	        'title_top_margin'            => '',
            'text'                        => '',
            'text_color'                  => '',
	        'text_top_margin'             => '',
            'link'                        => '',
            'target'                      => '_self',
            'text_padding'                => ''
        );

        $default_atts = array_merge($default_atts, depot_mikado_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);
	
	    $params['type'] = !empty($params['type']) ? $params['type'] : $default_atts['type'];

        $params['icon_parameters'] = $this->getIconParameters($params);
        $params['holder_classes']  = $this->getHolderClasses($params);
	    $params['content_styles']  = $this->getContentStyles($params);
	    $params['title_styles']    = $this->getTitleStyles($params);
	    $params['title_tag']       = !empty($params['title_tag']) ? $params['title_tag'] : $default_atts['title_tag'];
        $params['text_styles']     = $this->getTextStyles($params);
	    $params['target']          = !empty($params['target']) ? $params['target'] : $default_atts['target'];
	    
		return mkd_core_get_shortcode_module_template_part('templates/iwt', 'icon-with-text', $params['type'], $params);
    }

    /**
     * Returns parameters for icon shortcode as a string
     *
     * @param $params
     *
     * @return array
     */
    private function getIconParameters($params) {
        $params_array = array();

        if(empty($params['custom_icon'])) {
            $iconPackName = depot_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

            $params_array['icon_pack']   = $params['icon_pack'];
            $params_array[$iconPackName] = $params[$iconPackName];

            if(!empty($params['icon_size'])) {
                $params_array['size'] = $params['icon_size'];
            }

            if(!empty($params['custom_icon_size'])) {
                $params_array['custom_size'] = depot_mikado_filter_px($params['custom_icon_size']).'px';
            }

            if(!empty($params['icon_type'])) {
                $params_array['type'] = $params['icon_type'];
            }
	
	        if(!empty($params['shape_size'])) {
		        $params_array['shape_size'] = depot_mikado_filter_px($params['shape_size']).'px';
	        }

            if(!empty($params['icon_border_color'])) {
                $params_array['border_color'] = $params['icon_border_color'];
            }

            if(!empty($params['icon_border_hover_color'])) {
                $params_array['hover_border_color'] = $params['icon_border_hover_color'];
            }

            if($params['icon_border_width'] !== '') {
                $params_array['border_width'] = depot_mikado_filter_px($params['icon_border_width']).'px';
            }

            if(!empty($params['icon_background_color'])) {
                $params_array['background_color'] = $params['icon_background_color'];
            }

            if(!empty($params['icon_hover_background_color'])) {
                $params_array['hover_background_color'] = $params['icon_hover_background_color'];
            }

            $params_array['icon_color'] = $params['icon_color'];

            if(!empty($params['icon_hover_color'])) {
                $params_array['hover_icon_color'] = $params['icon_hover_color'];
            }

            $params_array['icon_animation']       = $params['icon_animation'];
            $params_array['icon_animation_delay'] = $params['icon_animation_delay'];
        }

        return $params_array;
    }

    /**
     * Returns array of holder classes
     *
     * @param $params
     *
     * @return array
     */
    private function getHolderClasses($params) {
        $classes = array('mkd-iwt', 'clearfix');

	    if(!empty($params['type'])) {
		    $classes[] = 'mkd-iwt-'.$params['type'];
	    }

        if(!empty($params['icon_size'])) {
            $classes[] = 'mkd-iwt-'.str_replace('mkd-', '', $params['icon_size']);
        }

        return $classes;
    }
	
	/**
	 * Returns inline content styles
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getContentStyles($params) {
		$styles = array();
		
		if($params['text_padding'] !== '' && $params['type'] === 'icon-left') {
			$styles[] = 'padding-left: '.depot_mikado_filter_px($params['text_padding']).'px';
		}
		
		if($params['text_padding'] !== '' && $params['type'] === 'icon-top') {
			$styles[] = 'padding-top: '.depot_mikado_filter_px($params['text_padding']).'px';
		}
		
		return implode(';', $styles);
	}

	/**
     * Returns inline title styles
     *
     * @param $params
     *
     * @return string
     */
    private function getTitleStyles($params) {
        $styles = array();

        if(!empty($params['title_color'])) {
            $styles[] = 'color: '.$params['title_color'];
        }
	
	    if(!empty($params['title_top_margin'])) {
		    $styles[] = 'margin-top: '.depot_mikado_filter_px($params['title_top_margin']).'px';
	    }

        return implode(';', $styles);
    }

	/**
     * Returns inline text styles
     *
     * @param $params
     *
     * @return string
     */
    private function getTextStyles($params) {
        $styles = array();

        if(!empty($params['text_color'])) {
            $styles[] = 'color: '.$params['text_color'];
        }
	    
	    if(!empty($params['text_top_margin'])) {
		    $styles[] = 'margin-top: '.depot_mikado_filter_px($params['text_top_margin']).'px';
	    }

        return implode(';', $styles);
    }
}