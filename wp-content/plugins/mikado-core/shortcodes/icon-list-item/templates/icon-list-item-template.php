<?php $icon_html = depot_mikado_icon_collections()->renderIcon($icon, $icon_pack, $params); ?>
<div class="mkd-icon-list-holder" <?php echo depot_mikado_get_inline_style($holder_styles); ?>>
	<div class="mkd-il-icon-holder">
		<?php print $icon_html;	?>
	</div>
	<p class="mkd-il-text" <?php echo depot_mikado_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></p>
</div>