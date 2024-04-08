<?php
require('partials/head.php');
require('partials/main_nav.php');
require_once 'Database.php';

// Ensure the session is started (if it's not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$driverId = $_SESSION['user_id']; // Assuming the driver's user ID is stored in session

try {
    $query = "
    SELECT DISTINCT
    payments.payment_id, 
    bookings.booking_id, 
    users.name AS passenger_name, 
    users.profile_photo_path, 
    rides.departure, 
    rides.arrival, 
    rides.date, 
    rides.time,
    payments.payment_status
    FROM payments
    JOIN bookings ON payments.ride_id = bookings.ride_id
    JOIN rides ON payments.ride_id = rides.ride_id
    JOIN users ON bookings.passenger_id = users.user_id
    WHERE payments.user_id = bookings.passenger_id AND rides.user_id= ? AND payments.payment_status = 'success'
    ORDER BY payments.payment_date DESC;

    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$driverId]);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    die("Error fetching driver bookings: " . $e->getMessage());
}
$defaultProfilePic = "images/user-female.png"; // Update this path to your default image location
$profilePicPath = !empty($booking['profile_photo_path']) ? $booking['profile_photo_path']: $defaultProfilePic;
?>

<div class="bookings-listing">
<div class="dashboard-heading">
        <h2 class="page-title">Complete Ride</h2>
        <hr class="complete-hr">
        </div>
    <?php if (!empty($bookings)): ?>
        <?php foreach ($bookings as $booking): ?>
            <div class="finish-booking">
                <div >
                    <img src="<?php echo htmlspecialchars($defaultProfilePic); ?>" class="booking-manage-image" alt="Passenger Photo">
                </div>
                <div class="booking-manage"> 
                    <p>Passenger: <?php echo htmlspecialchars($booking['passenger_name']); ?></p>
                    <p>From: <?php echo htmlspecialchars($booking['departure']); ?> to <?php echo htmlspecialchars($booking['arrival']); ?></p>
                    <p>Date: <?php echo htmlspecialchars($booking['date']); ?></p>
                    <p> Time: <?php echo htmlspecialchars($booking['time']); ?></p>
                </div>
                <div class="booking-details-button">

                <?php

                $ratingQuery = "
                SELECT
                    rating_id
                FROM
                    ratings
                WHERE
                    booking_id = ? AND
                    rater_id = ? AND
                    rating_type = 'passenger';
                ";

                $stmt = $pdo->prepare($ratingQuery);
                $stmt->execute([$booking['booking_id'], $driverId]);
                $rating = $stmt->fetch(PDO::FETCH_ASSOC);
        
                // Check if a rating exists
                if ($rating) { 
                    echo '<button disabled>Ride Completed</button>'; // Disable button if rating exists
                } else { 
                    echo '<button class="mark-completed" id="markAsCompletedButton" data-booking-id="' . $booking['booking_id'] . '" onclick="showCompletionModal(this);">Mark as Completed</button>';
                }
                ?>
        <!-- Other booking details here -->

</div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No bookings found.</p>
    <?php endif; ?>
</div>
<!-- Completion and Rating Modal -->
<div id="completionModal" style="display:none; position: fixed; z-index: 100; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
    <div style="background-color: white; padding: 50px; border-radius: 5px; display: flex; flex-direction: column; align-items: center;">
        <p id="completionMessage">The ride is completed.</p>
        <div id="starRating">
            <p>Rate Your Passenger:</p>
            <!-- Star Rating System -->
            <div class="star-rating">
                <span class="star" data-value="5">&#9733;</span>
                <span class="star" data-value="4">&#9733;</span>
                <span class="star" data-value="3">&#9733;</span>
                <span class="star" data-value="2">&#9733;</span>
                <span class="star" data-value="1">&#9733;</span>
            </div>
        </div>
       
        
        <form id="ratingForm" action="model/submit-rating-model.php" method="POST">
        <input type="hidden" id="hiddenRating" name="rating" value="">
        <input type="hidden" id="hiddenBookingId" name="bookingId" value="">
       
        <button id="submitRatingButton" style="margin-top: 20px;" onclick="submitRating()">Submit Rating</button>
        </form>
        <button style="margin-top: 20px;"onclick="hideCompletionModal()">Close</button>
    </div>
</div>


<?php require('partials/footer.php'); ?>
