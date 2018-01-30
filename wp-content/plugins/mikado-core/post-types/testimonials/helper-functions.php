<?php

if(!function_exists('mkd_core_testimonials_meta_box_functions')) {
	function mkd_core_testimonials_meta_box_functions($post_types) {
		$post_types[] = 'testimonials';
		
		return $post_types;
	}
	
	add_filter('depot_mikado_meta_box_post_types_save', 'mkd_core_testimonials_meta_box_functions');
	add_filter('depot_mikado_meta_box_post_types_remove', 'mkd_core_testimonials_meta_box_functions');
}

if(!function_exists('mkd_core_register_testimonials_cpt')) {
	function mkd_core_register_testimonials_cpt($cpt_class_name) {
		$cpt_class = array(
			'MikadoCore\CPT\Testimonials\TestimonialsRegister'
		);
		
		$cpt_class_name = array_merge($cpt_class_name, $cpt_class);
		
		return $cpt_class_name;
	}
	
	add_filter('mkd_core_filter_register_custom_post_types', 'mkd_core_register_testimonials_cpt');
}