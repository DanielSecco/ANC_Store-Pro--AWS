<?php

if ( ! function_exists('depot_mikado_portfolio_options_map') ) {
	function depot_mikado_portfolio_options_map() {

		depot_mikado_add_admin_page(array(
			'slug'  => '_portfolio',
			'title' => esc_html__('Portfolio', 'mkd-core'),
			'icon'  => 'fa fa-camera-retro'
		));

		$panel_archive = depot_mikado_add_admin_panel(array(
			'title' => esc_html__('Portfolio Archive', 'mkd-core'),
			'name'  => 'panel_portfolio_archive',
			'page'  => '_portfolio'
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'portfolio_archive_number_of_items',
			'type'        => 'text',
			'label'       => esc_html__('Number of Items', 'mkd-core'),
			'description' => esc_html__('Set number of items for your portfolio list on archive pages. Default value is 12', 'mkd-core'),
			'parent'      => $panel_archive,
			'args'        => array(
				'col_width' => 3
			)
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'portfolio_archive_number_of_columns',
			'type'        => 'select',
			'label'       => esc_html__('Number of Columns', 'mkd-core'),
			'default_value' => '4',
			'description' => esc_html__('Set number of columns for your portfolio list on archive pages. Default value is 4 columns', 'mkd-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'2' => esc_html__('2 Columns', 'mkd-core'),
				'3' => esc_html__('3 Columns', 'mkd-core'),
				'4' => esc_html__('4 Columns', 'mkd-core'),
				'5' => esc_html__('5 Columns', 'mkd-core')
			)
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'portfolio_archive_space_between_items',
			'type'        => 'select',
			'label'       => esc_html__('Space Between Items', 'mkd-core'),
			'default_value' => 'normal',
			'description' => esc_html__('Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'mkd-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'normal'    => esc_html__('Normal', 'mkd-core'),
				'small'     => esc_html__('Small', 'mkd-core'),
				'tiny'      => esc_html__('Tiny', 'mkd-core'),
				'no'        => esc_html__('No Space', 'mkd-core')
			)
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'portfolio_archive_image_size',
			'type'        => 'select',
			'label'       => esc_html__('Image Proportions', 'mkd-core'),
			'default_value' => 'landscape',
			'description' => esc_html__('Set image proportions for your portfolio list on archive pages. Default value is landscape', 'mkd-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'full'      => esc_html__('Original', 'mkd-core'),
				'landscape' => esc_html__('Landscape', 'mkd-core'),
				'portrait'  => esc_html__('Portrait', 'mkd-core'),
				'square'    => esc_html__('Square', 'mkd-core')
			)
		));
		
		depot_mikado_add_admin_field(array(
			'name'        => 'portfolio_archive_item_layout',
			'type'        => 'select',
			'label'       => esc_html__('Item Style', 'mkd-core'),
			'default_value' => 'standard-shader',
			'description' => esc_html__('Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'mkd-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'standard-shader' => esc_html__('Standard - Shader', 'mkd-core'),
				'gallery-overlay' => esc_html__('Gallery - Overlay', 'mkd-core')
			)
		));

		$panel = depot_mikado_add_admin_panel(array(
			'title' => esc_html__('Portfolio Single', 'mkd-core'),
			'name'  => 'panel_portfolio_single',
			'page'  => '_portfolio'
		));

		depot_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_template',
			'type'          => 'select',
			'label'         => esc_html__('Portfolio Type', 'mkd-core'),
			'default_value'	=> 'small-images',
			'description'   => esc_html__('Choose a default type for Single Project pages', 'mkd-core'),
			'parent'        => $panel,
			'options'       => array(
				'huge-images'       => esc_html__('Portfolio Full Width Images', 'mkd-core'),
				'images'            => esc_html__('Portfolio Images', 'mkd-core'),
				'small-images'      => esc_html__('Portfolio Small Images', 'mkd-core'),
				'slider'            => esc_html__('Portfolio Slider', 'mkd-core'),
				'small-slider'      => esc_html__('Portfolio Small Slider', 'mkd-core'),
				'gallery'           => esc_html__('Portfolio Gallery', 'mkd-core'),
				'small-gallery'     => esc_html__('Portfolio Small Gallery', 'mkd-core'),
				'masonry'           => esc_html__('Portfolio Masonry', 'mkd-core'),
				'small-masonry'     => esc_html__('Portfolio Small Masonry', 'mkd-core'),
				'custom'            => esc_html__('Portfolio Custom', 'mkd-core'),
				'full-width-custom' => esc_html__('Portfolio Full Width Custom', 'mkd-core')
			),
			'args' => array(
				'dependence' => true,
				'show' => array(
					'huge-images'       => '',
					'images'            => '',
					'small-images'      => '',
					'slider'            => '',
					'small-slider'      => '',
					'gallery'           => '#mkd_portfolio_gallery_container',
					'small-gallery'     => '#mkd_portfolio_gallery_container',
					'masonry'           => '#mkd_portfolio_masonry_container',
					'small-masonry'     => '#mkd_portfolio_masonry_container',
					'custom'            => '',
					'full-width-custom' => ''
				),
				'hide' => array(
					'huge-images'       => '#mkd_portfolio_gallery_container, #mkd_portfolio_masonry_container',
					'images'            => '#mkd_portfolio_gallery_container, #mkd_portfolio_masonry_container',
					'small-images'      => '#mkd_portfolio_gallery_container, #mkd_portfolio_masonry_container',
					'slider'            => '#mkd_portfolio_gallery_container, #mkd_portfolio_masonry_container',
					'small-slider'      => '#mkd_portfolio_gallery_container, #mkd_portfolio_masonry_container',
					'gallery'           => '#mkd_portfolio_masonry_container',
					'small-gallery'     => '#mkd_portfolio_masonry_container',
					'masonry'           => '#mkd_portfolio_gallery_container',
					'small-masonry'     => '#mkd_portfolio_gallery_container',
					'custom'            => '#mkd_portfolio_gallery_container, #mkd_portfolio_masonry_container',
					'full-width-custom' => '#mkd_portfolio_gallery_container, #mkd_portfolio_masonry_container'
				)
			)
		));
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = depot_mikado_add_admin_container(array(
			'parent'          => $panel,
			'name'            => 'portfolio_gallery_container',
			'hidden_property' => 'portfolio_single_template',
			'hidden_values' => array(
				'huge-images',
				'images',
				'small-images',
				'slider',
				'small-slider',
				'masonry',
				'small-masonry',
				'custom',
				'full-width-custom'
			)
		));
		
			depot_mikado_add_admin_field(array(
				'name'        => 'portfolio_single_gallery_columns_number',
				'type'        => 'select',
				'label'       => esc_html__('Number of Columns', 'mkd-core'),
				'default_value' => 'three',
				'description' => esc_html__('Set number of columns for portfolio gallery type', 'mkd-core'),
				'parent'      => $portfolio_gallery_container,
				'options'     => array(
					'two'   => esc_html__('2 Columns', 'mkd-core'),
					'three' => esc_html__('3 Columns', 'mkd-core'),
					'four'  => esc_html__('4 Columns', 'mkd-core')
				)
			));
		
			depot_mikado_add_admin_field(array(
				'name'        => 'portfolio_single_gallery_space_between_items',
				'type'        => 'select',
				'label'       => esc_html__('Space Between Items', 'mkd-core'),
				'default_value' => 'normal',
				'description' => esc_html__('Set space size between columns for portfolio gallery type', 'mkd-core'),
				'parent'      => $portfolio_gallery_container,
				'options'     => array(
					'normal'    => esc_html__('Normal', 'mkd-core'),
					'small'     => esc_html__('Small', 'mkd-core'),
					'tiny'      => esc_html__('Tiny', 'mkd-core'),
					'no'        => esc_html__('No Space', 'mkd-core')
				)
			));
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = depot_mikado_add_admin_container(array(
			'parent'          => $panel,
			'name'            => 'portfolio_masonry_container',
			'hidden_property' => 'portfolio_single_template',
			'hidden_values' => array(
				'huge-images',
				'images',
				'small-images',
				'slider',
				'small-slider',
				'gallery',
				'small-gallery',
				'custom',
				'full-width-custom'
			)
		));
		
			depot_mikado_add_admin_field(array(
				'name'        => 'portfolio_single_masonry_columns_number',
				'type'        => 'select',
				'label'       => esc_html__('Number of Columns', 'mkd-core'),
				'default_value' => 'three',
				'description' => esc_html__('Set number of columns for portfolio masonry type', 'mkd-core'),
				'parent'      => $portfolio_masonry_container,
				'options'     => array(
					'two'   => esc_html__('2 Columns', 'mkd-core'),
					'three' => esc_html__('3 Columns', 'mkd-core'),
					'four'  => esc_html__('4 Columns', 'mkd-core')
				)
			));
			
			depot_mikado_add_admin_field(array(
				'name'        => 'portfolio_single_masonry_space_between_items',
				'type'        => 'select',
				'label'       => esc_html__('Space Between Items', 'mkd-core'),
				'default_value' => 'normal',
				'description' => esc_html__('Set space size between columns for portfolio masonry type', 'mkd-core'),
				'parent'      => $portfolio_masonry_container,
				'options'     => array(
					'normal'    => esc_html__('Normal', 'mkd-core'),
					'small'     => esc_html__('Small', 'mkd-core'),
					'tiny'      => esc_html__('Tiny', 'mkd-core'),
					'no'        => esc_html__('No Space', 'mkd-core')
				)
			));
		
		/***************** Masonry Layout *****************/
		
		depot_mikado_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'       => esc_html__('Show Title Area', 'mkd-core'),
				'description' => esc_html__('Enabling this option will show title area on single projects', 'mkd-core'),
				'parent'      => $panel,
                'options' => array(
                    '' => esc_html__('Default', 'mkd-core'),
                    'yes' => esc_html__('Yes', 'mkd-core'),
                    'no' => esc_html__('No', 'mkd-core')
                ),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		depot_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_images',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Lightbox for Images', 'mkd-core'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for projects with images', 'mkd-core'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		depot_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_videos',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Lightbox for Videos', 'mkd-core'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'mkd-core'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		depot_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_date',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Date', 'mkd-core'),
			'description'   => esc_html__('Enabling this option will enable date meta on single projects', 'mkd-core'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));
		
		depot_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_sticky_sidebar',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Sticky Side Text', 'mkd-core'),
			'description'   => esc_html__('Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'mkd-core'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		depot_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments', 'mkd-core'),
			'description'   => esc_html__('Enabling this option will show comments on your page', 'mkd-core'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		depot_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_pagination',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Pagination', 'mkd-core'),
			'description'   => esc_html__('Enabling this option will turn off portfolio pagination functionality', 'mkd-core'),
			'parent'        => $panel,
			'default_value' => 'no',
			'args' => array(
				'dependence' => true,
				'dependence_hide_on_yes' => '#mkd_navigate_same_category_container'
			)
		));

			$container_navigate_category = depot_mikado_add_admin_container(array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'hidden_property' => 'portfolio_single_hide_pagination',
				'hidden_value'    => 'yes'
			));
	
				depot_mikado_add_admin_field(array(
					'name'            => 'portfolio_single_nav_same_category',
					'type'            => 'yesno',
					'label'           => esc_html__('Enable Pagination Through Same Category', 'mkd-core'),
					'description'     => esc_html__('Enabling this option will make portfolio pagination sort through current category', 'mkd-core'),
					'parent'          => $container_navigate_category,
					'default_value'   => 'no'
				));

		depot_mikado_add_admin_field(array(
			'name'        => 'portfolio_single_slug',
			'type'        => 'text',
			'label'       => esc_html__('Portfolio Single Slug', 'mkd-core'),
			'description' => esc_html__('Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'mkd-core'),
			'parent'      => $panel,
			'args'        => array(
				'col_width' => 3
			)
		));
	}

	add_action( 'depot_mikado_options_map', 'depot_mikado_portfolio_options_map', 10);
}