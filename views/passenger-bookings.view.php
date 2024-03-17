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
        SELECT rides.ride_id, rides.departure, rides.arrival, rides.time, bookings.booking_date
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
               <button onclick="location.href='/payment?ride_id=<?php echo $ride['ride_id']; ?>'">Pay Now</button>
            
            </div>

            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No rides booked yet.</p>
    <?php endif; ?>
</div>

<?php require('partials/footer.php'); ?>

