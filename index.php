<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- CSS BS-->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin</title>
    <style>
        .title {
            position: relative; /* Keeps the title in place */
            top: 0; /* You can adjust this if needed */
            margin-top: 20px; /* Space between title and alert */
        }
    </style>
</head>

<body>
    <div class="container logo-img float-start d-flex align-items-center">
        <div class="container logo d-flex justify-content-center">
            <img src="assets/image/crmc_logo.png" alt="">
        </div>
    </div>
    <div class="container-fluid login-form float-end">
        <!-- Alerts -->
        <div class="text-center">
            <?php if (isset($_SESSION['status'])) { ?>
                <div class="alert alert-success alert-dismissible fade show mx-auto mt-5" role="alert" style="width: 340px; border-radius: 20px;">
                    <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php unset($_SESSION['status']); } ?>

            <?php if (isset($_SESSION['status1'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show mx-auto mt-5" role="alert" style="width: 340px; border-radius: 20px;">
                    <strong>Hey!</strong> <?php echo $_SESSION['status1']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php unset($_SESSION['status1']); } ?>
        </div>

        <!-- Title -->
        <div class="container d-flex justify-content-center mt-5">
            <h1 class="title mt-5">OMNIBOOK</h1>
        </div>

        <h5 class="p-welcome text-center">Welcome back! Please login to your account.</h5>
        <div class="container form mt-5 w-75">
            <form action="utilities/login.php" method="post">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" required autocomplete="off">
                    <label for="floatingInput">Admin Email.</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="pass" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Remember Me
                        </label>
                    </div>
                    <div class="forgt-password mt-3">
                        <a href="#" class="nav-link">Forgot Password</a>
                    </div>
                </div>
                <div class="d-flex justify-content-evenly mt-5">
                    <button type="submit" name="login" class="btn btn-primary w-50">Login</button>
                    <!-- <button type="submit" name="login" class="btn btn-light w-25">Sign Up</button> -->
                </div>
            </form>
        </div>
    </div>
    <!-- JS bootstrap -->
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>
