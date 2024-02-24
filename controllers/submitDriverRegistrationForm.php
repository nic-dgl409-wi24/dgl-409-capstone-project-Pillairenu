<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $_SESSION['driving_info'] = [
        'licenseUpload' => $_FILES['licenseUpload']['name'], // Storing file name for simplicity
        'drivingExperience' => $_POST['drivingExperience'],
        'vehicleMakeModel' => $_POST['vehicleMakeModel'],
        'vehicleType' => $_POST['vehicleType'],
        'licensePlate' => $_POST['licensePlate'],
        'insuranceDoc' => $_FILES['insuranceDoc']['name'],
        'vehiclePhoto' => $_FILES['vehiclePhoto']['name'],
        'backgroundCheckConsent' => isset($_POST['backgroundCheck']) ? 'Yes' : 'No'
    ];

    // $drivinginfo = $_SESSION['driving_info'];
    // echo "<p>vehicleMakeModel: " . htmlspecialchars($drivinginfo['vehicleMakeModel']) . "</p>";
    header("Location: /model/submitDriverRegistrationForm.model.php");
    exit();
}