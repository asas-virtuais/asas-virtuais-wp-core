<?php

use AsasVirtuaisWPCore\V0_9_1\Modules\Assets\AssetsManager;
use AsasVirtuaisWPCore\V0_9_1\Modules\Admin\AdminManager;
use AsasVirtuaisWPCore\V0_9_1\Modules\Hooks\HookManager;
use AsasVirtuaisWPCore\V0_9_1\Modules\PuC\UpdateManager;
use AsasVirtuaisWPCore\V0_9_1\Modules\Post\PostManager;

class TestMainClass extends WP_Mock\Tools\TestCase {

	public function setUp() : void {
		$this->loader = require dirname( __DIR__ ) . '/Loader.php';
		$this->plugin_file = dirname( __DIR__ ) . '/plugin-starter-sample.php';
		WP_Mock::setUp();
  	}

	public function tearDown() : void {
		WP_Mock::tearDown();
	}

	public function test_static_instance() {

		$framework = $this->loader->load_framework_static_instance();
		\WP_Mock::userFunction( 'current_user_can', [
			'return' => true,
		] );
		\WP_Mock::userFunction( 'is_admin', [
			'return' => true,
		] );

		$this->assertTrue( $framework instanceof AsasVirtuaisWPCore\V0_9_1\Framework );
		$this->assertTrue( $framework->assets_manager() instanceof AssetsManager );
		$this->assertTrue( $framework->update_manager() instanceof UpdateManager );
		$this->assertTrue( $framework->admin_manager() instanceof AdminManager );
		$this->assertTrue( $framework->hook_manager() instanceof HookManager );

	}

}
