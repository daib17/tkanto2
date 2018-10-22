<?php
require_once("src/student_functions.php");

// Get login name from session
$student = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;

// Toggle between panels A and B
$hidePanelA = "";
$hidePanelB = "hidden";
if (isset($_POST["hidePanel"])) {
    if ($_POST["hidePanel"] == "A") {
        $hidePanelA = "hidden";
        $hidePanelB = "";
    }
}

// selDate is the selected date in the calendar
// date is the month/year being show (day is irrelevant here)
$today = date("Y-m-d");
$selHour = "";
$selDate = "";
$buttonLabel = "";
$buttonType = "hidden";
if (isset($_POST['selDate'])) {
    $selDate = $_POST['selDate'];
    $date = $selDate;
    if (isset($_POST['selHour'])) {
        $selHour = $_POST['selHour'];
        if (isset($_POST['statusLabel']) && $selDate >= $today) {
            if ($_POST['statusLabel'] == "booked") {
                $buttonLabel = "Cancel";
                $buttonType = "btn-danger";
            } elseif ($_POST['statusLabel'] == "available") {
                $buttonLabel = "Book";
                $buttonType = "btn-info";
            }
        }
    }
    $selHour = (isset($_POST['selHour'])) ? $_POST['selHour'] : "";
} elseif (isset($_POST['date'])) {
    $date = $_POST['date'];
} else {
    $date = date('Y-m-d');   // today
    $selDate = $date;
}

// Book selected time?
if (isset($_POST['button']) && $_POST['button'] == "Book") {
    doBooking($db, $selDate, $selHour, $student);
}

// Cancel a booking?
if (isset($_POST['button']) && $_POST['button'] == "Cancel") {
    cancelBooking($db, $selDate, $selHour, $student);
}

// Calendar header
$headMonth = date("n", strtotime($date));
$headYear = date("Y", strtotime($date));

// Calendar header
$headMonth = date("n", strtotime($date));
$headYear = date("Y", strtotime($date));

if (isset($_POST['changeMonth'])) {
    if ($_POST['changeMonth'] == ">>") {
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
