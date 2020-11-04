<?php

class TestLibraries extends WP_Mock\Tools\TestCase {

	public function setUp() : void {
		$this->loader = require dirname( __DIR__ ) . '/Loader.php';
		$this->plugin_file = dirname( __DIR__ ) . '/plugin-starter-sample.php';
		$this->loader->load_libraries();
		WP_Mock::setUp();
  	}

	public function tearDown() : void {
		WP_Mock::tearDown();
	}

	public function test_av_sanitize_title_with_underscores() {
		$this->assertTrue( av_sanitize_title_with_underscores( 'Title Case' ) === 'title_case' );
		$this->assertTrue( av_sanitize_title_with_underscores( 'kebab-case' ) === 'kebab_case' );
		$this->assertTrue( av_sanitize_title_with_underscores( 'Snake_Case' ) === 'snake_case' );
	}

	public function test_av_unslug() {
		$this->assertTrue( av_unslug( 'snake_case' ) === 'Snake Case' );
		$this->assertTrue( av_unslug( 'kebab-case' ) === 'Kebab Case' );
	}

	public function test_av_depascal_case() {
		$this->assertTrue( av_depascal_case( 'PascalCase' ) === 'pascal_case' );
	}

}
