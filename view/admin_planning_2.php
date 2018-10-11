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
        <div class="spinner">
            <?= $spinner ?>
        </div>
        hourSelected: <?= $hourSelected ?>

        <div class="admin-calendar">
            <form class="calendar-form" method="GET">
                <input type="hidden" name="route" value="admin_planning_2">
                <input type="hidden" name="dateSelected" value="<?= $dateSelected ?>">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $hoursTable ?>
                    </tbody>
                </table>
            </form>
        </div>
        <form class="save-button" method="get">
            <input type="hidden" name="route" value="admin_planning_2">
            <button class="btn btn-lg btn-primary btn-block font-weight-bold" type="submit">Save</button>
        </form>

    </div>
</div>
<script type="text/javascript" src="js/admin.js"></script>
