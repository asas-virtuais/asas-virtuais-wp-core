<?php
namespace AsasVirtuaisWPCore\Middleware\Elements\Metaboxes\Strategies;

use AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Metaboxes\Models\PostMetabox;

trait PostMetaboxTrait {

	public static $metaboxes = [];

	abstract public static function post_type() : string;

	public static function add_meta_box( string $title, string $context = 'advanced', array $args = [] ) : PostMetabox {
		$metabox = new PostMetabox( $title, static::post_type(), $context, $args );
		$class = get_called_class();
		$metabox->set_post_class( $class );
		$class::$metaboxes[] = $metabox;
		return $metabox;
	}
	public static function initialize_meta_boxes() {
		$class = get_called_class();
		add_action( 'add_meta_boxes', "$class::load_meta_boxes" );
		return $class;
	}
	public static function load_meta_boxes( $screen_id ) {
		$class = get_called_class();
		if ( $screen_id !== $class::post_type() ) return;
		foreach ( $class::$metaboxes as $metabox ) {
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
