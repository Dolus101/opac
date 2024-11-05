<?php
session_start();
include("../core/config.php");
include("../core/function.php");

$category = "SELECT * FROM category";
$resCat = mysqli_query($con, $category);

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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="../assets/css/books.css">
  <link rel="stylesheet" href="../assets/css/admin-sidebar.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRMC - Dashboard</title>
</head>

<body>
  <?php
  $page = 'book';
  include("../view/sidebar/admin-sidebar.php");
  ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <div class="container-fluid books mt-4">
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
            unset($_SESSION['status1']);
          }
          ?>
          <div class="container d-flex justify-content-between">
            <h2 class="pt-3">List of Books</h2>
            <button type="button" class="subject-modal" data-bs-toggle="modal" data-bs-target="#addModal">
              <i class="fa-solid fa-square-plus mt-4" style="color: #0a58ca;"></i>
            </button>
          </div>
          <div class="container table-borrwed mt-5">
            <table id="example" class="table table-striped mb-5" style="width:100%">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Department</th>
                  <th>Subject Area</th>
                  <th>Author</th>
                  <th>Copyright</th>
                  <th>No. Copies</th>
                  <th>ISBN</th>
                  <th style="width: 100px;">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Data will be loaded here by AJAX -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Add Modal -->
      <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Subject</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="../utilities/crud.php" method="POST">
                <div class="row g-3 needs-validation" novalidate>
                  <div class="col-md-12">
                    <label for="Title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="Title" required>
                  </div>
                  <div class="col-md-6  ">
                    <label for="Department" class="form-label">Department</label>
                    <select id="Department" class="form-select">
                      <option selected disabled>Select Department</option>
                      <option value="College">College</option>
                      <option value="Senior High">Senior High</option>
                      <option Value="Junior High">Junior High</option>
                    </select>
                  </div>
                  <div class="col-md-6  ">
                    <label for="Department" class="form-label">Category</label>
                    <select id="Category" class="form-select" size="3" style="height: auto; max-height: 200px; overflow-y: auto;">
                      <option selected disabled>Select Category</option>
                      <?php 
                        foreach($resCat as $cat){
                      ?>
                      <option value="<?=$cat['ID']?>"><?=$cat['Name']?></option>
                      <?php } ?>
                    </select>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add_subj" class="btn btn-primary">Add Subject</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </main>
    <footer class="py-4 mt-auto">
      <div class="container-fluid px-4">
      </div>
    </footer>
  </div>

  <script src="https://kit.fontawesome.com/581b97ebce.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/chart.js"></script>
  <script>
    $(document).ready(function() {
      // Check if DataTable is already initialized and destroy it
      if ($.fn.DataTable.isDataTable('#example')) {
        $('#example').DataTable().clear().destroy();
      }

      // Initialize DataTable with server-side processing
      $('#example').DataTable({
        "processing": true, // Show processing indicator
        "serverSide": true, // Enable server-side processing
        "ajax": {
          "url": "../utilities/lazyload.php", // Your server-side script URL
          "type": "POST" // Use POST method
        },
      });
    });
  </script>

</body>

</html>