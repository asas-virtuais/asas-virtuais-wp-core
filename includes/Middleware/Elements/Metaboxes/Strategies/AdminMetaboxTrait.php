<?php

namespace AsasVirtuaisWPCore\Middleware\Elements\Metaboxes\Strategies;

use AsasVirtuaisWPCore\V0_9_1\Middleware\Elements\Metaboxes\Models\AdminMetabox;

trait AdminMetaboxTrait {
	public $metaboxes = [];

	abstract public function get_screen_id() : string;

	public function add_meta_box( string $title, string $context = 'advanced', array $args = [] ) : AdminMetabox {
		$metabox = new AdminMetabox( $title, $this->get_screen_id(), $context, $args );
		$metabox->set_admin_page( $this );
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
			add_meta_box(
				$metabox->id,
				$metabox->title,
				[$metabox, 'render'],
				$metabox->screen,
				$metabox->context,
				$metabox->priority
			);
		}
	}
	public function render_meta_boxes( string $context = 'advanced' ) {
		do_meta_boxes( $this->get_screen_id(), $context, $this );
	}
}
