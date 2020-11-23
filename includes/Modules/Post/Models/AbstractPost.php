<?php

namespace AsasVirtuaisWPCore\Modules\Post\Models;

use AsasVirtuaisWPCore\Modules\Post\Traits\PostMeta;
use AsasVirtuaisWPCore\Elements\Metaboxes\Strategies\PostMetaboxTrait;

abstract class AbstractPost implements PostInterface {

	use PostMeta;
	use PostMetaboxTrait;

	public $wp_post;

	public function __construct( $data ) {
		if ( is_numeric( $data ) ) {
			$this->wp_post = get_post( $data );
		} elseif ( $data instanceof \WP_Post ) {
			$this->wp_post = $data;
		} else {
			throw new \Exception( 'WP_Post or Post ID expected, received: ' . var_export( $data, true ) );
		}
	}

	// Abstract methods
	abstract static function post_type() : string;

	// Getters
		public function get_id() {
			return $this->wp_post->ID;
		}
		public function get_type() {
			return $this->wp_post->post_type;
		}
		public function get_author() {
			return $this->wp_post->post_author;
		}
		public function get_content() {
			return $this->wp_post->post_content;
		}
		public function get_title() {
			return $this->wp_post->post_title;
		}
		public function get_excerpt() {
			return $this->wp_post->post_excerpt;
		}
		public function get_status() {
			return $this->wp_post->post_status;
		}
		public function get_comment_status() {
			return $this->wp_post->comment_status;
		}
		public function get_ping_status() {
			return $this->wp_post->ping_status;
		}
		public function get_password() {
			return $this->wp_post->post_password;
		}
		public function get_name() {
			return $this->wp_post->post_name;
		}
		public function get_to_ping() {
			return $this->wp_post->to_ping;
		}
		public function get_pinged() {
			return $this->wp_post->pinged;
		}
		public function get_parent() {
			return $this->wp_post->post_parent;
		}
		public function get_guid() {
			return $this->wp_post->guid;
		}
		public function get_menu_order() {
			return $this->wp_post->menu_order;
		}

	// Query
		/**
		 * Query DB for posts of this type and retrieves array of static instances
		 * @param array $args get_posts args
		 * @return static[]
		 */
		public static function query( $args = [] ) {
			$defaults = [
				'post_type' => static::post_type(),
				'posts_per_page' => -1
			];

			return array_map( function( $post ) {
				return new static ( $post );
			}, get_posts( array_replace( $defaults, $args ) ) );
		}

}
