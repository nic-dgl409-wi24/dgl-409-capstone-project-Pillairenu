<?php
require('partials/head.php');
require('partials/main_nav.php');
require_once 'Database.php';


session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'passenger') {
    header('Location: /signin');
    exit();
}

try {
    $stmt = $pdo->query("
        SELECT rides.*, users.name, users.profile_photo_path
        FROM rides
        JOIN users ON rides.user_id = users.user_id
        
    ");
    
} catch (Exception $e) {
    die("Error fetching rides: " . $e->getMessage());
}
?>
<div class="rides-listing">
<h2>Find Rides</h2>
    <hr>
    <?php if ($stmt->rowCount() > 0): ?>
    <?php while ($ride = $stmt->fetch()): ?>
        <div class="ride">
        <div class="rider-info">
            <img src="images/<?php echo htmlspecialchars($ride['profile_photo_path'] ?: 'images/person.png'); ?>" alt="Driver's Profile Picture" class="profile-pic">
            <h4><?php echo htmlspecialchars($ride['name']); ?></h4>
    </div>
            <div class="ride-details">
                <div class="ride-location">
                <p>Departure: <?php echo htmlspecialchars($ride['departure']); ?></p>
                <p>Destination: <?php echo htmlspecialchars($ride['arrival']); ?></p>
                </div>
                <p>Time: <?php echo htmlspecialchars($ride['time']); ?></p>
                
            </div>
            <!-- <button onclick="location.href='/model/book-trip.model.php?ride_id=<?php echo $ride['ride_id']; ?>'">Book Trip</button> -->
            <button onclick="handleRideDetails('<?php echo $ride['ride_id']; ?>')">Book Trip</button>

            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No rides posted yet.</p>
    <?php endif; ?>
</div>

<?php require('partials/footer.php'); ?>
