<?php
namespace AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Forms\Models;

use AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Fields\Traits\FieldsTrait;
use AsasVirtuaisWPCore\V0_3_0\Traits\ViewTrait;

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

	public function views_dir() {
		return plugin_dir_path( __DIR__ ) . 'Views/';	
	}

	public function render() {
		$this->render_view( 'form', [ 'form' => $this ] );
	}

}
