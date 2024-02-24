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
        'password' => $_POST['password'], 
        'govId' => $_POST['govId'],
        'govIdFile' => $_FILES['govIdFile']['name'],
        'profilePhoto' => $_FILES['profilePhoto']['name']
    ];

    // Redirect to the next form
    header("Location: /vehicle-registration");
    // require "views/vehicle-registration-view.php";
    exit();
}