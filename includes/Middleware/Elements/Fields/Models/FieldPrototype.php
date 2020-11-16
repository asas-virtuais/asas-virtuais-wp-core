<?php
namespace AsasVirtuaisWPCore\Middleware\Elements\Fields\Models;

class FieldPrototype {

	public $name;
	public $type;
	public $label;
	public $attributes;
	public $description;

	public function __construct( string $name, string $type, $callback, $args = [] ) {
		$this->callback = $callback;

		$this->name        = $name;
		$this->type        = $type;

		$this->label       = $args['label']       ?? av_unslug( $name );
		$this->description = $args['description'] ?? '';

		$this->attributes  = (object) $args;
	}
}
