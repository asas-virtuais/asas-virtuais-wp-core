<?php

namespace AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Metaboxes\Models;

use AsasVirtuaisWPCore\Middleware\Elements\Fields\Strategies\PostFieldsTrait;
use AsasVirtuaisWPCore\Middleware\Elements\Forms\Traits\FormsTrait;
use AsasVirtuaisWPCore\Traits\ViewTrait;

class PostMetabox extends MetaboxPrototype {

	use PostFieldsTrait;
	use FormsTrait;
	use ViewTrait;

	public function __construct( string $title, string $screen, string $context, $args = [] ) {
		parent::__construct( $title, $screen, $context, $args );
	}

	// View methods
		public function views_dir() : string {
			return plugin_dir_path( __DIR__ ) . 'Views/';	
		}

		public function render() {
			$this->render_view( 'metabox', [ 'metabox' => $this ] );
		}

	// Upstream methods
		public function register_meta( string $name ) {
			return $this->post::register_meta( $name );
		}
		public function get_field_value( string $name ) {
			return $this->post::get_meta( $name );
		}

}
