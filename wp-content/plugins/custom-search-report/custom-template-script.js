jQuery(document).ready(function($) {
    // Sample data (replace with your data)
    var data = <?php echo json_encode($your_data_array); ?>;
  
    var itemsPerPage = 2;
    var currentPage = 1;
    var totalPages = Math.ceil(data.length / itemsPerPage);
  
    function displayTableData() {
      var start = (currentPage - 1) * itemsPerPage;
      var end = start + itemsPerPage;
      var tableHtml = '';
  
      for (var i = start; i < end; i++) {
        if (data[i]) {
          tableHtml += '<tr><td>' + data[i].id + '</td><td>' + data[i].keyword + '</td><td>' + data[i].visitor_ip + '</td></tr>';
        }
      }
  
      $('#tableBody').html(tableHtml);
    }
  
    function displayPagination() {
      var paginationHtml = '';
  
      for (var i = 1; i <= totalPages; i++) {
        paginationHtml += '<li class="page-item"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
      }
  
      $('#pagination').html(paginationHtml);
    }
  
    function updatePagination(current) {
      currentPage = current;
      displayTableData();
      displayPagination();
    }
  
    $('#pagination').on('click', 'a', function(event) {
      event.preventDefault();
      updatePagination($(this).data('page'));
    });
  
    $('#searchInput').on('input', function() {
      var searchTerm = $(this).val().toLowerCase();
      var filteredData = data.filter(function(item) {
        return item.keyword.toLowerCase().indexOf(searchTerm) !== -1;
      });
  
      currentPage = 1;
      data = filteredData;
      totalPages = Math.ceil(data.length / itemsPerPage);
  
      updatePagination(1);
    });
  
    // Initial display
    displayTableData();
    displayPagination();
  });
  