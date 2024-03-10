<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');
session_start();

// Check if the user is logged in and has the role of 'driver'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'driver') {
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
} catch (Exception $e) {
    // Handle error - user not found or database error
    die("Error: " . $e->getMessage());
}
// Path to default profile picture
$defaultProfilePic = "images/user-female.png"; // Update this path to your default image location
$profilePicPath = !empty($user['profile_photo_path']) ? $user['profile_photo_path'] : $defaultProfilePic;
?>

<div class="driver-dashboard">
    <div class="user-info">
        <img src="images/<?php echo htmlspecialchars($profilePicPath); ?>" alt="Profile Picture" class="profile-pic">
        <span><?php echo "Welcome ".htmlspecialchars($user['name'])."!"; ?></span>
        <a href="/logout">Logout</a>
    </div>
    <div class="driver-options">
    <div class="heading">
        <h2 class="page-title">My Dashboard</h2>
        <hr>
    </div>
    <!-- <div class="dashboard-cards">
        <a href="/post-a-ride" class="dashboard-card"> 
        
            <h3>Post a Ride</h3>
        </a>
        <a href="/post-an-event" class="dashboard-card"> 
            <h3>Post an Event</h3>
        </a>
        
    </div> -->

    <div class="dashboard-cards">
    <div class="dashboard-card">
    <a href="/post-a-ride" >
            <div class="card-inner">
                <div class="card-front">
                <img src="images/post_ride.png" alt="Profile Picture" class="profile-pic">

                </div>
                <div class="card-back">
                <h3>Post a Ride</h3>
                    
                </div>
            </div>
        </a>
    </div>
    <div class="dashboard-card">
    <a href="/post-an-event">
            <div class="card-inner">
                <div class="card-front">
                <img src="images/post_event.png" alt="Profile Picture" class="profile-pic">

                </div>
                <div class="card-back">
                <h3>Post an Event</h3>
                   
                </div>
            </div>
        </a>
    </div>
</div>
</div>

<?php require('partials/footer.php'); ?>