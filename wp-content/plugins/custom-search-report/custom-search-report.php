<?php
/**
 * Plugin Name: Custom Search report
 * Description: Plugin for search report.
 * Version: 1.0.0
 * Author: Famcom
 * Author URI: https://famcom.com
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}

define('CUSTOMCONTENT_PLUGINPATH',plugin_dir_path( __FILE__ ));
define('CUSTOMCONTENT_PLUGINURI',plugin_dir_url( __FILE__ ));



// Add a menu item to the admin menu
function custom_data_display_menu() {
    add_menu_page(
        'Search Report Display',
        'Search report Data',
        'manage_options',
        'search-report-display',
        'search_report_data_display_page'
    );
}
add_action('admin_menu', 'custom_data_display_menu');

function custom_data_display_page() {
    global $wpdb;
    $data = $wpdb->get_results("SELECT * FROM wp_searchdata");
   
    echo '<div class="wrap">';
    echo '<h2>Custom Data Display</h2>';   
    
    if (!empty($data)) {
        foreach ($data as $item) {            
            echo '<p>Keyword:' . $item->keyword . '</p>';
			echo '<p>Visitor IP:' . $item->visitor_ip . '</p>';
			echo '<p>Search DateTime:' . $item->created_at . '</p>';
        }
    } else {
        echo '<p>No data found.</p>';
    }

    echo '</div>';
}

