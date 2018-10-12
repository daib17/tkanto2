<?php
require_once("src/admin_functions.php");

// Get month and year shown in calendar
if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
} else {
    $month = date('n');
    $year = date('Y');
}

// Prev/Next month clicked?
if (isset($_GET['changeMonth'])) {
    if ($_GET['changeMonth'] == ">>") {
        if ($month == 12) {
            $month = 1;
            $year++;
        } else {
            $month++;
        }
    } else {
        if ($month == 1) {
            $month = 12;
            $year--;
        } else {
            $month--;
        }
    }
}

// New day selected?
if (isset($_GET['day'])) {
    $day = $_GET['day'];
    $date = date('Y-m-d', strtotime($year . "-" . $month . "-" . $day));
} else {
    // Restore selected day
    if (isset($_GET['date'])) {
        $date = $_GET['date'];
    } else {
        $date = date('Y-m-d');   // today
    }
}

// Get month name for number
$monthName = date("F", mktime(0, 0, 0, $month, 1, 2018));
// $calendar = new Calendar($db);
$calendarTable = getAdminCalendarAsTable($db, $date, $month, $year);

// Extract day, month and year from selected day for day table header
$daySel = date("j", strtotime($date));
$monthSel = date("M", strtotime($date));
$yearSel = date("Y", strtotime($date));
