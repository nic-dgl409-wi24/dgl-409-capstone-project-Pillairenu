<?php require('partials/head.php');?>

<?php require('partials/main_nav.php');
session_start();

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
    <div class="user-info">
        <img src="<?php echo $defaultProfilePic; ?>" alt="Profile Picture" class="profile-pic">
        <span><?php echo "Welcome ".htmlspecialchars($user['name'])."!"; ?></span>
        <a href="/logout">Logout</a>
    </div>
    <div class="dashboard-cards">
        <a href="/find-rides" class="dashboard-card"> <!-- Update href as needed -->
        
            <h3>Find a Ride</h3>
        </a>
        <a href="/bookings" class="dashboard-card"> <!-- Update href as needed -->
            <h3>Bookings</h3>
        </a>
    </div>
</div>

<?php require('partials/footer.php'); ?>