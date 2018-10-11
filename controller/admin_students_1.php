<?php
require_once("src/admin_functions.php");

$filterId = isset($_GET['filter']) ? $_GET['filter'] : 2;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
if (isset($_GET['studentID'])) {
    $studentID = $_GET['studentID'];
    $infoMsg = "hidden";
} else {
    $studentID = -1;
    $editButton = "hidden";
}

// Spinner
$select = getSpinnerFilter($filterId);

// Generate student table
$studentTable = getStudentListAsTable($db, $filterId, $page, $studentID);

// pagination
$pagination = getPagination($db, $filterId, $page);
