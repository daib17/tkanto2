<?php

// Unset all of the session variables.
$_SESSION = array();

//
// // If it's desired to kill the session, also delete the session cookie.
// // Note: This will destroy the session, and not just the session data!
// if (ini_get("session.use_cookies")) {
//     $params = session_get_cookie_params();
//     setcookie(session_name(), '', time() - 42000,
//         $params["path"], $params["domain"],
//         $params["secure"], $params["httponly"]
//     );
// }
//
// // Finally, destroy the session.
// session_destroy();

// Start new session
// if (session_status() < 2) {
//     $started = "yes";
// }


if (isset($_GET['username'])) {
    $_SESSION['login'] = $_GET['username'];
    if ($_GET['username'] == "admin") {
        header("Location: ?route=admin_students_1");
        exit();
    }
    // Redirect
    header("Location: ?route=student_calendar");
    exit();
}
