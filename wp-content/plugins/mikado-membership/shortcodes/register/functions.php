<?php

if(!function_exists('mkd_membership_add_register_shortcodes')) {
    function mkd_membership_add_register_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'MikadoMembership\Shortcodes\MikadoUserRegister\MikadoUserRegister'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('mkd_membership_filter_add_vc_shortcode', 'mkd_membership_add_register_shortcodes');
}