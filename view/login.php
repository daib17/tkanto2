<div class="main-container">
    <div class="login-content text-center col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
        <img src="img/logo.png" alt="">
        <form method="POST">
            <!-- <input type="hidden" name="route" value="login"> -->
            <div class="form-group">
                <input type="text" name="user" class="form-control-lg w-100" placeholder="Username or Email" value="<?= $user ?>">
            </div>
            <div class="form-group">
                <input type="password" name="pass" class="form-control-lg mt-2 w-100" placeholder="Password" value="<?= $pass ?>">
            </div>
            <div class="error-message">
                <p><?= $msg ?></p>
            </div>
            <button class="btn btn-lg btn-primary btn-block mt-4 font-weight-bold mb-3" type="submit">Log in</button>
        </form>
        <form>
            <input type="hidden" name="route" value="register">
            <button class="btn btn-lg btn-link btn-link mt-3 font-weight-bold" type="submit">New student? Register here</button>
        </form>
        <form>
            <input type="hidden" name="route" value="admin_calendar_1">
            <!-- DEBUG -->
            <?php $_SESSION['user'] = "admin"; ?>
            <button class="btn btn-lg btn-link btn-link mt-3 font-weight-bold mb-3" type="submit">Forgot password?</button>
        </form>
    </div>
</div>
