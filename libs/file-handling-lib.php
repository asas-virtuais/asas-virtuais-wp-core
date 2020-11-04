<?php

if ( ! function_exists( 'include_once_or_throw' ) ) {
	function include_once_or_throw( $file ) {
		if ( ! include_once( $file ) ) {
			throw new \Exception( "Could not find file $file" );
		}
	}
}
