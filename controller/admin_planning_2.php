<?php
require_once("src/student_functions.php");
require_once("src/admin_functions.php");


if (isset($_GET['dateSelected'])) {
    $dateSelected = $_GET['dateSelected'];
}

if (isset($_GET['hourSelected'])) {
    // Remove (admin) from  "13.30 (admin)"
    $hourSelected = explode(" ", $_GET['hourSelected'])[0];
} else {
    $hourSelected = "";
}

// Generate array (0 to 27) with timetable for selected date from DB
// TODO: could I add this code inside getHoursTable and get rid of the
// method?
$hoursArray = getHoursFromDB($db, $dateSelected);

// Parameter sent by admin.js via URL parameters means spinner changed
if (isset($_GET['spinTime'])) {
    $spin = $_GET['spinTime'];
    $studentID = 0;
    $student = "admin";
    $hoursArray = updateDatabaseCalendar($db, $dateSelected, $studentID, $student, $hourSelected, $spin);
}

// Get spinner for the selected hour
$spinner = getSpinnerForSelectedHour($db, $hoursArray, $hourSelected, $dateSelected);

// Get month name for number
// $monthName = date("F", mktime(0, 0, 0, $month, 1, 2018));
// $calendar = new Calendar($db);
$hoursTable = getHoursTable($db, $dateSelected, $hoursArray, $hourSelected);

// Extract day, month and year from selected day for day table header
$daySel = date("j", strtotime($dateSelected));
$monthSel = date("M", strtotime($dateSelected));
$yearSel = date("Y", strtotime($dateSelected));
