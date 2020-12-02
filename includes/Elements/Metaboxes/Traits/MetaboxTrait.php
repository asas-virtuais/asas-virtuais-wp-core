<?php

namespace AsasVirtuaisWPCore\Elements\Metaboxes\Traits;

use AsasVirtuaisWPCore\V0_9_1\Elements\Metaboxes\Models\MetaboxPrototype;

trait MetaboxTrait {
	public $metaboxes = [];

	abstract public function get_screen_id() : string;

	public function add_meta_box( string $title, string $context = 'advanced', array $args = [] ) : MetaboxPrototype {
		$metabox = new MetaboxPrototype( $title, $this->get_screen_id(), $context, $args );
		$this->metaboxes[] = $metabox;
		return $metabox;
	}
	public function initialize_meta_boxes() {
		add_action( 'add_meta_boxes', [ $this, 'load_meta_boxes' ] );
		$this->prepare_meta_boxes();
	}
	public function prepare_meta_boxes() {
		wp_enqueue_script( 'post' );
		do_action( 'add_meta_boxes', $this->get_screen_id(), $this );
	}
	public function load_meta_boxes( $screen_id ) {
		if ( $screen_id !== $this->get_screen_id() ) return;
		foreach ( $this->metaboxes as $metabox ) {
			$metabox->initialize();
		}
	}
	public function render_meta_boxes( string $context = 'advanced' ) {
		do_meta_boxes( $this->get_screen_id(), $context, $this );
	}
}
