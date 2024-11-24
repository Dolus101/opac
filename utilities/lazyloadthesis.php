<?php
include("../core/config.php");

// Get parameters from DataTables
$draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
$start = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;
$searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

// Total records in the thesis table
$totalQuery = "SELECT COUNT(*) as total FROM thesis";
$totalResult = mysqli_query($con, $totalQuery);
$totalRecords = mysqli_fetch_assoc($totalResult)['total'];

// Base query to fetch thesis data with optional search filtering
$baseQuery = "SELECT Id, Title, Book_num, Author_num, Date FROM thesis";

if (!empty($searchValue)) {
    $baseQuery .= " WHERE 
                    Title LIKE '%$searchValue%' OR 
                    Book_num LIKE '%$searchValue%' OR 
                    Author_num LIKE '%$searchValue%' OR 
                    Date LIKE '%$searchValue%'";
}

// Total records after filtering
$filteredQuery = "SELECT COUNT(*) as total FROM ($baseQuery) as filtered";
$filteredResult = mysqli_query($con, $filteredQuery);
$totalFilteredRecords = mysqli_fetch_assoc($filteredResult)['total'];

// Add pagination
$baseQuery .= " LIMIT $start, $length";
$dataResult = mysqli_query($con, $baseQuery);

// Prepare data for DataTables
$data = [];
while ($row = mysqli_fetch_assoc($dataResult)) {
    $data[] = [
        $row['Title'],
        $row['Book_num'],
        $row['Author_num'],
        $row['Date'],
        "<button class='btn btn-sm btn-primary edit-btn' 
                data-id='{$row['Id']}' data-title='{$row['Title']}' 
                data-booknum='{$row['Book_num']}' data-authornum='{$row['Author_num']}' data-date='{$row['Date']}'>
                <i class='fa-regular fa-pen-to-square'></i> 
         </button>
         <button class='btn btn-sm btn-danger delete-btn' data-id='{$row['Id']}'>
            <i class='fa-solid fa-trash'></i> 
         </button>"
    ];
}

// Return JSON response
$response = [
    "draw" => $draw,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalFilteredRecords,
    "data" => $data,
];

echo json_encode($response);
?>
