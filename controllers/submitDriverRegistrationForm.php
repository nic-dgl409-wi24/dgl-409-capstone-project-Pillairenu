<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $_SESSION['driving_info'] = [
        'licenseUpload' => $_FILES['licenseUpload']['name'], // Storing file name for simplicity
        'drivingExperience' => $_POST['drivingExperience'],
        'vehicleMakeModel' => $_POST['vehicleMakeModel'],
        'vehicleType' => $_POST['vehicleType'],
        'licensePlate' => $_POST['licensePlate'],
        // Handle the file uploads, store file paths or references
    ];

    // // Process file uploads here (save files to the server and store file paths in the session)

    // // Redirect to the next step or confirmation page
    // header("Location: /confirmationPage");
    // exit();
    // $drivinginfo = $_SESSION['driving_info'];
    // echo "<p>vehicleMakeModel: " . htmlspecialchars($drivinginfo['vehicleMakeModel']) . "</p>";
}