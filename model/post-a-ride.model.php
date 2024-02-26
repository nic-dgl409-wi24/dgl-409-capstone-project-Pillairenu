<?php

require_once('../Database.php'); // Adjust this path to your database connection script
session_start();
// Check if the user is logged in and has a valid session user_id
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or show an error message
    header('Location: /signin');
    exit();
}

// Check if the form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract and sanitize input data
    $userId = $_SESSION['user_id']; // Get user ID from session
    $departure = filter_input(INPUT_POST, 'departure', FILTER_SANITIZE_STRING);
    $arrival = filter_input(INPUT_POST, 'arrival', FILTER_SANITIZE_STRING);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
    $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_STRING);
    $seats = filter_input(INPUT_POST, 'seats', FILTER_SANITIZE_NUMBER_INT);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);

    // Validate required fields
    if (!$departure || !$arrival || !$date || !$time || !$seats || !$price) {
        // Handle missing fields appropriately
        echo "All fields except notes are required.";
        exit();
    }

    try {
        // Prepare SQL statement to insert ride data
        $stmt = $pdo->prepare("INSERT INTO rides (user_id, departure, arrival, date, time, seats_available, price_per_seat, additional_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Execute statement with form data
        $stmt->execute([$userId, $departure, $arrival, $date, $time, $seats, $price, $notes]);

        // Redirect or inform the user of success
        header('Location: /driver-dashboard'); // Adjust the redirection URL as needed
    } catch (PDOException $e) {
        // Handle SQL errors or duplicates
        die("Error posting ride: " . $e->getMessage());
    }
} else {
    // Not a POST request, redirect to form or show an error
    header('Location: /post-a-ride');
}
?>
