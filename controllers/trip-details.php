<?php
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

// Now, pass $rideDetails to the view

require "views/view-ride.php";