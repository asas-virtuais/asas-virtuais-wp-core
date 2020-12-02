<?php

namespace AsasVirtuaisWPCore\V0_9_2\Modules\Assets;

use AsasVirtuaisWPCore\Traits\AssetsTrait;

class AssetsManager extends \AsasVirtuaisWPCore\V0_9_2\Models\Manager {
	use AssetsTrait;

	public $prefix;
	public $assets_version;

	public $js_dir;
	public $css_dir;
	public $assets_dir;

	public function initialize( $args = [] ) {
		$this->assets_version = $args['version']    ?? '';
		$this->assets_dir     = $args['assets_dir'] ?? '';
		$this->css_dir        = $args['css_dir']    ?? '';
		$this->js_dir         = $args['js_dir']     ?? '';
		$this->prefix         = $args['prefix']     ?? '';
		$this->set_script_hooks();
	}

	public function scripts_dir(): string {
		return $this->js_dir;
	}
	public function styles_dir(): string {
		return $this->css_dir;
	}
	public function assets_dir(): string {
		return $this->assets_dir;
	}
	public function assets_prefix () : string {
		return $this->prefix;
	}

}
