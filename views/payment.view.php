<?php
require('partials/head.php');
require('partials/main_nav.php');
require_once 'Database.php';


?>
<div class="checkout-container">
<div class="checkout">
        <h2>Checkout</h2>
        <form id="payment-form">
            <div class="payment-type">
                <label for="pay-method">Choose Payment Method:</label>
                <select id="pay-method" name="pay-method">
                    <option value="card">Pay with Card</option>
                    <option value="points">Redeem Points</option>
                </select>
            </div>
            
            <div id="card-details">
                <h3>Card Details</h3>
                <input type="text" placeholder="Card Number" required>
                <input type="text" placeholder="Expiration Date (MM/YY)" required>
                <input type="text" placeholder="CVV" required>
            </div>
            
            <div id="points-details" style="display: none;">
                <h3>Redeem Points</h3>
                <p>Available Points: <span id="available-points">1000</span></p>
                <input type="number" id="points-to-redeem" placeholder="Points to Redeem" min="1" max="1000" required>
            </div>
            <div class="button-container">
            <button type="submit">Submit Payment</button>
            </div>
        </form>
    </div>
</div>
    <?php require('partials/footer.php'); ?>