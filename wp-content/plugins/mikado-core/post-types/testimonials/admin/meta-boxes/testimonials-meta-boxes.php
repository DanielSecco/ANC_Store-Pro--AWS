<?php

if(!function_exists('mkd_core_map_testimonials_meta')) {
    function mkd_core_map_testimonials_meta() {
        $testimonial_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' => array('testimonials'),
                'title' => esc_html__('Testimonial', 'mkd-core'),
                'name' => 'testimonial_meta'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        	=> 'mkd_testimonial_title',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Title', 'mkd-core'),
                'description' 	=> esc_html__('Enter testimonial title', 'mkd-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        	=> 'mkd_testimonial_text',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Text', 'mkd-core'),
                'description' 	=> esc_html__('Enter testimonial text', 'mkd-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        	=> 'mkd_testimonial_author',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Author', 'mkd-core'),
                'description' 	=> esc_html__('Enter author name', 'mkd-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        	=> 'mkd_testimonial_position',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Author Position', 'mkd-core'),
                'description' 	=> esc_html__('Enter Author Position', 'mkd-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );
    }

    add_action('depot_mikado_meta_boxes_map', 'mkd_core_map_testimonials_meta', 95);
}