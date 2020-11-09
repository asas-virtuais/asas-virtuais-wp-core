<?php

namespace AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Metaboxes\Models;

use AsasVirtuaisWPCore\Middleware\Elements\Fields\Strategies\PostFields;
use AsasVirtuaisWPCore\Middleware\Elements\Forms\Traits\FormsTrait;
use AsasVirtuaisWPCore\Traits\ViewTrait;

class PostMetabox extends MetaboxPrototype {

	use PostFields;
	use FormsTrait;
	use ViewTrait;

	// View methods
		public function views_dir() : string {
			return plugin_dir_path( __DIR__ ) . 'Views/';	
		}

		public function render() {
			$this->render_view( 'metabox', [ 'metabox' => $this ] );
		}

}
