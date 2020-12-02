<?php
namespace AsasVirtuaisWPCore\V0_9_2\Modules\PuC;

use \AsasVirtuaisWPCore\V0_9_2\Models\Manager;

class UpdateManager extends Manager {

	private $release_url;
	private $pre_release;

	public function initialize( $args = [] ) {

		$this->release_url = $args['release_url'] ?? false;
		$this->pre_release = $args['pre_release'] ?? false;

		add_action( 'plugins_loaded', function() {
			$this->maybe_add_pre_release_settings_page();
			$this->load_update_checker();
		}, 20, 1 );
	}

	public function maybe_add_pre_release_settings_page() {
		// Create the Release Settings page
		if ( ! $this->pre_release ) {
			return;
		}
	}

	public function use_pre_release() {
		return $this->pre_release && $this->get_pre_release_option();
	}
	public function get_pre_release_option() {
		return get_option( $this->framework->plugin_slug.'_pre_release' ) !== false;
	}
	/** Returns either pre_release or the release_url */
	public function get_metadata_url() {
		return $this->use_pre_release() ? $this->pre_release : $this->release_url;
	}
	/** Calls build_update_checker in a try/catch */
	public function load_update_checker() {
		try {
			$this->build_update_checker();
		} catch (\Throwable $th) {
			$this->framework->admin_manager()->admin_error_from_exception( $th );
		}
	}
	/** Builds \Puc_v4_Factory */
	private function build_update_checker() {
		\Puc_v4_Factory::buildUpdateChecker(
			$this->get_metadata_url(),
			$this->framework->plugin_file,
			$this->framework->plugin_slug,
		);
	}

}
