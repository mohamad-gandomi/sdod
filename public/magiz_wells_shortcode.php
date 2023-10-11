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

                $locations = get_the_terms($well->ID, 'well-location');
                $systems = get_the_terms($well->ID, 'well-system');
                $masts = get_the_terms($well->ID, 'well-mast');
                $statuses = get_the_terms($well->ID, 'well-status');


                ?>
                <tr class="responsive-table__row">
                    <td class="responsive-table__body__text responsive-table__body__text--no"><?php echo $well->ID; ?></td>
                    <td class="responsive-table__body__text responsive-table__body__text--mastno">
                        <?php
                        if ($masts) {
                            foreach ($masts as $mast) {
                                echo $mast->name . ' ';
                            }
                        }
                        ?>
                    </td>
                    <td class="responsive-table__body__text responsive-table__body__text--location">
                        <?php
                        if ($locations) {
                            foreach ($locations as $location) {
                                echo $location->name . ' ';
                            }
                        }
                        ?>
                    </td>
                    <td class="responsive-table__body__text responsive-table__body__text--system">
                        <?php 
                        if ($systems) {
                            foreach ($systems as $system) {
                                echo $system->name . ' ';
                            }
                        }
                        ?>
                    </td>
                    <td class="responsive-table__body__text responsive-table__body__text--status">
                        <?php 
                        if ($statuses) {
                            foreach ($statuses as $status) {
                                echo $status->name . ' ';
                            }
                        }
                        ?>
                    </td>
                    <td class="responsive-table__body__text responsive-table__body__text--personle">
                        <?php
                            $args = array(
                                'meta_query' => array(
                                    array(
                                        'key'     => 'user_current_location',
                                        'value'   => $well->ID,
                                        'compare' => '=',
                                    ),
                                ),
                            );
                            $users = get_users( $args );
                            foreach ( $users as $user ) {
                                // Do something with each user
                                echo $user->display_name . ' ';
                            } 
                        ?>
                    </td>
                    <td class="responsive-table__body__text responsive-table__body__text--action"><a href="#"><?php _e('Last Status', 'magiz-dash-post') ?></a></td>
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