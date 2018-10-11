<?php
require_once("src/admin_functions.php");

if (isset($_GET['studentID'])) {
    $studentID = $_GET['studentID'];
} else {
    $studentID = -1;
}

if (isset($_GET['button']) && $_GET['button'] == 'edit') {
    // Get student details from database
    $student = getStudentByID($db, $studentID);
    // Generate select spinner
    $select = getSpinnerStatus($student->status);
} elseif (isset($_GET['button']) && $_GET['button'] == 'save') {
    // Update database
    $id = htmlspecialchars($_GET['studentID']);
    $fname = htmlspecialchars($_GET['fname']);
    $lname = htmlspecialchars($_GET['lname']);
    $email = htmlspecialchars($_GET['email']);
    $phone = htmlspecialchars($_GET['phone']);
    $status = htmlspecialchars($_GET['status']);
    $sql = "UPDATE student SET firstname = ?, lastname = ?, email = ?, phone = ?, status = ? WHERE id = ?;";
    $db->execute($sql, [$fname, $lname, $email, $phone, $status, $id]);
    header("Location: ?route=admin_students_1");
} elseif (isset($_GET['button']) && $_GET['button'] == 'cancel') {
    header("Location: ?route=admin_students_1");
}
