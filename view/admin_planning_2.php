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
            <div class="float-left w-50 mb-4">
                <?= $spinner ?>
            </div>
            <div class="float-right w-50 mb-4 <?= $hideSpinner ?>">
                <?= $studentSpinner ?>
            </div>
            <div class="float-right mb-4">
                <form  method="get">
                    <input type="hidden" name="route" value="admin_planning_2">
                    <input type="hidden" name="selDate" value="<?= $date ?>">
                    <input type="hidden" name="hourStr" value=<?= $hourStr ?>>
                    <button class="btn btn-md btn-danger font-weight-bold  <?= $clearFlagBtn ?>" type="submit" name="clearBtn" value="admin">Clear flag</button>
                    <button class="btn btn-md btn-danger font-weight-bold  <?= $cancelBtn ?>" type="submit" name="cancelBtn" value="admin">Cancel by me</button>
                    <button class="btn btn-md btn-danger font-weight-bold <?= $cancelBtn ?>" type="submit" name="cancelBtn" value="student">Cancel by student</button>
                </form>
            </div>

        </div>
        <div class="admin-calendar">
            <form class="calendar-form" method="GET">
                <input type="hidden" name="route" value="admin_planning_2">
                <input type="hidden" name="selDate" value="<?= $date ?>">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" colspan="1">
                                <input type="submit" class="btn btn-arrow btn-block font-weight-bold" name="changeDate" value="<<">
                            </th>
                            <th scope="col" colspan="2" class="title"><?= $dayOfWeek ?> / <?= $date ?></th>
                            <th scope="col" colspan="1">
                                <input type="submit" class="btn btn-arrow btn-block font-weight-bold" name="changeDate" value=">>">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $hoursTable ?>
                    </tbody>
                </table>
                <!-- <div>
                    <input type="hidden" name="route" value="admin_planning_2">
                    <button class="btn btn-lg btn-danger btn-block font-weight-bold mt-4 <?= $cancelBtn ?>" type="submit" name="button" value="copy">Cancel booking</button>
                </div> -->
                <div>
                    <input type="hidden" name="route" value="admin_planning_2">
                    <button class="btn btn-lg btn-info btn-block font-weight-bold mt-5" type="submit" name="button" value="copy">Copy open hours to next day</button>
                </div>
            </form>
            <form method="get">
                <input type="hidden" name="route" value="admin_planning_1">
                <input type="hidden" name="selDate" value="<?= $date ?>">
                <button class="btn btn-lg btn-secondary btn-block font-weight-bold my-3" type="submit">Back</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/admin.js"></script>
