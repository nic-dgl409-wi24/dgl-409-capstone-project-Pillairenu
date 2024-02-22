<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');?>
<div class="sigin">
<div class="signin-container">
    <h2>Sign In</h2>
    <form action="/submit-your-login-form-endpoint" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="signin-btn">Sign In</button>
    </form>
    <div class="register-links">
        <a href="register-driver.html">Register as a Driver</a>
        <a href="register-passenger.html">Register as a Passenger</a>
    </div>
</div>

</div>
<?php require('partials/footer.php');?>