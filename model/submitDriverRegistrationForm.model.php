<?php
session_start();
require_once('../Database.php');


if (isset($_SESSION['personal_info'], $_SESSION['driving_info'])) {
    $pdo->beginTransaction();

    try {
      

       $profile_photo = $_SESSION['personal_info']['profile_photo'];
       $govIdFile = $_SESSION['personal_info']['govIdFile'];
       $licenseUpload=$_SESSION['driving_info']['licenseUpload'];
       $insuranceDoc=$_SESSION['driving_info']['insuranceDoc'];
       $vehiclePhoto= $_SESSION['driving_info']['vehiclePhoto'];

    //   var_dump($_SESSION['personal_info']);
    //   var_dump($_SESSION['driving_info']);
    
        


        $stmt = $pdo->prepare("INSERT INTO users (name, gender,email,password, profile_photo_path, gov_id_type, gov_id_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['personal_info']['name'],
            $_SESSION['personal_info']['gender'],
            $_SESSION['personal_info']['email'],
            $_SESSION['personal_info']['password'], 
            $profile_photo, 
            $_SESSION['personal_info']['govId'],
            $govIdFile 
        ]);
    
        // Retrieve the last inserted user ID
        $userId = $pdo->lastInsertId();
    
        // Insert into vehicles table
        $stmt = $pdo->prepare("INSERT INTO vehicles (user_id, license_upload_path, driving_experience, vehicle_make_model, vehicle_type, license_plate, insurance_doc_path, vehicle_photo_path, consent_background_check) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $userId,
            $licenseUpload, 
            $_SESSION['driving_info']['drivingExperience'],
            $_SESSION['driving_info']['vehicleMakeModel'],
            $_SESSION['driving_info']['vehicleType'],
            $_SESSION['driving_info']['licensePlate'],
            $insuranceDoc, 
            $vehiclePhoto, 
            $_SESSION['driving_info']['backgroundCheckConsent']
        ]);
 
         // Assign "driver" role
         $stmt = $pdo->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, (SELECT role_id FROM roles WHERE role_name = 'driver'))");
         $stmt->execute([$userId]);
 
         $pdo->commit();
         echo "Driver registration successful.";
 
         // Clear session variables
         unset($_SESSION['personal_info'], $_SESSION['driver_info']);

         header("Location: /signin");
         exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Registration failed: " . $e->getMessage();
    }
} 
else {
    echo "Required information is missing.";
}
?>
