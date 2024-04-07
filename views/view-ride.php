<?php
require('partials/head.php');
require('partials/main_nav.php');
require_once 'Database.php'; 

// Assuming your Database.php file returns a PDO connection in some way, for example:
// $pdo = (new Database())->getConnection();

$rideId = $_GET['ride_id'] ?? null;
if (!$rideId) {
    die("Ride ID is required.");
}

$sql = "SELECT rides.*, users.name, users.email, users.gender, 
               vehicles.vehicle_make_model, vehicles.vehicle_photo_path
        FROM rides
        JOIN users ON rides.user_id = users.user_id
        JOIN vehicles ON users.user_id = vehicles.user_id
        WHERE rides.ride_id = :ride_id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['ride_id' => $rideId]);
    $rideDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$rideDetails) {
        die("Ride details not found.");
    }
} catch (Exception $e) {
    die("Error fetching ride details: " . $e->getMessage());
}
?>
<div class="view-ride">
<!-- View section for displaying ride details -->
<div class="ride-details-container">
    <h1>Ride Details</h1>
    <!-- Display ride details -->
    <div class="ride-details">
    
        <!-- Display driver and vehicle information -->
        <div class="driver-info">
            <h2>Driver: <?php echo htmlspecialchars($rideDetails['name']); ?></h2>
            <p>Email: <?php echo htmlspecialchars($rideDetails['email']); ?></p>
            <p>Gender: <?php echo htmlspecialchars($rideDetails['gender']); ?></p>
        </div>
        <div class="vehicle-info">
            <h3>Vehicle Details</h3>
            <img src="images/<?php echo htmlspecialchars($rideDetails['vehicle_photo_path'] ?? 'car.png'); ?>" alt="Vehicle Image" class="vehicle-img">
            <p>Make and Model: <?php echo htmlspecialchars($rideDetails['vehicle_make_model']); ?></p>
        </div>
        <div class="view-ride-info">
            <h3>Ride Information</h3>
            <p>Departure: <?php echo htmlspecialchars($rideDetails['departure']); ?></p>
            <p>Arrival: <?php echo htmlspecialchars($rideDetails['arrival']); ?></p>
            <p>Date: <?php echo htmlspecialchars($rideDetails['date']); ?></p>
            <p>Time: <?php echo htmlspecialchars($rideDetails['time']); ?></p>
        </div>
        <!-- Display booking button or sign-in prompt based on user session -->
   
        <?php
// Check if the user is logged in and is not a driver
if (isset($_SESSION['user_id']) && $_SESSION['role'] !== 'driver') {
    // Display the "Book Trip" button
    echo '<button onclick="location.href=\'/model/book-trip.model.php?ride_id=' . $rideId . '\'">Book Trip</button>';
}
?>    
    </div>
</div>
</div>
<?php require('partials/footer.php'); ?>
