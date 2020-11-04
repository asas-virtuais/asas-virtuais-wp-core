<?php
/**
 * Plugin Name: Plugin Starter Sample
 * Version: 1.0.0
 * Description: Reminder to set autoload in composer.json
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

 // Everything inside this function to evade global changes
if ( ! function_exists( 'plugin_sample_start' ) ) {
	function plugin_sample_start() {

		$admin_notice_exception = function( $th ) {
			add_action( 'admin_notices', function() use ( $th ) {
				$msg  = $th->getMessage();
				$line = $th->getLine();
				$file = $th->getFile();
				$message = "<pre>Error: $msg\nFile:  $file\nLine:  $line\n" . print_r( $th, true ) . '</pre>';
				echo "<div class='notice notice-error'><p>$message</p></div>";
			} );
		};

		// Everything in a try/catch to avoid crashing websites
		try {
			$plugin_dir = plugin_dir_path( __FILE__ );

			// Require autoload or throw
			if ( file_exists( $plugin_dir . 'vendor/autoload.php' ) ) {
				$autoload = require_once $plugin_dir . 'vendor/autoload.php';
			} else {
				throw new \Exception( 'Autoload not present' );
			}
			// Require framework loader or throw
			if ( file_exists( $plugin_dir . 'vendor/asas-virtuais/asas-virtuais-wp-core/Loader.php' ) ) {
				$framework_loader = require_once $plugin_dir . 'vendor/asas-virtuais/asas-virtuais-wp-core/Loader.php';
			} else {
				throw new \Exception( 'Framework Loader.php not present' );
			}
			// Do your stuff only after plugins_loaded hook
			add_action( 'plugins_loaded', function() use ( $autoload, $framework_loader, $admin_notice_exception ) {
				try {
					// Instantiate the framework.
					$framework = $framework_loader->load_framework( __FILE__, $autoload );
					include_once $framework->plugin_dir . 'plugin-starter-lib.php';

				} catch ( \Throwable $th ) {
					$admin_notice_exception( $th );
				}
			} );
		} catch ( \Throwable $th ) {
			$admin_notice_exception( $th );
		}
	}
	plugin_sample_start();
}
