<div class="mkd-social-share-holder mkd-dropdown">
	<a href="javascript:void(0)" target="_self" class="mkd-social-share-dropdown-opener">
        <span class="mkd-social-share-title"><?php esc_html_e('Share this', 'mkd-core') ?></span>
		<i class="social_share"></i>
	</a>
	<div class="mkd-social-share-dropdown">
		<ul>
			<?php foreach ($networks as $net) {
				print $net;
			} ?>
		</ul>
	</div>
</div>