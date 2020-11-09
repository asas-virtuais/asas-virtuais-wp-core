<?php

namespace AsasVirtuaisWPCore\Middleware\Elements\Fields\Strategies;

use AsasVirtuaisWPCore\Middleware\Elements\Fields\Models\WordpressField;

trait AdminFields {

	public $fields = [];
	public function add_field( string $name, string $type, array $args = [] ) {
		$this->fields[] = new WordpressField( $name, $type, [ $this, 'get_field_value' ], $args );
		$this->register_option( $name );
		return $this;
	}

	public function get_field_value( WordpressField $field ) {
		return get_option( $field->name );
	}

	abstract function register_option( string $option );

}
