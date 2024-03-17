<?php
require_once('../Database.php');

// Function to handle file uploads
function handleFileUpload($fileField, $uploadDir = 'uploads/') {
    if (!file_exists($uploadDir) && !mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
        throw new RuntimeException(sprintf('Directory "%s" was not created', $uploadDir));
    }
    
    $file = $_FILES[$fileField];
    if ($file['error']) {
        throw new Exception('Error uploading file - ' . $file['error']);
    }
    
    // Validate file size and type
    $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception("Invalid file type. Allowed types are JPEG, PNG, and PDF.");
    }
    
    $maxFileSize = 5 * 1024 * 1024; // 5 MB
    if ($file['size'] > $maxFileSize) {
        throw new Exception("File size is too large. Maximum size allowed is 5MB.");
    }
    
    // Generate a unique file name and move the file
    $fileName = uniqid() . '_' . basename($file['name']);
    $destination = $uploadDir . $fileName;
    
    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new Exception("Failed to move uploaded file.");
    }
    
    return $fileName; // Return the new filename for database storage
}

try {
    $pdo->beginTransaction();

    // Handling file uploads
    $profilePhotoPath = handleFileUpload('profilePhoto');
    $govIdFilePath = handleFileUpload('govIdFile');

    // Insert user data into the users table
    $stmt = $pdo->prepare("INSERT INTO users (name, gender, email, password, profile_photo_path, gov_id_type, gov_id_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['gender'],
        $_POST['email'],
        $_POST['password'],
        $profilePhotoPath,
        $_POST['govId'],
        $govIdFilePath
    ]);
    $userId = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, (SELECT role_id FROM roles WHERE role_name = 'passenger'))");
        $stmt->execute([$userId]);

        // Insert initial 100 points into the pointsbalance table
        $stmt = $pdo->prepare("INSERT INTO pointsbalance (user_id, points_balance) VALUES (?, 100)");
        $stmt->execute([$userId]);
 
         $pdo->commit();
        
         //echo "Passenger registration successful.";
        header("Location: /signin");
        exit();
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Registration failed: " . $e->getMessage();
}