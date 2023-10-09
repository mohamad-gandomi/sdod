<?php

// Security check to prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function magiz_wells_shortcode($atts) {
    ob_start();
    ?>
<!-- Page wrapper/Container Section -->
<div class="container">
	<!-- Responsive Table Section -->
	<table class="responsive-table">
		<!-- Responsive Table Header Section -->
		<thead class="responsive-table__head">
			<tr class="responsive-table__row">
				<th class="responsive-table__head__title responsive-table__head__title--no"><?php _e('No', 'magiz-dash-post'); ?></th>
				<th class="responsive-table__head__title responsive-table__head__title--mastno"><?php _e('Mast No', 'magiz-dash-post'); ?></th>
				<th class="responsive-table__head__title responsive-table__head__title--location"><?php _e('Location', 'magiz-dash-post'); ?></th>
				<th class="responsive-table__head__title responsive-table__head__title--system"><?php _e('System', 'magiz-dash-post'); ?></th>
				<th class="responsive-table__head__title responsive-table__head__title--status"><?php _e('Status', 'magiz-dash-post'); ?></th>
				<th class="responsive-table__head__title responsive-table__head__title--personel"><?php _e('Personel', 'magiz-dash-post'); ?></th>
				<th class="responsive-table__head__title responsive-table__head__title--action"><?php _e('Action', 'magiz-dash-post'); ?></th>
			</tr>
		</thead>
		<!-- Responsive Table Body Section -->
		<tbody class="responsive-table__body">
			<?php
            // Get all wells
            $wells = get_posts([
                'post_type' => 'well',
            ]);

            // Loop through the wells and display them in the table
            foreach ($wells as $well) {
                ?>
                <tr class="responsive-table__row">
                    <td class="responsive-table__body__text responsive-table__body__text--no"><?php echo $well->ID; ?></td>
                    <td class="responsive-table__body__text responsive-table__body__text--mastno"><?php echo 1;//get_post_meta($well->ID, 'mast_no', true); ?></td>
                    <td class="responsive-table__body__text responsive-table__body__text--location"><?php echo get_post_meta($well->ID, 'field-loc', true); ?></td>
                    <td class="responsive-table__body__text responsive-table__body__text--system"><?php echo 'APS';//get_post_meta($well->ID, 'system', true); ?></td>
                    <td class="responsive-table__body__text responsive-table__body__text--status"><span class="status-indicator status-indicator--active"></span>Active</td>
                    <td class="responsive-table__body__text responsive-table__body__text--personle"><?php echo 'ali';//get_post_meta($well->ID, 'personel', true); ?></td>
                    <td class="responsive-table__body__text responsive-table__body__text--action"><a href="#">link</a></td>
                </tr>
                <?php
            }
            ?>
		</tbody>
	</table>
</div>

    <?php
    return ob_get_clean();
}
add_shortcode('magiz_wells', 'magiz_wells_shortcode');