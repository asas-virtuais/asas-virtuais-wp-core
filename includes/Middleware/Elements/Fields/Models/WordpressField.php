<?php
namespace AsasVirtuaisWPCore\Middleware\Elements\Fields\Models;

use AsasVirtuaisWPCore\Traits\ViewTrait;
use AsasVirtuaisWPCore\Traits\AssetsTrait;

class WordpressField extends FieldPrototype {
	use ViewTrait;
	use AssetsTrait;

	public $assets_prefix = 'av_field_';
	public $callback;

	public function __construct( string $name, string $type, $callback, $args = [] ) {
		parent::__construct( $name, $type, $callback, $args );

		if ( did_action( 'wp_enqueue_scripts' ) ) {
			$this->register_field_assets();
		} else {
			add_action( 'wp_enqueue_scripts', function() {
				$this->register_field_assets();
			} );
		}
	}

	public function register_field_assets() {
		$this->register_style( $this->type );
		$this->register_script( $this->type );
	}
	public function enqueue_field_assets() {
		wp_enqueue_style( $this->type );
		wp_enqueue_script( $this->type );
	}

	public function get_value() {
		return call_user_func( $this->callback, $this );
	}
	public function assets_prefix () : string {
		return $this->assets_prefix;
	}
	public function scripts_dir() : string {
		return $this->assets_dir() . 'js/';
	}
	public function styles_dir() : string {
		return $this->assets_dir() . 'css/';
	}
	public function assets_dir() : string {
		return plugin_dir_path( __DIR__ ) . 'Assets/';
	}
	public function views_dir() : string {
		return plugin_dir_path( __DIR__ ) . 'Views/';
	}
	public function render() {
		$this->enqueue_field_assets();
		return $this->render_view( $this->type, [ 'field' => $this ] );
	}
	public function html() {
		$this->enqueue_field_assets();
		return $this->load_view( $this->type, [ 'field' => $this ] );
	}
}
