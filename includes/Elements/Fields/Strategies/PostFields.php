<?php

namespace AsasVirtuaisWPCore\Elements\Fields\Strategies;

use AsasVirtuaisWPCore\Elements\Fields\Models\WordpressField;
use AsasVirtuaisWPCore\Elements\Fields\Traits\CustomFieldsTrait;
use AsasVirtuaisWPCore\Modules\Post\Traits\UsePostTrait;

trait PostFields {

	use UsePostTrait;
	use CustomFieldsTrait;

	public $fields = [];
	public function add_field( string $name, string $type, array $args = [] ) {
		$this->fields[] = new WordpressField( $name, $type, [ $this, 'get_field_value' ], $args );
		$this->register_meta( $name );
		return $this;
	}

	public function get_field_value( WordpressField $field ) {
		$current_post = get_post();
		$class = $this->post_class;
		if ( $current_post && isset( $current_post->post_type ) && $current_post->post_type === $class::post_type() ) {
			return ( new $class( $current_post ) )->get_meta( $field->name );
		}
	}
	public function register_meta( string $name ) {
		$this->post_class::register_meta( $name );
	}
}
