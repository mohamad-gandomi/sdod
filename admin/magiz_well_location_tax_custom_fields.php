<?php

// Security check to prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

//======================================================================
// CATEGORY LARGE FONT
//======================================================================

add_action( 'well-location_add_form_fields', 'magiz_add_term_fields' );

function magiz_add_term_fields( $taxonomy ) {
	?>
		<div class="form-field">
			<label for="distance_to_tehran"><?php _e('Distance To Tehran (Km)', 'magiz-dash-post') ?></label>
			<input type="number" name="distance_to_tehran" id="distance_to_tehran" min="0"/>
			<p><?php _e('Distance To Tehran', 'magiz-dash-post') ?></p>
		</div>
	<?php
}

//======================================================================
// CATEGORY LARGE FONT
//======================================================================

add_action( 'well-location_edit_form_fields', 'magiz_edit_term_fields', 10, 2 );

function magiz_edit_term_fields( $term, $taxonomy ) {

	// get meta data value
	$distance_to_tehran = get_term_meta( $term->term_id, 'distance_to_tehran', true );

	?>
    <tr class="form-field">
		<th><label for="distance_to_tehran"><?php _e('Distance To Tehran (Km)', 'magiz-dash-post') ?></label></th>
		<td>
			<input name="distance_to_tehran" id="distance_to_tehran" type="number" value="<?php echo esc_attr( $distance_to_tehran ) ?>" min="0"/>
			<p class="description"><?php _e('Distance To Tehran (Km)', 'magiz-dash-post') ?></p>
		</td>
	</tr>
    <?php
}

//======================================================================
// CATEGORY LARGE FONT
//======================================================================

add_action( 'created_well-location', 'magiz_save_term_fields' );
add_action( 'edited_well-location', 'magiz_save_term_fields' );

function magiz_save_term_fields( $term_id ) {
	
	update_term_meta(
		$term_id,
		'distance_to_tehran',
		sanitize_text_field( $_POST[ 'distance_to_tehran' ] )
	);
	
}
