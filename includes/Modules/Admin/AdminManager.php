<?php
namespace AsasVirtuaisWPCore\V0_9_1\Modules\Admin;

use AsasVirtuaisWPCore\V0_9_1\Middleware\Elements\Pages\Models\AdminPage;
use AsasVirtuaisWPCore\V0_9_1\Middleware\Elements\Pages\Strategies\WPAdminStrategy;
use AsasVirtuaisWPCore\V0_9_1\Models\Manager;

class AdminManager extends Manager {

	use WPAdminStrategy;

	public $notices = [];
	public $prefix = '';

	public function initialize( $args = [] ) {

		$this->prefix = $args['prefix'] ?? '';

		$this->framework->hook_manager()->add_action( 'admin_notices', [ $this, 'display_admin_notices' ] );
		$this->framework->hook_manager()->add_action( 'admin_menu', [ $this, 'load_admin_pages' ] );

		if ( current_user_can( 'administrator' ) && ! is_admin() ) {
			$this->framework->hook_manager()->add_action( 'wp_head', [ $this, 'display_admin_notices' ] );
		}

		return $this;
	}

	public $plugin_settings_page;
	public function plugin_settings_page() : AdminPage {
		if ( ! isset ( $this->plugin_settings_page ) ) {
			$this->plugin_settings_page = $this->add_settings_page( $this->framework->plugin_name.' Settings' );
		}
		return $this->plugin_settings_page;
	}

	// Admin Notices
		public function display_admin_notices() {
			$admin = is_admin();
			if ( ! $admin ) {
				echo "<pre>";
			}
			foreach ( $this->notices as $notice ) {
				echo "<div class='notice $notice->class'><p>$notice->message</p></div>";
			}
			if ( ! $admin ) {
				echo "</pre>";
			}
		}
		public function admin_notice( $message, $type = 'info', $dismissible = false ) {
			$class = $dismissible ? 'is-dismissible ' : '';
			$class .= "notice-$type";
			$this->notices[] = (object) compact( 'message', 'class' );
		}
		public function admin_error( $message, $dismissible = false ) {
			$this->admin_notice( $message, 'error', $dismissible );
		}
		public function admin_warning( $message, $dismissible = false ) {
			$this->admin_notice( $message, 'warning', $dismissible );
		}
		public function admin_success( $message, $dismissible = false ) {
			$this->admin_notice( $message, 'success', $dismissible );
		}
		public function admin_error_from_exception( \Throwable $th ) {
			$this->admin_error( '<pre>' . av_get_error_details( $th ) . '</pre>' );
		}

}
