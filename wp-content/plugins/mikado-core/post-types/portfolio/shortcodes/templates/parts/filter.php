<?php if($filter == 'yes') {
	$filter_categories = $this_object->getFilterCategories($params);
	$filter_styles = $this_object->getFilterStyles($params);
	?>
	<div class="mkd-pl-filter-holder">
		<div class="mkd-plf-inner">
			<?php
			if(is_array($filter_categories) && count($filter_categories)){ ?>
				<ul>
					<li class="mkd-pl-filter" data-filter="">
						<span <?php depot_mikado_inline_style($filter_styles); ?>><?php esc_html_e('All', 'mkd-core')?></span>
					</li>
					<?php foreach($filter_categories as $cat) { ?>
						<li class="mkd-pl-filter" data-filter=".portfolio-category-<?php echo esc_attr($cat->slug); ?>">
							<span <?php depot_mikado_inline_style($filter_styles); ?>><?php echo esc_html($cat->name); ?></span>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
	</div>
<?php } ?>
