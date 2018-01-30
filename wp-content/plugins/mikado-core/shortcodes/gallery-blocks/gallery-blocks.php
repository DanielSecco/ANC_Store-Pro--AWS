<?php
namespace MikadoCore\CPT\Shortcodes\GalleryBlocks;

use MikadoCore\Lib;

class GalleryBlocks implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkd_gallery_blocks';

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
			'name'                      => esc_html__('Mikado Gallery Blocks', 'mkd-core'),
			'base'                      => $this->getBase(),
			'category'                  => esc_html__('by MIKADO', 'mkd-core'),
			'icon' 						=> 'icon-wpb-gallery-blocks extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'		  => 'attach_images',
					'param_name'  => 'images',
					'heading'	  => esc_html__('Images', 'mkd-core'),
					'description' => esc_html__('Select images from media library. The first image you upload will be set as the featured image if you set Featured Image Size.', 'mkd-core')
				),
				array(
					'type'		  => 'textfield',
					'param_name'  => 'featured_image_size',
					'heading'	  => esc_html__('Featured Image Size', 'mkd-core'),
					'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'mkd-core')
				),
				array(
					'type'		  => 'textfield',
					'param_name'  => 'image_size',
					'heading'	  => esc_html__('Image Size', 'mkd-core'),
					'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'mkd-core')
				),
				array(
					'type'		  => 'dropdown',
					'param_name'  => 'enable_lightbox',
					'heading'	  => esc_html__('Enable Lightbox Functionality', 'mkd-core'),
					'value'       => array_flip(depot_mikado_get_yes_no_select_array(false))
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
			'images'			    => '',
			'featured_image_size'   => '',
			'image_size'	        => 'full',
			'enable_lightbox'       => '',
			'space_between_columns'	=> 'normal'
		);

		$params = shortcode_atts($args, $atts);
		
		$params['holder_classes']      = $this->getHolderClasses($params);
		
		$params['images'] 			   = $this->getImages($params);
		$params['featured_image_size'] = $this->getFeaturedImageSize($params['featured_image_size']);
		$params['image_size'] 		   = $this->getImageSize($params['image_size']);
		$params['enable_lightbox']     = ($params['enable_lightbox'] === 'yes') ? true : false;

		$html = mkd_core_get_shortcode_module_template_part('templates/gallery-blocks', 'gallery-blocks', '', $params);

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
		
		if(!empty($params['space_between_columns'])){
			$holderClasses .= ' mkd-'.$params['space_between_columns'].'-space';
		}
		
		return $holderClasses;
	}

	/**
	 * Return image for shortcode
	 *
	 * @param $params
	 * @return array
	 */
	private function getImages($params) {
		$image_ids = array();
		$images = array();
		
		if ($params['images'] !== '') {
			$image_ids = explode(',', $params['images']);
		}
		
		foreach ($image_ids as $id) {
			$image['id'] = $id;
			$image_original = wp_get_attachment_image_src($id, 'full');
			$image['url'] = $image_original[0];
			$image['alt'] = get_post_meta($id, '_wp_attachment_image_alt', true);
			
			$images[] = $image;
		}

		return $images;
	}
	
	/**
	 * Return image size or custom image size array
	 *
	 * @param $image_size
	 * @return array
	 */
	private function getFeaturedImageSize($featured_image_size) {
		$featured_image_size = trim($featured_image_size);
		//Find digits
		preg_match_all( '/\d+/', $featured_image_size, $matches );
		if(in_array( $featured_image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
			return $featured_image_size;
		} elseif(!empty($matches[0])) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} else {
			return 'no-image';
		}
	}

	/**
	 * Return image size or custom image size array
	 *
	 * @param $image_size
	 * @return array
	 */
	private function getImageSize($image_size) {
		$image_size = trim($image_size);
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if(in_array( $image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
			return $image_size;
		} elseif(!empty($matches[0])) {
			return array(
					$matches[0][0],
					$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}
}