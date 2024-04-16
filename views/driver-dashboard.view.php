<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');


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

?>

<div class="driver-dashboard">
<div class="heading user-dashboard">
        <div class="dashboard-heading">
        <h2 class="page-title">My Dashboard</h2>
        <hr>
        </div>
        <div class="user-info">
        <?php if ($user['profile_photo_path']): ?>
         <img src="/uploads/<?php echo $user['profile_photo_path'] ?>" alt="Profile Picture1" class="profile-pic">
            <?php else: ?>
            <img src="images/person.png" alt="Default Profile Picture" class="profile-pic">
        <?php endif; ?>
        <span><?php echo "Hi ".htmlspecialchars($user['name'])."!"; ?></span>
    </div>
    </div>
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
    <a href="/manage-bookings">
            <div class="card-inner">
                <div class="card-front">
                <img src="images/booking.png" alt="Profile Picture" class="profile-pic">

                </div>
                <div class="card-back">
                <h3>Manage Rides</h3>
                   
                </div>
            </div>
        </a>
    </div>
</div>
</div>

<?php require('partials/footer.php'); ?>