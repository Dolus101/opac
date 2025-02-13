<?php
session_start();
include("../../core/config.php");
include("../../core/function.php");

$user_data = check_login($con);
if ($user_data['UserType'] !== 'Admin') {
    // Redirect to a different page or display an error message
    header("Location: ../../signout.php");
    exit();
}

$book = "SELECT count(*) AS count from `book`";
$result = mysqli_query($con, $book);
while ($row = mysqli_fetch_assoc($result)) {

    $output = $row['count'];
}

$borrowed = "SELECT count(*) AS count from `book_borrowed` WHERE Status = 'Borrowed'";
$result1 = mysqli_query($con, $borrowed);
while ($row1= mysqli_fetch_assoc($result1)) {

    $output1 = $row1['count'];
}

$Returned = "SELECT count(*) AS count from `book_borrowed` WHERE Status = 'Returned'";
$result2 = mysqli_query($con, $Returned);
while ($row2= mysqli_fetch_assoc($result2)) {

    $output2 = $row2['count'];
}

$Active = "SELECT count(*) AS count from `aspnetusers` WHERE Status = 'Active'";
$result3 = mysqli_query($con, $Active);
while ($row3= mysqli_fetch_assoc($result3)) {

    $output3 = $row3['count'];
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    
<!-- <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-duotone-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-duotone-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-duotone-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-duotone-light.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-light.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/duotone-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/duotone-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/duotone-light.css"> -->
    <!-- <link rel="icon" type="image/png" href="../images/scholar-logo.png" /> -->
    <!-- datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- index admin CSS -->
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <!-- sidebar admin CSS -->
    <link rel="stylesheet" href="../../assets/css/admin-sidebar.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css">
    <!-- Include DevExtreme CSS and JS files -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRMC - Dashboard</title>
</head>

<body>
    <?php
    $page = 'dashboard';
    include("../../view/sidebar/admin-sidebar.php")
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <!-- BOXES -->

                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"></li>
                </ol>
                <!-- DASHBOARD NI -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title total"><?php echo $output ?></h5>
                                    <p class="card-text">Books </p>
                                    <a href="#" class="btn btn-primary books"disabled>Books</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title total"><?php echo $output1 ?></h5>
                                    <p class="card-text">Borrowed Books</p>
                                    <a href="#" class="btn btn-primary" disabled>Books Borrowed</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title total"><?php echo $output2 ?></h5>
                                    <p class="card-text">Returned Books</p>
                                    <a href="#" class="btn btn-primary" disabled>Returned Books</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title total"><?php echo $output3 ?></h5>
                                    <p class="card-text">Active Users</p>
                                    <a href="#" class="btn btn-primary"disabled>Active Users</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of boxes -->
                <!-- admin logs -->
                <div class="container-fluid">
                    
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
    <!--  -->
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/chart.js"></script>
    <script src="../../assets/js/datatable.js"></script>
    
    



</body>

</html>