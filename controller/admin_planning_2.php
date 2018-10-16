<?php
require_once("src/admin_functions.php");

if (isset($_GET['selDate'])) {
    $date = $_GET['selDate'];
}

// Copy template to next day?
if (isset($_GET['copy'])) {
    copyTemplate($db, $date);
}

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

// Day of the week
$dayOfWeek = date("l", strtotime($date));

// Selected hour label from table
if (isset($_GET['hourLabel']) && $_GET['hourLabel'] != "") {
    $hourStr = explode(" ", $_GET['hourLabel'])[0];     // hour
    $bookedBy = explode(" ", $_GET['hourLabel'])[1];    // name
} else {
    $hourStr = "";
    $bookedBy = "";
}

// Cancel appointment button
if ($bookedBy != "" && $bookedBy !="admin") {
    $cancelBtn = "";
} else {
    $cancelBtn = "hidden";
}

// Show spinner with list of students
if ($bookedBy == "admin") {
    $studentSpinner = getStudentSpinner();
    $hideSpinner = "";
} else {
    $studentSpinner = "";
    $hideSpinner = "hidden";
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
    updateCalendarDB($db, $hourArr, $date, $student, $hourStr, $spin);
}

// Cancel booking
if (isset($_GET['cancel'])) {
    $spin = $_GET['spinTime'];
    $student = "admin";
    updateCalendarDB($db, $hourArr, $date, $student, $hourStr, $spin);
}

// Get spinner for the selected hour
$spinner = getSpinnerForSelectedHour($db, $hourArr, $hourStr);

// Get table
$hoursTable = getHoursTable($db, $date, $hourArr, $hourStr);
