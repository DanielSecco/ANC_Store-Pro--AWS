<div class="mkd-cb-item">
	<div class="mkd-cb-item-inner">
		<?php if(!empty($link)) { ?>
			<a itemprop="url" class="mkd-cb-link" href="<?php echo esc_attr($link); ?>" target="<?php echo esc_attr($target); ?>">
		<?php } ?>
			<?php if(!empty($image)) { ?>
				<img itemprop="image" class="mkd-cb-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
			<?php } ?>
			<?php if(!empty($hover_image)) { ?>
				<img itemprop="image" class="mkd-cb-hover-image" src="<?php echo esc_url($hover_image['url']); ?>" alt="<?php echo esc_attr($hover_image['alt']); ?>" />
			<?php } ?>
		<?php if(!empty($link)) { ?>
			</a>
		<?php } ?>
	</div>
</div>