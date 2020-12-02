<?php

namespace AsasVirtuaisWPCore\V0_9_1\Elements\Metaboxes\Models;

class MetaboxPrototype {

	public $id;
	public $title;
	public $screen;
	public $context;
	public $priority;
	public $callback;
	public $condition;

	public function __construct( string $title, string $screen, string $context, $args = [] ) {
		$this->id        = $args['id']        ?? sanitize_title( $title );
		$this->title     = $args['title']     ?? $title;
		$this->screen    = $args['screen']    ?? $screen;
		$this->context   = $args['context']   ?? $context;
		$this->priority  = $args['priority']  ?? 'default';
		$this->callback  = $args['callback']  ?? '__return_null';
		$this->condition = $args['condition'] ?? '__return_true';
	}

	public function set_condition( $condition ) : MetaboxPrototype {
		$this->condition = $condition;
		return $this;		
	}

	public function initialize() {
		$condition = $this->condition;
		if ( $condition( $this ) ) {
			add_meta_box(
				$this->id,
				$this->title,
				[$this, 'render'],
				$this->screen,
				$this->context,
				$this->priority
			);
		}
	}

}
