<div class="container main-container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_calendar_1"><i class="far fa-calendar-alt"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="?route=admin_students_1"><span class="fa-text"> Students</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_recent"><i class="fas fa-database"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_stats"><i class="fas fa-chart-bar"></i></a>
        </li>
    </ul>
    <div class="container main-container-inner">
        <div class="edit-content col-10 offset-1 col-lg-8 offset-lg-2">
            <br>
            <h4 class="float-left">Edit details</h4>
            <br>
            <form method="POST">
                <button class="float-right btn btn-md btn-danger btn-block font-weight-bold w-50 mb-4" type="submit" name="button" value="reset">Reset Password</button>
                <input type="hidden" name="route" value="admin_students_2">
                <input type="hidden" name="studentID" value="<?= $studentID ?>">
                <div class="form-group">
                    <input type="text" name="fname" class="form-control-lg w-100" placeholder="First Name" value="<?= $student->firstname ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="lname" class="form-control-lg w-100 mt-2" placeholder="Last Name" value="<?= $student->lastname ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="email" class="form-control-lg w-100" placeholder="Email" value="<?= $student->email ?>" required>
                </div>
                <div class="form-group">
                    <input type="number" name="phone" class="form-control-lg w-100" placeholder="Phone Number" value="<?= $student->phone ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="username" class="form-control-lg w-100" placeholder="Username" value="<?= $student->username ?>" disabled>
                </div>
                <div class="form-group">
                    <?= $select ?>
                </div>
                <div class="mt-5">
                    <button class="btn btn-lg btn-info btn-block w-100 font-weight-bold" type="submit" name="button" value="save">Save</button>
                    <button class="btn btn-lg btn-secondary btn-block w-100 font-weight-bold mt-4" type="submit" name="button" value="cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
