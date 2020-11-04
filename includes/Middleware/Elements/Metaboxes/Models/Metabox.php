<?php

namespace AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Metaboxes\Models;

use AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Fields\Traits\FieldsTrait;
use AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Forms\Traits\FormsTrait;
use AsasVirtuaisWPCore\V0_3_0\Traits\ViewTrait;

class Metabox {

	use ViewTrait;
	use FormsTrait;
	use FieldsTrait;

	public $id;
	public $title;
	public $screen;
	public $context;
	public $priority;
	public $callback;

	public function __construct( string $title, string $screen, string $context, $args = [] ) {
		$defaults = [
			'id'       => sanitize_title( $title ),
			'title'    => $title,
			'screen'   => $screen,
			'context'  => $context,
			'priority' => 'default',
			'callback' => '__return_null',
		];
		$attributes = array_replace( $defaults, $args );
		$this->id       = $attributes['id'];
		$this->title    = $attributes['title'];
		$this->screen   = $attributes['screen'];
		$this->context  = $attributes['context'];
		$this->priority = $attributes['priority'];
		$this->callback = $attributes['callback'];
	}

	public function views_dir() {
		return plugin_dir_path( __DIR__ ) . 'Views/';	
	}

	public function render() {
		$this->render_view( 'metabox', [ 'metabox' => $this ] );
	}

}
