<<?php echo esc_attr($title_tag); ?> class="mkd-title-holder">
    <span class="mkd-accordion-mark">
		<span class="mkd_icon_plus icon_plus"></span>
		<span class="mkd_icon_minus icon_close"></span>
	</span>
	<span class="mkd-tab-title"><?php echo esc_html($title); ?></span>
</<?php echo esc_attr($title_tag); ?>>
<div class="mkd-accordion-content">
	<div class="mkd-accordion-content-inner">
		<?php echo do_shortcode($content); ?>
	</div>
</div>