<?php
namespace AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Metaboxes\Strategies;

use AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Metaboxes\Models\Metabox;

trait PostMetabox {

	public static $metaboxes = [];

	abstract public static function post_type() : string;

	public static function add_meta_box( string $title, string $context = 'default', array $args = [] ) : Metabox {
		$metabox = new Metabox( $title, static::post_type(), $context, $args );
		static::$metaboxes[] = $metabox;
		return $metabox;
	}
	public static function initialize_meta_boxes() {
		add_filter( 'rwmb_meta_boxes', [ get_called_class(), 'load_meta_boxes' ] );
	}
	public static function load_meta_boxes( $meta_boxes ) {

		foreach ( static::$metaboxes as $metabox ) {
			$meta_box = [
				'title'      => $metabox->title,
				'post_types' => $metabox->screen,
				'fields' => []
			];
			foreach ( $metabox->fields as $field ) {
				$meta_box['fields'][] =  array_merge( [
					'id'   => $field->name,
					'name' => $field->label,
					'desc' => $field->description,
					'type' => $field->type,
				], $field->attributes );
			}
			$meta_boxes[] = $meta_box;
		}

		return $meta_boxes;
	}

}
