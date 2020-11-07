<?php

namespace AsasVirtuaisWPCore\Middleware\Elements\Fields\Strategies;

use AsasVirtuaisWPCore\Middleware\Elements\Fields\Models\WordpressField;
use AsasVirtuaisWPCore\Modules\Post\Traits\UsePostTrait;

trait PostFieldsTrait {

	use UsePostTrait;

	public $fields = [];
	public function add_field( string $name, string $type, array $args = [] ) {
		$this->fields[] = new WordpressField( $name, $type, [ $this, 'get_field_value' ], $args );
		return $this;
	}

	public function get_field_value( string $name ) {
		$current_post = get_post();
		$class = $this->post_class;
		if ( $current_post && isset( $current_post->post_type ) && $current_post->post_type === $class::get_post_type() ) {
			$post = new $class( $current_post );
			return $post->get_meta( $name );
		}
	}
	public function register_meta( string $name ) {
		$this->post_class::register_meta( $name );
	}

}
