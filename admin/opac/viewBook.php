<?php
session_start();
include("../../core/config.php");
include("../../core/function.php");

$bookId = $_GET['id'];

$query = "SELECT * FROM book WHERE ID = '$bookId'";
$bookName = mysqli_query($con, $query);
$book = mysqli_fetch_assoc($bookName);

$sql = "SELECT * FROM topic WHERE Book = '$bookId' ORDER BY Page ASC ";
$result = mysqli_query($con, $sql);

// Check if the user is an Admin
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
    <link rel="stylesheet" href="../../assets/css/subjects.css">
    <link rel="stylesheet" href="../../assets/css/admin-sidebar.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRMC - Dashboard</title>
</head>

<body>
    <?php
    $page = 'book';
    include("../../view/sidebar/admin-sidebar.php")
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="container-fluid subjects mt-4">
                    <div class="container d-flex justify-content-between">
                        <h3 class="pt-3"><b>Book: <?php echo $book['Title']; ?></b></h3>
                        <button type="button" class="subject-modal" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="fa-solid fa-square-plus mt-4" style="color: #0a58ca;"></i>
                        </button>
                    </div>

                    <div class="container table-borrwed mt-5">
                        <table id="example" class="table table-striped mb-5">
                            <thead>
                                <tr>
                                    <th>Content</th>
                                    <th>Pages</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?= $row['Name'] ?></td>
                                        <td><?= $row['Page'] ?></td>
                                        <td>
                                            <button type="button" class="subject-modal" data-bs-toggle="modal" data-bs-target="#EditModal<?= $row['ID'] ?>">
                                                <i class="fa-solid fa-pen-to-square" style="color: #0a58ca;"></i>
                                            </button>
                                            <button type="button" class="subject-modal" data-bs-toggle="modal" data-bs-target="#DelModal<?= $row['ID'] ?>">
                                                <i class="fa-solid fa-trash-can" style="color: #0a58ca;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- EDIT MODAL -->
                                    <div class="modal fade" id="EditModal<?= $row['ID'] ?>" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Content</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../../../utilities/crud.php" method="POST">
                                                        <div class="mb-3">
                                                            <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
                                                            <input type="hidden" name="id" value="<?= $row['ID'] ?>">
                                                            <label for="title" class="form-label">Content</label>
                                                            <input type="text" value="<?= $row['Name'] ?>" name="content" class="form-control" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="book_num" class="form-label">Pages</label>
                                                            <input type="number" value="<?= $row['Page'] ?>" name="page" class="form-control">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="edit_content" class="btn btn-primary">Add Content</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- DELETE MODAL -->
                                    <div class="modal fade" id="DelModal<?= $row['ID'] ?>" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Content</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../../../utilities/crud.php" method="POST">
                                                        <div class="mb-3">
                                                            <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
                                                            <input type="hidden" name="id" value="<?= $row['ID'] ?>">
                                                            <h4>Are you sure you want to delete this?</h4>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="del_content" class="btn btn-primary">Add Content</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Content</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../../utilities/crud.php" method="POST">
                        <div class="mb-3">
                            <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
                            <label for="title" class="form-label">Content</label>
                            <input type="text" name="content" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="book_num" class="form-label">Pages</label>
                            <input type="number" name="page" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="add_content" class="btn btn-primary">Add Content</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal (Your existing modal code) -->

    <!-- Scripts -->
    <!-- <script src="https://kit.fontawesome.com/581b97ebce.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "order": [
                    [1, 'asc']
                ]
            });
        });
    </script>
</body>

</html>