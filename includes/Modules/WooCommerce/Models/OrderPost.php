<?php

namespace AsasVirtuaisWPCore\Modules\WooCommerce\Models;

use AsasVirtuaisWPCore\Modules\Post\Models\AbstractPost;

class OrderPost extends AbstractPost {

	public static function post_type() : string {
		return 'shop_order';
	}

}
