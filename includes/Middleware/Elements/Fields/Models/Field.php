<?php
namespace AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Fields\Models;

class Field {

	public $name;
	public $type;
	public $label;
	public $attributes;
	public $description;

	public function __construct( string $name, string $type, $args = [] ) {
		$defaults = [
			'name'        => sanitize_title( $name ),
			'type'        => $type,
			'label'       => $name,
			'attributes'  => $args['attributes']  ?? [],
			'description' => $args['description'] ?? '',
		];

		$args = array_replace( $defaults, $args );

		$this->name = $args['name'];
		$this->type = $args['type'];
		$this->label = $args['label'];
		$this->attributes = $args['attributes'];
		$this->description = $args['description'];
	}

}
