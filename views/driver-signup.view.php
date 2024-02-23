<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');?>
<div class="signup">
    <h2>Driver Sign Up</h2>
    <form action="/submit-registration" method="POST" enctype="multipart/form-data" class="registration-form">


    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phone" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="profilePhoto">Profile Photo:</label>
    <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*" required>

    <label for="govId">Choose a Government ID:</label>
    <select id="govId" name="govId" required>
        <option value="passport">Passport</option>
        <option value="driving_license">Driving License</option>
        <option value="national_id">National ID Card</option>
    </select>

    <label for="govIdFile">Upload Government ID:</label>
    <input type="file" id="govIdFile" name="govIdFile" accept=".pdf,.jpg,.jpeg,.png" required>

    <div class="checkbox">
        <input type="checkbox" id="backgroundCheck" name="backgroundCheck" required>
        <label for="backgroundCheck">I consent to a background check</label>
    </div>

    <button type="submit" class="register-button">Register</button>
</form>
</div>
<?php require('partials/footer.php');?>