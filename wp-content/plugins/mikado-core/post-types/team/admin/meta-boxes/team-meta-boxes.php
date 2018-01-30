<?php

if(!function_exists('mkd_core_map_team_single_meta')) {
    function mkd_core_map_team_single_meta() {

        $meta_box = depot_mikado_add_meta_box(array(
            'scope' => 'team-member',
            'title' => esc_html__('Team Member Info', 'mkd-core'),
            'name'  => 'team_meta'
        ));

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_team_member_position',
            'type'        => 'text',
            'label'       => esc_html__('Position', 'mkd-core'),
            'description' => esc_html__('The members\'s role within the team', 'mkd-core'),
            'parent'      => $meta_box
        ));

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_team_member_birth_date',
            'type'        => 'date',
            'label'       => esc_html__('Birth date', 'mkd-core'),
            'description' => esc_html__('The members\'s birth date', 'mkd-core'),
            'parent'      => $meta_box
        ));

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_team_member_email',
            'type'        => 'text',
            'label'       => esc_html__('Email', 'mkd-core'),
            'description' => esc_html__('The members\'s email', 'mkd-core'),
            'parent'      => $meta_box
        ));

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_team_member_phone',
            'type'        => 'text',
            'label'       => esc_html__('Phone', 'mkd-core'),
            'description' => esc_html__('The members\'s phone', 'mkd-core'),
            'parent'      => $meta_box
        ));

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_team_member_address',
            'type'        => 'text',
            'label'       => esc_html__('Address', 'mkd-core'),
            'description' => esc_html__('The members\'s addres', 'mkd-core'),
            'parent'      => $meta_box
        ));

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_team_member_education',
            'type'        => 'text',
            'label'       => esc_html__('Education', 'mkd-core'),
            'description' => esc_html__('The members\'s education', 'mkd-core'),
            'parent'      => $meta_box
        ));

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_team_member_resume',
            'type'        => 'file',
            'label'       => esc_html__('Resume', 'mkd-core'),
            'description' => esc_html__('Upload members\'s resume', 'mkd-core'),
            'parent'      => $meta_box
        ));

        for($x = 1; $x < 6; $x++) {

            $social_icon_group = depot_mikado_add_admin_group(array(
                'name'   => 'mkd_team_member_social_icon_group'.$x,
                'title'  => esc_html__('Social Link ', 'mkd-core').$x,
                'parent' => $meta_box
            ));

                $social_row1 = depot_mikado_add_admin_row(array(
                    'name'   => 'mkd_team_member_social_icon_row1'.$x,
                    'parent' => $social_icon_group
                ));

                    DepotMikadoIconCollections::get_instance()->getSocialIconsMetaBoxOrOption(array(
                        'label' => esc_html__('Icon ', 'mkd-core').$x,
                        'parent' => $social_row1,
                        'name' => 'mkd_team_member_social_icon_pack_'.$x,
                        'defaul_icon_pack' => '',
                        'type' => 'meta-box',
                        'field_type' => 'simple'
                    ));

                $social_row2 = depot_mikado_add_admin_row(array(
                    'name'   => 'mkd_team_member_social_icon_row2'.$x,
                    'parent' => $social_icon_group
                ));

                    depot_mikado_add_meta_box_field(array(
                        'type'            => 'textsimple',
                        'label'           => esc_html__('Link', 'mkd-core'),
                        'name'            => 'mkd_team_member_social_icon_'.$x.'_link',
                        'hidden_property' => 'mkd_team_member_social_icon_pack_'.$x,
                        'hidden_value'    => '',
                        'parent'          => $social_row2
                    ));
	
			        depot_mikado_add_meta_box_field(array(
				        'type'          => 'selectsimple',
				        'label'         => esc_html__('Target', 'mkd-core'),
				        'name'          => 'mkd_team_member_social_icon_'.$x.'_target',
				        'options'       => depot_mikado_get_link_target_array(),
				        'hidden_property' => 'mkd_team_member_social_icon_'.$x.'_link',
				        'hidden_value'    => '',
				        'parent'          => $social_row2
			        ));
        }
    }

    add_action('depot_mikado_meta_boxes_map', 'mkd_core_map_team_single_meta', 46);
}