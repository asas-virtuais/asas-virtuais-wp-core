<?php
namespace AsasVirtuaisWP\V0_1_0;

abstract class Manager {
	/** @var Framework $framework */
	private $framework;
	public function __construct( $framework ) {
		$this->framework = $framework;
	}
	/** @return Framework */
	public function get_framework() {
		return $this->framework;
	}
	abstract public function initialize();
}
