<?php
require('partials/head.php');
require('partials/main_nav.php');
require_once 'Database.php';



if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'passenger') {
    header('Location: /signin');
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("
        SELECT rides.ride_id, rides.departure, rides.arrival, rides.time,bookings.booking_id, bookings.booking_date
        FROM bookings
        JOIN rides ON bookings.ride_id = rides.ride_id
        WHERE bookings.passenger_id = ?
        ORDER BY bookings.booking_date DESC
    ");
    $stmt->execute([$user_id]);
} catch (Exception $e) {
    die("Error fetching booked rides: " . $e->getMessage());
}
?>

<div class="bookings-listing">
    <h2>Your Booked Rides</h2>
    <hr class="hr">
    <?php if ($stmt->rowCount() > 0): ?>
        <?php while ($ride = $stmt->fetch()): ?>
            <div class="booking">
                <div class="ride-details">
                    <p>Departure: <?php echo htmlspecialchars($ride['departure']); ?></p>
                    <p>Destination: <?php echo htmlspecialchars($ride['arrival']); ?></p>
                    <p>Time: <?php echo htmlspecialchars($ride['time']); ?></p>
                    <p>Booking Date: <?php echo htmlspecialchars($ride['booking_date']); ?></p>
                    
                </div>

                
               <div class="booking-btn-container">
               <button onclick="location.href='/payment?ride_id=<?php echo $ride['ride_id']; ?>'" id="pay-button">Pay Now</button>
               <button id="cancel-button" data-booking-id="<?php echo $ride['booking_id']; ?>">Cancel</button>


            </div>

            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No rides booked yet.</p>
    <?php endif; ?>
</div>
<!-- Cancel Confirmation Modal -->
<div id="cancelModal" class="modal">
    <div class="modal-content">
        <h2>Are you sure you want to cancel this booking?</h2>
        <button id="confirmCancel">Yes, cancel it</button>
        <button id="closeModal">No, go back</button>
    </div>
</div>

<?php require('partials/footer.php'); ?>

