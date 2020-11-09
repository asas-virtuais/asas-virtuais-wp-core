<?php
namespace AsasVirtuaisWPCore\Traits;

trait ViewTrait {

	abstract public function views_dir() : string;

	public function load_view( $view, $data = [] ) {
		return $this->require_view( $view, $data, false );
	}
	
	public function render_view( $view, $data = [] ) {
		return $this->require_view( $view, $data, true );
	}
	
	public function require_view( $view, $data = [], $echo = false ) {

		try {
			$dir = $this->views_dir();

			if ( $data ) {
				extract( $data, EXTR_SKIP );
			}
		
			if ( $echo === true ) {
	
				return include( $dir . $view . '.php' );
	
			} else {
		
				ob_start();
		
				$return = include( $dir . $view . '.php' );
				if ( $return ) {
					$return = ob_get_contents();
				}
		
				ob_end_clean();
		
				return $return;
			}
		
		} catch (\Throwable $th) {
			$details = "<pre>" . av_get_error_details( $th ) . "</pre>";
			if ( $echo ) {
				echo $details;
			} else {
				return $details;
			}
		}
	}

}
