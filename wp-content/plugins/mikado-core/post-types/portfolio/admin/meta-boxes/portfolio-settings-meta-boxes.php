<?php

if(!function_exists('mkd_core_map_portfolio_settings_meta')) {
    function mkd_core_map_portfolio_settings_meta() {
        $meta_box = depot_mikado_add_meta_box(array(
            'scope' => 'portfolio-item',
            'title' => esc_html__('Portfolio Settings', 'mkd-core'),
            'name'  => 'portfolio_settings_meta_box'
        ));

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_portfolio_single_template_meta',
            'type'        => 'select',
            'label'       => esc_html__('Portfolio Type', 'mkd-core'),
            'description' => esc_html__('Choose a default type for Single Project pages', 'mkd-core'),
            'parent'      => $meta_box,
            'options'     => array(
                ''                  => esc_html__('Default', 'mkd-core'),
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
		            ''                  => '',
	            	'huge-images'       => '',
		            'images'            => '',
		            'small-images'      => '',
		            'slider'            => '',
		            'small-slider'      => '',
		            'gallery'           => '#mkd_mkd_gallery_type_meta_container',
		            'small-gallery'     => '#mkd_mkd_gallery_type_meta_container',
		            'masonry'           => '#mkd_mkd_masonry_type_meta_container',
		            'small-masonry'     => '#mkd_mkd_masonry_type_meta_container',
		            'custom'            => '',
		            'full-width-custom' => ''
	            ),
	            'hide' => array(
		            ''                  => '#mkd_mkd_gallery_type_meta_container, #mkd_mkd_masonry_type_meta_container',
	            	'huge-images'       => '#mkd_mkd_gallery_type_meta_container, #mkd_mkd_masonry_type_meta_container',
		            'images'            => '#mkd_mkd_gallery_type_meta_container, #mkd_mkd_masonry_type_meta_container',
		            'small-images'      => '#mkd_mkd_gallery_type_meta_container, #mkd_mkd_masonry_type_meta_container',
		            'slider'            => '#mkd_mkd_gallery_type_meta_container, #mkd_mkd_masonry_type_meta_container',
		            'small-slider'      => '#mkd_mkd_gallery_type_meta_container, #mkd_mkd_masonry_type_meta_container',
		            'gallery'           => '#mkd_mkd_masonry_type_meta_container',
		            'small-gallery'     => '#mkd_mkd_masonry_type_meta_container',
		            'masonry'           => '#mkd_mkd_gallery_type_meta_container',
		            'small-masonry'     => '#mkd_mkd_gallery_type_meta_container',
		            'custom'            => '#mkd_mkd_gallery_type_meta_container, #mkd_mkd_masonry_type_meta_container',
		            'full-width-custom' => '#mkd_mkd_gallery_type_meta_container, #mkd_mkd_masonry_type_meta_container'
	            )
            )
        ));
	
	    /***************** Gallery Layout *****************/
	
	    $gallery_type_meta_container = depot_mikado_add_admin_container(
		    array(
			    'parent' => $meta_box,
			    'name' => 'mkd_gallery_type_meta_container',
			    'hidden_property' => 'mkd_portfolio_single_template_meta',
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
		    )
	    );
	
	        depot_mikado_add_meta_box_field(array(
			    'name'        => 'mkd_portfolio_single_gallery_columns_number_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Number of Columns', 'mkd-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set number of columns for portfolio gallery type', 'mkd-core'),
			    'parent'      => $gallery_type_meta_container,
			    'options'     => array(
				    ''      => esc_html__('Default', 'mkd-core'),
				    'two'   => esc_html__('2 Columns', 'mkd-core'),
				    'three' => esc_html__('3 Columns', 'mkd-core'),
				    'four'  => esc_html__('4 Columns', 'mkd-core')
			    )
		    ));
	
	        depot_mikado_add_meta_box_field(array(
			    'name'        => 'mkd_portfolio_single_gallery_space_between_items_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Space Between Items', 'mkd-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set space size between columns for portfolio gallery type', 'mkd-core'),
			    'parent'      => $gallery_type_meta_container,
			    'options'     => array(
				    ''          => esc_html__('Default', 'mkd-core'),
				    'normal'    => esc_html__('Normal', 'mkd-core'),
				    'small'     => esc_html__('Small', 'mkd-core'),
				    'tiny'      => esc_html__('Tiny', 'mkd-core'),
				    'no'        => esc_html__('No Space', 'mkd-core')
			    )
		    ));
	
	    /***************** Gallery Layout *****************/
	
	    /***************** Masonry Layout *****************/
	
	    $masonry_type_meta_container = depot_mikado_add_admin_container(
		    array(
			    'parent' => $meta_box,
			    'name' => 'mkd_masonry_type_meta_container',
			    'hidden_property' => 'mkd_portfolio_single_template_meta',
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
		    )
	    );
	
		    depot_mikado_add_meta_box_field(array(
			    'name'        => 'mkd_portfolio_single_masonry_columns_number_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Number of Columns', 'mkd-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set number of columns for portfolio masonry type', 'mkd-core'),
			    'parent'      => $masonry_type_meta_container,
			    'options'     => array(
				    ''      => esc_html__('Default', 'mkd-core'),
				    'two'   => esc_html__('2 Columns', 'mkd-core'),
				    'three' => esc_html__('3 Columns', 'mkd-core'),
				    'four'  => esc_html__('4 Columns', 'mkd-core')
			    )
		    ));
		
		    depot_mikado_add_meta_box_field(array(
			    'name'        => 'mkd_portfolio_single_masonry_space_between_items_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Space Between Items', 'mkd-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set space size between columns for portfolio masonry type', 'mkd-core'),
			    'parent'      => $masonry_type_meta_container,
			    'options'     => array(
				    ''          => esc_html__('Default', 'mkd-core'),
				    'normal'    => esc_html__('Normal', 'mkd-core'),
				    'small'     => esc_html__('Small', 'mkd-core'),
				    'tiny'      => esc_html__('Tiny', 'mkd-core'),
				    'no'        => esc_html__('No Space', 'mkd-core')
			    )
		    ));
	
	    /***************** Masonry Layout *****************/

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_show_title_area_portfolio_single_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Show Title Area', 'mkd-core'),
                'description' => esc_html__('Enabling this option will show title area on your single portfolio page', 'mkd-core'),
                'parent'      => $meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'mkd-core'),
                    'yes' => esc_html__('Yes', 'mkd-core'),
                    'no' => esc_html__('No', 'mkd-core')
                )
            )
        );

	    depot_mikado_add_meta_box_field(array(
		    'name'        => 'portfolio_info_top_padding',
		    'type'        => 'text',
		    'label'       => esc_html__('Portfolio Info Top Padding', 'mkd-core'),
		    'description' => esc_html__('Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'mkd-core'),
		    'parent'      => $meta_box,
		    'args'        => array(
			    'col_width' => 3,
			    'suffix' => 'px'
		    )
	    ));

        $all_pages = array();
        $pages     = get_pages();
        foreach($pages as $page) {
            $all_pages[$page->ID] = $page->post_title;
        }

        depot_mikado_add_meta_box_field(array(
            'name'        => 'portfolio_single_back_to_link',
            'type'        => 'select',
            'label'       => esc_html__('"Back To" Link', 'mkd-core'),
            'description' => esc_html__('Choose "Back To" page to link from portfolio Single Project page', 'mkd-core'),
            'parent'      => $meta_box,
            'options'     => $all_pages
        ));

        depot_mikado_add_meta_box_field(array(
            'name'        => 'portfolio_external_link',
            'type'        => 'text',
            'label'       => esc_html__('Portfolio External Link', 'mkd-core'),
            'description' => esc_html__('Enter URL to link from Portfolio List page', 'mkd-core'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));
	
	    depot_mikado_add_meta_box_field(
		    array(
			    'name' => 'mkd_portfolio_featured_image_meta',
			    'type' => 'image',
			    'label' => esc_html__('Featured Image', 'mkd-core'),
			    'description' => esc_html__('Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'mkd-core'),
			    'parent' => $meta_box
		    )
	    );
	
	    depot_mikado_add_meta_box_field(array(
		    'name' => 'mkd_portfolio_masonry_fixed_dimensions_meta',
		    'type' => 'select',
		    'label' => esc_html__('Dimensions for Masonry - Image Fixed Proportion', 'mkd-core'),
		    'description' => esc_html__('Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'mkd-core'),
		    'default_value' => 'default',
		    'parent' => $meta_box,
		    'options' => array(
			    'default' => esc_html__('Default', 'mkd-core'),
			    'large-width' => esc_html__('Large Width', 'mkd-core'),
			    'large-height' => esc_html__('Large Height', 'mkd-core'),
			    'large-width-height' => esc_html__('Large Width/Height', 'mkd-core')
		    )
	    ));
	
	    depot_mikado_add_meta_box_field(array(
		    'name' => 'mkd_portfolio_masonry_original_dimensions_meta',
		    'type' => 'select',
		    'label' => esc_html__('Dimensions for Masonry - Image Original Proportion', 'mkd-core'),
		    'description' => esc_html__('Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'mkd-core'),
		    'default_value' => 'default',
		    'parent' => $meta_box,
		    'options' => array(
			    'default' => esc_html__('Default', 'mkd-core'),
			    'large-width' => esc_html__('Large Width', 'mkd-core')
		    )
	    ));
    }

    add_action('depot_mikado_meta_boxes_map', 'mkd_core_map_portfolio_settings_meta', 41);
}