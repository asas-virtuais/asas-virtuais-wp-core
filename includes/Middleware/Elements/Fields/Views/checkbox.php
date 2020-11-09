<?php

use \AsasVirtuaisWPCore\Middleware\Elements\Fields\Models\Field;
/** @var Field $field */

?>

<div>

	<label>
		<input type="checkbox" name="<?= $field->name ?>" value="1" <?php echo $field->get_value() ? 'checked' : '' ?> >
		<span><?= $field->label ?></span>
	</label>
	<p>
		<?= $field->description ?>
	</p>

</div>