<?php
namespace MikadoCore\CPT\Shortcodes\MobileSliderItem;

use MikadoCore\Lib;

class MobileSliderItem implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_mobile_slider_item';

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
            'name' => esc_html__('Mikado Mobile Slider Item', 'mkd-core'),
            'base' => $this->getBase(),
            'category' => esc_html__('by MIKADO', 'mkd-core'),
            'icon' => 'icon-wpb-mobile-slider-item extended-custom-icon',
            'as_child' => array('only' => 'mkd_mobile_slider'),
            'as_parent' => array('except' => 'vc_row'),
            'show_settings_on_create' => true,
            'params' => array(
                array(
                    'type' => 'textfield',
                    'param_name' => 'title',
                    'heading' => esc_html__('Title', 'mkd-core')
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'text',
                    'heading' => esc_html__('Text', 'mkd-core')
                ),
                array(
                    'type'		    => 'attach_image',
                    'param_name'	=> 'qr_image',
                    'heading'		=> esc_html__('QR Code Image', 'mkd-core'),
                    'description'	=> esc_html__('Select image from media library', 'mkd-core')
                ),
                array(
                    'type'			=> 'attach_image',
                    'param_name'	=> 'image',
                    'heading'		=> esc_html__('Image', 'mkd-core'),
                    'description'	=> esc_html__('Select image from media library', 'mkd-core')
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'link',
                    'heading' => esc_html__('Custom Link', 'mkd-core')
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'target',
                    'heading'    => esc_html__('Custom Link Target', 'mkd-core'),
                    'value'      => array_flip(depot_mikado_get_link_target_array())
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
            'title'	  => '',
            'text'	  => '',
            'qr_image'	  => '',
            'image'       => '',
            'link'	 	  => '',
            'target' 	  => '_self'
        );

        $params = shortcode_atts($args, $atts);

        $params['qr_image'] = $this->getSliderQrImage($params);
        $params['image'] = $this->getSliderImage($params);
        $params['target'] = !empty($params['target']) ? $params['target'] : $args['target'];

        $html = mkd_core_get_shortcode_module_template_part('templates/mobile-slider-item', 'mobile-slider', '', $params);

        return $html;
    }

    /**
     * Return images for slider
     *
     * @param $params
     * @return array
     */
    private function getSliderQrImage($params) {
        $image_meta = array();

        if (!empty($params['qr_image'])) {
            $image_id = $params['qr_image'];
            $image_original = wp_get_attachment_image_src($image_id, 'full');
            $image['url'] = $image_original[0];
            $image['alt'] = get_post_meta( $image_id, '_wp_attachment_image_alt', true);

            $image_meta = $image;
        }

        return $image_meta;
    }

    /**
     * Return images for slider
     *
     * @param $params
     * @return array
     */
    private function getSliderImage($params) {
        $image_meta = array();

        if (!empty($params['image'])) {
            $image_id = $params['image'];
            $image_original = wp_get_attachment_image_src($image_id, 'full');
            $image['url'] = $image_original[0];
            $image['alt'] = get_post_meta( $image_id, '_wp_attachment_image_alt', true);

            $image_meta = $image;
        }

        return $image_meta;
    }


}