<?php

namespace AsasVirtuaisWPCore\Modules\Post\Models;

class Post extends AbstractPost {

	public static function post_type() : string {
		return 'post';
	}

}