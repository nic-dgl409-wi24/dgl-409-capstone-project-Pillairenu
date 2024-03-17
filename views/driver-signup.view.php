<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');?>

<div class="signup-container">
<div class="signup">
   
<form id="personalDetailsForm" action="/registration-controller" method="POST" enctype="multipart/form-data" class="registration-form">
    
<div class="registration-form-group">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    </div>
    <div class="registration-form-group">
    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select>
    </div>

    <div class="registration-form-group">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required autocomplete="off">
    </div>
    <div class="registration-form-group">
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required autocomplete="off">
    </div>
    <div class="registration-form-group">
    <label for="profile_photo">Profile Photo:</label>
    <input type="file" id="profile_photo" name="profile_photo" accept=".jpg,.jpeg,.png" required>
    </div>
    <div class="registration-form-group">
    <label for="govId">Choose a Government ID:</label>
    <select id="govId" name="govId" required>
        <option value="passport">Passport</option>
        <!-- <option value="driving_license">Driving License</option> -->
        <option value="national_id">National ID Card</option>
    </select>
    </div>
    <div class="registration-form-group">
    <label for="govIdFile">Upload Govt.ID:</label>
    <input type="file" id="govIdFile" name="govIdFile" accept=".pdf,.jpg,.jpeg,.png" required>
    </div>
    <div class="registration-form-group">
    
    </div>
    <div  class="group">
        
        
    <button type="submit" class="signin-btn signup-btn" id="nextButton">Next</button>

</div> 
    
</form>

</div>
<div class="welcome-section">
    
    <div class="welcome-container">
    <h2>Come Join Us!</h2>
    <p>Enter your personal & vehicle details to start your journey with us a driver.</p>
    <a href="/signin" class="signin-link">Already have an account? Sign in.</a>
</div>
</div>
</div>
<?php require('partials/footer.php');?>