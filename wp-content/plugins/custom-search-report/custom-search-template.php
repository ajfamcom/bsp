<?php
/*
Template Name: Custom Search Data Template
*/
global $wpdb;
$your_data_array = $wpdb->get_results("SELECT * FROM wp_searchdata");

//get_header(); // Include the header
?>
<div class="container mt-5">
  <h2>Search Data from wp_searchdata Table</h2>

  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by Keyword">

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Keyword</th>
        <th>Visitor IP</th>
      </tr>
    </thead>
    <tbody id="tableBody">
      <!-- Table rows will be populated here -->
    </tbody>
  </table>

  <nav aria-label="Page navigation">
    <ul class="pagination" id="pagination">
      <!-- Pagination links will be populated here -->
    </ul>
  </nav>
</div>

<?php
//get_footer(); // Include the footer
?>
