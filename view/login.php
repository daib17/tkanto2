<div class="login-container">
    <div class="login-content text-center col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
        <img src="img/bootstrap-icon.png" alt="">
        <form method="get">
            <input type="hidden" name="route" value="student_calendar">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Email or Username">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control mt-2" placeholder="Password">
            </div>
            <button class="btn btn-lg btn-primary btn-block mt-3 font-weight-bold mb-3" type="submit">Log in</button>
        </form>
        <p class="py-2"><a href="?route=register">New student? Register here</a></p>
        <p><a href="?route=admin_students_1">Forgot password?</a></p>
    </div>
</div>
