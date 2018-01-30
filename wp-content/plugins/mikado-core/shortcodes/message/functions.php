<?php

if(!function_exists('mkd_core_add_message_shortcodes')) {
    function mkd_core_add_message_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'MikadoCore\CPT\Shortcodes\Message\Message'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('mkd_core_filter_add_vc_shortcode', 'mkd_core_add_message_shortcodes');
}