<?php
namespace AsasVirtuaisWPCore\Elements\Fields\Traits;

use AsasVirtuaisWPCore\Elements\Fields\Models\FieldPrototype;

trait FieldsTrait {

	public $fields = [];
	public function add_field( $name, $type, $args = [] ) {
		$class = "\AsasVirtuaisWPCore\Elements\Fields\Models\SSR\\" + str_replace( ' ', '', ucwords( str_replace( ['-', '_'], ' ', $type ) ) );
		$this->fields[] = new $class( $name, $args );
		return $this;
	}
}
