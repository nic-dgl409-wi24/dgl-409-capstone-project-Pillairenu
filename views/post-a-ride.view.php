<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');
session_start();?>
 <div class="post-ride-container">
        <h2>Post a Ride</h2>
        <form action="/submit-ride.php" method="POST"> <!-- Update action as needed -->
            <div class="form-group">
                <label for="departure">Departure:</label>
                <input type="text" id="departure" name="departure" required>
            </div>
            <div class="form-group">
                <label for="arrival">Arrival:</label>
                <input type="text" id="arrival" name="arrival" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="seats">Available Seats:</label>
                <select id="seats" name="seats" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price per Seat:</label>
                <input type="number" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="notes">Additional Notes:</label>
                <textarea id="notes" name="notes"></textarea>
            </div>
            <button type="submit" class="submit-btn">Post Ride</button>
        </form>
    </div>

























<?php require('partials/footer.php'); ?>