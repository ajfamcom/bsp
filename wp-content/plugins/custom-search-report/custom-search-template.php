<?php
/*
Template Name: Custom Search Data Template
*/
global $wpdb;
$fetchdata = $wpdb->get_results("SELECT * FROM wp_searchdata limit 0,5");
?>
<style>
    table, th, td {
  border: 1px solid black;
}
</style>    
<div class="container mt-5">
  <h2>Search Data</h2>

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
    
     if (!empty($fetchdata)) {
        foreach ($fetchdata as $item) {            
      echo '<tr><td>' .$item->keyword . '</td>';
			echo '<td>' .$item->visitor_ip . '</td>';
			echo '<td>' .$item->created_at . '</td>';
			echo '<td>' .$item->search_page . '</td></tr>';
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


