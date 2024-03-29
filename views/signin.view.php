<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');?>
<div class="sigin">
<div class="signin-container">
<div class="top">
    <h2>Sign In</h2>
</div>
<div class="signin-form">
    <form action="/model/signin-model.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required autocomplete="off">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="off">
        </div>
        <button type="submit" class="signin-btn">Sign In</button>
    </form>
    <div class="register-links">
        <h3> Don’t have an account?</h3>
        <a href="/driver-signup">Register as a Driver</a>
        <a href="/passenger-signup">Register as a Passenger</a>
    </div>
</div>
</div>
<div class="sigin-image-side">
            <img src="images/siginin.png" alt="Share Your Ride">
</div>

</div>
<?php require('partials/footer.php');?>