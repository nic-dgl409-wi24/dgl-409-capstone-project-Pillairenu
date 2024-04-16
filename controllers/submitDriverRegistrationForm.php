<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to keep track of any errors
    $errors = [];

    // File upload processing and validation
    try {
        if (isset($_FILES['licenseUpload']) && $_FILES['licenseUpload']['error'] === UPLOAD_ERR_OK) {
            $licenseUploadName = handleFileUpload('licenseUpload'); // Assumes function handles upload and returns new filename
            $_SESSION['driving_info']['licenseUpload'] = $licenseUploadName;
        } else {
            throw new Exception("Failed to upload driver's license.");
        }
    } catch (Exception $e) {
        $errors['licenseUpload'] = $e->getMessage();
    }

    try {
        if (isset($_FILES['insuranceDoc']) && $_FILES['insuranceDoc']['error'] === UPLOAD_ERR_OK) {
            $insuranceDocName = handleFileUpload('insuranceDoc');
            $_SESSION['driving_info']['insuranceDoc'] = $insuranceDocName;
        } else {
            throw new Exception("Failed to upload insurance document.");
        }
    } catch (Exception $e) {
        $errors['insuranceDoc'] = $e->getMessage();
    }

    try {
        if (isset($_FILES['vehiclePhoto']) && $_FILES['vehiclePhoto']['error'] === UPLOAD_ERR_OK) {
            $vehiclePhotoName = handleFileUpload('vehiclePhoto');
            $_SESSION['driving_info']['vehiclePhoto'] = $vehiclePhotoName;
        } else {
            throw new Exception("Failed to upload vehicle photo.");
        }
    } catch (Exception $e) {
        $errors['vehiclePhoto'] = $e->getMessage();
    }

    // Store other form data in the session
    $_SESSION['driving_info']['drivingExperience'] = $_POST['drivingExperience'];
    $_SESSION['driving_info']['vehicleMakeModel'] = $_POST['vehicleMakeModel'];
    $_SESSION['driving_info']['vehicleType'] = $_POST['vehicleType'];
    $_SESSION['driving_info']['licensePlate'] = $_POST['licensePlate'];
    $_SESSION['driving_info']['backgroundCheckConsent'] = isset($_POST['backgroundCheck']) ? 'Yes' : 'No';

    // Check for any errors and redirect or display errors
    if (empty($errors)) {
        header("Location: /model/submitDriverRegistrationForm.model.php");
        exit();
    } else {
        // Display errors if any occurred during the file upload process
        foreach ($errors as $field => $message) {
            echo "<p>Error with $field: $message</p>";
        }
    }
}
function sanitizeFileName($filename) {
    // Remove any characters that are not letters, numbers, dots, or underscores
    return preg_replace('/[^A-Za-z0-9._-]/', '', $filename);
}

function handleFileUpload($fileField, $uploadDir = 'model/uploads/') {
    if (!file_exists($uploadDir) && !mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
        throw new RuntimeException(sprintf('Directory "%s" was not created', $uploadDir));
    }

    $file = $_FILES[$fileField];
    if ($file['error']) {
        throw new Exception('Error uploading file - ' . $file['error']);
    }

    // Validate file size and type
    $allowedTypes = ['image/jpeg', 'image/png','image/jpg', 'application/pdf'];
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception("Invalid file type. Allowed types are JPEG, PNG, and PDF.");
    }

    $maxFileSize = 5 * 1024 * 1024; // 5 MB
    if ($file['size'] > $maxFileSize) {
        throw new Exception("File size is too large. Maximum size allowed is 5MB.");
    }

    // Sanitize and generate a unique file name
    $sanitizedBaseName = sanitizeFileName(basename($file['name']));
    $fileName = uniqid() . '_' . $sanitizedBaseName;
    $destination = $uploadDir . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new Exception("Failed to move uploaded file.");
    }

    return $fileName; // Return the new filename for database storage
}

