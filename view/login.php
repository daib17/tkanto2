<div class="main-container">
    <div class="login-content text-center col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
        <img src="img/bootstrap-icon.png" alt="">
        <form method="get">
            <input type="hidden" name="route" value="login">
            <div class="form-group">
                <input type="text" name="username" class="form-control-lg w-100" placeholder="Email or Username" value="ninas">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control-lg mt-2 w-100" placeholder="Password">
            </div>
            <button class="btn btn-lg btn-primary btn-block mt-3 font-weight-bold mb-3" type="submit">Log in</button>
        </form>
        <form method="get">
            <input type="hidden" name="route" value="register">
            <button class="btn btn-lg btn-link btn-link mt-3 font-weight-bold" type="submit">New student? Register here</button>
        </form>
        <form method="get">
            <input type="hidden" name="route" value="admin_calendar_1">
            <!-- DEBUG -->
            <?php $_SESSION['login'] = "admin"; ?>
            <button class="btn btn-lg btn-link btn-link mt-3 font-weight-bold mb-3" type="submit">Forgot password?</button>
        </form>
    </div>
</div>
