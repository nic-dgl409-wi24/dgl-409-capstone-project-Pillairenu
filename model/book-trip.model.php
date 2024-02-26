<?php
require_once('../Database.php');

session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header('Location: /signin');
    exit();
}

if (isset($_GET['ride_id'])) {
    $rideId = $_GET['ride_id'];
    $passengerId = $_SESSION['user_id'];

    try {
        // Prepare the SQL statement to insert the booking
        $stmt = $pdo->prepare("INSERT INTO bookings (ride_id, passenger_id) VALUES (?, ?)");
        // Execute the statement with the ride ID and passenger ID
        $stmt->execute([$rideId, $passengerId]);

        // Redirect or inform the user of success
        header('Location: /passenger-dashboard'); // Adjust the redirection URL as needed
    } catch (Exception $e) {
        die("Error making booking: " . $e->getMessage());
    }
} else {
    // Handle the case where no ride ID is provided
    echo "No ride selected for booking.";
    // Consider redirecting back to the rides listing page
}
?>
