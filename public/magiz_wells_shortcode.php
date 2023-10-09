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
			<tr class="responsive-table__row">
				<td class="responsive-table__body__text responsive-table__body__text--no">1</td>
				<td class="responsive-table__body__text responsive-table__body__text--mastno">1</td>
				<td class="responsive-table__body__text responsive-table__body__text--location">Ahvaz</td>
				<td class="responsive-table__body__text responsive-table__body__text--system">APS</td>
				<td class="responsive-table__body__text responsive-table__body__text--status"><span class="status-indicator status-indicator--active"></span>Active</td>
				<td class="responsive-table__body__text responsive-table__body__text--personle">Gandomi</td>
				<td class="responsive-table__body__text responsive-table__body__text--action"><a href="#">link</a></td>
			</tr>
			<tr class="responsive-table__row">
				<td class="responsive-table__body__text responsive-table__body__text--row">1</td>
				<td class="responsive-table__body__text responsive-table__body__text--mastno">1</td>
				<td class="responsive-table__body__text responsive-table__body__text--location">Ahvaz</td>
				<td class="responsive-table__body__text responsive-table__body__text--system">APS</td>
				<td class="responsive-table__body__text responsive-table__body__text--status"><span class="status-indicator status-indicator--active"></span>Active</td>
				<td class="responsive-table__body__text responsive-table__body__text--personle">Gandomi</td>
				<td class="responsive-table__body__text responsive-table__body__text--action"><a href="#">link</a></td>
			</tr>
			<tr class="responsive-table__row">
				<td class="responsive-table__body__text responsive-table__body__text--row">1</td>
				<td class="responsive-table__body__text responsive-table__body__text--mastno">1</td>
				<td class="responsive-table__body__text responsive-table__body__text--location">Ahvaz</td>
				<td class="responsive-table__body__text responsive-table__body__text--system">APS</td>
				<td class="responsive-table__body__text responsive-table__body__text--status"><span class="status-indicator status-indicator--active"></span>Active</td>
				<td class="responsive-table__body__text responsive-table__body__text--personle">Gandomi</td>
				<td class="responsive-table__body__text responsive-table__body__text--action"><a href="#">link</a></td>
			</tr>
			<tr class="responsive-table__row">
				<td class="responsive-table__body__text responsive-table__body__text--row">1</td>
				<td class="responsive-table__body__text responsive-table__body__text--mastno">1</td>
				<td class="responsive-table__body__text responsive-table__body__text--location">Ahvaz</td>
				<td class="responsive-table__body__text responsive-table__body__text--system">APS</td>
				<td class="responsive-table__body__text responsive-table__body__text--status"><span class="status-indicator status-indicator--active"></span>Active</td>
				<td class="responsive-table__body__text responsive-table__body__text--personle">Gandomi</td>
				<td class="responsive-table__body__text responsive-table__body__text--action"><a href="#">link</a></td>
			</tr>
		</tbody>
	</table>
</div>

    <?php
    return ob_get_clean();
}
add_shortcode('magiz_wells', 'magiz_wells_shortcode');