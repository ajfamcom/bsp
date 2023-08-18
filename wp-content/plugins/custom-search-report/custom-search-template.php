<?php
/*
Template Name: Custom Search Data Template
*/
global $wpdb;

// Pagination variables
$current_page = max(1, $_GET['paged']);
$result_count_filter=isset($_GET['result_count_filter']) ? sanitize_text_field($_GET['result_count_filter']) : '';
$items_per_page = 10; // Number of items per page
$offset = ($current_page - 1) * $items_per_page;

// Search keyword
$search_keyword = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$current_admin_url = admin_url('admin.php');
$current_admin_url = add_query_arg(array('page' => 'search-report-display'), $current_admin_url);

if (!empty($search_keyword)) {
    $current_admin_url = add_query_arg(array('s' => urlencode($search_keyword)), $current_admin_url);
}
// Query to fetch data with pagination
$query = "SELECT * FROM wp_searchdata";

// If search keyword is provided, add WHERE clause
if (!empty($search_keyword)) {
    $query .= " WHERE keyword LIKE '%$search_keyword%'";
}

$query .= " ORDER BY created_at DESC LIMIT $items_per_page OFFSET $offset";
$fetchdata = $wpdb->get_results($query);

// Count total number of rows without pagination

    


if (!empty($search_keyword)) {
  $sql_query="SELECT * FROM wp_searchdata WHERE keyword LIKE '%$search_keyword%' LIMIT $result_count_filter";
  $fetch_dataquery = $wpdb->get_results($sql_query);
  $total_items =count($fetch_dataquery);
}
else{
    $sql_query="SELECT * FROM wp_searchdata LIMIT $result_count_filter";
    $fetch_dataquery = $wpdb->get_results($sql_query);
    $total_items =count($fetch_dataquery);
}
// Calculate total number of pages for pagination
$total_pages = ceil($total_items / $items_per_page);
?>
<style>
    /* table, th, td {
  border: 1px solid black;
} */
.custom-search-table {
    border-collapse: collapse;
    width: 100%;
}

.custom-search-table th,
.custom-search-table td {
    border: 1px solid black;
    padding: 8px;
    text-align: center;
}
.custom-search-form {
    text-align: center;
    margin-bottom: 20px;
}

.custom-search-input {
    width: 300px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.custom-search-button {
    background-color: #0073e6;
    color: #fff;
    border: none;
    padding: 8px 20px;
    border-radius: 4px;
    cursor: pointer;
}
.custom-search-pagination {
    text-align: center;
    margin-top: 20px;
}

.custom-search-pagination a,
.custom-search-pagination span {
    display: inline-block;
    padding: 6px 12px;
    margin: 0 2px;
    background-color: #f7f7f7;
    border: 1px solid #ddd;
    color: #333;
    text-decoration: none;
    border-radius: 3px;
    cursor: pointer;
}

.custom-search-pagination a:hover {
    background-color: #ddd;
}
</style>
<div class="container mt-5">
  <h2>Search Data</h2>

  <form method="get" action="<?php echo esc_url($current_admin_url); ?>">
    <input type="hidden" name="page" value="search-report-display">
    <input type="text" name="s" id="searchInput" class="custom-search-input form-control mb-3" placeholder="Search by Keyword" value="<?php echo esc_attr($search_keyword); ?>">
    <input type="number" name="result_count_filter" id="result_count_filter" class="custom-search-input form-control mb-3" placeholder="Search by Keyword" value="<?php echo ($result_count_filter); ?>" min="10" step=20>
    
    </select>    
    <button type="submit" class="custom-search-button btn btn-primary">Search</button>
    <button type="button" class="custom-search-button btn btn-primary" onclick="location.href='<?php echo admin_url('admin.php').'?page=search-report-display';?>'">Reset</button>
    <button type="button" class="custom-search-button btn btn-primary btndownload">Download CSV</button>
    <button type="button" class="custom-search-button btn btn-primary btndownload">Result Count: <b><?php echo $total_items;?></b></button>
   
</form>

  <table class="custom-search-table">
    <thead>
      <tr>
        <th>Keyword</th>
        <th>Visitor IP</th>
        <th>Search DateTime</th>
        <th>Search Page</th>
      </tr>
    </thead>
    <tbody>
    <?php
    if (!empty($fetchdata)) {
        foreach ($fetchdata as $item) {
            echo '<tr><td>' . $item->keyword . '</td>';
            echo '<td>' . $item->visitor_ip . '</td>';
            echo '<td>' . $item->created_at . '</td>';
            echo '<td>' . ucwords(str_replace('_',' ',$item->search_page)) . '</td></tr>';
        }
    } else {
        echo '<tr><td colspan="4">No data found.</td></tr>';
    }
    ?>
    </tbody>
  </table>

    <?php
  if ($total_pages > 1) {
      echo '<div class="custom-search-pagination">';
      echo paginate_links(array(
          'base' => admin_url('admin.php?page=search-report-display') . '%_%',
          'format' => '&paged=%#%',
          'current' => $current_page,
          'total' => $total_pages,
      ));
      echo '</div>';
  } 
  



  ?>
  
  
</div>
<script>
    jQuery(document).ready(function($) {
        $('.btndownload').on('click', function() {
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'custom_csv_download','search_text':'<?php echo $search_keyword ; ?>'
                },
                success: function(response) {
                    // Create a hidden anchor element to trigger the download
                    var link = document.createElement('a');
                    link.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(response);
                    link.target = '_blank';
                    link.download = 'data.csv';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            });
        });
    });
    </script>




