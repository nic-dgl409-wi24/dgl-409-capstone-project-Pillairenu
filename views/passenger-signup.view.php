<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');?>
<?php session_start();?>

<div class="signup-container">
<div class="signup">
    
    <form action="/model/passenger-signup.model.php" method="POST" enctype="multipart/form-data" class="registration-form" id="passenger-registration-form">
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
    <input type="email" id="email" name="email" required>
    </div>
    
    <div class="registration-form-group">
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    </div>
    <div class="registration-form-group ">
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
    <div class="registration-form-group ">
    <label for="govIdFile">Upload Govt.ID:</label>
    <input type="file" id="govIdFile" name="govIdFile" accept=".pdf,.jpg,.jpeg,.png" required>
    </div>
    <!-- Hidden field for the driver role -->
    <input type="hidden" name="role" value="passenger">
    <div class="registration-form-group">
    
    </div>
    <button type="submit" class="signin-btn" id="passenger-signin">Submit</button>
</form>
</div>
<div class="welcome-section">
    
    <div class="welcome-container">
    
    <h2>Come Join Us!</h2>
    <p>Enter your personal details to start your journey with us a passenger.</p>
    <a href="/signin" class="signin-link">Already have an account? Sign in.</a>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="modalLabel">Form Submission Success</h2>     
      </div>
      <div class="modal-body">
        <p>Your form has been submitted successfully. You will be redirected shortly.</p>
      </div>
      <div class="close-btn-container">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         Close
    </button>

</div>
    </div>
 
  </div>
</div>
<?php require('partials/footer.php');?>