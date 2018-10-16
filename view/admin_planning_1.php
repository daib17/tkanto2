<div class="main-container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_students_1">Students</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_bookings">Bookings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="?route=admin_planning_1">Planning</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_stats">Statistics</a>
        </li>
    </ul>
    <div class="container main-container-inner">
        <div class="admin-calendar">
            <table class="table table-only-header table-bordered">
                <thead>
                    <form class="calendar-form" method="GET">
                        <input type="hidden" name="route" value="admin_planning_1">
                        <input type="hidden" name="date" value=<?= $date ?>>
                        <tr>
                            <th scope="col" colspan="1">
                                <input type="submit" class="btn btn-arrow btn-block font-weight-bold" name="changeMonth" value="<<">
                            </th>
                            <th scope="col" colspan="5" class="title"><?= $monthName ?> <?= $year ?></th>
                            <th scope="col" colspan="1">
                                <input type="submit" class="btn btn-arrow btn-block font-weight-bold" name="changeMonth" value=">>">
                            </th>
                        </tr>
                    </form>
                </thead>
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="day-label">Mon</th>
                        <th class="day-label">Tue</th>
                        <th class="day-label">Wed</th>
                        <th class="day-label">Thu</th>
                        <th class="day-label">Fri</th>
                        <th class="day-label">Sat</th>
                        <th class="day-label">Sun</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $calendarTable ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/teacher.js"></script>
