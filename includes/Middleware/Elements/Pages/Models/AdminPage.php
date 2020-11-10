<?php
namespace AsasVirtuaisWPCore\V0_9_0\Middleware\Elements\Pages\Models;

use AsasVirtuaisWPCore\Middleware\Elements\Metaboxes\Strategies\AdminMetaboxTrait;
use AsasVirtuaisWPCore\Traits\ViewTrait;

class AdminPage {

	use ViewTrait;
	use AdminMetaboxTrait;

	public $capability;
	public $page_title;
	public $menu_title;
	public $menu_slug;
	public $function;
	public $position;
	public $icon_url;
	public $parent;

	public function __construct( string $title, array $args = [] ) {

		$this->capability = $args['capability'] ?? 'manage_options';
		$this->page_title = $args['page_title'] ?? $title;
		$this->menu_title = $args['menu_title'] ?? $title;
		$this->menu_slug  = $args['menu_slug']  ?? sanitize_title( $title );
		$this->icon_url   = $args['icon_url']   ?? null;
		$this->function   = $args['function']   ?? [ $this, 'render' ];
		$this->position   = $args['position']   ?? null;
		$this->parent     = $args['parent']     ?? null;
	}

	/** @see MetaboxTrait */
	public function get_screen_id() : string {
		return $this->menu_slug;
	}

	public function views_dir() : string {
		return plugin_dir_path( __DIR__ ) . 'Views/';	
	}

	private $options = [];
	public function save_options() {
		foreach ( $this->options as $option ) {
			$value = $_POST[$option] ?? false;
			if ( $value ) {
				echo "<div>";
				echo "Updated option: $option with value ";
				av_show( $value, false, false );
				echo "</div>";
				update_option( $option, $value );
			} else {
				echo "<div>";
				echo "Cleared option: $option with value ";
				echo "</div>";
				update_option( $option, null );
			}
		}
	}
	public function register_option( string $option ) {
		$this->options[] = $option;
	}
	public function render() {
		if ( isset( $_POST['save'] ) ) {
			$this->save_options();
		}
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
