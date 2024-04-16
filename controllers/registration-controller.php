<?php

session_start();

// Assuming form method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initial error handling setup
    $errors = [];

    // Process the file upload for government ID
    try {
        if (isset($_FILES['govIdFile']) && $_FILES['govIdFile']['error'] === UPLOAD_ERR_OK) {
            $govIdFileName = handleFileUpload('govIdFile'); // This function handles upload and returns the new filename
            $_SESSION['personal_info']['govIdFile'] = $govIdFileName;
        } else {
            throw new Exception("Failed to upload government ID file.");
        }
    } catch (Exception $e) {
        $errors['govIdFile'] = $e->getMessage();
    }

    // Process the file upload for profile photo
    try {
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
            $profilePhotoName = handleFileUpload('profile_photo');
            $_SESSION['personal_info']['profile_photo'] = $profilePhotoName;
        } else {
            throw new Exception("Failed to upload profile photo.");
        }
    } catch (Exception $e) {
        $errors['profile_photo'] = $e->getMessage();
    }

    // Store other personal information
    $_SESSION['personal_info']['name'] = $_POST['name'];
    $_SESSION['personal_info']['gender'] = $_POST['gender'];
    $_SESSION['personal_info']['email'] = $_POST['email'];
    $_SESSION['personal_info']['password'] = $_POST['password'];  // Consider hashing this before storing
    $_SESSION['personal_info']['govId'] = $_POST['govId'];

    // Check for any errors and redirect or display errors
    if (empty($errors)) {
        header("Location: /vehicle-registration");
        exit();
    } else {
        // Handle errors appropriately - possibly re-display the form with error messages
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
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

