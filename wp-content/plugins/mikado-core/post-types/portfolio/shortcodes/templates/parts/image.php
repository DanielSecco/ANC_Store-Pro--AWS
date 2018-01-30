<?php
$thumb_size = $this_object->getImageSize($params);
?>
<div class="mkd-pli-image">
	<?php if(has_post_thumbnail()) { ?>
		<?php echo get_the_post_thumbnail(get_the_ID(), $thumb_size); ?>
	<?php } else { ?>
		<img itemprop="image" class="mkd-pl-original-image" width="800" height="600" src="<?php echo MIKADO_ASSETS_ROOT.'/img/portfolio_featured_image.jpg'; ?>" alt="<?php esc_html_e('Portfolio Featured Image', 'mkd-core'); ?>" />
	<?php } ?>
</div>