<div class="container main-container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="?route=student_calendar">Calendar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=student_bookings">Bookings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=student_recent">Recent</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="?route=student_account">Account</a>
        </li>
    </ul>
    <div class="container main-container-inner">
        <div class="edit-content col-12 col-lg-8 offset-lg-2">
            <h5>Student: <?= $student ?></h5>
            <br>
            <?php if ($msg != ""): ?>
                <div class="alert alert-info" role="alert">
                    <?= $msg ?>
                </div>
            <?php endif; ?>
            <form method="POST">
                <input type="hidden" name="route" value="student_account">
                <div class="form-group">
                    <input type="text" class="form-control-lg mt-2 w-100" placeholder="First Name" name="fname" value="<?= $fname ?>" maxlength="25" required>
                    <small class="text-left form-text error-message"><?= $fnameError ?></small>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control-lg mt-2 w-100" placeholder="Last Name" name="lname" value="<?= $lname ?>" maxlength="25" required>
                    <small class="text-left form-text error-message"><?= $lnameError ?></small>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control-lg mt-2 w-100" placeholder="Email" name="email" value="<?= $email ?>" required>
                    <small class=" text-left form-text error-message"><?= $emailError ?></small>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control-lg mt-2 w-100" placeholder="Phone Number" name="phone" value="<?= $phone ?>" maxlength="15" required>
                    <small class="text-left form-text error-message"><?= $phoneError ?></small>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control-lg mt-2 w-100" placeholder="Password" name="pass" value="<?= $pass ?>" maxlength="15">
                    <small class="text-left form-text error-message"><?= $passError ?></small>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control-lg mt-2 w-100" placeholder="New Password" name="newpass" value="<?= $newpass ?>" maxlength="15">
                    <small class="text-left form-text error-message"><?= $newpassError ?></small>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control-lg mt-2 w-100" placeholder="Confirm New Password" name="newpass2" value="<?= $newpass2 ?>" maxlength="15">
                    <small class="text-left form-text error-message"><?= $newpass2Error ?></small>
                </div>
                <div class="mt-5">
                    <button class="btn btn-lg btn-info btn-block w-100 font-weight-bold" type="submit" name="button" value="save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
