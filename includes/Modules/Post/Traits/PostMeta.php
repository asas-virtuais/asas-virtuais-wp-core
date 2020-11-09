<?php

namespace AsasVirtuaisWPCore\Modules\Post\Traits;

trait PostMeta {

	static $metadata = [];

	public static function register_meta( string $name ) {
		$class = get_called_class();
		$class::$metadata[] = $name;
		return $class;
	}
	public static function set_post_meta_hooks() {
		$class = get_called_class();
		add_action( 'save_post', "$class::save_meta" );
		return $class;
	}
	public static function save_meta( $post_id ) {

		$class = get_called_class();

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		foreach ( $class::$metadata as $name ) {

			if ( ! isset( $_POST[$name] ) ) {
				continue;
			}

			update_post_meta( $post_id, $name, $_POST[$name] );
		}
	}

	// Instance Metadata
		/**
		 * @param string $key
		 * @param mixed $value
		 * @return bool
		 */
		public function update_meta( $key, $value ) {
			$result = update_post_meta( $this->get_id(), $key, $value );
			if ( $result !== false ) {
				return true;
			}
			$meta = get_post_meta( $this->get_id(), $key, true );
			if ( $value === $meta || json_encode( $value ) === json_encode( $meta ) ) {
				return true;
			}
			return false;
		}
		public function get_meta( $key, $fallback = null ) {
			$result = get_post_meta( $this->get_id(), $key, true );
			if ( $result === null && $fallback !== null ) {
				return $fallback;
			}
			return $result;
		}

}
