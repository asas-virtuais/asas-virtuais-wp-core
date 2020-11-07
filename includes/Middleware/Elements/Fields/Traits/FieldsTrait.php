<?php
namespace AsasVirtuaisWPCore\Middleware\Elements\Fields\Traits;

use AsasVirtuaisWPCore\Middleware\Elements\Fields\Models\FieldPrototype;

trait FieldsTrait {

	public $fields = [];
	public function add_field( $name, $type, $args = [] ) {
		$this->fields[] = new FieldPrototype( $name, $type, $args );
		return $this;
	}
}
