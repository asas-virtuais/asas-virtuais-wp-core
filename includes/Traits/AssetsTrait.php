<?php
namespace AsasVirtuaisWPCore\Traits;

trait AssetsTrait {

	public $styles           = [];
	public $scripts          = [];
	public $localize         = [];
	public $admin_styles     = [];
	public $admin_scripts    = [];
	public $register_styles  = [];
	public $register_scripts = [];

	public function set_script_hooks() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ] );
	}

	// Hooked Methods
		public function enqueue_assets() {
			foreach ( $this->scripts as $script ) {
				$this->enqueue_script( $script );
			}
			foreach ( $this->styles as $style ) {
				$this->enqueue_style( $style );
			}
		}
		public function enqueue_admin_assets() {
			foreach ( $this->admin_scripts as $script ) {
				$this->enqueue_script( $script );
			}
			foreach ( $this->admin_styles as $style ) {
				$this->enqueue_style( $style );
			}
		}

	// Enqueue Methods
		private function enqueue_style( $style ) {
			return wp_enqueue_style( $style->name, $style->src, $style->deps, ( $this->assets_version ?? false ), $style->media );
		}
		private function enqueue_script( $script ) {
			wp_enqueue_script( $script->name, $script->src, $script->deps, ( $this->assets_version ?? false ), $script->footer );
			$localize_arr = $this->localize[ $script->name ] ?? false;
			if ( $localize_arr ) {
				foreach ( $localize_arr as $localize ) {
					wp_localize_script( $script->name, $localize->name, $localize->data );
				}
			}
		}

	// Public methods for local scripts and styles
		public function add_script( $name, $src = false, $footer = true, $deps = [] ) {

			$src = $src ? $src : static::asset_file_url( $name, $this->scripts_dir(), 'js' );
			$this->scripts[] = $this->compact_script( $name, $src, $footer, $deps );
			return $this;
		}
		public function add_admin_script( $name, $src = false, $footer = true, $deps = [] ) {

			$src = $src ? $src : static::asset_file_url( $name, $this->scripts_dir(), 'js' );

			$this->admin_scripts[] = $this->compact_script( $name, $src, $footer, $deps );
			return $this;
		}
		public function add_style( $name, $src = false, $deps = [], $media = 'all' ) {

			$src = $src ? $src : static::asset_file_url( $name, $this->styles_dir(), 'css' );

			$this->styles[] = $this->compact_style( $name, $src, $deps, $media );
			return $this;
		}
		public function add_admin_style( $name, $src = false, $deps = [], $media = 'all' ) {

			$src = $src ? $src : static::asset_file_url( $name, $this->styles_dir(), 'css' );

			$this->admin_styles[] = $this->compact_style( $name, $src, $deps, $media );
			return $this;
		}

	// Compact methods
		public function compact_script( $name, $src, $footer = true, $deps = [] ) {
			$name = $this->assets_prefix() . $name;
			return (object) compact( 'name', 'src', 'footer', 'deps' );
		}
		public function compact_style( $name, $src, $deps = [], $media = 'all' ) {
			$name = $this->assets_prefix() . $name;
			return (object) compact( 'name', 'src', 'deps', 'media' );
		}

	// Register Methods
		public function register_style( $name, $src = false, $deps = [], $media = 'all' ) {
			$src  = $src ? $src : static::asset_file_url( $name, $this->styles_dir(), 'css' );
			$style = $this->compact_style( $name, $src, $deps, $media );
			if ( wp_register_style( $style->name, $style->src, $style->deps, ( $this->assets_version ?? false ), $style->media ) ) {
				return $style;
			}
			return false;
		}
		public function register_script( $name, $src = false, $footer = true, $deps = [] ) {
			$src  = $src ? $src : static::asset_file_url( $name, $this->scripts_dir(), 'js' );
			$script = $this->compact_script( $name, $src, $footer, $deps );
			if ( wp_register_script( $script->name, $script->src, $script->deps, ( $this->assets_version ?? false ), $script->footer ) ) {
				return $script;
			}
			return false;
		}

	// Script Localization
		public function localize_script( $handle, $name, $data ) {
			$this->localize[ $handle ][] = (object) compact( 'name', 'data' );
		}
	// Helper Method
		public static function asset_file_url( $name, $dir_path, $extension ) {

			$min = "$name.min.$extension";
			$src = "$name.$extension";

			$dir_url = plugin_dir_url( $dir_path . $src );

			if ( file_exists( $dir_path . $min ) ) {
				return $dir_url . $min;
			} else {
				return $dir_url . $src;
			}
		}
	// Directory Methods
		abstract public function assets_prefix() : string;
		abstract public function scripts_dir() : string;
		abstract public function styles_dir()  : string;
		abstract public function assets_dir()  : string;
}
