<?php $i = 0; ?>
<div class="mkd-frame-slider-holder">
	<div class="mkd-fs-phone"></div>
	<div class="mkd-fs-slides">
		<?php foreach ($images as $image) { ?>
			<div class="mkd-fs-slide">
				<?php if(!empty($links)){ ?>
					<a class="mkd-ig-link" href="<?php echo esc_url($links[$i++]) ?>" title="<?php echo esc_attr($image['alt']); ?>" target="<?php echo esc_attr($target); ?>">
				<?php } ?>
					<?php echo wp_get_attachment_image($image['image_id'], 'full'); ?>
				<?php if(!empty($links)){ ?>
					</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>
