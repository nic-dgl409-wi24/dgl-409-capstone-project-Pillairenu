<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');
session_start();

?>

<div class="sidebar">
    <!-- Filters will go here -->
    <label for="date">Date:</label>
    <input type="date" id="date">
    <label for="gender">Driver's Preferences:</label>
    <select id="gender">
        <option value="any">Men or Women</option>
        <option value="men">Men</option>
        <option value="women">Women</option>
    </select>
</div>

<div class="main-content">
    <header>
        <!-- Navigation will go here -->
    </header>
    
    <div class="search-form">
        <input type="text" id="departure" placeholder="Departure">
        <input type="text" id="destination" placeholder="Destination">
        <button id="search">Search</button>
    </div>

    <div class="ride-list">
        <!-- Rides will be listed here -->
        <div class="ride">
            <img src="profile1.jpg" alt="Driver" class="ride-photo">
            <div class="ride-info">
                <p><strong>Name</strong></p>
                <p>3.20pm — 4.20pm</p>
                <p>Departure — Destination</p>
            </div>
            <button class="book-btn">Book Trip</button>
        </div>
        <!-- Repeat for each ride -->
    </div>
</div>

<?php require('partials/footer.php'); ?>