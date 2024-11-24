<?php
include("../core/config.php");

// Sanitize input
$bookId = mysqli_real_escape_string($con, $_POST['bookId']);
$title = mysqli_real_escape_string($con, $_POST['title']);
$department = mysqli_real_escape_string($con, $_POST['department']);
$subject = mysqli_real_escape_string($con, $_POST['subject']);
$bookNo = mysqli_real_escape_string($con, $_POST['bookNo']);
$author = mysqli_real_escape_string($con, $_POST['author']);
$authNum = mysqli_real_escape_string($con, $_POST['authNo']);
$copyright = mysqli_real_escape_string($con, $_POST['copyright']);
$publisher = mysqli_real_escape_string($con, $_POST['publisher']);
$accNum = mysqli_real_escape_string($con, $_POST['accNo']);
$copies = mysqli_real_escape_string($con, $_POST['noCopy']);
$isbn = mysqli_real_escape_string($con, $_POST['isbn']);

// Validate bookId
if (!is_numeric($bookId)) {
    echo "Invalid book ID.";
    exit();
}

// Update query
$query = "UPDATE book SET 
            Title='$title', 
            Department='$department', 
            Category='$subject', 
            Book_no='$bookNo', 
            Author='$author', 
            Author_num='$authNum', 
            Copy_date='$copyright', 
            No_copies='$copies', 
            Isbn='$isbn', 
            Publisher='$publisher', 
            Acc_num='$accNum' 
          WHERE Id=$bookId";

if (mysqli_query($con, $query)) {
    echo "Success";
} else {
    echo "Error: " . mysqli_error($con);
}
?>
