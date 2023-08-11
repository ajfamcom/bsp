<?php
/*
Template Name: Custom Search Data Template
*/
global $wpdb;
$data = $wpdb->get_results("SELECT * FROM wp_searchdata");
?>
<style>
    table, th, td {
  border: 1px solid black;
}
</style>    
<div class="container mt-5">
  <h2>Search Data from wp_searchdata Table</h2>

  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by Keyword">

  <table class="table" style="">
    <thead>
      <tr>
       
        <th>Keyword</th>
        <th>Visitor IP</th>
        <th>Search DateTime</th>
        <th>Search Page</th>
      </tr>
    </thead>
    <tbody id="">
    <?php
    print_r($data);
     if (!empty($data)) {
        foreach ($data as $item) {            
            echo '<tr><td>Keyword:</td><td>' . $item->keyword . '</td></tr>';
			echo '<tr><td>Visitor IP:</td><td>' . $item->visitor_ip . '</td></tr>';
			echo '<tr><td>Search DateTime:</td><td>' . $item->created_at . '</td></tr>';
			echo '<tr><td>Search From:</td><td>' . $item->search_page . '</td></tr>';
        }
    } else {
        echo '<tr><td>No data found.</td></tr>';
    } 
   ?>
    </tbody>
  </table>

  <nav aria-label="Page navigation">
    <ul class="pagination" id="pagination">
      <!-- Pagination links will be populated here -->
    </ul>
  </nav>
</div>


