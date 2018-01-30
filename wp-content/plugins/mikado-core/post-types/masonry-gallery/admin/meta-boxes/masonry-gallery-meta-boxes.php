<?php

if(!function_exists('mkd_core_map_masonry_gallery_meta')) {
    function mkd_core_map_masonry_gallery_meta() {
        $masonry_gallery_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' => array('masonry-gallery'),
                'title' => esc_html__('Masonry Gallery General', 'mkd-core'),
                'name' => 'masonry_gallery_meta'
            )
        );
	    
        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_masonry_gallery_item_title_tag',
                'type' => 'select',
                'default_value' => 'h4',
                'label' => esc_html__('Title Tag', 'mkd-core'),
                'parent' => $masonry_gallery_meta_box,
                'options' => depot_mikado_get_title_tag()
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_masonry_gallery_item_text',
                'type' => 'text',
                'label' => esc_html__('Text', 'mkd-core'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_masonry_gallery_item_image',
                'type' => 'image',
                'label' => esc_html__('Custom Item Icon', 'mkd-core'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_masonry_gallery_item_link',
                'type' => 'text',
                'label' => esc_html__('Link', 'mkd-core'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_masonry_gallery_item_link_target',
                'type' => 'select',
                'default_value' => '_self',
                'label' => esc_html__('Link Target', 'mkd-core'),
                'parent' => $masonry_gallery_meta_box,
                'options' => depot_mikado_get_link_target_array()
            )
        );

        depot_mikado_add_admin_section_title(array(
            'name'   => 'mkd_section_style_title',
            'parent' => $masonry_gallery_meta_box,
            'title'  => esc_html__('Masonry Gallery Item Style', 'mkd-core')
        ));

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_masonry_gallery_item_size',
                'type' => 'select',
                'default_value' => 'square-small',
                'label' => esc_html__('Size', 'mkd-core'),
                'parent' => $masonry_gallery_meta_box,
                'options' => array(
                    'square-small'			=> esc_html__('Square Small', 'mkd-core'),
                    'square-big'			=> esc_html__('Square Big', 'mkd-core'),
                    'rectangle-portrait'	=> esc_html__('Rectangle Portrait', 'mkd-core'),
                    'rectangle-landscape'	=> esc_html__('Rectangle Landscape', 'mkd-core')
                )
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_masonry_gallery_item_type',
                'type' => 'select',
                'default_value' => 'standard',
                'label' => esc_html__('Type', 'mkd-core'),
                'parent' => $masonry_gallery_meta_box,
                'options' => array(
                    'standard'		=> esc_html__('Standard', 'mkd-core'),
                    'with-button'	=> esc_html__('With Button', 'mkd-core'),
                    'simple'		=> esc_html__('Simple', 'mkd-core')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        'with-button' => '#mkd_masonry_gallery_item_simple_type_container',
                        'simple' => '#mkd_masonry_gallery_item_button_type_container',
                        'standard' => '#mkd_masonry_gallery_item_button_type_container, #mkd_masonry_gallery_item_simple_type_container'
                    ),
                    'show' => array(
                        'with-button' => '#mkd_masonry_gallery_item_button_type_container',
                        'simple' => '#mkd_masonry_gallery_item_simple_type_container',
                        'standard' => ''
                    )
                )
            )
        );

        $masonry_gallery_item_button_type_container = depot_mikado_add_admin_container_no_style(array(
            'name'				=> 'masonry_gallery_item_button_type_container',
            'parent'			=> $masonry_gallery_meta_box,
            'hidden_property'	=> 'mkd_masonry_gallery_item_type',
            'hidden_values'		=> array('standard', 'simple')
        ));

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_masonry_gallery_button_label',
                'type' => 'text',
                'label' => esc_html__('Button Label', 'mkd-core'),
                'parent' => $masonry_gallery_item_button_type_container
            )
        );

        $masonry_gallery_item_simple_type_container = depot_mikado_add_admin_container_no_style(array(
            'name'				=> 'masonry_gallery_item_simple_type_container',
            'parent'			=> $masonry_gallery_meta_box,
            'hidden_property'	=> 'mkd_masonry_gallery_item_type',
            'hidden_values'		=> array('standard', 'with-button')
        ));

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_masonry_gallery_simple_content_background_skin',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Content Background Skin', 'mkd-core'),
                'parent' => $masonry_gallery_item_simple_type_container,
                'options' => array(
                    'default' => esc_html__('Default', 'mkd-core'),
                    'light'	=> esc_html__('Light', 'mkd-core'),
                    'dark'	=> esc_html__('Dark', 'mkd-core')
                )
            )
        );
    }

    add_action('depot_mikado_meta_boxes_map', 'mkd_core_map_masonry_gallery_meta', 45);
}