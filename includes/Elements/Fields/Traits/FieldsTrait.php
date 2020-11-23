<?php
namespace AsasVirtuaisWPCore\Elements\Fields\Traits;

use AsasVirtuaisWPCore\Elements\Fields\Models\FieldPrototype;

trait FieldsTrait {

	public $fields = [];
	public function add_field( $name, $type, $args = [] ) {
		$this->fields[] = new FieldPrototype( $name, $type, $args );
		return $this;
	}
}
