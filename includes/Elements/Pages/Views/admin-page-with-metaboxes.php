<?php
use AsasVirtuaisWPCore\V0_9_1\Elements\Pages\Models\AdminPage;
/** @var AdminPage $admin_page */
?>

<div class='wrap' >

	<div id="wphead">
		<h1><?= $admin_page->page_title ?></h1>
	</div>

	<form action="" method="POST" >
		<input type="hidden" name="page" value="<?= $admin_page->get_screen_id() ?>">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<!-- <div id="post-body-content" class="postbox-container" style="position: relative;">
				</div> -->
				<div id="postbox-container-1" class="postbox-container" >
					<div id="side-sortables" class="meta-box-sortables ui-sortable">
						<?= $admin_page->render_meta_boxes( 'sidebar' ) ?>
					</div>
				</div>
				<div id="postbox-container-2" class="postbox-container">
					<div id="normal-sortables" class="meta-box-sortables ui-sortable">
						<?= $admin_page->render_meta_boxes() ?>
					</div>
				</div>
			</div>
		</div>
	</form>

</div>
