<?php
use AsasVirtuaisWPCore\Middleware\Elements\Fields\Models\WordpressField;
/** @var WordpressField $field */
$taxonomies = get_taxonomies( [], 'objects' );
$value = $field->get_value();
?>

<div style="width: 100%;" >
	<select style="width: 100%;" class="select2-terms" multiple="multiple" name="<?= $field->name ?>[]">

		<?php foreach( $taxonomies as $key => $taxonomy ): $terms = get_terms( [ 'taxonomy' => $key, 'hide_empty' => false ] ); if ( ! $terms ) continue; ?>
			<optgroup label="<?= $taxonomy->label ?>" >
				<?php foreach( $terms as $term ): ?>
					<option value="<?= $term->term_id ?>" <?= in_array( $term->term_id, $value ) ? 'selected' : null ; ?> ><?= $term->name ?></option>			
				<?php endforeach; ?>
			</optgroup>
		<?php endforeach; ?>

	</select>
</div>