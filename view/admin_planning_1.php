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
        <div class="row">
            <div class="admin-calendar">
                <form class="calendar-form" method="GET">
                    <input type="hidden" name="route" value="admin_planning_1">
                    <input type="hidden" name="dateSelected" value=<?= $dateSelected ?>>
                    <input type="hidden" name="month" value=<?= $month ?>>
                    <input type="hidden" name="year" value=<?= $year ?>>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" colspan="1">
                                    <input type="submit" class="arrow" name="changeMonth" value="<<">
                                </th>
                                <th scope="col" colspan="5" class="title"><?= $monthName ?> <?= $year ?></th>
                                <th scope="col" colspan="1">
                                    <input type="submit" class="arrow" name="changeMonth" value=">>">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $calendarTable ?>
                        </tbody>
                    </table>
                </form>
                <!-- <?php var_dump($dateSelected); ?> -->
            </div>
        </div>
        <form class="edit-button" method="get">
            <input type="hidden" name="route" value="admin_planning_2">
            <input type="hidden" name="dateSelected" value="<?= $dateSelected ?>">
            <button class="btn btn-lg btn-primary btn-block font-weight-bold" type="submit">Edit</button>
        </form>
    </div>
</div>
<script type="text/javascript" src="js/teacher.js"></script>
