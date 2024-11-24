<?php
session_start();
include("../core/config.php");
include("../core/function.php");

$sql = "SELECT * from category";
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
  <!-- <link rel="icon" type="image/png" href="../images/scholar-logo.png" /> -->
  <!-- datatable css-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <!-- index admin CSS -->
  <link rel="stylesheet" href="../assets/css/subjects.css">
  <!-- sidebar admin CSS -->
  <link rel="stylesheet" href="../assets/css/admin-sidebar.css">
  <!-- bootstrap -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
  <!-- Include DevExtreme CSS and JS files -->

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRMC - Dashboard</title>
</head>

<body>
  <?php
  $page = 'subject';
  include("../view/sidebar/admin-sidebar.php")
  ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <!-- BOXES -->


        <!-- DASHBOARD NI -->
        <div class="container-fluid subjects mt-4">
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
            <h2 class="pt-3">Subject Areas</h2>
            <button type="button" class="subject-modal" data-bs-toggle="modal" data-bs-target="#addModal">
              <i class="fa-solid fa-square-plus mt-4" style="color: #0a58ca;"></i>
            </button>
          </div>
          <div class="container table-borrwed mt-5">
            <table id="example" class="table table-striped  mb-5">
              <thead>
                <tr>
                  <th>Name</th>
                  <td style="width: 100px;">Action</td>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($result as $row) {
                ?>
                  <tr>
                    <td><?= $row['Name']; ?></td>

                    <td>
                      <button type="button" class="subject-modal" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['cat_ID']; ?>">
                        <i class="fa-solid fa-pen-to-square" style="color: #0a58ca;"></i>
                      </button>
                    </td>
                  </tr>

                  <!-- Edit Modal -->
                  <div class="modal fade" id="editModal<?= $row['ID']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Subject</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="../utilities/crud.php" method="POST">
                            <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Subject</label>
                              <input type="hidden" name="id" value="<?= $row['cat_ID'] ?>">
                              <input type="text" class="form-control" name="name_subj" value="<?= $row['Name']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="edit_subj" class="btn btn-primary">Save changes</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
            </table>
          </div>
        </div>
        <!-- end of boxes -->
        <!-- table -->
      </div>

      <!-- Add Modal -->
      <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Subject</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="../utilities/crud.php" method="POST">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Subject</label>
                <input type="text" name="name_subj" class="form-control" id="exampleFormControlInput1" value="">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="add_subj" class="btn btn-primary">Add Subject</button>
                </form>
              </div>
            </div>
          </div>
        </div>




    </main>
    <footer class="py-4  mt-auto">
      <div class="container-fluid px-4">

      </div>
    </footer>
  </div>



  <!-- font awesone -->
  <script src="https://kit.fontawesome.com/581b97ebce.js" crossorigin="anonymous"></script>
  <!--BOOTSTRAP JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- DATATABLE -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <!-- script file-->
  
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/chart.js"></script>
  <script src="../assets/js/datatable.js"></script>



</body>

</html>