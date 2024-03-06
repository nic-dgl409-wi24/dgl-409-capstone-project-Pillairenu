<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');?>
<?php session_start();?>
<div class="signup-container">
<div class="signup">
   
    <form action="/registration-controller" method="POST" enctype="multipart/form-data" class="registration-form">
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
    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" required>
    </div>
    <div class="registration-form-group">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    </div>
    <div class="registration-form-group">
    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phone" required>
    </div>
    <div class="registration-form-group">
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    </div>
    <div class="registration-form-group upload-file">
    <label for="profilePhoto">Profile Photo:</label>
    <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*" required>
    </div>
    <div class="registration-form-group">
    <label for="govId">Choose a Government ID:</label>
    <select id="govId" name="govId" required>
        <option value="passport">Passport</option>
        <option value="driving_license">Driving License</option>
        <option value="national_id">National ID Card</option>
    </select>
    </div>
    <div class="registration-form-group upload-file">
    <label for="govIdFile">Upload Govt.ID:</label>
    <input type="file" id="govIdFile" name="govIdFile" accept=".pdf,.jpg,.jpeg,.png" required>
    </div>
    <div class="registration-form-group">
    
    </div>
    <div  class="group">
        <a href="/signin">Sign in instead</a>
        
        <button type="submit" class="signin-btn signup-btn">
            Next  
        </button>
</div> 
    
</form>

</div>
<div class="signup-image">
    
    <!-- <img src="images/signup-2.png" alt="Share Your Ride"> -->
    <h1>Create your RideConnect Driver's Account</h1>
</div>
</div>
<?php require('partials/footer.php');?>