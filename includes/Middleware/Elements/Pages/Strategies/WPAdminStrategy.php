<?php
namespace AsasVirtuaisWPCore\V0_9_0\Middleware\Elements\Pages\Strategies;

use AsasVirtuaisWPCore\V0_9_0\Middleware\Elements\Pages\Models\AdminPage;
use AsasVirtuaisWPCore\V0_9_0\Middleware\Elements\Pages\Traits\PagesTrait;

trait WPAdminStrategy {

	public $prefix = '';

	use PagesTrait;
	// Admin Pages
	public function add_admin_page( string $title, array $args = [] ) : AdminPage {
		return $this->add_page( new AdminPage( $title, $args ) );
	}
	public function add_settings_page( string $title, array $args = [] ) : AdminPage {
		$args['parent'] = 'options-general.php';
		return $this->add_admin_page( $title, $args );
	}
	public function load_admin_pages() {
		foreach ( $this->pages as $page ) {
			$this->load_page( $page );
		}
	}
	public function load_page( AdminPage $page ) {
		if ( $page->parent ) {
			add_submenu_page(
				$page->parent,
				$page->page_title,
				$page->menu_title,
				$page->capability,
				$page->menu_slug,
				$page->function,
				$page->position
			);
		} else {
			add_menu_page(
				$page->page_title,
				$page->menu_title,
				$page->capability,
				$page->menu_slug,
				$page->function,
				$page->icon_url,
				$page->position
			);
		}
	}

}
