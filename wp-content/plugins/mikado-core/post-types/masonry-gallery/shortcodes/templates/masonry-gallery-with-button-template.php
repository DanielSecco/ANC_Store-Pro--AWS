<article class="<?php echo esc_attr($item_classes) ?>">
	<div class="mkd-mg-content">
		<?php if (has_post_thumbnail()) { ?>
			<div class="mkd-mg-image">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php } ?>
		<div class="mkd-mg-item-outer">
			<div class="mkd-mg-item-inner">
				<div class="mkd-mg-item-content">
					<?php if(!empty($item_image)) { ?>
						<img itemprop="image" class="mkd-mg-item-icon" src="<?php echo esc_url($item_image['url'])?>" alt="<?php echo esc_attr($item_image['alt']); ?>" />
					<?php } ?>
					<?php if (!empty($item_title)) { ?>
						<<?php echo esc_attr($item_title_tag); ?> itemprop="name" class="mkd-mg-item-title entry-title"><?php echo esc_html($item_title); ?></<?php echo esc_attr($item_title_tag); ?>>
					<?php } ?>
					<?php if (!empty($item_text)) { ?>
						<p class="mkd-mg-item-text"><?php echo esc_html($item_text); ?></p>
					<?php } ?>
					<?php if(!empty($item_button_label) && !empty($item_link)) : ?>
						<a itemprop="url" href="<?php echo esc_url($item_link); ?>" class="mkd-btn mkd-btn-solid mkd-mg-item-button" target="<?php echo esc_attr($item_link_target); ?>">
							<?php echo esc_attr($item_button_label); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</article>
