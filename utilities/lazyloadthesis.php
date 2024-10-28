<?php
session_start();
include("../core/config.php");

// Get parameters from DataTable
$draw = intval($_POST['draw']);
$row = array();
$start = $_POST['start']; // Offset
$length = $_POST['length']; // Number of records per page
$searchValue = $_POST['search']['value']; // Search value

// Query to get the total number of records
$totalRecordsQuery = "SELECT COUNT(*) as total FROM thesis";
$totalRecordsResult = mysqli_query($con, $totalRecordsQuery);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];

// Query to get the data with search functionality
$dataQuery = "SELECT Id, Title, Book_num, Author_num, Date FROM thesis";

// If there's a search value, modify the query
if (!empty($searchValue)) {
    $dataQuery .= " WHERE Title LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' 
                    OR Book_num LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' 
                    OR Author_num LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%'";
}

// Add limit clause for pagination
$dataQuery .= " LIMIT $start, $length";

$dataResult = mysqli_query($con, $dataQuery);

// Process the data and format it for DataTables
while ($rowData = mysqli_fetch_assoc($dataResult)) {
    $row[] = array(
        "Title" => $rowData['Title'],
        "Book_num" => $rowData['Book_num'],
        "Author_num" => $rowData['Author_num'],
        "Date" => $rowData['Date'],
        "Action" => '<button type="button" class="subject-modal editThesis" data-id="' . $rowData['Id'] . '" data-title="' . $rowData['Title'] . '" data-booknum="' . $rowData['Book_num'] . '" data-authornum="' . $rowData['Author_num'] . '" data-date="' . $rowData['Date'] . '" title="Edit">
                        <i class="fa-solid fa-pen-to-square" style="color: #0a58ca;"></i>
                     </button>
                     <button type="button" class="subject-modal" data-bs-toggle="modal" data-bs-target="#DelModal' . $rowData['Id'] . '" title="Delete">
                        <i class="fa-solid fa-trash" style="color: #0a58ca;"></i>
                     </button>'
    );
}

// Prepare response for DataTables
$response = array(
    "draw" => $draw,
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecords, // For simplicity, we'll use the total number of records for now
    "data" => $row
);

// Output the response in JSON format
echo json_encode($response);
?>
