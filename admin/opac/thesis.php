<?php
session_start();
include("../../core/function.php");
include("../../core/config.php");

// Check user authentication and authorization
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../../assets/css/thesis.css">
    <link rel="stylesheet" href="../../assets/css/admin-sidebar.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRMC - Dashboard</title>
</head>

<body>
    <?php
    $page = 'thesis';
    include("../../view/sidebar/admin-sidebar.php");
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="container-fluid thesis mt-4">
                    <div class="container-fluid  d-flex justify-content-between">
                        <h2 class="pt-3">List of Thesis</h2>
                        <button type="button" class="subject-modal" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="fa-solid fa-square-plus mt-4" style="color: #0a58ca;"></i>
                        </button>
                    </div>
                    <div class="container table-borrowed mt-5">
                        <table id="example" class="table table-striped mb-5" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Book Num</th>
                                    <th>Author Num</th>
                                    <th>Date</th>
                                    <th>Actions</th>
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
                <form id="editForm">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Thesis</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Title</label>
                            <input type="text" id="editTitle" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editBookNum" class="form-label">Book Num</label>
                            <input type="text" id="editBookNum" name="book_num" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="editAuthorNum" class="form-label">Author Num</label>
                            <input type="text" id="editAuthorNum" name="author_num" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDate" class="form-label">Date</label>
                            <input type="date" id="editDate" name="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
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
                    <form action="../../utilities/crud.php" method="POST">
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

    <!-- JS -->
    <!-- <script src="https://kit.fontawesome.com/581b97ebce.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '../../utilities/lazyloadthesis.php',
                    type: 'POST'
                },
                columns: [{
                        data: 0
                    },
                    {
                        data: 1
                    },
                    {
                        data: 2
                    },
                    {
                        data: 3
                    },
                    {
                        data: 4
                    },
                ],
            });

            // Edit Button Click
            $(document).on('click', '.edit-btn', function() {
                const data = $(this).data();
                $('#editId').val(data.id);
                $('#editTitle').val(data.title);
                $('#editBookNum').val(data.booknum);
                $('#editAuthorNum').val(data.authornum);
                $('#editDate').val(data.date);
                $('#editModal').modal('show');
            });

            // Edit Form Submit
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '../../utilities/thesisCrud.php', // Adjust to your edit endpoint
                    method: 'POST',
                    data: $(this).serialize() + '&action=edit',
                    success: function(response) {
                        $('#editModal').modal('hide');
                        table.ajax.reload();
                        alert('Thesis updated successfully!');
                    }
                });
            });

            // Delete Button Click
            $(document).on('click', '.delete-btn', function() {
                const id = $(this).data('id');
                if (confirm('Are you sure you want to delete this thesis?')) {
                    $.ajax({
                        url: '../../utilities/thesisCrud.php', // Adjust to your delete endpoint
                        method: 'POST',
                        data: {
                            id: id,
                            action: 'delete'
                        },
                        success: function(response) {
                            table.ajax.reload();
                            alert('Thesis deleted successfully!');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>

</body>

</html>