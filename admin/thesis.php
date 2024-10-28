<?php
session_start();
include("../core/config.php");
include("../core/function.php");

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
  <link rel="stylesheet" href="../assets/css/thesis.css">
  <link rel="stylesheet" href="../assets/css/admin-sidebar.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRMC - Dashboard</title>
</head>

<body>
  <?php
  $page = 'thesis';
  include("../view/sidebar/admin-sidebar.php")
  ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <div class="container-fluid thesis mt-4">
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
            <h2 class="pt-3">List of Thesis</h2>
            <button type="button" class="subject-modal" data-bs-toggle="modal" data-bs-target="#addModal">
              <i class="fa-solid fa-square-plus mt-4" style="color: #0a58ca;"></i>
            </button>
          </div>
          <div class="container table-borrwed mt-5">
            <table id="example" class="table table-striped mb-5" style="width:100%">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Book Num</th>
                  <th>Author Num</th>
                  <th>Date/Year</th>
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
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Thesis Information</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="../utilities/crud.php" method="POST">
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="book_num" class="form-label">Book Num</label>
                  <input type="text" name="book_num" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="author_num" class="form-label">Author Num</label>
                  <input type="text" name="author_num" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="date" class="form-label">Date/Year</label>
                  <input type="date" name="date" class="form-control" required>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="add_thesis" class="btn btn-primary">Add Thesis</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Modal -->
      <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Thesis</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="../utilities/crud.php" method="POST">
                <input type="hidden" name="id" id="editThesisId">
                <div class="mb-3">
                  <label for="editTitle" class="form-label">Title</label>
                  <input type="text" name="title" id="editTitle" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="editBookNum" class="form-label">Book Num</label>
                  <input type="text" name="book_num" id="editBookNum" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="editAuthorNum" class="form-label">Author Num</label>
                  <input type="text" name="author_num" id="editAuthorNum" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="editDate" class="form-label">Date/Year</label>
                  <input type="date" name="date" id="editDate" class="form-control" required>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="edit_thesis" class="btn btn-primary">Update Thesis</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </main>
    <footer class="py-4 mt-auto">
      <div class="container-fluid px-4"></div>
    </footer>
  </div>

  <script src="https://kit.fontawesome.com/581b97ebce.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function() {
      // Initialize DataTable with server-side processing
      $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": "../utilities/lazyloadthesis.php", // Your server-side script URL
          "type": "POST" // Use POST method
        },
        "columns": [
          { "data": "Title" },
          { "data": "Book_num" },
          { "data": "Author_num" },
          { "data": "Date" },
          { "data": "Action" }
        ]
      });

      // Edit thesis data
      $(document).on('click', '.editThesis', function() {
        // Get data attributes
        var thesisId = $(this).data('id');
        var title = $(this).data('title');
        var bookNum = $(this).data('booknum');
        var authorNum = $(this).data('authornum');
        var date = $(this).data('date');

        // Set data to modal fields
        $('#editThesisId').val(thesisId);
        $('#editTitle').val(title);
        $('#editBookNum').val(bookNum);
        $('#editAuthorNum').val(authorNum);
        $('#editDate').val(date);

        // Show the edit modal
        $('#editModal').modal('show');
      });
    });
  </script>

</body>

</html>
