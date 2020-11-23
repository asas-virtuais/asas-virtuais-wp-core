<?php

use \AsasVirtuaisWPCore\Middleware\Elements\Fields\Models\Field;
/** @var Field $field */

?>

<div>

	<label>
		<span><?= $field->label ?></span>
		<input type="text" name="<?= $field->name ?>" value="<?= $field->get_value() ?>" >
	</label>

	<p>
		<?= $field->description ?>
	</p>

</div>