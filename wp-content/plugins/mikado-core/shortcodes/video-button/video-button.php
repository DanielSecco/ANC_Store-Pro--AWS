<?php
namespace MikadoCore\CPT\Shortcodes\VideoButton;

use MikadoCore\Lib;

class VideoButton implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_video_button';

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
            'name'                      => esc_html__('Mikado Video Button', 'mkd-core'),
            'base'                      => $this->getBase(),
            'category'                  => esc_html__('by MIKADO', 'mkd-core'),
            'icon'                      => 'icon-wpb-video-button extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
	            array(
		            'type'       => 'textfield',
		            'param_name' => 'video_link',
		            'heading'    => esc_html__('Video Link', 'mkd-core')
	            ),
	            array(
		            'type'		  => 'attach_image',
		            'param_name'  => 'video_image',
		            'heading'	  => esc_html__('Video Image', 'mkd-core'),
		            'description' => esc_html__('Select image from media library', 'mkd-core')
	            ),
	            array(
		            'type'       => 'colorpicker',
		            'param_name' => 'play_button_color',
		            'heading'    => esc_html__('Play Button Color', 'mkd-core')
	            ),
	            array(
		            'type'       => 'textfield',
		            'param_name' => 'play_button_size',
		            'heading'    => esc_html__('Play Button Size (px)', 'mkd-core')
	            ),
	            array(
		            'type'		  => 'attach_image',
		            'param_name'  => 'play_button_image',
		            'heading'	  => esc_html__('Play Button Custom Image', 'mkd-core'),
		            'description' => esc_html__('Select image from media library. If you use this field then play button color and button size options will not work', 'mkd-core')
	            ),
	            array(
		            'type'		  => 'attach_image',
		            'param_name'  => 'play_button_hover_image',
		            'heading'	  => esc_html__('Play Button Custom Hover Image', 'mkd-core'),
		            'description' => esc_html__('Select image from media library. If you use this field then play button color and button size options will not work', 'mkd-core')
	            )
            )
        ));
    }
	
	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'video_link'              => '#',
			'video_image'             => '',
			'play_button_color'       => '',
			'play_button_size'        => '',
			'play_button_image'       => '',
			'play_button_hover_image' => ''
		);
		
		$params = shortcode_atts($args, $atts);
		
		$params['play_button_styles'] = $this->getPlayButtonStyles($params);
		
		//Get HTML from template
		$html = mkd_core_get_shortcode_module_template_part('templates/video-button', 'video-button', '', $params);
		
		return $html;
	}
	
	private function getPlayButtonStyles($params) {
		$styles = array();
		
		if (!empty($params['play_button_color'])) {
			$styles[] = 'color: '.$params['play_button_color'];
		}
		
		if (!empty($params['play_button_size'])) {
			$styles[] = 'font-size: '.depot_mikado_filter_px($params['play_button_size']) .'px';
		}
		
		return implode(';', $styles);
	}
}