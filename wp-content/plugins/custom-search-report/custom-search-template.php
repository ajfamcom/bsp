<?php
/*
Template Name: Custom Search Data Template
*/
global $wpdb;

// Pagination variables
$current_page = max(1, get_query_var('paged'));
$items_per_page = 30; // Number of items per page
$offset = ($current_page - 1) * $items_per_page;

// Search keyword
$search_keyword = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

// Query to fetch data with pagination
$query = "SELECT * FROM wp_searchdata";

// If search keyword is provided, add WHERE clause
if (!empty($search_keyword)) {
    $query .= " WHERE keyword LIKE '%$search_keyword%'";
}

$query .= " ORDER BY created_at DESC LIMIT $items_per_page OFFSET $offset";
$fetchdata = $wpdb->get_results($query);

// Count total number of rows without pagination
$total_items = $wpdb->get_var("SELECT COUNT(*) FROM wp_searchdata");

// Calculate total number of pages for pagination
$total_pages = ceil($total_items / $items_per_page);
?>
<style>
    table, th, td {
  border: 1px solid black;
}
</style>
<div class="container mt-5">
  <h2>Search Data</h2>

  <form method="get" action="">
    <input type="text" name="s" id="searchInput" class="form-control mb-3" placeholder="Search by Keyword" value="<?php echo esc_attr($search_keyword); ?>">
    <button type="submit" class="btn btn-primary">Search</button>
  </form>

  <table class="table">
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
            echo '<td>' . $item->search_page . '</td></tr>';
        }
    } else {
        echo '<tr><td colspan="4">No data found.</td></tr>';
    }
    ?>
    </tbody>
  </table>

    <?php
 /*  if ($total_pages > 1) {
      echo '<div class="pagination">';
      echo paginate_links(array(
          'base' => admin_url('admin.php?page=search-report-display') . '%_%',
          'format' => '&paged=%#%',
          'current' => $current_page,
          'total' => $total_pages,
      ));
      echo '</div>';
  } */
  
if ($total_pages > 1) {
    echo '<div class="pagination">';
    
    echo '<span class="pagination-links">';
    for ($i = 1; $i <= $total_pages; $i++) {
        $page_url = add_query_arg(array('paged' => $i));
        
        if ($search_keyword) {
            $page_url = add_query_arg(array('s' => urlencode($search_keyword)), $page_url);
        }

        if ($current_page === $i) {
            echo '<span class="current">' . $i . '</span>';
        } else {
            echo '<a href="' . esc_url($page_url) . '">' . $i . '</a>';
        }
    }
    echo '</span>';

    echo '</div>';
}


  ?>
  
  
</div>



