<?php $i = 0; ?>
<div class="mkd-image-gallery">
	<div class="mkd-ig-slider <?php echo esc_attr($slider_classes); ?>" <?php echo depot_mikado_get_inline_attrs($slider_data); ?>>
		<?php foreach ($images as $image) {
			if ($pretty_photo) { ?>
				<a itemprop="image" class="mkd-ig-lightbox" href="<?php echo esc_url($image['url'])?>" data-rel="prettyPhoto[single_pretty_photo]" title="<?php echo esc_attr($image['title']); ?>">
			<?php } else if($enable_links){ ?>
				<a itemprop="url" class="mkd-ig-link" href="<?php echo esc_url($links[$i++]) ?>" title="<?php echo esc_attr($image['title']); ?>" target="<?php echo esc_attr($custom_link_target); ?>">
			<?php } ?>
				<?php if(is_array($image_size) && count($image_size)) : ?>
					<?php echo depot_mikado_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
				<?php else: ?>
					<?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
				<?php endif; ?>
			<?php if ($pretty_photo || $enable_links) { ?>
				</a>
			<?php }
		} ?>
	</div>
</div>