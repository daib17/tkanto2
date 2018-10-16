<div class="main-container">
    <div class="register-content text-center col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
        <!-- <img src="img/bootstrap-icon.png" alt=""> -->
        <h3>Create new account</h3>
        <br>
        <form class="" action="index.php" method="POST">
            <div class="form-group">
                <label for="firstname" class="sr-only">First Name</label>
                <input type="text" id="firstname" class="form-control-lg mt-2 w-100" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="lastname" class="sr-only">Last Name</label>
                <input type="text" id="lastname" class="form-control-lg mt-2 w-100" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="text" id="inputEmail" class="form-control-lg mt-2 w-100" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="phone" class="sr-only">Phone Number</label>
                <input type="text" id="phone" class="form-control-lg mt-2 w-100" placeholder="Phone Number">
            </div>
            <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control-lg mt-2 w-100" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword" class="sr-only">Confirm Password</label>
                <input type="password" id="confirmPassword" class="form-control-lg mt-2 w-100" placeholder="Confirm Password" required>
            </div>

            <button class="btn btn-lg btn-primary btn-block mt-3 font-weight-bold mb-3" type="submit">Register</button>
        </form>
        <form method="get">
            <input type="hidden" name="route" value="login">
            <button class="btn btn-lg btn-link btn-link mt-3 font-weight-bold mb-3" type="submit">Already registered? Log me in.</button>
        </form>
    </div>
</div>
