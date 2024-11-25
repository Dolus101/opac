<?php
session_Start();

include("../core/config.php");


// ------------------------------ SUBJECT BEGIN -------------------------------
if (isset($_POST['add_subj'])) {
    $name = $_POST['name_subj'];


    $sql = "INSERT INTO category(Name) VALUES ('$name')";
    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "Successfully Added";
        header('location: ../admin/subject');
    } else {
        $_SESSION['status1'] = "Failed to Add";
        header('location: ../admin/subject');
    }
}


if (isset($_POST['edit_subj'])) {
    $name = $_POST['name_subj'];
    $id = $_POST['id'];


    $sql = "UPDATE category SET Name = '$name' WHERE ID = '$id'";
    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "Successfully Edited";
        header('location: ../admin/subject');
    } else {
        $_SESSION['status1'] = "Failed to edit";
        header('location: ../admin/subject');
    }
}

// ------------------------------ SUBJECT END -------------------------------

// ------------------------------ THESIS BEGIN -------------------------------
if (isset($_POST['add_thesis'])) {
    $title = $_POST['title'];
    $book_num = $_POST['book_num'];
    $acc_num = $_POST['acc_num'];
    $author_name = $_POST['author_name'];
    $author_num = $_POST['author_num'];
    $category = $_POST['category'];
    $date = $_POST['date'];
    $year = date('Y', strtotime($date));

    $sql = "INSERT INTO thesis (Title, Acc_num, Book_num, Author, Author_num, Category, Date) 
    VALUES ('$title', '$acc_num', '$book_num', '$author_name', '$author_num', '$category', '$year')";
    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "Successfully Added Thesis";
        header('location: ../admin/thesis');
    } else {
        $_SESSION['status1'] = "Failed to Add Thesis";
        header('location: ../admin/thesis');
    }
}


if (isset($_POST['edit_thesis'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $book_num = $_POST['book_num'];
    $author_num = $_POST['author_num'];
    $date = $_POST['date'];
    $year = date('Y', strtotime($date));

    $sql = "UPDATE thesis SET Title = '$title', Book_num = '$book_num', Author_num = '$author_num', Date = '$year' WHERE id = '$id'";
    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "Successfully Edited Thesis";
        header('location: ../admin/thesis');
    } else {
        $_SESSION['status1'] = "Failed to Edited Thesis";
        header('location: ../admin/thesis');
    }
}

if (isset($_POST['del_thesis'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM thesis WHERE id = '$id'";
    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "Successfully Deleted Thesis";
        header('location: ../admin/thesis');
    } else {
        $_SESSION['status1'] = "Failed to Deleted Thesis";
        header('location: ../admin/thesis');
    }
}

// ------------------------------- ADD BOOK ---------------------------------

if (isset($_POST['add_book'])) {
    $title = $_POST['title'];
    $department = $_POST['department'];
    $category = $_POST['category'];
    $bookNo = $_POST['bookNo'];
    $author = $_POST['author'];
    $authNo = $_POST['authNo'];
    $copyright = $_POST['copyright'];
    $publisher = $_POST['publisher'];
    $accNo = $_POST['accNo'];
    $isbn = $_POST['isbn'];
    $noCopy = $_POST['noCopy'];

    $sql = "INSERT INTO book (Title, Author, Book_No, Acc_num, Publisher, Copy_date, Isbn, No_Copies, Category, AvailableCopies, Author_num, Department)
    VALUES ('$title', '$author', '$bookNo', '$accNo', '$publsiher', '$copyright', '$isbn', '$noCopy', '$category', '$noCopy', '$authNo', '$department')";

    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "Successfully Added Book";
        header('location: ../admin/books');
    } else {
        $_SESSION['status1'] = "Failed to Add Book";
        header('location: ../admin/books');
    }
}
// ------------------------------- End add BOOK ---------------------------------

// ------------------------------- ADD User ---------------------------------

if (isset($_POST['add_users'])) {
    $school_id = $_POST['school_id'];
    $usertype = $_POST['userType'];

    $sql = "INSERT INTO id_verifier(school_id,user_type) VALUES ('$school_id','$usertype')";
    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "Successfully Added User";
        header('location: ../admin/users');
    } else {
        $_SESSION['status1'] = "Failed to Add User";
        header('location: ../admin/users');
    }
}

// ------------------------------- End add user ---------------------------------
// ------------------------------- add Content ---------------------------------

if (isset($_POST['add_content'])) {
    $content = $_POST['content'];
    $page = $_POST['page'];
    $bookId = $_POST['book_id'];

    $sql = "INSERT INTO topic(Book,Name,Page) VALUES ('$bookId','$content','$page')";
    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "Successfully Added Content";
        header("location: ../admin/viewbook.php?id=$bookId");
    } else {
        $_SESSION['status1'] = "Failed to Add Cotent";
        header("location: ../admin/viewbook.php?id=$bookId");
    }
}

if (isset($_POST['edit_content'])) {
    $content = $_POST['content'];
    $page = $_POST['page'];
    $Id = $_POST['id'];
    $bookId = $_POST['book_id'];


    $sql = "UPDATE topic SET Name = '$content', Page = '$page' WHERE ID = '$Id'";
    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "Successfully Added Content";
        header("location: ../admin/viewbook.php?id=$bookId");
    } else {
        $_SESSION['status1'] = "Failed to Add Cotent";
        header("location: ../admin/viewbook.php?id=$bookId");
    }
}

if (isset($_POST['del_content'])) {

    $Id = $_POST['id'];
    $bookId = $_POST['book_id'];


    $sql = "DELETE FROM topic WHERE ID = '$Id'";
    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "Successfully Added Content";
        header("location: ../admin/viewbook.php?id=$bookId");
    } else {
        $_SESSION['status1'] = "Failed to Add Cotent";
        header("location: ../admin/viewbook.php?id=$bookId");
    }
}
// ------------------------------- End add Content ---------------------------------
// ------------------------------- Booking ---------------------------------
if (isset($_POST['Accept'])) {
    $id = $_POST['id'];
    $student_id = $_POST['student_id'];
    $book_id = $_POST['book_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];




    $sql = "UPDATE book_reservation SET Status = '$status' WHERE Id = '$id'";
    $query = "INSERT INTO book_borrowed (Student_id, Book_id, Date_borrowed, Status) VALUES
    ('$student_id', '$book_id', '$date', 'Borrowed')";
    mysqli_query($con, $query);

    if (mysqli_query($con, $sql)) {
        header("location: ../admin/borrow_confirmation");
    } else {
        header("location: ../admin/borrow_confirmation");
    }
}


if (isset($_POST['Reject'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];


    $sql = "UPDATE book_reservation SET Status = '$status' WHERE Id = '$id'";

    if (mysqli_query($con, $sql)) {
        header("location: ../admin/borrow_confirmation");
    } else {
        header("location: ../admin/borrow_confirmation");
    }
}