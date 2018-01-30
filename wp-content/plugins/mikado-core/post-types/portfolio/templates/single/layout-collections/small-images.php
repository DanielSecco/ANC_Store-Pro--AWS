<div class="mkd-grid-row">
	<div class="mkd-grid-col-8">
        <div class="mkd-ps-image-holder">
            <div class="mkd-ps-image-inner">
                <?php
                $media = mkd_core_get_portfolio_single_media();
                
                if(is_array($media) && count($media)) : ?>
                    <?php foreach($media as $single_media) : ?>
                        <div class="mkd-ps-image">
                            <?php mkd_core_get_portfolio_single_media_html($single_media); ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
	<div class="mkd-grid-col-4">
        <div class="mkd-ps-info-holder mkd-ps-info-sticky-holder">
            <?php
            //get portfolio content section
            mkd_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout);
            
            //get portfolio custom fields section
            mkd_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);
            
            //get portfolio date section
            mkd_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);
            
            //get portfolio tags section
            mkd_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
            
            //get portfolio share section
            mkd_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
            ?>
        </div>
    </div>
</div>