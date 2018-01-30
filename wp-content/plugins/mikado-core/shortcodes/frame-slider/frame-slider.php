<?php
namespace MikadoCore\CPT\Shortcodes\FrameSlider;

use MikadoCore\Lib;

class FrameSlider implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkd_frame_slider';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Mikado Frame Slider', 'mkd-core'),
			'base' => $this->base,
			'icon' => 'icon-wpb-device-slider extended-custom-icon',
			'category' => esc_html__('by MIKADO', 'mkd-core'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type'		  => 'attach_images',
						'param_name'  => 'images',
						'heading'	  => esc_html__('Images', 'mkd-core'),
						'description' => esc_html__('Select images from media library', 'mkd-core')
					),
					array(
						'type'        => 'textarea',
						'param_name'  => 'custom_links',
						'heading'     => esc_html__('Custom Links', 'mkd-core'),
						'description' => esc_html__('Delimit links by comma', 'mkd-core')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'target',
						'heading'    => esc_html__('Custom Link Target', 'mkd-core'),
						'value'      => array_flip(depot_mikado_get_link_target_array())
					)
				)
			)
		);
	}

	public function render($atts, $content = null) {
		$args = array(
			'images'       => '',
			'custom_links' => '',
			'target'       => '_self'
        );

		$html = '';

		$params = shortcode_atts($args, $atts);
		extract($params);

		$params['images'] = $this->getGalleryImages($params);
		$params['links'] = $this->getGalleryLinks($params);
		$params['target'] = !empty($params['target']) ? $params['target'] : $args['target'];
		
        $html .= mkd_core_get_shortcode_module_template_part('templates/frame-slider', 'frame-slider', '', $params);
		
		return $html;
	}
	
	/**
	 * Return images for gallery
	 *
	 * @param $params
	 * @return array
	 */
	private function getGalleryImages($params) {
		$image_ids = array();
		$images = array();
		$i = 0;
		
		if ($params['images'] !== '') {
			$image_ids = explode(',', $params['images']);
		}
		
		foreach ($image_ids as $id) {
			
			$image['image_id'] = $id;
			$image_original = wp_get_attachment_image_src($id, 'full');
			$image['url'] = $image_original[0];
			$image['alt'] = get_post_meta( $id, '_wp_attachment_image_alt', true);
			
			$images[$i] = $image;
			$i++;
		}
		
		return $images;
	}
	
	/**
	 * Return links for gallery
	 *
	 * @param $params
	 * @return array
	 */
	private function getGalleryLinks($params) {
		$custom_links = array();
		
		if (!empty($params['custom_links'])) {
			$custom_links = array_map('trim', explode(',', $params['custom_links']));
		}
		
		return $custom_links;
	}
}
