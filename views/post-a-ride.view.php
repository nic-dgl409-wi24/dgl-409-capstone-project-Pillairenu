<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');
session_start();

?>
 <div class="post-ride-container">
    <h2 class="page-title">Post a Ride</h2>
    <hr>
    <div class="container">
    <form action="/model/post-a-ride.model.php" method="POST" class="post-ride-form">
        
        <div class="input-group">
            <label for="departure">Departure:</label>
            <input type="text" id="departure" name="departure" placeholder="Enter departure location">
        </div>
        <div class="input-group">
            <label for="arrival">Arrival:</label>
            <input type="text" id="arrival" name="arrival" placeholder="Enter arrival location">
        </div>
        
        <div class="date-time-group">
            <div class="input-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date">
            </div>
            <div class="input-group">
                <label for="time">Time:</label>
                <input type="time" id="time" name="time">
            </div>
        </div>
        <div class="input-group">
            <label for="seats">Available Seats:</label>
            <select id="seats" name="seats" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <!-- Add more options as needed -->
                </select>
        </div>
        <div class="input-group">
            <label for="price">Price per Seat:</label>
            <input type="number" id="price" name="price" placeholder="0.00">
        </div>
        <div class="input-group">
            <label for="notes">Additional Notes:</label>
            <textarea id="notes" name="notes" placeholder="Any additional information..."></textarea>
        </div>
        
        <button type="submit" class="submit-btn">Post Ride</button>
    </form>
    <div id="mapContainer"></div>
</div>
    
    
</div>
























<?php require('partials/footer.php'); ?>