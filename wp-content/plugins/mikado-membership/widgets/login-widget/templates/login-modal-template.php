<div class="mkd-login-register-holder">
	<div class="mkd-login-register-content">
		<ul>
			<li><a href="#mkd-login-content"><?php esc_html_e( 'Login', 'mkd_membership' ); ?></a></li>
			<li><a href="#mkd-register-content"><?php esc_html_e( 'Register', 'mkd_membership' ); ?></a></li>
		</ul>
		<div class="mkd-login-content-inner" id="mkd-login-content">
			<div class="mkd-wp-login-holder"><?php echo mkd_membership_execute_shortcode( 'mkd_user_login', array() ); ?></div>
		</div>
		<div class="mkd-register-content-inner" id="mkd-register-content">
			<div class="mkd-wp-register-holder"><?php echo mkd_membership_execute_shortcode( 'mkd_user_register', array() ) ?></div>
		</div>
	</div>
</div>