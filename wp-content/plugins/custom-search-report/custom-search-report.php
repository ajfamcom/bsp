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

function search_report_data_display_page() {	
	include(plugin_dir_path(__FILE__) . 'custom-search-template.php');
}
/*function search_report_data_display_page() {
     global $wpdb;
    $data = $wpdb->get_results("SELECT * FROM wp_searchdata");
   ?>
    <div class="wrap">
    <h2>Custom Data Display</h2> 
	<table> 
    <?php
     if (!empty($data)) {
        foreach ($data as $item) {            
            echo '<tr><td>Keyword:</td><td>' . $item->keyword . '</td></tr>';
			echo '<tr><td>Visitor IP:</td><td>' . $item->visitor_ip . '</td></tr>';
			echo '<tr><td>Search DateTime:</td><td>' . $item->created_at . '</td></tr>';
			echo '<tr><td>Search From:</td><td>From Top Header Search</td></tr>';
        }
    } else {
        echo '<tr><td>No data found.</td></tr>';
    } 
   ?>
   </table>
</div>
<?php 
}*/
function enqueue_custom_template_scripts() {
    if (is_page_template('custom-search-data-template.php')) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), null, true);
        wp_enqueue_script('custom-template-script', get_template_directory_uri() . '/custom-template-script.js', array('jquery'), null, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_template_scripts');

