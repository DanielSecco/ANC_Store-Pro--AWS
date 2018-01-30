<div class="mkd-message  <?php echo esc_attr($message_classes)?>" <?php echo depot_mikado_inline_style($message_styles); ?>>
	<div class="mkd-message-inner">
		<?php		
		if($type == 'with_icon'){
			$icon_html = mkd_core_get_shortcode_module_template_part('templates/' . $type, 'message', '', $params);
			print $icon_html;
		}
		?>
		<a href="javascript:void(0)" class="mkd-close" <?php depot_mikado_inline_style($close_icon_holder_style); ?>><i class="mkd-font-elegant-icon icon_close" <?php depot_mikado_inline_style($close_icon_style); ?>></i></a>
		<div class="mkd-message-text-holder">
			<div class="mkd-message-text">
				<div class="mkd-message-text-inner"><?php echo do_shortcode($content); ?></div>
			</div>
		</div>
	</div>
</div>