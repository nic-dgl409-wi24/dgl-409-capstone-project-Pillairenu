<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');?>
<?php


// // Check if the personal information is set in the session
// if (isset($_SESSION['personal_info'])) {
//     $personalInfo = $_SESSION['personal_info'];
    
//     // Echoing session data for verification
//     echo "<p>Name: " . htmlspecialchars($personalInfo['name']) . "</p>";
//     echo "<p>Gender: " . htmlspecialchars($personalInfo['gender']) . "</p>";
//     echo "<p>Date of Birth: " . htmlspecialchars($personalInfo['dob']) . "</p>";
//     echo "<p>Email: " . htmlspecialchars($personalInfo['email']) . "</p>";
//     echo "<p>Phone: " . htmlspecialchars($personalInfo['phone']) . "</p>";
//     // Password is not displayed for security reasons
//     // If you handle file uploads, remember to process them securely and only store references or file paths in session
// } else {
//     echo "<p>No personal information found. Please start from the registration form.</p>";
// }
?>

<div class="signup-container">
<div class="signup">
    
    <form action="/submitDriverRegistrationForm" method="POST" enctype="multipart/form-data" class="registration-form" id="driver-registration-form">
    
    <!-- Driving Information -->
    
    <div class="registration-form-group">
        <label for="drivingExperience">Years of Driving Experience:</label>
        <input type="number" id="drivingExperience" name="drivingExperience">
    </div>
    <div class="registration-form-group upload-file">
        <label for="licenseUpload">Upload Driving License:</label>
        <input type="file" id="licenseUpload" name="licenseUpload" required>
    </div>

    <!-- Vehicle Information -->
    <div class="registration-form-group">
        <label for="vehicleMakeModel">Vehicle Make & Model:</label>
        <input type="text" id="vehicleMakeModel" name="vehicleMakeModel" required>
    </div>
    <div class="registration-form-group">
        <label for="vehicleType">Vehicle Type:</label>
        <input type="text" id="vehicleType" name="vehicleType" required>
    </div>
    <div class="registration-form-group">
        <label for="licensePlate">License Plate No.:</label>
        <input type="text" id="licensePlate" name="licensePlate" required>
    </div>
    <div class="registration-form-group upload-file">
        <label for="insuranceDoc">Vehicle Insurance:</label>
        <input type="file" id="insuranceDoc" name="insuranceDoc" required>
    </div>
    <div class="registration-form-group upload-file">
        <label for="vehiclePhoto">Vehicle Photo:</label>
        <input type="file" id="vehiclePhoto" name="vehiclePhoto" required>
    </div>
    <!-- Hidden field for the driver role -->
    <input type="hidden" name="role" value="driver">
    <div class="checkbox upload-file">
        <input type="checkbox" id="backgroundCheck" name="backgroundCheck" required>
        <label for="backgroundCheck">I consent to a background check</label>
    </div>
    <button type="submit" class="signin-btn">Submit</button>
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