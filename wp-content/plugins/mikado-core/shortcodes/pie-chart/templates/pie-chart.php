<div class="mkd-pie-chart-holder">
	<div class="mkd-pc-percentage" <?php echo depot_mikado_get_inline_attrs($pie_chart_data); ?>>
		<span class="mkd-pc-percent" <?php echo depot_mikado_get_inline_style($percent_styles); ?>><?php echo esc_html($percent); ?></span>
	</div>
	<?php if(!empty($title) || !empty($text)) { ?>
		<div class="mkd-pc-text-holder">
			<?php if(!empty($title)) { ?>
				<<?php echo esc_attr($title_tag); ?> class="mkd-pc-title" <?php echo depot_mikado_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
			<?php } ?>
			<?php if(!empty($text)) { ?>
				<p class="mkd-pc-text" <?php echo depot_mikado_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
			<?php } ?>
		</div>
	<?php } ?>
</div>