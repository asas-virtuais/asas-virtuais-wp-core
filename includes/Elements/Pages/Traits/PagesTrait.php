<?php
namespace AsasVirtuaisWPCore\V0_9_2\Elements\Pages\Traits;

use AsasVirtuaisWPCore\V0_9_2\Elements\Pages\Models\AdminPage;

trait PagesTrait {

	public $pages = [];
	public function add_page( AdminPage $page ) : AdminPage {
		$this->pages[] = $page;
		return $page;
	}

}
