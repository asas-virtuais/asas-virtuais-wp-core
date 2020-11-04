<?php

class TestLoader extends WP_Mock\Tools\TestCase {

	public function setUp() : void {
		$this->loader = require dirname( __DIR__ ) . '/Loader.php';
		$this->plugin_file = dirname( __DIR__ ) . '/plugin-starter-sample.php';
		WP_Mock::setUp();
  	}

	public function tearDown() : void {
		WP_Mock::tearDown();
	}

	public function test_loader() {
		$this->assertTrue( $this->loader instanceof \AsasVirtuaisWPCoreVersionLoader\LoaderV0_3_0 );

		\WP_Mock::userFunction( 'did_action', [
			'args'   => [ 'plugins_loaded' ],
			'return' => true,
		] );
		\WP_Mock::userFunction( 'did_action', [
			'args'   => [ 'init' ],
			'return' => false,
		] );

		$autoload = require dirname( dirname( __FILE__ ) ) . '/vendor/autoload.php';
		$this->loader->add_psr4_autoload( $autoload );
		$this->assertTrue( isset( $autoload->getPrefixesPsr4()[$this->loader->get_namespace()] ) );
		$this->assertTrue( in_array( $this->loader->get_includes_path(), $autoload->getPrefixesPsr4()[$this->loader->get_namespace()] ) );

	}

}
