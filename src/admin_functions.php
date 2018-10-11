<?php

const ITEMS_PAGE = 5;   // Number of students per page

/**
*   Get students from database
*
*   @param int $status (0)disabled, (1)pending, (2)active, (3)all
*/
function getStudentsByStatus($db, $status = 2) {
    $sql = "SELECT * FROM student";
    if ($status < 3) {
        $sql .= " WHERE status = ?";
    }
    $res = $db->executeFetchAll($sql, [$status]);
    return $res;
}

function getStudentByID($db, $id) {
    $sql = "SELECT * FROM student WHERE id = ?";
    $res = $db->executeFetch($sql, [$id]);
    return $res;
}

function getStudentListAsTable($db, $filterId = 3, $page, $selectedID) {
    $statusStr = ["Disabled", "Pending", "Active"];
    $res = getStudentsByStatus($db, $filterId);
    $table = "";
    if ($res != null && count($res) > 0) {
        $firstID = ($page - 1) * ITEMS_PAGE; // id for first element to draw
        $lastID = $firstID + ITEMS_PAGE;
        for ($id = $firstID; $id < $lastID; $id++) {
            $table .= "<tr class='selectable'>";
            if ($id < count($res)) {
                $name = $res[$id]->firstname . "&nbsp;" . $res[$id]->lastname;
                $studentID = $res[$id]->id;
                if ($studentID == $selectedID) {
                    $selected = " selected";
                } else {
                    $selected = "";
                }

                $table .= "<td colspan=2><form method='GET'><input type='hidden' name='route' value='admin_students_1'><input type='submit' class='submit-clean" . $selected ."' name='name' value=" . $name . "><input type='hidden' name='studentID' value=" . $studentID . " /><input type='hidden' name='filter' value=" . $filterId . " /><input type='hidden' name='page' value=" . $page . " /></form></td>";
                $table .= "<td>" . $statusStr[$res[$id]->status] . "</td>";
            } else {
                $table .= "<td colspan=2>&nbsp;</td>";
                $table .= "<td><div class='empty'>Empty</div></td>";
            }
            $table .= "</tr>";
        }
    } else {
        $table = "";
        $table .= "<tr>";
        $table .= "<td colspan=4>" . "No students found." . "</td>";
        $table .= "</tr>";
    }

    return $table;
}


function getPagination($db, $filterId, $actualPage) {
    $res = getStudentsByStatus($db, $filterId);
    if ($res == null || count($res) < ITEMS_PAGE + 1) {
        return "";
    }

    $pages = ceil((count($res) / ITEMS_PAGE));
    // Pagination
    $table = "";
    $table .= "<nav>";
    $table .= "<ul class='pagination justify-content-center'>";

    for ($id = 1; $id < $pages + 1; $id++) {
        $active = $id == $actualPage ? "active" : "";
        $table .= "<form method='GET'><input type='hidden' name='route' value='admin_students_1'><input type='hidden' name='filter' value=" . $filterId . " /><li class='page-item " . $active . "'><input type='submit' class='page-link' name='page' value=" . $id . "></li></form>";
    }

    $table .= "</ul>";
    $table .= "</nav>";
    return $table;
}

function getSpinnerFilter($status) {
    $filterType = ["Disabled", "Pending", "Active", "All"];
    // Generate select spinner
    $select = "<select id='showFilter' class='form-control w-50'>";
    foreach ($filterType as $key => $value) {
        if ($key == $status) {
            $select .= "<option value='" . $key . "'selected='selected'>" . $value . "</option>";
        } else {
            $select .= "<option value='" . $key . "'>" . $value . "</option>";
        }
    }
    $select .= "</select>";
    return $select;
}

function getSpinnerStatus($status) {
    $status;    // status 0 does not exist in panel B
    $filterType = ["Disabled", "Pending", "Active"];
    // Generate select spinner
    $select = "<select name='status' class='form-control w-50'>";
    foreach ($filterType as $key => $value) {
        if ($key == $status) {
            $select .= "<option value='" . $key . "'selected='selected'>" . $value . "</option>";
        } else {
            $select .= "<option value='" . $key . "'>" . $value . "</option>";
        }
    }
    $select .= "</select>";
    return $select;
}

/**
* Get hours from database for date and convert to array.
* Array with length 28 represents hours between 8 and 21:30
* Each array cell will contain the username that booked the time or
* admin if available.
*
* @return array contains student's usernames for booked time.
*/
function getHoursFromDB($db, $date) {
    $sql = "SELECT * FROM calendar WHERE date = ?";
    $res = $db->executeFetchAll($sql, [$date]);
    $hours = [];
    for ($i = 0; $i < 28; $i++) {
        $hours[] = "";
    }
    foreach ($res as $row) {
        $id = (((int)($row->time / 100)) - 8) * 2;
        if ($row->time % 100 != 0) {
            $id++;
        }
        $hours[$id] = $row->student;
    }
    return $hours;
}

