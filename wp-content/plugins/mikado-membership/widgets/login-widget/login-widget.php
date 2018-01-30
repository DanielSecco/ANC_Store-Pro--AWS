<?php

class MikadoMembershipLoginRegister extends WP_Widget {
	protected $params;

	public function __construct() {
		parent::__construct(
			'mkd_login_register_widget', // Base ID
			'Mikado Login',
			array( 'description' => esc_html__( 'Login and register wordpress widget', 'mkd_membership' ), )
		);
	}

	public function widget( $args, $instance ) {
		$additional_class = '';
		if(is_user_logged_in()){
			$additional_class .= 'mkd-user-logged-in';
		}

		echo '<div class="widget mkd-login-register-widget '.$additional_class.'">';
		if ( ! is_user_logged_in() ) {
			echo '<a href="#" class="mkd-login-opener">' . esc_html__( 'Login', 'mkd_membership' ) . '</a>';

			add_action( 'wp_footer', array( $this, 'mkd_membership_render_login_form' ) );

		} else {
			echo mkd_membership_get_widget_template_part( 'login-widget', 'login-widget-template' );
		}
		echo '</div>';

	}

	public function mkd_membership_render_login_form() {

		//Render modal with login and register forms
		echo mkd_membership_get_widget_template_part( 'login-widget', 'login-modal-template' );
	}
}

function mkd_membership_login_widget_load() {
	register_widget( 'MikadoMembershipLoginRegister' );
}

add_action( 'widgets_init', 'mkd_membership_login_widget_load' );