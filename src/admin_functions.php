<?php
// require();

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
function generateHourArrayFromDB($db, $date) {
    $hourArr = [];
    for ($i = 0; $i < 28; $i++) {
        $hourArr[] = new Hour();
    }
    $sql = "SELECT * FROM calendar WHERE date = ?";
    $res = $db->executeFetchAll($sql, [$date]);
    foreach ($res as $row) {
        // Calculate id in array for time in db (800 is 0, 2130 is 27)
        $id = (((int)($row->time / 100)) - 8) * 2;
        if ($row->time % 100 != 0) {
            $id++;
        }
        $hourArr[$id]->setStudent($row->student);
        $hourArr[$id]->setTime($row->time);
        $hourArr[$id]->setDuration($row->duration);
    }
    return $hourArr;
}

/**
* ADMIN - Planning
* Create dynamic spinner for selected date and hour
*
* @param db database
* @param array $arr array [0, 27] of Hour objects
* @param string hourStr selected "13:30"
*
* @return string html code for spinner
*/
function getSpinnerForSelectedHour($db, $arr, $hourStr) {
    // Convert string time to integer
    if ($hourStr != "") {
        $str = explode(":", $hourStr);
        $time = (int)$str[0] * 100 + (int)$str[1];
        // Get id in array for given hour
        $id = (((int)($time / 100)) - 8) * 2;
        if ($time % 100 != 0) {
            $id++;
        }
    }

    // Return if no hour has been selected yet or no admin time
    if ($hourStr == "") {
        $spinHTML = "<select id='spinner' class='form-control w-50' disabled>";
        $spinHTML .= "<option value='0'>0</option>";
        $spinHTML .= "</select>";
        return $spinHTML;
    }

    // Calculate id in array for time in db (800 is 0, 2130 is 27)
    $id = (((int)($time / 100)) - 8) * 2;
    if ($time % 100 != 0) {
        $id++;
    }

    $duration = $arr[$id]->getDuration();
    $student = $arr[$id]->getStudent();

    // Only admin and available hours are changeable
    if ($student != "admin" && $student != "") {
        $spinHTML = "<select id='spinner' class='form-control w-50' disabled>";
        $spinHTML .= "<option value=''>{$duration}</option>";
        $spinHTML .= "</select>";
        return $spinHTML;
    }

    $spinHTML = "<select id='spinner' class='form-control w-50'>";
    if ($duration == 0) {
        $spinHTML .= "<option value='0' selected>0</option>";
    } else {
        $spinHTML .= "<option value='0'>0</option>";
    }

    if ($duration == 30 ) {
        $spinHTML .= "<option value='30' selected>30</option>";
    } else {
        $spinHTML .= "<option value='30'>30</option>";
    }
    // Check if next slot is available
    if ($duration == 60) {
        $spinHTML .= "<option value='60' selected>60</option>";
    } elseif ($student == "admin") {

    }
    if ($id < 27) {
        if ($arr[$id + 1]->getDuration() == -1 || (
            $arr[$id + 1]->getStudent() == "admin" &&
            $arr[$id + 1]->getDuration() == 30
        )) {
            $spinHTML .= "<option value='60'>60</option>";
        }
    }

    $spinHTML .= "</select>";
    return $spinHTML;
}

