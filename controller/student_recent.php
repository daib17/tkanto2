<?php
require_once("src/student_functions.php");

// Get login name from session
$student = (isset($_SESSION['login'])) ? $_SESSION['login'] : "ninas";

$logTable = getRecentActivity($db, $student);
