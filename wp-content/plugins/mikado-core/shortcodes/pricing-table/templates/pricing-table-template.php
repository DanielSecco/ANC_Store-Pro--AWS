<div class="mkd-price-table">
	<div class="mkd-pt-inner" <?php echo depot_mikado_get_inline_style($holder_styles); ?>>
		<ul>
			<li class="mkd-pt-title-holder">
				<span class="mkd-pt-title" <?php echo depot_mikado_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></span>
			</li>
			<li class="mkd-pt-prices">
				<span class="mkd-pt-value" <?php echo depot_mikado_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
				<span class="mkd-pt-price" <?php echo depot_mikado_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
				<h6 class="mkd-pt-mark" <?php echo depot_mikado_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></h6>
			</li>
            <li class="mkd-pt-subtitle-holder">
                <span class="mkd-pt-subtitle" <?php echo depot_mikado_get_inline_style($subtitle_styles); ?>><?php echo esc_html($subtitle); ?></span>
            </li>
			<li class="mkd-pt-content">
				<?php echo do_shortcode($content); ?>
			</li>
			<?php 
			if(!empty($button_text)) { ?>
				<li class="mkd-pt-button">
					<?php echo depot_mikado_get_button_html(array(
						'link' => $link,
						'text' => $button_text,
						'type' => 'solid',
                        'size' => 'large'
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>