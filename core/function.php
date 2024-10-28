<?php
include("config.php");

function check_login($con)
{

    if(isset($_SESSION['Id']))
    {
        $Id = $_SESSION['Id'];
        $query = "SELECT * FROM aspnetusers WHERE Id = '$Id' LIMIT 1";

        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    header("Location: ../index.php");
    die;
}
