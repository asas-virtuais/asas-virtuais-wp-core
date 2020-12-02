<?php

if ( ! function_exists( 'asas_virtuais_wp' ) ) {
	function asas_virtuais_wp( $plugin_slug = 'asas-virtuais-wp' ) {
		return \AsasVirtuaisWPCore\V0_9_2\Framework::instance( $plugin_slug );
	}
}

