<div class="mkd-membership-dashboard-page">
	<h3 class="mkd-membership-dashboard-page-title">
		<?php esc_html_e( 'Edit Profile', 'mkd_membership' ); ?>
	</h3>
	<div>
		<form method="post" id="mkd-membership-update-profile-form">
			<div class="mkd-membership-input-holder">
				<label for="first_name"><?php esc_html_e( 'First Name', 'mkd_membership' ); ?></label>
				<input class="mkd-membership-input" type="text" name="first_name" id="first_name"
				       value="<?php echo $first_name; ?>">
			</div>
			<div class="mkd-membership-input-holder">
				<label for="last_name"><?php esc_html_e( 'Last Name', 'mkd_membership' ); ?></label>
				<input class="mkd-membership-input" type="text" name="last_name" id="last_name"
				       value="<?php echo $last_name; ?>">
			</div>
			<div class="mkd-membership-input-holder">
				<label for="email"><?php esc_html_e( 'Email', 'mkd_membership' ); ?></label>
				<input class="mkd-membership-input" type="email" name="email" id="email"
				       value="<?php echo $email; ?>">
			</div>
			<div class="mkd-membership-input-holder">
				<label for="url"><?php esc_html_e( 'Website', 'mkd_membership' ); ?></label>
				<input class="mkd-membership-input" type="text" name="url" id="url" value="<?php echo $website; ?>">
			</div>
			<div class="mkd-membership-input-holder">
				<label for="description"><?php esc_html_e( 'Description', 'mkd_membership' ); ?></label>
				<input class="mkd-membership-input" type="text" name="description" id="description"
				       value="<?php echo $description; ?>">
			</div>
			<div class="mkd-membership-input-holder">
				<label for="password"><?php esc_html_e( 'Password', 'mkd_membership' ); ?></label>
				<input class="mkd-membership-input" type="password" name="password" id="password" value="">
			</div>
			<div class="mkd-membership-input-holder">
				<label for="password2"><?php esc_html_e( 'Repeat Password', 'mkd_membership' ); ?></label>
				<input class="mkd-membership-input" type="password" name="password2" id="password2" value="">
			</div>
			<?php
			if ( mkd_membership_theme_installed() ) {
				echo depot_mikado_get_button_html( array(
					'text'      => esc_html__( 'UPDATE PROFILE', 'mkd_membership' ),
					'html_type' => 'button',
					'custom_attrs' => array(
						'data-updating-text' => esc_html__('UPDATING PROFILE', 'mkd_membership'),
						'data-updated-text' => esc_html__('PROFILE UPDATED', 'mkd_membership'),
					)
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'UPDATE PROFILE', 'mkd_membership' ) . '</button>';
			}
			wp_nonce_field( 'mkd_validate_edit_profile', 'mkd_nonce_edit_profile' )
			?>
		</form>
		<?php
		do_action( 'mkd_membership_action_login_ajax_response' );
		?>
	</div>
</div>