<?php

namespace AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Metaboxes\Models;

class MetaboxPrototype {

	public $id;
	public $title;
	public $screen;
	public $context;
	public $priority;
	public $callback;

	public function __construct( string $title, string $screen, string $context, $args = [] ) {
		$this->id       = $attributes['id']       ?? sanitize_title( $title );
		$this->title    = $attributes['title']    ?? $title;
		$this->screen   = $attributes['screen']   ?? $screen;
		$this->context  = $attributes['context']  ?? $context;
		$this->priority = $attributes['priority'] ?? 'default';
		$this->callback = $attributes['callback'] ?? '__return_null';
	}

}
