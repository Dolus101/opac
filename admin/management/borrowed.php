<?php
session_start();
include("../../core/config.php");
include("../../core/function.php");

$sql = "SELECT book.Title, book_borrowed.Date_borrowed, book_borrowed.Date_returned, book_borrowed.Status, Firstname, LastName 
from book_borrowed 
INNER JOIN book ON book_borrowed.Book_id = book.ID 
INNER JOIN aspnetusers ON book_borrowed.Student_id = aspnetusers.Id";
$result = mysqli_query($con, $sql);



$user_data = check_login($con);
if ($user_data['UserType'] !== 'Admin') {
  // Redirect to a different page or display an error message
  header("Location: ../../signout.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- <link rel="icon" type="image/png" href="../images/scholar-logo.png" /> -->
  <!-- datatable css-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <!-- index admin CSS -->
  <link rel="stylesheet" href="../../assets/css/borrowed.css">
  <!-- sidebar admin CSS -->
  <link rel="stylesheet" href="../../assets/css/admin-sidebar.css">
  <!-- bootstrap -->
  <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css">
  <!-- Include DevExtreme CSS and JS files -->

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRMC - Dashboard</title>
</head>

<body>
  <?php
  $page = 'borrowed';
  include("../../view/sidebar/admin-sidebar.php")
  ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <!-- BOXES -->


        <!-- DASHBOARD NI -->
        <div class="container-fluid users mt-4">
          <?php
          if (isset($_SESSION['status'])) {
          ?>
            <div class="text-center">
              <div class="alert alert-success alert-dismissible fade show mx-auto" role="alert" style="width: 340px; border-radius: 20px;">
                <strong> Hey! </strong> <?php echo $_SESSION['status']; ?>
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
                <strong> Hey! </strong> <?php echo $_SESSION['status1']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          <?php

            unset($_SESSION['status']);
          }
          ?>
          <div class="container d-flex justify-content-between">
            <h2 class="pt-3">List of Transaction</h2>
          </div>
          <div class="container table-borrwed mt-5">



            <table id="example" class="table table-striped mb-5" style="width:100%">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Book Name</th>
                  <th>Date Borrowed</th>
                  <th>Date Returnned</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($result as $row) {
                  // Convert DD-MM-YYYY to YYYY-MM-DD

                ?>
                  <tr>
                    <td><?= $row['Firstname'];?> <?=$row['LastName']?></td>
                    <td><?= $row['Title']; ?></td>
                    <td><?= $row['Date_borrowed']; ?></td>
                    <td><?= $row['Date_returned']; ?></td>
                    <td><?= $row['Status']; ?></td>


                <?php } ?>
            </table>
          </div>
        </div>
        <!-- end of boxes -->
        <!-- table -->
      </div>


    



    </main>
    <footer class="py-4  mt-auto">
      <div class="container-fluid px-4">

      </div>
    </footer>
  </div>



  <!-- font awesone -->
  <!-- <script src="https://kit.fontawesome.com/581b97ebce.js" crossorigin="anonymous"></script> -->
  <!--BOOTSTRAP JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- DATATABLE -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <!-- script file-->

  <script src="../../assets/js/main.js"></script>
  <script src="../../assets/js/chart.js"></script>
  <script src="../../assets/js/datatable.js"></script>



</body>

</html>