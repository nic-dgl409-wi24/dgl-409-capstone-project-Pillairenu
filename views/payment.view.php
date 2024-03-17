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
    // Use a prepared statement with placeholders for variables to prevent SQL injection
    $stmt = $pdo->prepare("
        SELECT points_balance
        FROM pointsbalance
        WHERE user_id = :user_id
    ");
    
    // Bind the $user_id variable to the placeholder and execute the query
    $stmt->execute(['user_id' => $user_id]);
    
    // Fetch the result
    $points = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Check if we got a result
    if ($points) {
        $points_balance = $points['points_balance'];
        //echo "Points Balance: " . $points_balance;
    } else {
        echo "No points balance found.";
    }
} catch (Exception $e) {
    die("Error fetching points balance: " . $e->getMessage());
}
?>

<div class="checkout-container">
<div class="checkout">
        <h2>Checkout</h2>
        <div id="payment-form-message"></div>

        <form action="model/payment.model.php" method="POST" enctype="multipart/form-data" id="payment-form">

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
                <input type="number" name="points-to-redeem" id="points-to-redeem" placeholder="Points to Redeem" min="1" max="1000" required>
            </div>
            <div class="button-container">
            <button type="submit">Submit Payment</button>

            </div>
        </form>
    </div>
</div>
    <?php require('partials/footer.php'); ?>