<?php
namespace AsasVirtuaisWPCore\Modules\Users;

class User {

	protected \WP_User $wp_user;

	public function __construct( $wp_user = false ) {
		if ( ! $wp_user ) {
			$this->wp_user = wp_get_current_user();
		} else {
			$this->wp_user = $wp_user;
		}
	}

	public function get_id() {
		return $this->wp_user->ID;
	}

	private $is_admin;
	public function is_admin() {
		if ( ! isset( $this->is_admin ) ) {
			$this->is_admin = user_can( $this->get_id(), 'administrator' );
		}
		return $this->is_admin;
	}

	public function update_meta( $key, $value ) {
		return update_user_meta( $this->get_id(), $key, $value );
	}

}
