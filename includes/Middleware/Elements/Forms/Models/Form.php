<?php
namespace AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Forms\Models;

use AsasVirtuaisWPCore\Traits\ViewTrait;
use AsasVirtuaisWPCore\Middleware\Elements\Fields\Traits\FieldsTrait;

class Form {

	use ViewTrait;
	use FieldsTrait;

	public $title;
	public $method;
	public $action;
	public function __construct( string $title, string $method, $action = '' ) {
		$this->title = $title;
		$this->method = $method;
		$this->action = $action;
	}

	public function views_dir() : string {
		return plugin_dir_path( __DIR__ ) . 'Views/';	
	}

	public function render() {
		$this->render_view( 'form', [ 'form' => $this ] );
	}

}
