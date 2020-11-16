<?php

namespace AsasVirtuaisWPCore\Modules\WooCommerce\Models;

use AsasVirtuaisWPCore\Modules\Post\Models\AbstractPost;

class OrderPost extends AbstractPost {

	public $wc_order;

	public function __construct( $data ) {
		parent::__construct( $data );
		$this->wc_order = new \WC_Order( $data );
	}

	public static function post_type() : string {
		return 'shop_order';
	}

	public function get_customer() {
		$customer_id = $this->wc_order->get_customer_id();
		if ( ! $customer_id ) {
			return false;
		}
		return new \WC_Customer( $customer_id );
	}

	public function get_email() {

		$email = false;

		$customer = $this->get_customer();

		if ( $customer ) {
			$email = $customer->get_email();
		} else {
			$email = $this->wc_order->get_billing_email();
		}

		if ( ! $email ) {
			return false;
		}
		return $email;
	}

}
