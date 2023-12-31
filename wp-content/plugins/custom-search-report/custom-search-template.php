<?php
/*
Template Name: Custom Search Data Template
*/
global $wpdb;

$current_admin_url = admin_url('admin.php');
$current_admin_url = add_query_arg(array('page' => 'search-report-display'), $current_admin_url);
// Add this code to your existing PHP code, after the form submission check.
$start_date = isset($_GET['start_date']) ? sanitize_text_field($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? sanitize_text_field($_GET['end_date']) : '';
$search_page = isset($_GET['search_page']) ? sanitize_text_field(trim($_GET['search_page'])) : '';
$query = "SELECT 
keyword,
visitor_ip,
created_at,
search_page
FROM wp_searchdata WHERE 1=1";



if (!empty($start_date) && !empty($end_date)) {
    //$query .= " AND created_at BETWEEN '$start_date' AND '$end_date' ";
    $start_date = date('Y-m-d', strtotime($start_date));
   
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
$fetchdata = $wpdb->get_results($query);

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
.date-range-match {
    background-color: yellow; /* Adjust the styling as needed */
}

</style>
<div class="container mt-5">
  <h2>Search Data</h2>

  <form method="get" action="<?php echo esc_url($current_admin_url); ?>">
    <input type="hidden" name="page" value="search-report-display">
   <!--  <input type="text" name="s" id="searchInput" class="custom-search-input form-control mb-3" placeholder="Search by Keyword" value="<?php //echo esc_attr($search_keyword); ?>">
    <input type="number" name="result_count_filter" id="result_count_filter" class="custom-search-input form-control mb-3" placeholder="Search by Count" value="<?php //echo ($result_count_filter); ?>" min="10" step=20 > -->  
    <!-- <button type="submit" class="custom-search-button btn btn-primary">Search</button> -->
    <button type="button" class="custom-search-button btn btn-primary" onclick="location.href='<?php echo admin_url('admin.php').'?page=search-report-display';?>'">Reset</button>
    <button type="button" class="custom-search-button btn btn-primary btndownload">Download CSV</button>
    <button type="button" class="custom-search-button btn btn-primary">Total Result Count: <b><?php echo count($fetchdata);?></b></button>
    <div class="form-group">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="end_date">Search Page:</label>
        <select name="search_page" id="search_page" class="form-control">
            <option value="">Select</option>
            <option value="polls_page" <?php echo ($_GET['search_page']=='polls_page') ? 'selected' : ''; ?>>Polls Page</option>
            <option value="top_header" <?php echo ($_GET['search_page']=='top_header') ? 'selected' : ''; ?>>Top Header</option>
        </select>
    </div>
    <div class="form-group">
        <button type="submit" name="Search"  class="custom-search-button btn btn-primary">Search</button>
    </div>
</form>

  <table class="table table-striped table-bordered custom-search-table" id="sortTable">
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

    
  
  
</div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<script>
    
    jQuery(document).ready(function($) {
        $('.btndownload').on('click', function() {
            var searchinput = $("input[type='search']").val();
            var start_date = $("#start_date").val();
            var end_date = $("end_date").val();
            var search_page = $("#search_page").val();
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'custom_csv_download','search_text':searchinput,'start_date':start_date,'end_date':end_date,'search_page':search_page
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
    <script>  

       jQuery(document).ready(function($) {
          $('#sortTable').DataTable();
          
        });


       
       /*   $(document).ready(function() {
            var table = $('#sortTable').DataTable({
        "columnDefs": [
            { "type": "date", "targets": 2 } // Assuming the datetime column is at index 2
        ]
    }); 
  

    $('#start_date, #end_date').on('change', function () {
        var start_date = new Date($('#start_date').val());
        

        var end_date = new Date($('#end_date').val());
     
var formattedStartDate = start_date.getFullYear() + '-' + String(start_date.getMonth() + 1).padStart(2, '0') + '-' + String(start_date.getDate()).padStart(2, '0');

var searchValue =  formattedStartDate;
console.log("Start Date: " + typeof formattedStartDate);
console.log("Search Value: " +typeof searchValue);

table.columns(2).search(searchValue, true, false).draw();


        
        
    });
}); 
 */


    </script>



