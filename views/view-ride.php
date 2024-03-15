<?php

session_start();
require('partials/head.php');
require('partials/main_nav.php');
require_once 'Database.php'; // Ensure this path is correct


// Initialize the database connection
$pdo = (new Database())->getConnection();

// Initialize the RideModel with PDO connection
$rideModel = new RideModel($pdo);

$rideId = $_GET['ride_id'] ?? null;
if (!$rideId) {
    die("Ride ID is required.");
}

$rideDetails = $rideModel->getRideDetails($rideId);
if (!$rideDetails) {
    die("Ride details not found.");
}
?>

<div class="ride-details-container">
    <h1>Ride Details</h1>
    <div class="ride-details">
        <div class="driver-info">
            <img src="images/<?php echo htmlspecialchars($rideDetails['vehicle_photo_path']) ?: 'default-vehicle.jpg'; ?>" alt="Vehicle Image" class="vehicle-img">
            <h2>Driver: <?php echo htmlspecialchars($rideDetails['name']); ?></h2>
            <p>Email: <?php echo htmlspecialchars($rideDetails['email']); ?></p>
            <p>Gender: <?php echo htmlspecialchars($rideDetails['gender']); ?></p>
        </div>
        <div class="vehicle-info">
            <h3>Vehicle Details</h3>
            <p>Make and Model: <?php echo htmlspecialchars($rideDetails['vehicle_make_model']); ?></p>
        </div>
        <div class="ride-info">
            <h3>Ride Information</h3>
            <p>Departure: <?php echo htmlspecialchars($rideDetails['departure']); ?></p>
            <p>Arrival: <?php echo htmlspecialchars($rideDetails['arrival']); ?></p>
            <p>Date: <?php echo htmlspecialchars($rideDetails['date']); ?></p>
            <p>Time: <?php echo htmlspecialchars($rideDetails['time']); ?></p>
        </div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <button onclick="location.href='/model/book-trip.model.php?ride_id=<?php echo $rideDetails['ride_id']; ?>'">Book Ride</button>
        <?php else: ?>
            <p>Please <a href="/signin">sign in</a> to book a ride.</p>
        <?php endif; ?>
    </div>
</div>

<?php require('partials/footer.php'); ?>