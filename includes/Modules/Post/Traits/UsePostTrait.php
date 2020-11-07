<?php

namespace AsasVirtuaisWPCore\Modules\Post\Traits;

trait UsePostTrait {

	public $post_class;

	public function set_post_class( string $class ) {
		$this->post_class = $class;
	}

}
