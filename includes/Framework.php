<?php
namespace AsasVirtuaisWPCore\V0_3_0;

use AsasVirtuaisWPCore\V0_3_0\Modules\Assets\AssetsManager;
use AsasVirtuaisWPCore\V0_3_0\Modules\Admin\AdminManager;
use AsasVirtuaisWPCore\V0_3_0\Modules\Hooks\HookManager;
use AsasVirtuaisWPCore\V0_3_0\Modules\PuC\UpdateManager;
use AsasVirtuaisWPCore\V0_3_0\Modules\Post\CPTManager;
use AsasVirtuaisWPCore\V0_3_0\Modules\REST\RestManager;

defined( 'ABSPATH' ) || exit;

class Framework {

	public $plugin_data;
	public $plugin_version;
	public $plugin_prefix;
	public $plugin_slug;
	public $plugin_name;
	public $plugin_file;
	public $plugin_url;
	public $plugin_dir;

	public $framework_dir;
	public $framework_url;

	private static $instances = [];

	public static function instance( $plugin_slug ) : self {

		if ( ! isset( self::$instances[$plugin_slug] ) ) {
            self::$instances[$plugin_slug] = new self( $plugin_slug );
		}

		return self::$instances[$plugin_slug];
    }

	private function __construct( $plugin_slug ) {
		$this->plugin_slug = $plugin_slug;
		$this->framework_dir = plugin_dir_path( __FILE__ );
		$this->framework_url = plugin_dir_url( __FILE__ );
	}

	public function initialize( $plugin_file, $args = [] ) : self {

		$plugin_data          = $args['plugin_data'] ?? av_get_plugin_data( $plugin_file, false, false );
		$this->plugin_data    = $plugin_data;

		$this->plugin_version = $plugin_data['Version'];
		$this->plugin_name    = $plugin_data['Name'] ?? $this->plugin_slug;

		$this->plugin_file    = $plugin_file;
		$this->plugin_dir     = plugin_dir_path( $plugin_file );
		$this->plugin_url     = plugin_dir_url( $plugin_file );
		return $this;
	}

	private $admin_manager;
	/** @return AdminManager */
	public function admin_manager( $args = [] ) : AdminManager {
		if ( ! isset( $this->admin_manager ) ) {
			$this->admin_manager = new AdminManager( $this );
			$this->admin_manager->initialize( $args );
		}
		return $this->admin_manager;
	}
	private $assets_manager;
	/** @return AssetsManager */
	public function assets_manager( $args = [] ) : AssetsManager {
		if ( ! isset( $this->assets_manager ) ) {
			$this->assets_manager = new AssetsManager( $this );
			$this->assets_manager->initialize( $args );
		}
		return $this->assets_manager;
	}
	private $update_manager;
	/** @return UpdateManager */
	public function update_manager( $args = [] ) : UpdateManager {
		if ( ! isset( $this->update_manager ) ) {
			$this->update_manager = new UpdateManager( $this );
			$this->update_manager->initialize( $args );
		}
		return $this->update_manager;
	}
	private $hook_manager;
	/** @return HookManager */
	public function hook_manager() : HookManager {
		if ( ! isset( $this->hook_manager ) ) {
			$this->hook_manager = new HookManager( $this );
		}
		return $this->hook_manager;
	}
	private $cpt_manager;
	/** @return CPTManager */
	public function cpt_manager() : CPTManager {
		if ( ! isset( $this->cpt_manager ) ) {
			$this->cpt_manager = new CPTManager( $this );
			$this->cpt_manager->initialize();
		}
		return $this->cpt_manager;
	}
	private $rest_manager;
	/** @return RestManager */
	public function rest_manager( string $route_namespace, $args = [] ) : RestManager {
		if ( ! isset( $this->rest_manager ) ) {
			$this->rest_manager = new RestManager( $this );
			$args['route_namespace'] = $route_namespace;
			$this->rest_manager->initialize( $args );
		}
		return $this->rest_manager;
	}

	/**
	 * @param mixed $plugins array of plugin index by plugin_dir/plugin_file strings and with the plugin name as value
	 * @return bool
	 */
	public function check_required_plugins( array $plugins ) {

		foreach ( $plugins as $plugin_dir_file => $plugin_name ) {

			if ( ! is_plugin_active( $plugin_dir_file ) ) {
				$this->admin_manager()->admin_error( "The plugin $this->plugin_name requires the plugin $plugin_name to be installed and active." );
				return false;
			}
		}

		return true;
	}

}
