<?php
/** This file should be required without the use of autoloaders, it returns the instance of the loader class */
namespace AsasVirtuaisWPCoreVersionLoader;

if ( ! class_exists( 'AsasVirtuaisWPCoreVersionLoader\\LoaderV0_9_0' ) ) {

	/** Loader class */
	final class LoaderV0_9_0 {

		public $dirpath;
		public $version;

		public function __construct( $dirpath, $version ) {
			$this->dirpath = $dirpath;
			$this->version = $version;
		}

		public static function include_once_or_throw( $file ) {
			if ( ! include_once( $file ) ) {
				throw new \Exception( "Could not find file: $file" );
			}
			return true;
		}

		/**
		 * This method should be called after the plugin_loaded hook, and before the init hook
		 * Plugins must provide the autoload, all paths registered to the version will be registered in the loader psr4
		 * @param string $version version to load
		 * @param mixed $autoload class provided by the plugin
		 * @return Framework
		 */
		public function load_framework( $plugin_file, $autoload ) {

			if ( ! did_action( 'plugins_loaded' ) || did_action( 'init' ) ) {
				_doing_it_wrong( __METHOD__, __METHOD__ . ' should be called only after plugins_loaded and before init ', '1.0.0' );
			}

			include_once dirname( $plugin_file ) . '/vendor/wpmetabox/meta-box/meta-box.php';
			$this->load_libraries();
			$this->add_psr4_autoload( $autoload );
			$this->load_framework_static_instance();

			return $this->framework_instance( $plugin_file );
		}
		public function load_framework_static_instance() {
			$main_class = $this->get_namespace() . 'Framework';
			return call_user_func( "$main_class::instance", 'asas-virtuais-wp' );
		}
		public function framework_instance( $plugin_file ) {
			$main_class = $this->get_namespace() . 'Framework';
			$plugin_slug = wp_basename( dirname( $plugin_file ) );
			$instance = call_user_func( "$main_class::instance", $plugin_slug );
			return $instance->initialize( $plugin_file );
		}
		public function get_plugin_data( $plugin_file ) {
			return av_get_plugin_data( $plugin_file );
		}
		public function get_namespace( $include_version = true ) {
			$version = $include_version ? "$this->version\\" : '';
			return "AsasVirtuaisWPCore\\" . $version;
		}
		public function add_psr4_autoload( $autoload ) {
			$autoload->addPsr4( $this->get_namespace(), $this->get_includes_path() );
			$autoload->addPsr4( $this->get_namespace( false ), $this->get_includes_path() );
		}
		public function get_includes_path() {
			return $this->dirpath . '/includes/';
		}
		public function load_libraries() {
			foreach ( glob( "$this->dirpath/libs/*-lib.php" ) as $lib_file ) {
				self::include_once_or_throw( $lib_file );
			}
		}
	}
}

return new LoaderV0_9_0( __DIR__, 'V0_9_0' );
