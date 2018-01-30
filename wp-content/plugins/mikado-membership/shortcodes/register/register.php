<?php
namespace MikadoMembership\Shortcodes\MikadoUserRegister;

use MikadoMembership\Lib\ShortcodeInterface;
/**
 * Class MikadoUserRegister
 */
class MikadoUserRegister implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkd_user_register';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer
	 *
	 * @see vc_map
	 */
	public function vcMap() {
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render( $atts, $content = null ) {

		$args = array();

		$params = shortcode_atts( $args, $atts );
		extract( $params );
		$html = '';

		if ( ! is_user_logged_in() ) {
			if ( get_option( 'users_can_register' ) ) {
				$html .= mkd_membership_get_shortcode_template_part( 'register', 'register-template', '', $params );
			} else {
				$message = esc_html__( "You don't have permission to register", 'mkd_membership' );
				$html .= mkd_membership_get_shortcode_template_part( 'register', 'register-message', '', array( 'message' => $message ) );
			}
		} else {
			$message = esc_html__( 'You are already logged in', 'mkd_membership' );
			$html .= mkd_membership_get_shortcode_template_part( 'register', 'register-message', '', array( 'message' => $message ) );
		}

		return $html;
	}

}