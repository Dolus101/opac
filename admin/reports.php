<?php
session_start();
include("../core/config.php");
include("../core/function.php");

// Fetch users from the database
$sql = "SELECT * FROM thesis";
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
  $page = 'users';
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
  $(function () {
    const users = <?= json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC)); ?>;

    // Initialize DevExtreme DataGrid
    $("#dataGrid").dxDataGrid({
      dataSource: users,
      keyField: "Id",
      allowColumnReordering: true,  // Enable dragging columns
      allowColumnResizing: true,
      groupPanel: {
        visible: true, // Show the group panel
        emptyPanelText: "Drag a column header here to group by that column" // Placeholder text
      },
      columns: [
        { dataField: "Title", caption: "Title", allowSorting: true, allowGrouping: true },
        { dataField: "Author_num", caption: "Author Number", allowSorting: true, allowGrouping: true },
        { dataField: "Author", caption: "Author", allowSorting: true, allowGrouping: true },
        { dataField: "Category", caption: "Category", allowSorting: true, allowGrouping: true },
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
      onHeaderClick: function(e) {
        // Prevent the dropdown from opening when grouping
        if (e.event.target.closest('.dx-datagrid-group-panel') === null) {
          e.component.showColumnChooser();
        }
      },
      // Disable the dropdown on group column header
      onRowDraggingChange: function(e) {
        if (e.toIndex !== null && e.fromIndex !== null) {
          // Prevent the dropdown from opening
          e.cancel = true;
        }
      }
    });
  });
</script>

</body>
</html>
