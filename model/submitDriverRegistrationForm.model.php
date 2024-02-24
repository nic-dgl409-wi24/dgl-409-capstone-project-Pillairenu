<?php
session_start();
require_once('../Database.php');

// Function to handle file uploads
function uploadFile($fileField, $uploadDir) {
    if (isset($_FILES[$fileField]) && $_FILES[$fileField]['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES[$fileField]['tmp_name'];
        $fileName = $_FILES[$fileField]['name'];
        $fileSize = $_FILES[$fileField]['size'];
        $fileType = $_FILES[$fileField]['type'];
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        $maxFileSize = 5 * 1024 * 1024; // 5 MB

        // Validate file size and type
        if ($fileSize > $maxFileSize) {
            die("File size is too large. Maximum size allowed is 5MB.");
        }
        if (!in_array($fileType, $allowedTypes)) {
            die("Invalid file type. Allowed types are JPEG, PNG, and PDF.");
        }

        // Secure file storage
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $destination = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destination)) {
            return $newFileName; // Return new file name for database storage
        } else {
            die("There was an error uploading the file.");
        }
    }
    return null;
}
// var_dump( $_SESSION['personal_info']);
// var_dump( $_SESSION['driving_info']);

if (isset($_SESSION['personal_info'], $_SESSION['driving_info'])) {
    $pdo->beginTransaction();

    try {
        // Upload files and update session data with file paths
        $uploadDir = 'path/to/your/uploads/directory/'; // Make sure this directory exists and is writable
        $_SESSION['personal_info']['profile_photo_path'] = uploadFile('profilePhoto', $uploadDir);
        $_SESSION['personal_info']['gov_id_path'] = uploadFile('govIdFile', $uploadDir);
        $_SESSION['driving_info']['license_upload_path'] = uploadFile('licenseUpload', $uploadDir);
        $_SESSION['driving_info']['insurance_doc_path'] = uploadFile('insuranceDoc', $uploadDir);
        $_SESSION['driving_info']['vehicle_photo_path'] = uploadFile('vehiclePhoto', $uploadDir);

        
        $stmt = $pdo->prepare("INSERT INTO users (name, gender, dob, email, phone, password, profile_photo_path, gov_id_type, gov_id_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['personal_info']['name'],
            $_SESSION['personal_info']['gender'],
            $_SESSION['personal_info']['dob'],
            $_SESSION['personal_info']['email'],
            $_SESSION['personal_info']['phone'],
            $_SESSION['personal_info']['password'], // Assume already hashed or will be hashed
            $_SESSION['personal_info']['profile_photo_path'], // Assume this is set correctly
            $_SESSION['personal_info']['govId'],
            $_SESSION['personal_info']['govIdFile'] // Assume this is the path where the file is saved
        ]);
    
        // Retrieve the last inserted user ID
        $userId = $pdo->lastInsertId();
    
        // Insert into vehicles table
        $stmt = $pdo->prepare("INSERT INTO vehicles (user_id, license_upload_path, driving_experience, vehicle_make_model, vehicle_type, license_plate, insurance_doc_path, vehicle_photo_path, consent_background_check) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $userId,
            $_SESSION['driving_info']['licenseUpload'], // Assuming you've saved the file and set this to the path
            $_SESSION['driving_info']['drivingExperience'],
            $_SESSION['driving_info']['vehicleMakeModel'],
            $_SESSION['driving_info']['vehicleType'],
            $_SESSION['driving_info']['licensePlate'],
            $_SESSION['driving_info']['insuranceDoc'], // Assuming you've saved the file and set this to the path
            $_SESSION['driving_info']['vehiclePhoto'], // Assuming you've saved the file and set this to the path
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
