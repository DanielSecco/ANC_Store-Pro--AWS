<?php
$gallery_classes = '';
$number_of_columns = depot_mikado_get_meta_field_intersect('portfolio_single_gallery_columns_number');
if(!empty($number_of_columns)) {
	$gallery_classes .= ' mkd-ps-'.$number_of_columns.'-columns';
}
$space_between_items = depot_mikado_get_meta_field_intersect('portfolio_single_gallery_space_between_items');
if(!empty($space_between_items)) {
	$gallery_classes .= ' mkd-ps-'.$space_between_items.'-space';
}
?>
<div class="mkd-ps-content-holder">
    <div class="mkd-ps-title-holder">
        <?php mkd_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout); ?>
    </div>
    <div class="mkd-ps-info-holder">
        <?php
        //get portfolio custom fields section
        mkd_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);

        //get portfolio date section
        mkd_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);

        //get portfolio tags section
        mkd_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
        ?>
    </div>
</div>
<div class="mkd-ps-image-holder mkd-ps-gallery-images <?php echo esc_attr($gallery_classes); ?>">
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
<div class="mkd-ps-social-info-holder">
    <?php
    //get portfolio share section
    mkd_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
    ?>
</div>