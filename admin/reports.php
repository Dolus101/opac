<?php
session_start();
include("../core/config.php");
include("../core/function.php");

// Fetch users from the database
$sql = "SELECT * FROM aspnetusers WHERE MonthLogIn = '1'";
$result = mysqli_query($con, $sql);

$user_data = check_login($con);
if ($user_data['UserType'] !== 'Admin') {
  // Redirect to a different page or display an error message
  header("Location: ../signout.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRMC - Dashboard</title>

  <!-- JSZip Library (Required for Excel Export) -->
  <script src="https://cdn.jsdelivr.net/npm/jszip@3.7.1/dist/jszip.min.js"></script>

  <!-- FileSaver.js (Required for saving Excel file) -->
  <script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.5/dist/FileSaver.min.js"></script>

  <!-- DevExtreme CSS -->
  <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/22.2.4/css/dx.light.css">
  <!-- Index Admin CSS -->
  <link rel="stylesheet" href="../assets/css/report.css">
  <!-- Sidebar Admin CSS -->
  <link rel="stylesheet" href="../assets/css/admin-sidebar.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    /* Style for the grouping area */
    .grouping-area {
      border: 1px dashed #ccc;
      padding: 10px;
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <?php
  $page = 'report';
  include("../view/sidebar/admin-sidebar.php");
  ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <div class="container-fluid users mt-4">
          <?php
          if (isset($_SESSION['status'])) {
          ?>
            <div class="text-center">
              <div class="alert alert-success alert-dismissible fade show mx-auto" role="alert" style="width: 340px; border-radius: 20px;">
                <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          <?php
            unset($_SESSION['status']);
          }

          if (isset($_SESSION['status1'])) {
          ?>
            <div class="text-center">
              <div class="alert alert-danger alert-dismissible fade show mx-auto" role="alert" style="width: 340px; border-radius: 20px;">
                <strong>Hey!</strong> <?php echo $_SESSION['status1']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          <?php
            unset($_SESSION['status1']);
          }
          ?>
          <div class="container d-flex justify-content-between">
            <h2 class="pt-3">Report</h2>
            <div class="dropdown mt-4 ms-auto">
              <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Export Data
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" id="exportAll">Export all Data</a></li>
                <li><a class="dropdown-item" href="#" id="exportSelected">Export Selected Rows</a></li>
              </ul>
            </div>
            <button type="button" class="subject-modal" data-bs-toggle="modal" data-bs-target="#addModal">
              <i class="fa-solid fa-square-plus mt-4" style="color: #0a58ca;"></i>
            </button>
          </div>

          <!-- DevExtreme DataGrid Container -->
          <div id="dataGrid" class="mt-5"></div>
        </div>
      </div>
    </main>
    <footer class="py-4 mt-auto">
      <div class="container-fluid px-4">
      </div>
    </footer>
  </div>

  <!-- DevExtreme JS -->
  <script src="https://cdn3.devexpress.com/jslib/22.2.4/js/dx.all.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
  $(function() {
    const users = <?= json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC)); ?>;

    // Initialize DevExtreme DataGrid
    const grid = $("#dataGrid").dxDataGrid({
      dataSource: users,
      keyField: "Id",
      allowColumnReordering: true, // Enable dragging columns
      allowColumnResizing: true,
      groupPanel: {
        visible: true, // Show the group panel
        emptyPanelText: "Drag a column header here to group by that column" // Placeholder text
      },
      columns: [{
          dataField: "Firstname",
          caption: "Full Name",
          allowSorting: true,
          allowGrouping: true,
          cellTemplate: function(container, options) {
            const fullName = options.data.Firstname + ' ' + options.data.Lastname; // Concatenate Firstname and Lastname
            container.text(fullName); // Set the concatenated value
          }
        },
        {
          dataField: "UserName",
          caption: "User Name",
          allowSorting: true,
          allowGrouping: true
        },
        {
          dataField: "Email",
          caption: "Email",
          allowSorting: true,
          allowGrouping: true
        },
        {
          dataField: "UserType",
          caption: "User Type",
          allowSorting: true,
          allowGrouping: true
        },
      ],
      pager: {
        showPageSizeSelector: true,
        allowedPageSizes: [5, 10, 20],
        showInfo: true,
      },
      paging: {
        pageSize: 10,
      },
      filterRow: {
        visible: true,
        applyFilter: "auto",
      },
      sorting: {
        mode: "multiple"
      },
      grouping: {
        autoExpandAll: false,
      },
      selection: {
        mode: "multiple", // Allow multiple row selection
      }
    }).dxDataGrid("instance");

    // Export All Data to Excel
    $('#exportAll').on('click', function() {
      grid.exportToExcel({
        fileName: 'list.xlsx', // Custom file name
        exportAll: true // Add exportAll flag to include all data in export
      });
    });

    // Export Selected Rows to Excel
    $('#exportSelected').on('click', function() {
      const selectedRows = grid.getSelectedRowsData();
      if (selectedRows.length > 0) {
        grid.option("dataSource", selectedRows);
        grid.exportToExcel({
          fileName: 'list.xlsx' // Custom file name
        });
        grid.option("dataSource", users); // Restore original data
      } else {
        alert('No rows selected for export.');
      }
    });
  });
</script>


</body>

</html>
