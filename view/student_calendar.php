<div class="main-container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="?route=student_calendar">Calendar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=student_bookings">Bookings</a>
        </li>
    </ul>

    <div class="container main-container-inner">
        <div class="row">
            <div class="col-md-6 student-calendar">
                <form class="calendar-form" method="GET">
                    <input type="hidden" name="route" value="student_calendar">
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
                <!-- <?php var_dump($daySelected); ?> -->
            </div>

            <div class="col-md-6 student-day">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"><?= $daySel ?> <?= $monthSel ?> <?= $yearSel ?></th>
                            <th scope="col">Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $dayTable ?>
                    </tbody>
                </table>
            </div>
        </div>
        <form class="save-button" action="#" method="POST">
            <button class="btn btn-lg btn-primary btn-block font-weight-bold" type="submit">Save</button>
        </form>
    </div>
</div>
