<div class="mkd-call-to-action-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="mkd-cta-inner <?php echo esc_attr($inner_classes); ?>">
		<div class="mkd-cta-text-holder">
			<div class="mkd-cta-text"><?php echo do_shortcode($content); ?></div>
		</div>
		<div class="mkd-cta-button-holder" <?php echo depot_mikado_get_inline_style($button_holder_styles); ?>>
			<div class="mkd-cta-button"><?php echo depot_mikado_get_button_html($button_parameters); ?></div>
		</div>
	</div>
</div>