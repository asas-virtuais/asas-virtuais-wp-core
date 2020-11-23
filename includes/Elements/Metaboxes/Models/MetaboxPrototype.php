<?php

namespace AsasVirtuaisWPCore\V0_9_1\Middleware\Elements\Metaboxes\Models;

class MetaboxPrototype {

	public $id;
	public $title;
	public $screen;
	public $context;
	public $priority;
	public $callback;

	public function __construct( string $title, string $screen, string $context, $args = [] ) {
		$this->id       = $args['id']       ?? sanitize_title( $title );
		$this->title    = $args['title']    ?? $title;
		$this->screen   = $args['screen']   ?? $screen;
		$this->context  = $args['context']  ?? $context;
		$this->priority = $args['priority'] ?? 'default';
		$this->callback = $args['callback'] ?? '__return_null';
	}

}
