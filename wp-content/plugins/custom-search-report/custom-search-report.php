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
function generate_csv_data($data) {
    $csv = '';
    foreach ($data as $item) {
        $csv .= '"' . $item->keyword . '","' . $item->visitor_ip . '","' . $item->created_at . '","' . ucwords(str_replace('_', ' ', $item->search_page)) . '"' . PHP_EOL;
    }
    return $csv;
}

/* function search_report_download_csv() {
    global $wpdb;

    $query = "SELECT * FROM wp_searchdata";

    if (!empty($_GET['s'])) {
        $search_keyword = sanitize_text_field($_GET['s']);
        $query .= " WHERE keyword LIKE '%$search_keyword%'";
    }

    $data = $wpdb->get_results($query);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="search_data.csv"');

    echo generate_csv_data($data);

    exit;
} */

function custom_csv_download_ajax() {
    if (isset($_POST['action']) && $_POST['action'] === 'custom_csv_download') {
        global $wpdb;
        $search=$_POST['search_text'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
        $search_page=$_POST['search_page'];

        $query="SELECT keyword, visitor_ip, created_at, search_page FROM wp_searchdata WHERE 1=1";
        if (!empty($search)) {
            $search_keyword = sanitize_text_field($search);
            $query .= " AND keyword LIKE '%$search%'";
        }
        if (!empty($start_date) && !empty($end_date)) {
            //$query .= " AND created_at BETWEEN '$start_date' AND '$end_date' ";
            $end_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
            $query .= " AND created_at >= '$start_date' ";
            $query .= " AND created_at <= '$end_date' ";
        } elseif (!empty($start_date)) {
            $start_date = date('Y-m-d', strtotime($start_date));
            $query .= " AND created_at >= '$start_date' ";
        } elseif (!empty($end_date)) {
            $end_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
            $query .= " AND created_at <= '$end_date' ";
        }
        if (!empty($search_page)) {
            $query .= " AND search_page LIKE '%$search_page%'";
        }
        $query .= " ORDER BY created_at DESC";
        $data = $wpdb->get_results($query);
        
        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="data.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('Keyword', 'Visitor IP', 'Created At', 'Search Page')); // Replace with your column headers

        foreach ($data as $row) {
            fputcsv($output, (array)$row); // Assuming $row is an object
        }

        fclose($output);

        exit;
    }
}

add_action('wp_ajax_custom_csv_download', 'custom_csv_download_ajax');
add_action('wp_ajax_nopriv_custom_csv_download', 'custom_csv_download_ajax');




