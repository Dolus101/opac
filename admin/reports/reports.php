<?php
session_start();
include("../../core/config.php");
include("../../core/function.php");

// Fetch users from the database
$sql = "SELECT * FROM aspnetusers WHERE MONTH(MonthlyLogIn) = MONTH(CURDATE())AND YEAR(MonthlyLogIn) = YEAR(CURDATE())";
;
$result = mysqli_query($con, $sql);

$user_data = check_login($con);
if ($user_data['UserType'] !== 'Admin') {
  header("Location: ../../signout.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRMC - Dashboard</title>

  <!-- JSZip Library -->
  <script src="https://cdn.jsdelivr.net/npm/jszip@3.7.1/dist/jszip.min.js"></script>

  <!-- FileSaver.js -->
  <script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.5/dist/FileSaver.min.js"></script>

  <!-- ExcelJS Library -->
  <script src="https://cdn.jsdelivr.net/npm/exceljs@4.3.0/dist/exceljs.min.js"></script>

  <!-- DevExtreme CSS -->
  <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/22.2.4/css/dx.light.css">
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../../assets/css/report.css">
  <link rel="stylesheet" href="../../assets/css/admin-sidebar.css">
  <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css">
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <?php
  $page = 'report';
  include("../../view/sidebar/admin-sidebar.php");
  ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <div class="container-fluid users mt-4">
          <?php if (isset($_SESSION['status'])) { ?>
            <div class="text-center">
              <div class="alert alert-success alert-dismissible fade show mx-auto" role="alert" style="width: 340px; border-radius: 20px;">
                <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          <?php unset($_SESSION['status']); } ?>

          <div class="container d-flex justify-content-between">
            <h2 class="pt-3">Report</h2>
            <div class="dropdown mt-4 ms-auto">
              <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Export Data
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" id="exportAll">Export all Data</a></li>
              </ul>
            </div>
          </div>

          <div id="dataGrid" class="mt-5"></div>
        </div>
      </div>
    </main>
  </div>

  <!-- DevExtreme JS -->
  <script src="https://cdn3.devexpress.com/jslib/22.2.4/js/dx.all.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    $(function () {
      const users = <?= json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC)); ?>;

      // Initialize DevExtreme DataGrid
      const grid = $("#dataGrid").dxDataGrid({
        dataSource: users,
        keyExpr: "Id",
        allowColumnReordering: true,
        allowColumnResizing: true,
        groupPanel: {
          visible: true,
          emptyPanelText: "Drag a column header here to group by that column"
        },
        columns: [
          {
            dataField: "Firstname",
            caption: "Full Name",
            cellTemplate: function (container, options) {
              const fullName = options.data.Firstname + " " + options.data.LastName;
              container.text(fullName);
            }
          },
          { dataField: "UserName", caption: "User Name" },
          { dataField: "Email", caption: "Email" },
          { dataField: "UserType", caption: "User Type" }
        ],
        pager: {
          showPageSizeSelector: true,
          allowedPageSizes: [5, 10, 20],
          showInfo: true
        },
        paging: { pageSize: 10 },
        filterRow: { visible: true, applyFilter: "auto" },
        sorting: { mode: "multiple" },
        grouping: { autoExpandAll: false }
      }).dxDataGrid("instance");

      // Export All Data to Excel
      $("#exportAll").on("click", function () {
        const workbook = new ExcelJS.Workbook();
        const worksheet = workbook.addWorksheet("Report");

        DevExpress.excelExporter.exportDataGrid({
          component: grid,
          worksheet: worksheet
        }).then(() => {
          workbook.xlsx.writeBuffer().then((buffer) => {
            saveAs(new Blob([buffer], { type: "application/octet-stream" }), "report.xlsx");
          });
        });
      });
    });
  </script>
</body>

</html>
