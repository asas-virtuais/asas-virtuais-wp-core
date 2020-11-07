<?php

namespace AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Metaboxes\Models;

use AsasVirtuaisWPCore\Middleware\Elements\Fields\Traits\FieldsTrait;
use AsasVirtuaisWPCore\Middleware\Elements\Forms\Traits\FormsTrait;
use AsasVirtuaisWPCore\Traits\ViewTrait;

class Metabox extends MetaboxPrototype {

	use FieldsTrait;
	use FormsTrait;
	use ViewTrait;
	
	public function views_dir() : string {
		return plugin_dir_path( __DIR__ ) . 'Views/';	
	}

	public function render() {
		$this->render_view( 'metabox', [ 'metabox' => $this ] );
	}

}
