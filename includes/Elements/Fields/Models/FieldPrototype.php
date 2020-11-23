<?php
namespace AsasVirtuaisWPCore\Elements\Fields\Models;

class FieldPrototype {

	public $name;
	public $type;
	public $label;
	public $attributes;
	public $description;

	public function __construct( string $name, string $type, $callback, $args = [] ) {
		$this->callback = $callback;

		$this->name        = $args['name']        ?? $name;
		$this->type        = $args['type']        ?? $type;
		$this->label       = $args['label']       ?? av_unslug( $name );
		$this->attributes  = $args['attributes']  ?? [];
		$this->description = $args['description'] ?? '';
	}
}
