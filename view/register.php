<div class="login-container">
    <div class="login-content text-center col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
        <img src="img/bootstrap-icon.png" alt="">
        <form class="" action="index.php" method="POST">
            <div class="form-group">
                <label for="firstname" class="sr-only">First Name</label>
                <input type="text" id="firstname" class="form-control mt-2" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="lastname" class="sr-only">Last Name</label>
                <input type="text" id="lastname" class="form-control mt-2" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="text" id="inputEmail" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="phone" class="sr-only">Phone Number</label>
                <input type="text" id="phone" class="form-control" placeholder="Phone Number">
            </div>
            <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control mt-2" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword" class="sr-only">Confirm Password</label>
                <input type="password" id="confirmPassword" class="form-control mt-2" placeholder="Confirm Password" required>
            </div>

            <button class="btn btn-lg btn-primary btn-block mt-3 font-weight-bold mb-3" type="submit">Register</button>
        </form>
        <p class="py-2"><a href="?route=login">Already registered. Log me in.</a></p>
    </div>
</div>
