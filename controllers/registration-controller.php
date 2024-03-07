<?php

session_start();

// Assuming form method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store personal information in session variables
        $_SESSION['personal_info'] = [
        'name' => $_POST['name'],
        'gender' => $_POST['gender'],
        'email' => $_POST['email'],
        'password' => $_POST['password'], 
        'govId' => $_POST['govId'],
        'govIdFile' => $_FILES['govIdFile']['name'],
        'profile_photo' => $_FILES['profile_photo']['name']
    ];
// var_dump($_SESSION['personal_info']);
// exit();
    // Redirect to the next form
    header("Location: /vehicle-registration");
    // require "views/vehicle-registration-view.php";
    exit();
}