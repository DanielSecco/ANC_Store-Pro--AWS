<?php
get_header();
if ( mkd_membership_theme_installed() ) {
	depot_mikado_get_title();
} else { ?>
	<div class="mkd-membership-title">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</div>
<?php }
?>
	<div class="mkd-container">
		<?php do_action( 'depot_mikado_after_container_open' ); ?>
		<div class="mkd-container-inner clearfix">
			<?php if ( is_user_logged_in() ) { ?>
				<div class="mkd-membership-dashboard-nav-holder clearfix">
					<?php
					//Include dashboard navigation
					echo mkd_membership_get_dashboard_template_part( 'navigation' );
					?>
				</div>
				<div class="mkd-membership-dashboard-content-holder">
					<?php echo mkd_membership_get_dashboard_pages(); ?>
				</div>
			<?php } else { ?>
				<div class="mkd-login-register-content mkd-user-not-logged-in">
					<ul>
						<li>
							<a href="#mkd-login-content"><?php esc_html_e( 'Login', 'mkd_membership' ); ?></a>
						</li>
						<li>
							<a href="#mkd-register-content"><?php esc_html_e( 'Register', 'mkd_membership' ); ?></a>
						</li>
						<li>
							<a href="#mkd-reset-pass-content"><?php esc_html_e( 'Reset Password', 'mkd_membership' ); ?></a>
						</li>
					</ul>
					<div class="mkd-login-content-inner" id="mkd-login-content">
						<div
							class="mkd-wp-login-holder"><?php echo mkd_membership_execute_shortcode( 'mkd_user_login', array() ); ?>
						</div>
					</div>
					<div class="mkd-register-content-inner" id="mkd-register-content">
						<div
							class="mkd-wp-register-holder"><?php echo mkd_membership_execute_shortcode( 'mkd_user_register', array() ) ?>
						</div>
					</div>
					<div class="mkd-reset-pass-content-inner" id="mkd-reset-pass-content">
						<div
							class="mkd-wp-reset-pass-holder"><?php echo mkd_membership_execute_shortcode( 'mkd_user_reset_password', array() ) ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php do_action( 'depot_mikado_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>