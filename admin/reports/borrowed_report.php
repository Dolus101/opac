<?php
session_start();
include("../../core/config.php");
include("../../core/function.php");

// Check user session and role
$user_data = check_login($con);
if ($user_data['UserType'] !== 'Admin') {
    header("Location: ../../signout.php");
    exit();
}

// Fetch data from the database
$sql = "SELECT book.ID, book.Title, book.Author, book.Publisher, book_borrowed.Date_borrowed 
        FROM book_borrowed 
        INNER JOIN book ON book_borrowed.Book_id = book.ID
        WHERE MONTH(book_borrowed.date_borrowed) = MONTH(CURDATE()) 
        AND YEAR(book_borrowed.date_borrowed) = YEAR(CURDATE())";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error fetching data: " . mysqli_error($con));
}

$borrowed_books = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    $page = 'borrowed_report';
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
        $(function() {
            const borrowedBooks = <?= json_encode($borrowed_books); ?>;

            // Initialize DataGrid
            const grid = $("#dataGrid").dxDataGrid({
                dataSource: borrowedBooks,
                keyExpr: "ID",
                columns: [{
                        dataField: "Title",
                        caption: "Title"
                    },
                    {
                        dataField: "Author",
                        caption: "Author"
                    },
                    {
                        dataField: "Publisher",
                        caption: "Publisher"
                    },
                    {
                        dataField: "Date_borrowed",
                        caption: "Date Borrowed",
                        dataType: "date"
                    }
                ],
                paging: {
                    pageSize: 10
                },
                pager: {
                    showPageSizeSelector: true,
                    allowedPageSizes: [5, 10, 20],
                    showInfo: true
                },
                filterRow: {
                    visible: true,
                    applyFilter: "auto"
                },
                sorting: {
                    mode: "multiple"
                }
            }).dxDataGrid("instance");

            // Export to Excel
            $("#exportAll").on("click", function() {
                const workbook = new ExcelJS.Workbook();
                const worksheet = workbook.addWorksheet("Borrowed Books Report");

                DevExpress.excelExporter.exportDataGrid({
                    component: grid,
                    worksheet: worksheet
                }).then(() => {
                    workbook.xlsx.writeBuffer().then((buffer) => {
                        saveAs(new Blob([buffer], {
                            type: "application/octet-stream"
                        }), "Borrowed_Books_Report.xlsx");
                    });
                });
            });
        });
    </script>
</body>

</html>