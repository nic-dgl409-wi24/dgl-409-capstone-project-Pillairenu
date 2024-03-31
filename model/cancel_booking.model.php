<?php
require_once('../Database.php'); // Ensure this points to your actual database connection file
session_start();

// Check if the user is logged in and the booking_id is passed
if (isset($_SESSION['user_id'], $_GET['booking_id'])) {
    $user_id = $_SESSION['user_id'];
    $booking_id = $_GET['booking_id'];

    try {
        // Prepare the SQL statement to delete the booking
        $stmt = $pdo->prepare("DELETE FROM bookings WHERE booking_id = ? AND passenger_id = ?");

        // Execute the statement with the booking_id and user_id
        $stmt->execute([$booking_id, $user_id]);

        // Optional: Check if the deletion was successful
        if ($stmt->rowCount() > 0) {
            // Redirect back to the bookings page with a success message
            $_SESSION['message'] = 'Booking canceled successfully';
            header('Location: /passenger-dashboard');
        } else {
            // Handle cases where the booking was not found or belongs to another user
            $_SESSION['message'] = 'Booking cancellation failed. Booking not found or permission denied.';
            header('Location: /passenger-dashboard');
        }
        exit();
    } catch (Exception $e) {
        // Handle errors, such as database connection issues
        die("Error canceling booking: " . $e->getMessage());
    }
} else {
    // Redirect to login or error page if not logged in or booking_id is missing
    header('Location: /signin');
    exit();
}
?>