<?php

namespace AsasVirtuaisWPCore\V0_9_1\Elements\Metaboxes\Models;

use AsasVirtuaisWPCore\Elements\Fields\Strategies\PostFields;
use AsasVirtuaisWPCore\Elements\Forms\Traits\FormsTrait;
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
