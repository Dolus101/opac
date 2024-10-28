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
</head>

<body>
    <div class="container-fluid login-form float-end">
        <div class="contianer d-flex justify-content-center mt-5">
            <h1 class="title mt-5"> OMNIBOOK </h1>
        </div>
        <h5 class="p-welcome text-center">Welcome back! Please login to your account.</h5>
        <div class="container form mt-5 w-75">
            <form action="utilities/login.php" method="post">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Admin Email.</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="pass" id="floatingPassword" placeholder="Password">
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
                <button type="submit" name="login" class="btn btn-primary w-25">Login</button>
            </div>
            </form>
        </div>
    </div>
    <!-- JS bootstrap -->
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>