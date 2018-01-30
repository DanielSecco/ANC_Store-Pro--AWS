<div class="mkd-membership-dashboard-page">
	<h3 class="mkd-membership-dashboard-page-title">
		<?php esc_html_e( 'Profile', 'mkd_membership' ); ?>
	</h3>
	<div class="mkd-membership-dashboard-page-content">
		<div class="mkd-profile-image">
            <?php echo mkd_membership_kses_img( $profile_image ); ?>
        </div>
		<p>
			<span><?php esc_html_e( 'First Name', 'mkd_membership' ); ?>:</span>
			<?php echo $first_name; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Last Name', 'mkd_membership' ); ?>:</span>
			<?php echo $last_name; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Email', 'mkd_membership' ); ?>:</span>
			<?php echo $email; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Desription', 'mkd_membership' ); ?>:</span>
			<?php echo $description; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Website', 'mkd_membership' ); ?>:</span>
			<a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo $website; ?></a>
		</p>
	</div>
</div>
