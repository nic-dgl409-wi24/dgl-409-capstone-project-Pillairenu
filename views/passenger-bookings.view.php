<?php
require('partials/head.php');
require('partials/main_nav.php');
require_once 'Database.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'passenger') {
    header('Location: /signin');
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("
        SELECT rides.*, users.name AS driver_name, users.profile_photo_path, bookings.booking_date
        FROM bookings
        JOIN rides ON bookings.ride_id = rides.ride_id
        JOIN users ON rides.user_id = users.user_id
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
    <?php if ($stmt->rowCount() > 0): ?>
        <?php while ($ride = $stmt->fetch()): ?>
            <div class="booking">
                <div class="driver-info">
                    <img src="<?php echo htmlspecialchars($ride['profile_photo_path'] ?: 'images/person.png'); ?>" alt="Driver's Profile Picture" class="profile-pic">
                    <h4><?php echo htmlspecialchars($ride['driver_name']); ?></h4>
                </div>
                <div class="ride-details">
                    <p>Departure: <?php echo htmlspecialchars($ride['departure']); ?></p>
                    <p>Destination: <?php echo htmlspecialchars($ride['arrival']); ?></p>
                    <p>Time: <?php echo htmlspecialchars($ride['time']); ?></p>
                    <p>Booking Date: <?php echo htmlspecialchars($ride['booking_date']); ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No rides booked yet.</p>
    <?php endif; ?>
</div>

<?php require('partials/footer.php'); ?>
