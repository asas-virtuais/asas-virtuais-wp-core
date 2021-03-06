<?php

if ( ! function_exists( 'av_get_error_details' ) ) {
	function av_get_error_details( \Throwable $e, $pre_msg = "", $s = "\n" ) {
		try {
			$msg = "$pre_msg$s";
			$class = get_class($e);
			$e_msg = $e->getMessage();
			$msg .= "File: {$e->getFile()}$s";
			$msg .= "Line: {$e->getLine()}$s";
			$msg .= "Type: {$class}$s";
			$msg .= "Msg: $e_msg$s";
			$previous = $e->getPrevious();
			if ( $previous ) {
				$msg .= "$s" . av_get_error_details( $previous, '', $s );
			}
			return $msg;
		} catch (\Throwable $th) {
			throw $e;
		}
	}
}

if ( ! function_exists( 'av_wp_error_message' ) ) {
	function av_wp_error_message( \WP_Error $wp_error ) {
		$errors   = implode( "\n", $wp_error->get_error_codes() );
		$messages = implode( "\n", $wp_error->get_error_messages() );
		return "WP_Error \n code: \n $errors \n messages: \n $messages ";
	}
}
