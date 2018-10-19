<?php
require_once("src/student_functions.php");

// Get login name from session
$student = (isset($_SESSION['login'])) ? $_SESSION['login'] : "ninas";

// Toggle between panels A and B
$hidePanelA = "";
$hidePanelB = "hidden";
if (isset($_GET["hidePanel"])) {
    if ($_GET["hidePanel"] == "A") {
        $hidePanelA = "hidden";
        $hidePanelB = "";
    }
}

// selDate is the selected date in the calendar
// date is the month/year being show (day is irrelevant here)
$selHour = "";
$selDate = "";
$buttonLabel = "";
$buttonType = "hidden";
if (isset($_GET['selDate'])) {
    $selDate = $_GET['selDate'];
    $date = $selDate;
    if (isset($_GET['selHour'])) {
        $selHour = $_GET['selHour'];
        if (isset($_GET['statusLabel'])) {
            if ($_GET['statusLabel'] == "booked") {
                $buttonLabel = "Cancel";
                $buttonType = "btn-danger";
            } elseif ($_GET['statusLabel'] == "available") {
                $buttonLabel = "Book";
                $buttonType = "btn-info";
            }
        }
    }
    $selHour = (isset($_GET['selHour'])) ? $_GET['selHour'] : "";
} elseif (isset($_GET['date'])) {
    $date = $_GET['date'];
} else {
    $date = date('Y-m-d');   // today
    $selDate = $date;
}

// Book selected time?
if (isset($_GET['button']) && $_GET['button'] == "Book") {
    doBooking($db, $selDate, $selHour, $student);
}

// Cancel a booking?
if (isset($_GET['button']) && $_GET['button'] == "Cancel") {
    cancelBooking($db, $selDate, $selHour, $student);
}

// Calendar header
$headMonth = date("n", strtotime($date));
$headYear = date("Y", strtotime($date));

// Calendar header
$headMonth = date("n", strtotime($date));
$headYear = date("Y", strtotime($date));

if (isset($_GET['changeMonth'])) {
    if ($_GET['changeMonth'] == ">>") {
        if ($headMonth == 12) {
            $headMonth = 1;
            $headYear++;
        } else {
            $headMonth++;
        }
    } else {
        if ($headMonth == 1) {
            $headMonth = 12;
            $headYear--;
        } else {
            $headMonth--;
        }
    }
    // Update month and year to show
    $date = $headYear . "-" . $headMonth . "-" . "01";
}

// Month name and year for table header
$monthName = date("F", strtotime($date));
$year = date("Y", strtotime($date));

$calendarTable = getMonthCalendar($db, $date, $selDate, $student);
$dayTable = getDayCalendar($db, $student, $selDate, $selHour);

// Extract day, month and year from selected day for day table header
$daySel = date("j", strtotime($selDate));
$monthSel = date("M", strtotime($selDate));
$yearSel = date("Y", strtotime($selDate));
