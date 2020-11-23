<?php
namespace AsasVirtuaisWPCore\Elements\Fields\Traits;

trait CustomFieldsTrait {

	public abstract function add_field( string $name, string $type, array $args = [] );

	public function add_text_field( string $name, array $args = [] ) {
		return $this->add_field( $name, 'text', $args );
	}
	public function add_email_field( string $name, array $args = [] ) {
		return $this->add_field( $name, 'email', $args );
	}
	public function add_google_map_field( string $name, array $args = [] ) {
		return $this->add_field( $name, 'google_map', $args );
	}
	public function add_terms_field( string $name, array $args = [] ) {
		return $this->add_field( $name, 'terms', $args );
	}

}
