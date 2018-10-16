<?php
require_once("src/admin_functions.php");

$filter = isset($_GET['filter']) ? $_GET['filter'] : 2;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

if (isset($_GET['studentID'])) {
    $studentID = $_GET['studentID'];
    $infoMsg = "hidden";
} else {
    $studentID = -1;
    $editButton = "hidden";
}

if (isset($_GET['search'])) {
    $search = (strlen($_GET['search']) > 2) ? $_GET['search'] : "";
} else {
    $search = "";
}

// Spinner
$select = getSpinnerFilter($filter);

// Generate student table
$studentTable = getStudentListAsTable($db, $filter, $page, $studentID, $search);

// pagination
$pagination = getPagination($db, $filter, $page, $search);
