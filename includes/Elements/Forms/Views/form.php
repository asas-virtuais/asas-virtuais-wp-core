<?php
use AsasVirtuaisWPCore\V0_9_2\Elements\Forms\Models\Form;
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
