<?php
namespace AsasVirtuaisWPCore\V0_9_0\Middleware\Elements\Pages\Traits;

use AsasVirtuaisWPCore\V0_9_0\Middleware\Elements\Pages\Models\AdminPage;

trait PagesTrait {

	public $pages = [];
	public function add_page( AdminPage $page ) : AdminPage {
		$this->pages[] = $page;
		return $page;
	}

}
