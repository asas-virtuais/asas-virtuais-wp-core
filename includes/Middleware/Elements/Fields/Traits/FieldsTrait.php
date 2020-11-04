<?php
namespace AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Fields\Traits;

use AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Fields\Models\Field;

trait FieldsTrait {

	public $fields = [];
	public function add_field( $name, $type, $args = [] ) {
		$this->fields[] = new Field( $name, $type, $args );
		return $this;
	}
}