/**
* Generate table from timetable with hours for given date.
*
* @return string html table
*/
function getHoursTable($db, $date, $hourArr, $hourLabel) {
    $table = "";
    $id = 0;
    for ($row = 0; $row < 7; $row++) {
        $table .= "<tr>";
        for ($id = $row * 4; $id < ($row * 4) + 4; $id++) {
            // Booked by label
            $bookedBy = $hourArr[$id]->getStudent();
            // $bookedBy = $hourArr[$id] ? "($hourArr[$id])": "";
            $color = "";
            // Time label
            $hour = (int)($id / 2) + 8;
            $half = ($id % 2 == 1) ? ":30" : ":00";
            $time = $hour . $half;
            // Background color for cell
            if ($hourArr[$id]->getDuration() == 0) {
                // Second 30 min slot for 60 min booking
                if ($hourArr[$id - 1]->getStudent() == "admin") {
                    $disabled = "disabled-admin";
                } else {
                    $disabled = "disabled-student";
                }
                $table .= "<td><input id='h{$id}' type='submit' class='button {$disabled}' name='hourLabel' value='' /></td>";
            } else {
                if ($time == $hourLabel) {
                    $color = "selected";
                } elseif ($bookedBy == "admin") {
                    $color = "admin-color";
                } elseif ($bookedBy != "") {
                    $color = "student-color";
                }
                $table .= "<td><input id='h{$id}' type='submit' class='button {$color}' name='hourLabel' value='{$time} {$bookedBy}' /></td>";
            }
        }
        $table .= "</tr>";
    }

    return $table;
}

/**
* Insert or update calendar database with new value from spinner.
*
* @return array updated $hoursArray
*/
function updateDatabaseCalendar($db, $arr, $date, $student, $hourStr, $spin) {
    // Convert hour "11:30" to integer 1130
    $val = explode(":", $hourStr);
    $time = $val[0] * 100 + $val[1];

    // Get array id for time (830 is 0)
    $id = (((int)($time / 100)) - 8) * 2;
    if ($time % 100 != 0) {
        $id++;
    }

    // New spin value same as old OR spin zero on available hour?
    if ($arr[$id]->getDuration() == $spin || (
        $arr[$id]->getDuration() == -1 && $spin == 0)) {
        return;
    }

    // Insert if hour not in database
    if ($arr[$id]->getStudent() == "") {
        $sql = "INSERT INTO calendar (date, student, time, duration) VALUES (?, ?, ?, ?);";
        $db->execute($sql, [$date, $student, $time, $spin]);
        // 60?
        if ($spin == 60) {
            $time = ($time % 100 == 0) ? $time += 30 : $time += 70;
            // Insert OR Update if second slot already booked by admin
            if ($arr[$id + 1]->getStudent() == "") {
                $sql = "INSERT INTO calendar (date, student, time, duration) VALUES (?, ?, ?, ?);";
                $db->execute($sql, [$date, $student, $time, 0]);
            } else {
                $sql = "UPDATE calendar SET duration = ? WHERE date = ? AND time = ?;";
                $db->execute($sql, [0, $date, $time]);
            }
        }
        // Redirect
        header("Location: ?route=admin_planning_2&date=$date");
        exit;
    }

    // Delete hours from db
    if ($spin == 0) {
        // Delete first slot
        $sql = "DELETE FROM calendar WHERE date = ? AND time = ?;";
        $db->execute($sql, [$date, $time]);
        // Delete second if exists
        if ($arr[$id]->getDuration() == 60) {
            // Delete second slot
            $time2 = ($time % 100 == 0) ? $time += 30 : $time += 70;
            $sql = "DELETE FROM calendar WHERE date = ? AND time = ?;";
            $db->execute($sql, [$date, $time2]);
        }
        
    } elseif ($spin == 30) {
        // Update first
        $sql = "UPDATE calendar SET duration = ? WHERE date = ? AND time = ?;";
        $db->execute($sql, [30, $date, $time]);
        // Delete second slot
        $time2 = ($time % 100 == 0) ? $time += 30 : $time += 70;
        $sql = "DELETE FROM calendar WHERE date = ? AND time = ?;";
        $db->execute($sql, [$date, $time2]);

    } elseif ($spin == 60) {
        // Update first
        $sql = "UPDATE calendar SET duration = ? WHERE date = ? AND time = ?;";
        $db->execute($sql, [60, $date, $time]);
        // Insert second
        $time2 = ($time % 100 == 0) ? $time += 30 : $time += 70;
        $sql = "INSERT INTO calendar (date, student, time, duration) VALUES (?, ?, ?, ?);";
        $db->execute($sql, [$date, $student, $time2, 0]);
    }

    // Redirect
    header("Location: ?route=admin_planning_2&date=$date");
}
