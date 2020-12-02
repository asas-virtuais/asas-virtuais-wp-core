<?php

use \AsasVirtuaisWPCore\Elements\Fields\Models\Field;
/** @var Field $field */

?>

<div>

	<label>
		<span><?= $field->label ?></span>
		<br>
		<textarea style="width: 100%;" placeholder="<?= $field->attributes->placeholder ?? '' ?>" name="<?= $field->name ?>" rows="10"><?= $field->get_value() ?></textarea>
	</label>

	<p>
		<?= $field->description ?>
	</p>

</div>