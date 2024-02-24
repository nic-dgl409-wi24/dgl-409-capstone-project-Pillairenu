<?php require('partials/head.php');?>

<?php require('partials/nav.php');?>

<div class="home-page-content">
<section class="ride-share-info" id="driver">
    <div class="container-1">
        <div class="image-side">
            <img src="images/shareride.png" alt="Share Your Ride">
        </div>
        <div class="text-side">
            <h2>Why Share Your Ride?</h2>
            <p>Sharing your ride through RideConnect offers a range of benefits for drivers, including reducing travel costs, lowering carbon emissions, and making travel more social and enjoyable. By sharing your drive, you contribute to a more sustainable and community-oriented way of traveling.</p>
           <div class="feature-container">
                <div class="features-list">
                    <img src="images/saving.png" alt="cost saving">
                   <span>Split fuel and parking costs with passengers</span>
                </div>
                <div class="features-list">
                    <img src="images/carbon.png" alt="carbon footprint">
                    <span> Reduce your carbon footprint by sharing rides</span>
                </div>
                <div class="features-list">
                    <img src="images/community.png" alt="networking">
                    <span> Meet new people and make connections</span>
                </div>
                <div class="features-list">
                    <img src="images/traffic.png" alt="traffic">
                    <span> Fewer cars on the road means less traffic</span>
                </div>
            </div>
            <button onclick="location.href='/driver-signup'" class="signup-btn">Sign Up Now</button>
        </div>
    </div>
</section>
<section class="ride-share-info" id="passenger">
    <div class="container-1">
    <div class="image-side">
            <img src="images/bookride.png" alt="Share Your Ride">
        </div>
        <div class="text-side">
            <h2>Why Book a Ride with Us?</h2>
            <p>Booking your ride through RideConnect is not just about reaching your destination; it's about enjoying a safe, 
                comfortable, and eco-friendly journey. Experience the convenience of ride-sharing with added benefits.</p>
           <div class="feature-container">
                <div class="features-list">
                    <img src="images/saving.png" alt="cost saving">
                   <span>Cost-effective travel options compared to traditional taxi services and rentals</span>
                </div>
                <div class="features-list">
                    <img src="images/carbon.png" alt="carbon footprint">
                    <span> Contribute to the environment by opting for shared journeys</span>
                </div>
                <div class="features-list">
                    <img src="images/community.png" alt="networking">
                    <span> Meet new people and make connections</span>
                </div>
                <div class="features-list">
                    <img src="images/safety.png" alt="safety">
                    <span> Priority on safety of passengers</span>
                </div>
            </div>
            <button onclick="location.href='/passenger-signup'" class="signup-btn">Sign Up Now</button>
        </div>
        
    </div>
</section>
</div>

<?php require('partials/footer.php');?>
 