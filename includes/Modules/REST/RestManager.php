<?php
namespace AsasVirtuaisWPCore\V0_9_1\Modules\REST;

use AsasVirtuaisWPCore\V0_9_1\Models\Manager;

class RestManager extends Manager {

	public $routes = [];
	public $route_namespace;

	public function initialize( $args = [] ) {
		$this->route_namespace = $args['route_namespace'] ?? _doing_it_wrong( __METHOD__, 'Rest Manager requires namespace', '5.5.3' );
		$this->framework->hook_manager()->add_action( 'rest_api_init', [ $this, 'register_routes' ] );
	}

	public function register_routes() {
		foreach( $this->routes as $endpoint => $args ) {
			register_rest_route( $this->route_namespace, "/$endpoint", $args );
		}
	}

	public function add_endpoint( string $endpoint, $methods, $callback, $args = [] ) {
		$args['methods'] = $methods;
		$args['callback'] = $this->make_callback( $callback );
		$args['permission_callback'] = $args['permission_callback'] ?? '__return_true';
		$this->routes[ $endpoint ] = $args;
	}

	public function make_callback( callable $callback ) {
		return function() use ( $callback ) {
			try {
				$response = call_user_func_array( $callback, func_get_args() );
				return [
					'status' => 'success',
					'response' => $response
				];
			} catch ( \Throwable $th ) {
				return [
					'status' => 'error',
					'response' => av_get_error_details( $response )
				];
			}
		};
	}

}
