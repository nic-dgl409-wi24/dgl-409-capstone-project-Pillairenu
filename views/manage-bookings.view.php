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
    SELECT 
    bookings.booking_id, 
    users.name AS passenger_name, 
    users.profile_photo_path, 
    rides.departure, 
    rides.arrival, 
    rides.date, 
    rides.time,
    payments.amount,
    payments.payment_method,
    payments.payment_status,
    payments.payment_date
FROM payments
JOIN bookings ON payments.ride_id = bookings.ride_id
JOIN rides ON bookings.ride_id = rides.ride_id
JOIN users ON bookings.passenger_id = users.user_id
WHERE rides.user_id= ? AND payments.payment_status = 'success'
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
    <?php if (!empty($bookings)): ?>
        <?php foreach ($bookings as $booking): ?>
            <div class="booking-manage">

                <img src="<?php echo htmlspecialchars($defaultProfilePic); ?>" alt="Passenger Photo">
                <p>Passenger: <?php echo htmlspecialchars($booking['passenger_name']); ?></p>
                <p>From: <?php echo htmlspecialchars($booking['departure']); ?> To: <?php echo htmlspecialchars($booking['arrival']); ?></p>
                <p>Date: <?php echo htmlspecialchars($booking['date']); ?> Time: <?php echo htmlspecialchars($booking['time']); ?></p>
                <button class="mark-completed" data-booking-id="<?php echo $booking['booking_id']; ?>">Mark as Completed</button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No bookings found.</p>
    <?php endif; ?>
</div>

<?php require('partials/footer.php'); ?>
