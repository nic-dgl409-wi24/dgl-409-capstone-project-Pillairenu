<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');?>
<?php


// Check if the user is logged in and has the role of 'driver'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'passenger') {
    header('Location: /signin'); // Redirect to sign-in page if not signed in or not a driver
    exit();
}

require_once 'Database.php'; // Adjust the path as needed to your database connection script

$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("SELECT name, profile_photo_path FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if (!$user) {
        throw new Exception("User not found.");
    }

        // Fetch average rating for the user
        $ratingStmt = $pdo->prepare("SELECT AVG(rating_value) AS average_rating FROM ratings WHERE ratee_id = ? AND rating_type = 'passenger'");
        $ratingStmt->execute([$user_id]);
        $ratingResult = $ratingStmt->fetch();

        $averageRating = $ratingResult ? round($ratingResult['average_rating'], 1) : "Not rated yet";
        $fullStar = "★"; // Full star symbol
        $halfStar = "½"; // Half star symbol (optional, depending on your design)
        $emptyStar = "☆"; // Empty star symbol
        $maxStars = 5;

        // Convert average rating to the nearest half-star for visual representation
        $roundedRating = round($averageRating * 2) / 2;

        // Calculate the number of full and empty stars
        $fullStars = floor($roundedRating);
        $halfStars = $roundedRating - $fullStars >= 0.5 ? 1 : 0;
        $emptyStars = $maxStars - $fullStars - $halfStars;

} catch (Exception $e) {
    // Handle error - user not found or database error
    die("Error: " . $e->getMessage());
}
// Path to default profile picture
$defaultProfilePic = "images/person.png"; // Update this path to your default image location
$user['profile_photo_path'];
$profilePicPath = !empty($user['profile_photo_path']) ? $user['profile_photo_path'] : $defaultProfilePic;
?>

<div class="driver-dashboard">
   
    <div class="driver-options">
    <div class="heading user-dashboard">
        <div class="dashboard-heading">
        <h2 class="page-title">My Dashboard</h2>
        <hr>
        </div>
        
        <div class="user-info">
        <img src="images/person.png" alt="Profile Picture" class="profile-pic">
        <div class="average-rating">
        <span><?php echo "Welcome ".htmlspecialchars($user['name'])."!"; ?></span>
         <!-- Display average rating -->
         <div class="user-rating">
        <?php
        if ($averageRating > 0) {
            // Display full stars
            echo str_repeat($fullStar, $fullStars);
            
            // Display half star, if any
            if ($halfStars) {
                echo $halfStar;
            }
        
            // Display empty stars
            echo str_repeat($emptyStar, $emptyStars);
        } else {
            // No stars are displayed if the average rating is 0 or "Not rated yet"
            // Optionally, display a message if there are no positive ratings
            if ($averageRating === 0) {
                echo "No positive ratings yet."; // This message is optional and can be customized
            } else {
                // If $averageRating is "Not rated yet", it will display that message
                echo "No ratings yet.";;
            }
        }
        ?>
        </div>
        </div>
    </div>
    </div>
    <div class="dashboard-cards">
    <div class="dashboard-card">
    <a href="/find-rides" >
            <div class="card-inner">
                <div class="card-front">
                <img src="images/find-ride.png" alt="Profile Picture" class="profile-pic">

                </div>
                <div class="card-back">
                <h3>Find a Ride</h3>
                    
                </div>
            </div>
        </a>
    </div>
    <div class="dashboard-card">
    <a href="/bookings">
            <div class="card-inner">
                <div class="card-front">
                <img src="images/booking.png" alt="Profile Picture" class="profile-pic">

                </div>
                <div class="card-back">
                <h3>Bookings</h3>
                   
                </div>
            </div>
        </a>
    </div>
</div>
</div>
    

</div>

<?php require('partials/footer.php'); ?>