<?php
include("../core/config.php");

// Get parameters from DataTables
$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value']; // Search value

// Total records
$totalQuery = "SELECT COUNT(*) as total FROM book";
$totalResult = mysqli_query($con, $totalQuery);
$totalRecords = mysqli_fetch_assoc($totalResult)['total'];

// Base query with optional search
$baseQuery = "SELECT Id, Title, Department, Name, Author, Copy_date, No_copies, Isbn, Book_No, Category, Author_num, Publisher, Acc_num
              FROM book
              INNER JOIN category ON book.Category = category.cat_ID";

if (!empty($searchValue)) {
    $baseQuery .= " WHERE 
                    Title LIKE '%$searchValue%' OR 
                    Department LIKE '%$searchValue%' OR 
                    Name LIKE '%$searchValue%' OR 
                    Author LIKE '%$searchValue%' OR 
                    Isbn LIKE '%$searchValue%'";
}

// Total filtered records
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
        $row['Department'],
        $row['Name'],
        $row['Author'],
        $row['Copy_date'],
        $row['No_copies'],
        $row['Isbn'],
        "<button class='btn btn-sm edit-btn' data-id='{$row['Id']}' data-title='{$row['Title']}' 
                data-department='{$row['Department']}' data-subject='{$row['Category']}' data-author='{$row['Author']}'
                data-copyright='{$row['Copy_date']}' data-copies='{$row['No_copies']}' data-isbn='{$row['Isbn']}' data-bookno='{$row['Book_No']}'
                data-authnum='{$row['Author_num']}' data-publisher='{$row['Publisher']}' data-accnum='{$row['Acc_num']}'>
                <i class='fa-regular fa-pen-to-square' style='color: #0a58ca;' ></i>
         </button>
         
             <a href='viewBook.php?id={$row['Id']}' class='btn btn-sm'>
                 <i class='fa-solid fa-eye' style='color: #0a58ca;'></i>
            </a>"
        
    ];
}

// Return JSON response
$response = [
    "draw" => intval($draw),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalFilteredRecords,
    "data" => $data,
];
echo json_encode($response);
