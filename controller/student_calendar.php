<?php
require_once("src/student_functions.php");

// Get month and year shown in calendar
if (isset($_SESSION['month']) && isset($_SESSION['year'])) {
    $month = $_SESSION['month'];
    $year = $_SESSION['year'];
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
    $daySelected = date('Y-m-d', strtotime($year . "-" . $month . "-" . $day));
} else {
    // Restore selected day
    if (isset($_SESSION['daySelected'])) {
        $daySelected = $_SESSION['daySelected'];
    } else {
        $daySelected = date('Y-m-d');   // today
    }
}

// Get month name for number
$monthName = date("F", mktime(0, 0, 0, $month, 1, 2018));
// $calendar = new Calendar($db);
$calendarTable = getCalendarAsTable($daySelected, $month, $year);
$dayTable = getDayTable($db, $daySelected);

$_SESSION['month'] = $month;
$_SESSION['year'] = $year;
$_SESSION['daySelected'] = $daySelected;

// Extract day, month and year from selected day for day table header
$daySel = date("j", strtotime($daySelected));
$monthSel = date("M", strtotime($daySelected));
$yearSel = date("Y", strtotime($daySelected));
