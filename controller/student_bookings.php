<?php
require_once("src/student_functions.php");

// Get login name from session
$student = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;

// Actual page
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Date and time from selected item
$selDate = isset($_GET['selDate']) ? $_GET['selDate'] : "";
$selTime = isset($_GET['selTime']) ? $_GET['selTime'] : "";

// Default UI
$cancelButton = "hidden";

// Cancel booking?
if (isset($_GET['button']) && $_GET['button'] == "cancel") {
    cancelBooking($db, $selDate, $selTime, $student);
    $selDate = "";
    $selTime = "";
} elseif (isset($_GET['selDate']) && !isset($_GET['isCanceled'])) {
    $cancelButton = "";
}

// Generate student table
$bookingsTable = getBookingsList($db, $student, $page, $selDate, $selTime);

// Page navigation
$pagination = createPageNavigation($db, $student, $page);
