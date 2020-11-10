<?php
use AsasVirtuaisWPCore\V0_9_0\Middleware\Elements\Metaboxes\Models\Metabox;
/** @var Metabox $metabox */
?>

<div>
	<?php call_user_func( $metabox->callback ); ?>
</div>

<div>
	<?php foreach( $metabox->forms as $form ): ?>
		<div>
			<?php $form->render(); ?>
		</div>
	<?php endforeach; ?>
</div>

<div>
	<?php foreach( $metabox->fields as $field ): ?>
		<div>
			<?php $field->render(); ?>
		</div>
	<?php endforeach; ?>
</div>
