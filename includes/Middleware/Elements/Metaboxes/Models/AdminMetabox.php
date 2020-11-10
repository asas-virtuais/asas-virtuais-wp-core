<?php

namespace AsasVirtuaisWPCore\V0_9_0\Middleware\Elements\Metaboxes\Models;

use AsasVirtuaisWPCore\V0_9_0\Middleware\Elements\Pages\Models\AdminPage;
use AsasVirtuaisWPCore\Middleware\Elements\Fields\Strategies\AdminFields;
use AsasVirtuaisWPCore\Middleware\Elements\Forms\Traits\FormsTrait;
use AsasVirtuaisWPCore\Traits\ViewTrait;

class AdminMetabox extends MetaboxPrototype {

	use AdminFields;
	use FormsTrait;
	use ViewTrait;
	
	public function views_dir() : string {
		return plugin_dir_path( __DIR__ ) . 'Views/';	
	}

	public function render() {
		$this->render_view( 'metabox', [ 'metabox' => $this ] );
	}

	public function set_admin_page( AdminPage $admin_page ) {
		$this->admin_page = $admin_page;
	}
	public function register_option( string $option ) {
		$this->admin_page->register_option( $option );
	}
}