/**
* ADMIN - Planning
* Create dynamic spinner for selected date and hour
*
* @param db database
* @param array $arr array [0, 27] usernames with booked hours
* @param string selected hour "13:30"
* @param string selected date "Y-m-d"
*
* @return string html code for spinner
*/
function getSpinnerForSelectedHour($db, $arr, $hour, $date) {
    // Convert string time to integer
    if ($hour != "") {
        $str = explode(":", $hour);
        $time = (int)$str[0] * 100 + (int)$str[1];
        // Get id in array for given hour
        $id = (((int)($time / 100)) - 8) * 2;
        if ($time % 100 != 0) {
            $id++;
        }
    }

    // Return if no hour has been selected yet or no admin time
    if ($hour == "") {
        $spinHTML = "<select id='spinner' class='form-control w-50' disabled>";
        $spinHTML .= "<option value='0'>0</option>";
        $spinHTML .= "<option value='30'>30</option>";
        $spinHTML .= "<option value='60'>60</option>";
        $spinHTML .= "</select>";
        return $spinHTML;
    }

    // Check database
    $sql = "SELECT * FROM calendar WHERE date = ? AND time = ?";
    $res = $db->executeFetch($sql, [$date, $time]);
    // Get length of booking in minutes from DB
    $len = $res ? $res->length : 0;

    if ($arr[$id] != "admin" && $arr[$id] != "") {
        $spinHTML = "<select id='spinner' class='form-control w-50' disabled>";
        $spinHTML .= "<option value=''>{$len}</option>";
        $spinHTML .= "</select>";
        return $spinHTML;
    }

    $spinHTML = "<select id='spinner' class='form-control w-50'>";
    if ($len == 0) {
        $spinHTML .= "<option value='0' selected>0</option>";
    } else {
        $spinHTML .= "<option value='0'>0</option>";
    }

    if ($len == 30 ) {
        $spinHTML .= "<option value='30' selected>30</option>";
    } else {
        $spinHTML .= "<option value='30'>30</option>";
    }
    // Check if next slot is available
    if ($id > -1 && $id < 27) {
        if ($arr[$id + 1] == "" || ($arr[$id] == "admin" &&
            ($arr[$id + 1] == "" || $arr[$id + 1] == "+"))) {
                if ($len == 60) {
                    $spinHTML .= "<option value='60' selected>60</option>";
                } else {
                    $spinHTML .= "<option value='60'>60</option>";
                }
            }
    }

    $spinHTML .= "</select>";
    return $spinHTML;
}

function getHoursTable($db, $date, $arr, $hourSelected) {
    $table = "";
    $id = 0;
    for ($row = 0; $row < 7; $row++) {
        $table .= "<tr>";
        for ($id = $row * 4; $id < ($row * 4) + 4; $id++) {
            // Booked by label
            $bookedBy = $arr[$id] ? "($arr[$id])": "";
            $color = "";
            // Time label
            $hour = (int)($id / 2) + 8;
            $half = ($id % 2 == 1) ? ":30" : ":00";
            $time = $hour . $half;
            // Background color for cell
            if (substr($bookedBy, -2) == "+)") {
                $table .= "<td><input id='h{$id}' type='submit' class='button disabled' name='hourSelected' value='' /></td>";
            } else {
                if ($hourSelected == $time) {
                    $color = "selected";
                } elseif ($bookedBy == "(admin)") {
                    $color = "admin-color";
                } elseif ($bookedBy != "") {
                    $color = "student-color";
                }
                $table .= "<td><input id='h{$id}' type='submit' class='button {$color}' name='hourSelected' value='{$time} {$bookedBy}' /></td>";
            }
        }
        $table .= "</tr>";
    }

    return $table;
}

/**
* Insert or update calendar database with new value from Spinner
*
* @return array updated $hoursArray
*/
function updateDatabaseCalendar($db, $date, $studentID, $student, $hourStr, $spin) {
    // Convert hour "11:30" to integer 1130
    $val = explode(":", $hourStr);
    $hour = $val[0] * 100 + $val[1];
    // Check if entry already exists
    $sql = "SELECT * FROM calendar WHERE date = ? AND time = ?;";
    $res = $db->executeFetch($sql, [$date, $hour]);

    // Insert and return if not in database
    // TODO: check if 30 or 60 before inserting!!!!!
    if (!$res) {
        $sql = "INSERT INTO calendar (date, student_id, student, time, length) VALUES (?, ?, ?, ?, ?);";
        $db->execute($sql, [$date, $studentID, $student, $hour, $spin]);
        return;
    }
    //
    // // Return if database already has right value
    // if (($spin == 0 && $res->length == 0) ||
    //     ($spin == 30 && $res->length == 30) ||
    //     ($spin == 60 && $res->length == 60)){
    //     return;
    // }
    //
    // // Update
    // $sql = "UPDATE calendar SET length = ? WHERE date = ? AND time = ?;";
    // $db->execute($sql, [$date, $hour]);

    // Redirect
    header("Location: ?route=admin_planning_2&dateSelected=$date");
}



// function getUsername($firstname, $lastname) {
//     try {
//         $sql = "SELECT * FROM student WHERE firstname = ? AND lastname = ?";
//         $params = [$firstname, $lastname];
//         $stmt = $db->prepare($sql);
//         $stmt->execute($params);
//         $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//         if ($res != null & count($res) == 1) {
//             return $res[0];
//         } else {
//             throw new Exception("null or more than one.");
//         }
//         return $res;
//     } catch (Exception $e) {
//         echo $e->getMessage();
//         return null;
//     }
// }
