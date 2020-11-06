<?php
namespace AsasVirtuaisWPCore\Middleware\Elements\Metaboxes\Strategies;

use AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Metaboxes\Models\Metabox;

trait PostMetabox {

	public static $metaboxes = [];

	abstract public static function post_type() : string;

	public static function add_meta_box( string $title, string $context = 'advanced', array $args = [] ) : Metabox {
		$metabox = new Metabox( $title, static::post_type(), $context, $args );
		static::$metaboxes[] = $metabox;
		return $metabox;
	}
	public static function initialize_meta_boxes() {
		$klass = get_called_class();
		add_action( 'add_meta_boxes', "$klass::load_meta_boxes" );
		return $klass;
	}
	public static function load_meta_boxes( $screen_id ) {
		$klass = get_called_class();
		if ( $screen_id !== $klass::post_type() ) return;
		foreach ( $klass::$metaboxes as $metabox ) {
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

}
