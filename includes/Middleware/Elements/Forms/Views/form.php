<?php
use AsasVirtuaisWPCore\V0_9_1\Middleware\Elements\Forms\Models\Form;
/** @var Form $form */
?>

<form action="<?= $form->action ?>" method="<?= $form->method ?>" >
	<?php

	

	?>
	<?php foreach( $form->fields as $field ): ?>
		<?php $field->render() ?>
	<?php endforeach; ?>
	<div>
		<button type="submit" >Submit</button>
	</div>
</form>
