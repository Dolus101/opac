<?php
session_start(); 
include("../core/function.php"); 
 

if (isset($_POST['login'])) {
    include("../core/config.php"); 
  
    $email = $_POST['email'];
    $password = $_POST['pass'];
    

    $sql = "SELECT * FROM aspnetusers WHERE `Email` = '$email' AND `Password` = '$password'";
    $query = $con->query($sql); 
    $row = $query->fetch_array(); 

    
    if ($query->num_rows != 0) {
        $_SESSION['Id'] = $row['Id']; 
       
        if ($row['UserType'] == 'Admin') { 
            @header("Location: ../admin/index.php"); 
            exit();
        }
    } else {
        // User not found or password is incorrect
        $_SESSION['status'] = "Wrong username or password!";
        header('location: ../index.php'); 
        exit(); 
    }
}
?>
