<div class="main-container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_calendar_1">Calendar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="?route=admin_students_1">Students</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_bookings">Recent</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_stats">Statistics</a>
        </li>
    </ul>
    <div class="container main-container-inner">
        <form method="get">
            <input type="hidden" name="route" value="admin_students_2">
            <input type="hidden" name="studentID" value="<?= $studentID ?>">
            <div class="form-group">
                <input type="text" name="fname" class="form-control mt-2" placeholder="First Name" value="<?= $student->firstname ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="lname" class="form-control mt-2" placeholder="Last Name" value="<?= $student->lastname ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Email" value="<?= $student->email ?>" required>
            </div>
            <div class="form-group">
                <input type="number" name="phone" class="form-control" placeholder="Phone Number" value="<?= $student->phone ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" value="<?= $student->username ?>" disabled>
            </div>
            <div class="spinner">
                <?= $select ?>
            </div>
            <div class="top-buffer">
                <button class="btn btn-lg btn-info btn-block mt-3 font-weight-bold mb-3" type="submit" name="button" value="save">Save</button>

                <button class="btn btn-lg btn-secondary btn-block font-weight-bold" type="submit" name="button" value="cancel">Cancel</button>
            </div>
        </form>
    </div>
</div>
