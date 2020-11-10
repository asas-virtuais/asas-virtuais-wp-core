<?php
namespace AsasVirtuaisWPCore\V0_9_0\Models;

abstract class Manager {
	/** @var \AsasVirtuaisWPCore\V0_9_0\Framework $framework */
	public $framework;
	public function __construct( $framework ) {
		$this->framework = $framework;
	}
	abstract public function initialize();
}
