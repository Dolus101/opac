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

$query = "
    SELECT 
        YEAR(Date_borrowed) AS year, 
        MONTH(Date_borrowed) AS month, 
        CourseYear,
        COUNT(*) AS total_borrowed
    FROM book_borrowed
    WHERE YEAR(Date_borrowed) = 2022
    GROUP BY YEAR(Date_borrowed), MONTH(Date_borrowed), CourseYear
    ORDER BY year DESC, month DESC
";
$result = mysqli_query($con, $query);

$months = [];
$students_data = [];
$teachers_data = [];

while ($row = mysqli_fetch_assoc($result)) {
    // Format month as MM-YYYY for better display
    $month = str_pad($row['month'], 2, '0', STR_PAD_LEFT) . '-' . $row['year'];
    if (!in_array($month, $months)) {
        $months[] = $month;
    }
    if ($row['CourseYear'] == 'student') {
        $students_data[$month] = $row['total_borrowed'];
    } else {
        $teachers_data[$month] = $row['total_borrowed'];
    }
}

// Fill missing months with 0 values for both students and teachers
$students_data = array_merge(array_fill_keys($months, 0), $students_data);
$teachers_data = array_merge(array_fill_keys($months, 0), $teachers_data);

// Prepare data for chart
$data = [
    'months' => array_reverse($months),
    'students' => array_reverse(array_values($students_data)),
    'teachers' => array_reverse(array_values($teachers_data))
];

echo json_encode($data);


$borrowed = "SELECT Title, CourseYear, book_borrowed.Status
FROM book_borrowed INNER JOIN book ON book_borrowed.Book_id = book.ID ORDER BY Date_borrowed DESC";
$result5 = mysqli_query($con, $borrowed);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <link rel="icon" type="image/png" href="../images/scholar-logo.png" /> -->
    <!-- datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- index admin CSS -->
    <link rel="stylesheet" href="../assets/css/admin.css">
    <!-- sidebar admin CSS -->
    <link rel="stylesheet" href="../assets/css/admin-sidebar.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
    <!-- Include DevExtreme CSS and JS files -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRMC - Dashboard</title>
</head>

<body>
    <?php
    $page = 'chart';
    include("../view/sidebar/admin-sidebar.php")
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <!-- BOXES -->

                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"></li>
                </ol>
                <!-- DASHBOARD NI -->
                <!-- <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title total"><?php echo $output ?></h5>
                                    <p class="card-text">Books </p>
                                    <a href="#" class="btn btn-primary"disabled>Books</a>
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
                </div> -->
                <!-- end of boxes -->
                <!-- table -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="container-fluid recent-borrowed mt-4">
                                <h2 class="pt-3">Recent Borrowed Books</h2>
                                <div class="container table-borrwed mt-5">
                                    <table id="example" class="table table-striped  mb-5">
                                        <thead>
                                            <tr>
                                                <th>Book</th>
                                                <th>Department</th>
                                                <th>Status</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                            
                                            foreach($result5 as $row5){
                                            ?>
                                            <tr>
                                                <td><?=$row5['Title']?></td>
                                                <td><?=$row5['CourseYear']?></td>
                                                <td><?=$row5['Status']?></td>     
                                            </tr>
                                            <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="container mt-4 chart">
                                <h3 class="pt-3">Overview</h3>
                                <canvas id="lineChart"></canvas>
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
    <!--  -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/chart.js"></script>
    <script src="../assets/js/datatable.js"></script>
    
    



</body>

</html>