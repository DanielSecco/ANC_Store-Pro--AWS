<?php if($query_results->max_num_pages > 1) { ?>
	<div class="mkd-pl-loading">
		<div class="mkd-pl-loading-bounce1"></div>
		<div class="mkd-pl-loading-bounce2"></div>
		<div class="mkd-pl-loading-bounce3"></div>
	</div>
	<div class="mkd-pl-load-more-holder">
		<div class="mkd-pl-load-more">
			<?php 
				echo depot_mikado_get_button_html(array(
					'link' => 'javascript: void(0)',
					'size' => 'large',
					'text' => esc_html__('LOAD MORE', 'mkd-core')
				));
			?>
		</div>
	</div>
<?php }