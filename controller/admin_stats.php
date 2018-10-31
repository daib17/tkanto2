<?php
require_once("src/admin_functions.php");

$actualMonth = date('n');
$actualYear = date('o');

$fromDay = (isset($_GET["fromDay"])) ? $_GET["fromDay"] : 1;
$toDay = (isset($_GET["toDay"])) ? $_GET["toDay"] : 31;
$fromMonth = (isset($_GET["fromMonth"])) ? $_GET["fromMonth"] : $actualMonth;
$fromYear = (isset($_GET["fromYear"])) ? $_GET["fromYear"] : $actualYear;
$toMonth = (isset($_GET["toMonth"])) ? $_GET["toMonth"] : $actualMonth;
$toYear = (isset($_GET["toYear"])) ? $_GET["toYear"] : $actualYear;
$student = (isset($_GET["student"])) ? $_GET["student"] : "all";
$limit = (isset($_GET["limit"])) ? $_GET["limit"] : 10;

$selList = $selLimit20 = $selLimit30 = "";
if (isset($_GET["type"])) {
    $type = $_GET["type"];
    $selList = ($type == "list") ? "selected" : "";
}

if (isset($_GET["limit"])) {
    $selLimit20 = ($_GET["limit"] == 20) ? "selected" : "";
    $selLimit30 = ($_GET["limit"] == 30) ? "selected" : "";
}

$spinnerDayFrom = getDayListSpinner($fromDay);
$spinnerDayTo = getDayListSpinner($toDay);
$spinnerMonthFrom = getMonthListSpinner($fromMonth);
$spinnerMonthTo = getMonthListSpinner($toMonth);
$spinnerYearFrom = getYearListSpinner($db, $fromYear);
$spinnerYearTo = getYearListSpinner($db, $toYear);
$spinnerStudents = getStudentListSpinner($db, $student);


$fromDate = (new DateTime($fromYear . "-" . $fromMonth . "-" . $fromDay))->format("Y-m-d 00:00:00");
$toDate = (new DateTime($toYear . "-" . $toMonth . "-" . $toDay))->format("Y-m-d 23:59:59");

$table = "";
if (isset($_GET["button"]) && $_GET["button"] == "run") {
    if ($type == "acc") {
        $table = getStatAcc($db, $fromDate, $toDate, $student, $limit);
    } else {
        $table = getStatList($db, $fromDate, $toDate, $student, $limit);
    }
}
