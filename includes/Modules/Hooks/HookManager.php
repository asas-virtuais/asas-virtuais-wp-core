<?php

namespace AsasVirtuaisWPCore\V0_9_1\Modules\Hooks;

use \AsasVirtuaisWPCore\V0_9_1\Models\Manager;

class HookManager extends Manager {

	public function initialize() {
	}

	public function add_action( $name, $callback, $priority = 10, $variables = 1 ) {
		$callback = $this->make_callback( $callback );
		add_action( $name, $callback, $priority, $variables );
		return $callback;
	}

	public function add_filter( $name, $callback, $priority = 10, $variables = 1 ) {
		$callback = $this->make_callback( $callback );
		add_filter( $name, $callback, $priority, $variables );
		return $callback;
	}

	public function make_callback( $callback ) {
		return function( $anything = false ) use ( $callback ) {
			try {
				$args = func_get_args();
				return call_user_func_array( $callback, $args );
			} catch ( \Throwable $th ) {
				$this->framework->admin_manager()->admin_error_from_exception( $th );
			}
			return $anything;
		};
	}

	public function make_shortcode_callback( string $shortcode, callable $callback ) {
		return function ( $atts, $content = '' ) use ( $shortcode, $callback ) {
			$args = shortcode_atts( [], $atts, $shortcode );
			return $callback( $args, $content );
		};
	}
	public function add_shortcode( string $shortcode, callable $callback ) {
		add_shortcode( $shortcode, $this->make_shortcode_callback( $shortcode, $callback ) );
	}

}
