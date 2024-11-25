<?php
session_start();
include("../core/config.php");
include("../core/function.php");

$query = "SELECT * FROM category";
$resCat = mysqli_query($con, $query);

$user_data = check_login($con);
if ($user_data['UserType'] !== 'Admin') {
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
          <div class="container d-flex justify-content-between">
            <h2 class="pt-3">List of Books</h2>
            <button type="button" class="subject-modal" data-bs-toggle="modal" data-bs-target="#addModal">
              <i class="fa-solid fa-square-plus mt-4" style="color: #0a58ca;"></i>
            </button>
          </div>
          <div class="container table-borrowed mt-5">
            <table id="example" class="table table-striped mb-5" style="width:100%">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Department</th>
                  <th>Subject Area</th>
                  <th>Author</th>
                  <th>Publish Year</th>
                  <th>No. Copies</th>
                  <th>ISBN</th>
                  <th style="width: 100px;">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Book</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editForm">
          <div class="modal-body">
            <input type="hidden" id="editBookId" name="bookId">
            <div class="row g-3 needs-validation" novalidate>
              <div class="col-md-12">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="editTitle" required>
              </div>
              <div class="col-md-4">
                <label for="Department" class="form-label">Department</label>
                <select id="editDepartment" name="department" class="form-select">
                  <option selected disabled>Select Department</option>
                  <option value="College">College</option>
                  <option value="Senior High">Senior High</option>
                  <option Value="Junior High">Junior High</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="Department" class="form-label">Category</label>
                <select id="editCategory" name="subject" class="form-select" style="max-height: 40px;">
                  <option selected disabled>Select Category</option>
                  <?php
                  foreach ($resCat as $cat) {
                  ?>
                    <option value="<?= $cat['cat_ID'] ?>"><?= $cat['Name'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4">
                <label for="editBookNo" class="form-label">Book No.</label>
                <input type="text" name="bookNo" class="form-control" id="editBookNo" required>
              </div>
              <div class="col-md-6">
                <label for="Title" class="form-label">Author</label>
                <input type="text" name="author" class="form-control" id="editAuthor" required>
              </div>
              <div class="col-md-6">
                <label for="Title" class="form-label">Author No.</label>
                <input type="text" name="authNo" class="form-control" id="editAuthNum" required>
              </div>
              <div class="col-md-4">
                <label for="Title" class="form-label">Copyright Date</label>
                <input type="number" name="copyright" class="form-control" id="editCopyDate" required>
              </div>
              <div class="col-md-4">
                <label for="Title" class="form-label">Publisher</label>
                <input type="text" name="publisher" class="form-control" id="editPublisher" required>
              </div>
              <div class="col-md-4">
                <label for="Title" class="form-label">Accession No.</label>
                <input type="text" name="accNo" class="form-control" id="editAccNum" required>
              </div>
              <div class="col-md-4">
                <label for="Title" class="form-label">ISBN</label>
                <input type="text" name="isbn" class="form-control" id="editIsbn" required>
              </div>
              <div class="col-md-4">
                <label for="Title" class="form-label">No. Copies</label>
                <input type="text" name="noCopy" class="form-control" id="editCopies" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
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
                <input type="text" class="form-control" id="Title" name="title" required>
              </div>
              <div class="col-md-4">
                <label for="Department" class="form-label">Department</label>
                <select id="Department" class="form-select" name="department" required>
                  <option selected disabled>Select Department</option>
                  <option value="CCS">College of Computer Studies</option>
                  <option value="CBE">College of Business Education</option>
                  <option Value="CTE">College of Teacher Education</option>
                  <option Value="CCJE">College of Criminal Justice Education</option>
                  <option Value="PYSCH">Psychology Program</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="Category" class="form-label">Category</label>
                <select id="Category" class="form-select" name="category" required>
                  <option selected disabled>Select Category</option>
                  <?php
                  foreach ($resCat as $cat) {
                  ?>
                    <option value="<?= $cat['cat_ID'] ?>"><?= $cat['Name'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4">
                <label for="BookNo" class="form-label">Book Number</label>
                <input type="text" class="form-control" id="BookNo" name="bookNo" required>
              </div>
              <div class="col-md-6">
                <label for="Author" class="form-label">Author Name</label>
                <input type="text" class="form-control" id="Author" name="author" required>
              </div>
              <div class="col-md-6">
                <label for="AuthNo" class="form-label">Author Number</label>
                <input type="text" class="form-control" id="AuthNo" name="authNo" required>
              </div>
              <div class="col-md-6">
                <label for="Copyright" class="form-label">Copyright Date</label>
                <input type="text" class="form-control" id="Copyright" name="copyright" required>
              </div>
              <div class="col-md-6">
                <label for="Publisher" class="form-label">Publisher</label>
                <input type="text" class="form-control" id="Publisher" name="publisher" required>
              </div>
              <div class="col-md-6">
                <label for="AccNo" class="form-label">Accession Number</label>
                <input type="text" class="form-control" id="AccNo" name="accNo" required>
              </div>
              <div class="col-md-6">
                <label for="Isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="Isbn" name="isbn" required>
              </div>
              <div class="col-md-6">
                <label for="NoCopy" class="form-label">Number of Copies</label>
                <input type="text" class="form-control" id="NoCopy" name="noCopy" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="add_book" class="btn btn-primary">Add Book</button>
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

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://kit.fontawesome.com/581b97ebce.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": "../utilities/lazyload.php",
          "type": "POST"
        },
        "columns": [{
            "data": 0
          },
          {
            "data": 1
          },
          {
            "data": 2
          },
          {
            "data": 3
          },
          {
            "data": 4
          },
          {
            "data": 5
          },
          {
            "data": 6
          },
          {
            "data": 7
          }
        ]
      });
    });

    $(document).on('click', '.edit-btn', function() {
      $('#editBookId').val($(this).data('id'));
      $('#editTitle').val($(this).data('title'));
      $('#editDepartment').val($(this).data('department'));
      $('#editCategory').val($(this).data('subject'));
      $('#editBookNo').val($(this).data('bookno'));
      $('#editAuthor').val($(this).data('author'));
      $('#editAuthNum').val($(this).data('authnum'));
      $('#editCopyDate').val($(this).data('copyright'));
      $('#editPublisher').val($(this).data('publisher'));
      $('#editAccNum').val($(this).data('accnum'));
      $('#editCopies').val($(this).data('copies'));
      $('#editIsbn').val($(this).data('isbn'));
      $('#editModal').modal('show');
    });

    $('#editForm').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: '../utilities/updateBook.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          alert('Book updated successfully!');
          $('#editModal').modal('hide');
          $('#example').DataTable().ajax.reload();
        },
      });
    });

    $(document).on('click', '.delete-btn', function() {
      const bookId = $(this).data('id');
      $('#confirmDelete').data('id', bookId);
      $('#deleteModal').modal('show');
    });

    $('#confirmDelete').on('click', function() {
      const bookId = $(this).data('id');
      $.ajax({
        url: '../utilities/deleteBook.php',
        type: 'POST',
        data: {
          bookId: bookId
        },
        success: function(response) {
          alert('Book deleted successfully!');
          $('#deleteModal').modal('hide');
          $('#example').DataTable().ajax.reload();
        },
      });
    });
  </script>

</body>

</html>