<?php

use \AsasVirtuaisWPCore\Middleware\Elements\Fields\Models\Field;
/** @var Field $field */

$value = $field->get_value();
?>

<div>

	<select name="<?= $field->name ?>">
		<option <?php echo $value !== null ? 'selected' : '' ; ?> disabled><?= $field->label ?></option>
		<?php foreach( $field->attributes->options as $key => $name ): ?>
			<option <?php echo intval($value) === intval($key) ? 'selected': '' ; ?> value="<?= $key ?>"><?= $name ?></option>
		<?php endforeach; ?>
	</select>

	<p>
		<?= $field->description ?>
	</p>

</div>