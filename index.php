<?php
require "config/autoload.php";
require "config/config.php";
require "src/helper_functions.php";
// require "src/classes/Database.php";

// Global variables
// $headerAction = "Log out";
$controller = [];
$view = [];
$db = new Database();
$db->connect($databaseConfig);
// $sql = null;
// $resultset = null;

// Route
$route = getGet("route", "");

switch ($route) {
    case "":
    case "login":
        $title = "Tk | Login";
        // TODO
        // Validate username and password
        // If login ok view/student_cal.php or view/admin_students.php
        $controller = ["controller/login.php"];
        $view = ["incl/header.php", "view/login.php"];
        break;
    case "logout":
        $title = "Tk | Login";
        $controller = ["controller/login.php"];
        $view = ["incl/header.php", "view/login.php"];
    break;
    case "register":
        $title = "Tk | Register";
        $view = ["incl/header_login.php", "view/register.php"];
        break;
    case "logout":
        $title = "Tk | Logout";
        $view = ["incl/header_logout.php", "view/logout.php"];
        break;
    case "student_calendar":
        $title = "Tk | Student";
        $controller = ["controller/student_calendar.php"];
        $view = ["incl/header_logout.php", "view/student_calendar.php"];
        break;
    case "student_bookings":
        $title = "Tk | Student";
        $controller = ["controller/student_bookings.php"];
        $view = ["incl/header_logout.php", "view/student_bookings.php"];
        break;
    case "student_recent":
        $title = "Tk | Student";
        $controller = ["controller/student_recent.php"];
        $view = ["incl/header_logout.php", "view/student_recent.php"];
        break;
    case "admin_students_1":
        $title = "Tk | Admin";
        $controller = ["controller/admin_students_1.php"];
        $view = ["incl/header_logout.php", "view/admin_students_1.php"];
        break;
    case "admin_students_2":
        $title = "Tk | Admin";
        $controller = ["controller/admin_students_2.php"];
        $view = ["incl/header_logout.php", "view/admin_students_2.php"];
        break;
    case "admin_recent":
        $title = "Tk | Admin";
        $controller = ["controller/admin_recent.php"];
        $view = ["incl/header_logout.php", "view/admin_recent.php"];
        break;
    case "admin_calendar_1":
        $title = "Tk | Admin";
        $controller = ["controller/admin_calendar_1.php"];
        $view = ["incl/header_logout.php", "view/admin_calendar_1.php"];
        break;
    case "admin_calendar_2":
        $title = "Tk | Admin";
        $controller = ["controller/admin_calendar_2.php"];
        $view = ["incl/header_logout.php", "view/admin_calendar_2.php"];
        break;
    case "admin_stats":
        $title = "Tk | Admin";
        $controller = ["controller/admin_stats.php"];
        $view = ["incl/header_logout.php", "view/admin_stats.php"];
        break;
}

// Controller
foreach ($controller as $value) {
    require $value;
}

// Render view
foreach ($view as $value) {
    require $value;
}
require "incl/footer.php";
