<div class="mkd-social-reset-password-holder">
	<form action="<?php echo site_url( 'wp-login.php?action=lostpassword' ); ?>" method="post" id="mkd-lost-password-form" class="mkd-reset-pass-form">
		<div>
			<input type="text" name="user_reset_password_login" class="mkd-input-field" id="user_reset_password_login" placeholder="<?php esc_html_e( 'Enter username or email', 'mkd_membership' ) ?>" value="" size="20" required>
		</div>
		<?php do_action( 'lostpassword_form' ); ?>
		<div class="mkd-reset-password-button-holder">
			<?php
			if ( mkd_membership_theme_installed() ) {
				echo depot_mikado_get_button_html( array(
					'html_type' => 'button',
					'text'      => esc_html__( 'NEW PASSWORD', 'mkd_membership' ),
					'type'      => 'solid',
					'size'      => 'small'
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'NEW PASSWORD', 'mkd_membership' ) . '</button>';
			}
			?>
		</div>
	</form>
	<?php do_action( 'mkd_membership_action_login_ajax_response' ); ?>
</div>