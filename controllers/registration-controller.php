<?php

session_start();

// Assuming form method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store personal information in session variables
    $_SESSION['personal_info'] = [
        'name' => $_POST['name'],
        'gender' => $_POST['gender'],
        'dob' => $_POST['dob'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'password' => $_POST['password'], // Consider hashing the password before storing it
        // Handle file uploads as needed
    ];

    // Redirect to the next form
    header("Location: /vehicle-registration");
    // require "views/vehicle-registration-view.php";
    exit();
}