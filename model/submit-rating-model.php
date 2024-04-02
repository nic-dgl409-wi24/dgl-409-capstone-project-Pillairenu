<?php

require_once('../Database.php');
session_start();

// Check if the necessary POST data is available
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookingId'], $_POST['rating'])) {
    // Assume $pdo is your PDO database connection
    
    // Sanitize and validate inputs
    $bookingId = filter_var($_POST['bookingId'], FILTER_SANITIZE_NUMBER_INT);
    $rating = filter_var($_POST['rating'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $review = isset($_POST['review']) ? filter_var($_POST['review'], FILTER_SANITIZE_STRING) : null;

// Debugging the output

        // Step 1: Fetch passenger_id (ratee_id) and ride_id from bookings table
        $stmt = $pdo->prepare("SELECT passenger_id, ride_id FROM bookings WHERE booking_id = :bookingId");
        $stmt->execute([':bookingId' => $bookingId]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

    

        $passengerId = $booking['passenger_id'];
        $rideId = $booking['ride_id'];

        // Step 2: Fetch driver_id (rater_id) from rides table
        $stmt = $pdo->prepare("SELECT user_id FROM rides WHERE ride_id = :rideId");
        $stmt->execute([':rideId' => $rideId]);
        $ride = $stmt->fetch(PDO::FETCH_ASSOC);

       
        $driverId = $ride['user_id'];
       
        // Step 3: Insert the rating into the ratings table
        $stmt = $pdo->prepare("INSERT INTO ratings (booking_id, rater_id, ratee_id, rating_type, rating_value, review, rating_date) VALUES (:bookingId, :raterId, :rateeId, 'passenger', :rating, :review, NOW())");
        
        $stmt->execute([
            ':bookingId' => $bookingId,
            ':raterId' => $driverId,
            ':rateeId' => $passengerId,
            ':rating' => $rating,
            ':review' => $review
        ]);
       
        $_SESSION['flash_message'] = 'Rating submitted successfully';
        
        // Redirect to dashboard
        header('Location: /driver-dashboard');
        exit;
  
} 

else {
    $_SESSION['flash_message'] = 'Invalid request. Required data missing.';
    header('Location: /manage-booking');
    exit;
}
?>