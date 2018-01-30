<?php
get_header();
depot_mikado_get_title(); ?>
<div class="mkd-container mkd-default-page-template">
	<?php do_action('depot_mikado_after_container_open'); ?>
	<div class="mkd-container-inner clearfix">
		<?php
			$mkd_taxonomy_id = get_queried_object_id();
			$mkd_taxonomy = !empty($mkd_taxonomy_id) ? get_category($mkd_taxonomy_id) : '';
			$mkd_taxonomy_slug = !empty($mkd_taxonomy) ? $mkd_taxonomy->slug : '';
		
			mkd_core_get_team_category_list($mkd_taxonomy_slug);
		?>
	</div>
	<?php do_action('depot_mikado_before_container_close'); ?>
</div>
<?php get_footer(); ?>
