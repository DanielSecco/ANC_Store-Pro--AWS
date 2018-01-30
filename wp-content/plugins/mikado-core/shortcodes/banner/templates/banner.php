<div class="mkd-banner-holder">
    <div class="mkd-banner-image">
        <?php echo wp_get_attachment_image($image, 'full'); ?>
    </div>
    <div class="mkd-banner-text-holder">
	    <div class="mkd-banner-text-inner">
	        <?php if(!empty($subtitle)) { ?>
	            <<?php echo esc_attr($subtitle_tag); ?> class="mkd-banner-subtitle" <?php echo depot_mikado_get_inline_style($subtitle_styles); ?>><?php echo esc_html($subtitle); ?></<?php echo esc_attr($subtitle_tag); ?>>
	        <?php } ?>
	        <?php if(!empty($title)) { ?>
	            <<?php echo esc_attr($title_tag); ?> class="mkd-banner-title" <?php echo depot_mikado_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
	        <?php } ?>
			<?php if(!empty($text)) { ?>
	            <p class="mkd-banner-text" <?php echo depot_mikado_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
	        <?php } ?>
		</div>
	</div>
	<?php if (!empty($link)) { ?>
        <a itemprop="url" class="mkd-banner-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"></a>
    <?php } ?>
</div>