<?php
namespace AsasVirtuaisWPCore\V0_9_1\Models;

abstract class Manager {
	/** @var \AsasVirtuaisWPCore\V0_9_1\Framework $framework */
	public $framework;
	public function __construct( $framework ) {
		$this->framework = $framework;
	}
	abstract public function initialize();
}
