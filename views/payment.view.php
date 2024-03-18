<?php
require('partials/head.php');
require('partials/main_nav.php');
require_once 'Database.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'passenger') {
    header('Location: /signin');
    exit();
}

$user_id = $_SESSION['user_id'];
$rideId = $_GET['ride_id'] ?? ''; // Use null coalescing operator to ensure $rideId is set
$pricePerSeat = 0; // Initialize pricePerSeat

try {
    // Fetch ride details including price per seat
    $rideStmt = $pdo->prepare("SELECT price_per_seat FROM rides WHERE ride_id = :ride_id");
    $rideStmt->execute(['ride_id' => $rideId]);
    $ride = $rideStmt->fetch(PDO::FETCH_ASSOC);
    
    if ($ride) {
        $pricePerSeat = $ride['price_per_seat'];
    } else {
        echo "Ride details not found.";
        exit; // Stop script execution if ride details are not found
    }

    // Fetch user's points balance
    $pointsStmt = $pdo->prepare("SELECT points_balance FROM pointsbalance WHERE user_id = :user_id");
    $pointsStmt->execute(['user_id' => $user_id]);
    $points = $pointsStmt->fetch(PDO::FETCH_ASSOC);
    
    if ($points) {
        $points_balance = $points['points_balance'];
    } else {
        echo "No points balance found.";
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<div class="checkout-container">
<div class="checkout">
        <h2>Checkout</h2>
        <div id="payment-form-message"></div>
        <p class="amount"><strong>Total Amount:</strong>  $<?php echo htmlspecialchars($pricePerSeat); ?> </p>

        <form action="model/payment.model.php?ride_id=<?php echo $rideId; ?>" method="POST" enctype="multipart/form-data" id="payment-form">

            <div class="payment-type">
                <label for="pay-method">Choose Payment Method:</label>
                <select id="pay-method" name="pay-method">
                    <option value="card">Pay with Card</option>
                    <option value="points">Redeem Points</option>
                </select>
            </div>
            
            <div id="card-details">
                <h3>Card Details</h3>
                <input type="text" placeholder="Card Number" >
                <input type="text" placeholder="Expiration Date (MM/YY)" >
                <input type="text" placeholder="CVV" >
            </div>
            
            <div id="points-details" style="display: none;">
                <h3>Redeem Points</h3>
                <p>Available Points: <span id="available-points"><?php echo $points_balance;?></span></p>
                <input type="number" name="points-to-redeem" id="points-to-redeem" placeholder="Points to Redeem" min="1" max="1000">
            </div>
            <div class="button-container">
            <button type="submit">Submit Payment</button>

            </div>
        </form>
    </div>
</div>
    <?php require('partials/footer.php'); ?>