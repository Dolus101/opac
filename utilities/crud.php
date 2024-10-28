<?php
session_Start();

include("../core/config.php");


// ------------------------------ SUBJECT BEGIN -------------------------------
if(isset($_POST['add_subj'])){
    $name = $_POST['name_subj'];


    $sql = "INSERT INTO category(Name) VALUES ('$name')";
    if(mysqli_query($con,$sql)){
        $_SESSION['status'] = "Successfully Added";
        header('location: ../admin/subject.php');
    }else{
        $_SESSION['status1'] = "Failed to Add";
        header('location: ../admin/subject.php');
    }
}


if(isset($_POST['edit_subj'])){
    $name = $_POST['name_subj'];
    $id = $_POST['id'];


    $sql = "UPDATE category SET Name = '$name' WHERE ID = '$id'";
    if(mysqli_query($con,$sql)){
        $_SESSION['status'] = "Successfully Edited";
        header('location: ../admin/subject.php');
    }else{
        $_SESSION['status1'] = "Failed to edit";
        header('location: ../admin/subject.php');
    }
}

// ------------------------------ SUBJECT END -------------------------------

// ------------------------------ THESIS BEGIN -------------------------------
if(isset($_POST['add_thesis'])){
    $title = $_POST['title'];
    $book_num = $_POST['book_num'];
    $author_num = $_POST['author_num'];
    $date = $_POST['date'];
    $year = date('Y', strtotime($date));

    $sql="INSERT INTO thesis (Title, Book_num, Author_num, Date) VALUES ('$title', '$book_num', '$author_num', '$year')";
    if(mysqli_query($con,$sql)){
        $_SESSION['status'] = "Successfully Added Thesis";
        header('location: ../admin/thesis.php');
    }else{
        $_SESSION['status1'] = "Failed to Add Thesis";
        header('location: ../admin/thesis.php');
    }

}


if(isset($_POST['edit_thesis'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $book_num = $_POST['book_num'];
    $author_num = $_POST['author_num'];
    $date = $_POST['date'];
    $year = date('Y', strtotime($date));

    $sql = "UPDATE thesis SET Title = '$title', Book_num = '$book_num', Author_num = '$author_num', Date = '$year' WHERE id = '$id'";
    if(mysqli_query($con,$sql)){
        $_SESSION['status'] = "Successfully Edited Thesis";
        header('location: ../admin/thesis.php');
    }else{
        $_SESSION['status1'] = "Failed to Edited Thesis";
        header('location: ../admin/thesis.php');
    }
}

if(isset($_POST['del_thesis'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM thesis WHERE id = '$id'";
    if(mysqli_query($con,$sql)){
        $_SESSION['status'] = "Successfully Deleted Thesis";
        header('location: ../admin/thesis.php');
    }else{
        $_SESSION['status1'] = "Failed to Deleted Thesis";
        header('location: ../admin/thesis.php');
    }
}












?>