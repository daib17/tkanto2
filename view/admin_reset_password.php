<div class="main-container">
    <div class="col-10 offset-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-xl-4 offset-xl-4">
        <br><br>
        <h3>Password Reset to 123456</h3><br>
        Student: <b><?= $res->firstname ?> <?= $res->lastname?></b>
        <br>
        Username: <b><?= $res->username ?></b>
        <br><br>
        <?php if ($msg != ""): ?>
            <div class="alert alert-info" role="alert">
                <?= $msg ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <button class="btn btn-lg btn-danger btn-block font-weight-bold mt-4 mb-3" type="submit" name="confirmBtn" value="yes">Yes, reset it</button>
            <button class="btn btn-lg btn-secondary btn-block font-weight-bold mt-4 mb-3" type="submit" name="confirmBtn" value="no">Cancel</button>
        </form>
    </div>
</div>
