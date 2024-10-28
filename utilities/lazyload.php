<?php
include("../core/config.php");

// Get DataTables request parameters
$draw = intval($_POST['draw']);
$start = intval($_POST['start']);
$length = intval($_POST['length']);
$searchValue = $_POST['search']['value']; // Search term
$orderColumnIndex = $_POST['order'][0]['column']; // Column index to sort
$orderDirection = $_POST['order'][0]['dir']; // Sort direction (asc or desc)

// Array of columns for sorting
$columns = array('Title', 'Department', 'Name', 'Author', 'Copy_date', 'No_copies', 'Isbn');

// Query to get the total number of records without filtering
$totalRecordsQuery = "SELECT COUNT(*) as total FROM book INNER JOIN category ON book.Category = category.ID";
$totalRecordsResult = mysqli_query($con, $totalRecordsQuery);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];

// Query to get the total number of records with filtering
$searchQuery = "";
if (!empty($searchValue)) {
    $searchQuery = " WHERE Title LIKE '%$searchValue%' 
                     OR Department LIKE '%$searchValue%' 
                     OR Name LIKE '%$searchValue%' 
                     OR Author LIKE '%$searchValue%' 
                     OR Copy_date LIKE '%$searchValue%' 
                     OR No_copies LIKE '%$searchValue%' 
                     OR Isbn LIKE '%$searchValue%'";
}

$filteredRecordsQuery = "SELECT COUNT(*) as total FROM book 
                         INNER JOIN category ON book.Category = category.ID" . $searchQuery;
$filteredRecordsResult = mysqli_query($con, $filteredRecordsQuery);
$totalFilteredRecords = mysqli_fetch_assoc($filteredRecordsResult)['total'];

// Query to get the data with filtering, ordering, and pagination
$dataQuery = "SELECT Title, Department, Name, Author, Copy_date, No_copies, Isbn
              FROM book 
              INNER JOIN category ON book.Category = category.ID" 
              . $searchQuery . 
              " ORDER BY " . $columns[$orderColumnIndex] . " " . $orderDirection . 
              " LIMIT $start, $length";

$dataResult = mysqli_query($con, $dataQuery);

// Process the data and format it for DataTables
$row = array();
while ($rowData = mysqli_fetch_assoc($dataResult)) {
    $row[] = array(
        $rowData['Title'],
        $rowData['Department'],
        $rowData['Name'],
        $rowData['Author'],
        $rowData['Copy_date'],
        $rowData['No_copies'],
        $rowData['Isbn'],
        '<button type="button" class="subject-modal" data-bs-toggle="modal" data-bs-target="#editModal">
            <i class="fa-solid fa-pen-to-square" style="color: #0a58ca;"></i>
        </button>'
    );
}

// Prepare response for DataTables
$response = array(
    "draw" => $draw,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalFilteredRecords,
    "data" => $row
);

// Send JSON response
echo json_encode($response);
?>
