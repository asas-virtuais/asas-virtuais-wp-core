<?php
namespace AsasVirtuaisWPCore\V0_9_1\Modules\Post;

use AsasVirtuaisWPCore\V0_9_1\Models\Manager;

class CPTManager extends Manager {

	public function initialize() {
		add_action( 'init', [ $this, 'register_custom_post_types' ] );
	}

	public function register_custom_post_types() {
		foreach( $this->custom_post_types as $slug => $args ) {
			register_post_type( $slug, $args );
		}
	}

	private $custom_post_types = [];
	public function register_cpt( string $cpt_class, $args = [] ) {

		$slug = $cpt_class::post_type();

		$args = array_replace( [
			'labels'              => CPTHelper::cpt_labels( $slug ),
			'description'         => '',
			'public'              => true,
			'hierarchical'        => false,
			'show_in_rest'        => true,
			'supports'            => [ 'title', 'editor', 'thumbnail' ],
			'rewrite' 	          => false
		], $args );

		$this->custom_post_types[ $slug ] = $args;
	}

}
