<?php
namespace AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Pages\Models;

use AsasVirtuaisWPCore\V0_3_0\Traits\ViewTrait;
use AsasVirtuaisWPCore\V0_3_0\Middleware\Elements\Metaboxes\Traits\MetaboxTrait;

class AdminPage {

	use ViewTrait;
	use MetaboxTrait;

	public $capability;
	public $page_title;
	public $menu_title;
	public $menu_slug;
	public $function;
	public $position;
	public $icon_url;
	public $parent;

	public function __construct( string $title, array $args = [] ) {

		$defaults = [
			'capability' => 'manage_options',
			'position'   => null,
			'function'   => [ $this, 'render' ],
			'icon_url'   => '',
			'page_title' => $title,
			'menu_title' => $title,
			'menu_slug'  => sanitize_title( $title ),
			'parent'     => null
		];
		$attributes = array_replace( $defaults, $args );

		$this->capability = $attributes['capability'];
		$this->page_title = $attributes['page_title'];
		$this->menu_title = $attributes['menu_title'];
		$this->menu_slug  = $attributes['menu_slug'];
		$this->icon_url   = $attributes['icon_url'];
		$this->function   = $attributes['function'];
		$this->position   = $attributes['position'];
		$this->parent     = $attributes['parent'];
	}

	/** @see MetaboxTrait */
	public function get_screen_id() : string {
		return $this->menu_slug;
	}

	public function views_dir() {
		return plugin_dir_path( __DIR__ ) . 'Views/';	
	}

	public function render() {
		$this->add_meta_box( 'Publish', 'sidebar', [
			'callback' => function() {
				?>
					<input type="submit" name="save" id="publish" class="button button-primary button-large" value="Update"/>
				<?php
			},
		] );
		$this->initialize_meta_boxes();
		$this->render_view( 'admin-page-with-metaboxes', [ 'admin_page' => $this ] );
	}

}
