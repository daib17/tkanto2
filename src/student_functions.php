<?php

/**
* @param date day selected (Y-m-d)
* @param int $month
* @param int $year
*/
function getCalendarAsTable(string $date, int $month, int $year)
{
    $daySel = date("j", strtotime($date));
    $monthSel = date("n", strtotime($date));
    $yearSel = date("Y", strtotime($date));

    // Today
    $dayToday = date("j");
    $monthToday = date("n");
    $yearToday = date("Y");

    // Get number of days in month
    $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $table = "";
    // Get day of the week for the 1st of month/year
    $dayOne = date('w', strtotime($year . "-" . $month . "-" . "1"));
    // Empty cells before day one
    $emptyCells = $dayOne == 0 ? 6 : $dayOne - 1;
    for ($i = 1; $i < $emptyCells + 1; $i++) {
        if ($i == 1) {
            $table .= "<tr>";
        }
        $table .= "<td><input type='submit' class='button' name='day' value='' disabled /></td>";
    }

    // Cells for every day of the month
    for ($day = 1; $day < $numDays + 1; $day++) {
        $weekDay = date('w', strtotime($year . "-" . $month . "-" . $day));
        if ($weekDay == 1) {
            $table .= "<tr>";
        }
        if ($day == $daySel && $month == $monthSel
        && $year == $yearSel) {
            $table .= "<td><input type='submit' class='button selected' name='day' value={$day} /></td>";
        } elseif ($day == $dayToday && $month == $monthToday
        && $year = $yearToday) {
            $table .= "<td><input type='submit' class='button today' name='day' value={$day} /></td>";
        } elseif ($weekDay == 6 || $weekDay == 0) {
            $table .= "<td><input type='submit' class='button weekend' name='day' value={$day} /></td>";
        } else {
            $table .= "<td><input type='submit' class='button' name='day' value={$day} /></td>";
        }
        if ($weekDay == 0) {
            $table .= "</tr>";
        }
    }

    // Empty cells after last day of the month
    $weekDay = date('w', strtotime($year . "-" . $month . "-" . $numDays));
    if ($weekDay != 0) {
        for ($day = $weekDay; $day < 7; $day++) {
            $table .= "<td><input type='submit' class='button' name='day' value='' disabled /></td>";
        }
    }

    $table .= "</tr>";
    return $table;
}

/**
*
*/
function getDayTable($db, $date)
{
    $sql = "SELECT * FROM calendar WHERE date = ?";
    $res = $db->executeFetchAll($sql, [$date]);

    // No results?
    $table = "";
    if (count($res) > 0) {
        // Generate table
        foreach ($res as $row) {
            $table .= "<tr>";
            $table .= "<td>" . $row->time . "</td>";
            $table .= "<td>" . $row->student . "</td>";
            $table .= "</tr>";
        }
    } else {
        $table = "";
        $table .= "<tr>";
        $table .= "<td colspan=2>" . "There are not open hours today." . "</td>";
        $table .= "</tr>";
    }

    return $table;
}
