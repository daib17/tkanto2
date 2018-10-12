<?php
// require_once("src/student_functions.php");
require_once("src/admin_functions.php");

if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

// Copy template to next day?
if (isset($_GET['copy'])) {
    copyTemplate($db, $date);
}

// Day of the week
$dayOfWeek = date("l", strtotime($date));

// Prev and Next arrow buttons on header
if (isset($_GET['changeDate'])) {
    $date = new DateTime($date);
    if ($_GET['changeDate'] == ">>") {
        $date->modify("+1 day");
    } else {
        $date->modify("-1 day");
    }
    $date = $date->format("Y-m-d");
}

// Selected hour label from table
if (isset($_GET['hourLabel'])) {
    // Remove (admin) from  "13.30 (admin)"
    $hourStr = explode(" ", $_GET['hourLabel'])[0];
} else {
    $hourStr = "";
}

// Generate array (0 to 27) of Hour objects for selected date from DB
$hourArr = generateHourArrayFromDB($db, $date);

// Copy template to next day?
if (isset($_GET['button']) && $_GET['button'] == "copy") {
    copyTemplate($db, $date, $hourArr);
}

// Parameter sent by admin.js via URL parameters means spinner changed
if (isset($_GET['spinTime'])) {
    $spin = $_GET['spinTime'];
    $student = "admin";
    $hoursArray = updateDatabaseCalendar($db, $hourArr, $date, $student, $hourStr, $spin);
}

// Get spinner for the selected hour
$spinner = getSpinnerForSelectedHour($db, $hourArr, $hourStr);

// Get table
$hoursTable = getHoursTable($db, $date, $hourArr, $hourStr);
