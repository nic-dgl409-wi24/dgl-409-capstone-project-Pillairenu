<?php
require_once('../Database.php');
session_start();

// Redirect if not signed in or not a passenger
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'passenger') {
    header('Location: /signin');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay-method']) && $_POST['pay-method'] === 'points') {
    // The amount of points the user wants to redeem, adjust based on your form input
   $pointsToRedeem = $_POST['points-to-redeem'];
   

    try {
        // Begin a transaction
        $pdo->beginTransaction();

        // Check current points balance
        $stmt = $pdo->prepare("SELECT points_balance FROM pointsbalance WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['points_balance'] >= $pointsToRedeem) {
            // Deduct points from balance and add new points
            $newBalance = $result['points_balance'] - $pointsToRedeem + 20; 
            $updateStmt = $pdo->prepare("UPDATE pointsbalance SET points_balance = :new_balance WHERE user_id = :user_id");
            $updateStmt->execute(['new_balance' => $newBalance, 'user_id' => $user_id]);

            // Record the transaction
            $transactionStmt = $pdo->prepare("INSERT INTO PointsTransactions (user_id, points, transaction_type, description) VALUES (:user_id, :points, 'redeem', 'Redeemed points for ride')");
            $transactionStmt->execute(['user_id' => $user_id, 'points' => -$pointsToRedeem]);

            $bonusStmt = $pdo->prepare("INSERT INTO PointsTransactions (user_id, points, transaction_type, description) VALUES (:user_id, :points, 'earn', 'Bonus points for booking ride')");
            $bonusStmt->execute(['user_id' => $user_id, 'points' => 20]);

            $pdo->commit();
            echo "Payment successful. Points redeemed and bonus points added.";
        } else {
            echo "Not enough points to redeem.";
        }
    } catch (Exception $e) {
        $pdo->rollBack();
        die("Error processing payment: " . $e->getMessage());
    }
}
?>
