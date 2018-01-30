<div class="mkd-eh-item <?php echo esc_attr($elements_holder_item_class); ?>" <?php echo depot_mikado_get_inline_style($elements_holder_item_style); ?> <?php echo depot_mikado_get_inline_attrs($elements_holder_item_responsive_data); ?>>
	<div class="mkd-eh-item-inner">
		<div class="mkd-eh-item-content <?php echo esc_attr($elements_holder_item_content_class); ?>" <?php echo depot_mikado_get_inline_style($elements_holder_item_content_style); ?>>
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
</div>