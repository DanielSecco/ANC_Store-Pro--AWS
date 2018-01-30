<?php

if (!function_exists('mkd_core_map_portfolio_meta')) {
    function mkd_core_map_portfolio_meta() {
        global $depot_Framework;

        $mkd_pages = array();
        $pages = get_pages();
        foreach ($pages as $page) {
            $mkd_pages[$page->ID] = $page->post_title;
        }

        //Portfolio Images

        $mkdPortfolioImages = new DepotMikadoMetaBox('portfolio-item', esc_html__('Portfolio Images (multiple upload)', 'mkd-core'), '', '', 'portfolio_images');
        $depot_Framework->mkdMetaBoxes->addMetaBox('portfolio_images', $mkdPortfolioImages);

        $mkd_portfolio_image_gallery = new DepotMikadoMultipleImages('mkd-portfolio-image-gallery', esc_html__('Portfolio Images', 'mkd-core'), esc_html__('Choose your portfolio images', 'mkd-core'));
        $mkdPortfolioImages->addChild('mkd-portfolio-image-gallery', $mkd_portfolio_image_gallery);

        //Portfolio Images/Videos 2

        $mkdPortfolioImagesVideos2 = new DepotMikadoMetaBox('portfolio-item', esc_html__('Portfolio Images/Videos (single upload)', 'mkd-core'));
        $depot_Framework->mkdMetaBoxes->addMetaBox('portfolio_images_videos2', $mkdPortfolioImagesVideos2);

        $mkd_portfolio_images_videos2 = new DepotMikadoImagesVideosFramework('', '');
        $mkdPortfolioImagesVideos2->addChild('mkd_portfolio_images_videos2', $mkd_portfolio_images_videos2);

        //Portfolio Additional Sidebar Items

        $mkdAdditionalSidebarItems = depot_mikado_add_meta_box(
            array(
                'scope' => array('portfolio-item'),
                'title' => esc_html__('Additional Portfolio Sidebar Items', 'mkd-core'),
                'name' => 'portfolio_properties'
            )
        );

        $mkd_portfolio_properties = depot_mikado_add_options_framework(
            array(
                'label' => esc_html__('Portfolio Properties', 'mkd-core'),
                'name' => 'mkd_portfolio_properties',
                'parent' => $mkdAdditionalSidebarItems
            )
        );
    }

    add_action('depot_mikado_meta_boxes_map', 'mkd_core_map_portfolio_meta', 40);
}