<div class="mkd-social-register-holder">
	<form method="post" class="mkd-register-form">
		<fieldset>
			<div>
				<input type="text" name="user_register_name" id="user_register_name"
				       placeholder="<?php esc_html_e( 'User Name', 'mkd_membership' ) ?>" value="" required
				       pattern=".{3,}"
				       title="<?php esc_html_e( 'Three or more characters', 'mkd_membership' ); ?>"/>
			</div>
			<div>
				<input type="email" name="user_register_email" id="user_register_email"
				       placeholder="<?php esc_html_e( 'Email', 'mkd_membership' ) ?>" value="" required/>
			</div>
            <div>
                <input type="password" name="user_register_password" id="user_register_password"
                       placeholder="<?php esc_html_e('Password','mkd_membership') ?>" value="" required/>
            </div>
            <div>
                <input type="password" name="user_register_confirm_password" id="user_register_confirm_password"
                       placeholder="<?php esc_html_e('Repeat Password','mkd_membership') ?>" value="" required/>
            </div>
			<div class="mkd-register-button-holder">
				<?php
				if ( mkd_membership_theme_installed() ) {
					echo depot_mikado_get_button_html( array(
						'html_type' => 'button',
						'text'      => esc_html__( 'REGISTER', 'mkd_membership' ),
						'type'      => 'solid',
						'size'      => 'small'
					) );
				} else {
					echo '<button type="submit">' . esc_html__( 'REGISTER', 'mkd_membership' ) . '</button>';
				}
				wp_nonce_field( 'mkd-ajax-register-nonce', 'mkd-register-security' ); ?>
			</div>
		</fieldset>
	</form>
	<?php do_action( 'mkd_membership_action_login_ajax_response' ); ?>
</div>