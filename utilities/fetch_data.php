<?php
include("../core/config.php");

$sql = "SELECT book.Title, book_borrowed.Date_borrowed, book_borrowed.Date_returned, book_borrowed.Status, aspnetusers.Firstname, aspnetusers.LastName 
        FROM book_borrowed 
        INNER JOIN book ON book_borrowed.Book_id = book.ID 
        INNER JOIN aspnetusers ON book_borrowed.Student_id = aspnetusers.Id";
        
$result = mysqli_query($con, $sql);

$data = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>
