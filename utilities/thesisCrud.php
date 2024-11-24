<?php
include("../core/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'edit') {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $book_num = $_POST['book_num'];
        $author_num = $_POST['author_num'];
        $date = $_POST['date'];
        $year = date('Y', strtotime($date));

        $query = "UPDATE thesis SET Title = '$title', Book_num = '$book_num', Author_num = '$author_num', Date = '$year' WHERE Id = '$id'";
        mysqli_query($con, $query);

    } elseif ($action === 'delete') {
        $id = $_POST['id'];
        $query = "DELETE FROM thesis WHERE Id = '$id'";
        mysqli_query($con, $query);
    }
}
?>
