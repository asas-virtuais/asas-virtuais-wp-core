<?php
use AsasVirtuaisWPCore\Elements\Fields\Models\WordpressField;
/** @var WordpressField $field */
$taxonomies = get_taxonomies( [], 'objects' );
$value = $field->get_value();
av_show( $value, false, false );
$value = is_array( $value ) ? $value : [];

function av_terms_checkbox_loop( $terms, string $name, string $taxonomy, array $selected ) {
	?>
		<ul>
			<?php foreach( $terms as $term ): $children = get_terms( [ 'taxonomy' => $term->taxonomy, 'hide_empty' => false, 'parent' => $term->term_id ] ); ?>
				<li>
					<label multiple >
						<input 
							type="checkbox"
							value="<?= $term->term_id ?>"
							<?= in_array( 
								$term->term_id,
								( $selected[$taxonomy] ?? [] )
							) ? 'checked' : null ; ?>
							name="<?= $name ?>[<?= $taxonomy ?>][]"
						/>
						<b><?= $term->name ?></b>
						<?php av_terms_checkbox_loop( $children, $name, $term->taxonomy, $selected ); ?>
					</label>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php
}
?>

<div style="width: 100%;" class="<?= $field->type ?>_wrapper" >

	<ul>
		<li>
			<?php foreach( $taxonomies as $key => $taxonomy ): $terms = get_terms( [ 'taxonomy' => $key, 'hide_empty' => false, 'parent' => 0 ] ); if ( ! $terms ) continue; ?>
				<label multiple>
					<input type="checkbox" <?= ( array_diff( array_column( $terms, 'term_id' ), array_values( $value[$key] ?? [] ) ) ? '' : 'checked' ) ?> />
					<b><?= $taxonomy->label ?></b>
					<?php av_terms_checkbox_loop( $terms, $field->name, $key, $value ); ?>
				</label>
			<?php endforeach; ?>
		</li>
	</ul>

</div>
