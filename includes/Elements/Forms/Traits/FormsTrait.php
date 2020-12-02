<?php
namespace AsasVirtuaisWPCore\Elements\Forms\Traits;
use AsasVirtuaisWPCore\V0_9_2\Elements\Forms\Models\Form;

trait FormsTrait {

	public $forms = [];
	public function add_form( string $title, string $method ) : Form {
		$form = new Form( $title, $method );
		$this->forms[] = $form;
		return $form;
	}

}
