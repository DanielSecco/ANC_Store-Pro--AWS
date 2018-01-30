<div class="mkd-social-login-holder">
	<form method="post" class="mkd-login-form">
		<?php
		$redirect = '';
		if ( isset( $_GET['redirect_uri'] ) ) {
			$redirect = $_GET['redirect_uri'];
		} ?>
		<fieldset>
			<div>
				<input type="text" name="user_login_name" id="user_login_name" placeholder="<?php esc_html_e( 'User Name', 'mkd_membership' ) ?>" value="" required pattern=".{3,}" title="<?php esc_html_e( 'Three or more characters', 'mkd_membership' ); ?>"/>
			</div>
			<div>
				<input type="password" name="user_login_password" id="user_login_password" placeholder="<?php esc_html_e( 'Password', 'mkd_membership' ) ?>" value="" required/>
			</div>
			<div class="mkd-lost-pass-remember-holder clearfix">
				<span class="mkd-login-remember">
					<input name="rememberme" value="forever" id="rememberme" type="checkbox"/>
					<label for="rememberme" class="mkd-checbox-label"><?php esc_html_e( 'Remember me', 'mkd_membership' ) ?></label>
				</span>	
			</div>
			<input type="hidden" name="redirect" id="redirect" value="<?php echo esc_url( $redirect ); ?>">
			<div class="mkd-login-button-holder">
				<a href="<?php echo wp_lostpassword_url(); ?>" class="mkd-login-action-btn" data-el="#mkd-reset-pass-content" data-title="<?php esc_html_e( 'Lost Password?', 'mkd_membership' ); ?>"><?php esc_html_e( 'Lost Your password?', 'mkd_membership' ); ?></a>
				<?php
				if ( mkd_membership_theme_installed() ) {
					echo depot_mikado_get_button_html( array(
						'html_type' => 'button',
						'text'      => esc_html__( 'LOGIN', 'mkd_membership' ),
						'type'      => 'solid',
                        'size'      => 'small'
					) );
				} else {
					echo '<button type="submit">' . esc_html__( 'LOGIN', 'mkd_membership' ) . '</button>';
				}
				?>
				<?php wp_nonce_field( 'mkd-ajax-login-nonce', 'mkd-login-security' ); ?>
			</div>
		</fieldset>
	</form>
	<?php do_action( 'mkd_membership_action_login_ajax_response' ); ?>
</div>