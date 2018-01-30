<?php
namespace MikadoCore\CPT\Shortcodes\MobileSlider;

use MikadoCore\Lib;

class MobileSlider implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_mobile_slider';

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
        vc_map(array(
            'name' => esc_html__('Mikado Mobile Slider', 'mkd-core'),
            'base' => $this->getBase(),
            'category' => esc_html__('by MIKADO', 'mkd-core'),
            'icon' => 'icon-wpb-mobile-slider extended-custom-icon',
            'as_parent' => array('only' => 'mkd_mobile_slider_item'),
            'content_element' => true,
            'js_view' => 'VcColumnView',
            'params' => array(
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'slider_number_of_items',
                    'heading'     => esc_html__('Slider Number Of Visible Items', 'mkd-core'),
                    'description' => esc_html__('Set number of visible items for mobile slider. Default value is 3', 'mkd-core')
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'slider_autoplay',
                    'heading'     => esc_html__('Enable Slider Autoplay', 'mkd-core'),
                    'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true))
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'slider_loop',
                    'heading'     => esc_html__('Enable Slider Loop', 'mkd-core'),
                    'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true))
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'slider_speed',
                    'heading'     => esc_html__('Slider Animation Speed (ms)', 'mkd-core'),
                    'description' => esc_html__('Slider interval. Default value is 3500', 'mkd-core'),
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'show_navigation_arrows',
                    'heading'     => esc_html__('Show Side Navigation', 'mkd-core'),
                    'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'show_navigation_dots',
                    'heading'     => esc_html__('Show Bottom Navigation', 'mkd-core'),
                    'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
                    'save_always' => true
                )
            )
        ));
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'slider_number_of_items'  => '3',
            'slider_autoplay'	 	  	=> 'yes',
            'slider_loop'	 		 	=> 'yes',
            'slider_speed' 		 	=> '5000',
            'show_navigation_arrows' => 'yes',
            'show_navigation_dots'  => 'yes',
        );

        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['slider_data'] = $this->getSliderData($params);
        $params['content'] = $content;

        $html = mkd_core_get_shortcode_module_template_part('templates/mobile-slider', 'mobile-slider', '', $params);

        return $html;
    }

    /**
     * Generates holder classes
     *
     * @param $params
     *
     * @return string
     */
    private function getHolderClasses($params){
        $holderClasses = '';

        $holderClasses .= !empty($params['items_hover_animation']) ? ' mkd-cc-hover-'.$params['items_hover_animation'] : ' mkd-cc-hover-switch-images';

        return $holderClasses;
    }

    /**
     * Return all configuration data for carousel
     *
     * @param $params
     * @return array
     */
    private function getSliderData($params) {

        $slider_data = array();

        $slider_data['data-number-of-items'] = (!empty($params['slider_number_of_items'])) ? $params['slider_number_of_items'] : '3';
        $slider_data['data-enable-autoplay'] = (!empty($params['slider_autoplay'])) ? $params['slider_autoplay'] : 'yes';
        $slider_data['data-enable-loop'] = (!empty($params['slider_loop'])) ? $params['slider_loop'] : 'yes';
        $slider_data['data-slider-speed'] = (!empty($params['slider_speed'])) ? $params['slider_speed'] : '5000';
        $slider_data['data-enable-navigation'] = (!empty($params['show_navigation_arrows'])) ? $params['show_navigation_arrows'] : 'yes';
        $slider_data['data-enable-pagination'] = (!empty($params['show_navigation_dots'])) ? $params['show_navigation_dots'] : 'yes';

        return $slider_data;
    }
}