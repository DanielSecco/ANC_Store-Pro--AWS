<div class="mkd-social-share-holder mkd-list">
	<?php if(!empty($title)) { ?>
		<p class="mkd-social-title"><?php echo esc_html($title); ?></p>
	<?php } ?>
	<ul>
		<?php foreach ($networks as $net) {
			print $net;
		} ?>
	</ul>
</div>