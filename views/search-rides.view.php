<?php
require_once 'Database.php';

require('partials/head.php');
require('partials/main_nav.php');

$userLoggedIn = isset($_SESSION['user_id']) && ($_SESSION['role'] === 'passenger' || $_SESSION['role'] === 'driver');

try {
    // Start with a base SQL query
    $sql = "
        SELECT rides.*, users.name, users.profile_photo_path
        FROM rides
        JOIN users ON rides.user_id = users.user_id
    ";

    // Initialize an array for SQL conditions and parameters
    $conditions = [];
    $parameters = [];
    
    // Check if the form has been submitted
    if (isset($_GET['search'])) {
        $departure = isset($_GET['departure']) ? $_GET['departure'] : '';
        $destination = isset($_GET['destination']) ? $_GET['destination'] : '';

        // Add conditions for departure if it's not empty
        if (!empty($departure)) {
            $conditions[] = "rides.departure LIKE :departure";
            $parameters[':departure'] = "%$departure%";
        }

        // Add conditions for destination if it's not empty
        if (!empty($destination)) {
            $conditions[] = "rides.arrival LIKE :destination";
            $parameters[':destination'] = "%$destination%";
        }
    }

    // Append conditions to SQL query if any
    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(' AND ', $conditions);
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($parameters);

} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
<div class="search-container">

<div class="sidebar">
    <!-- Filters will go here -->
    <label for="date">Date:</label>
    <input type="date" id="date">
    <label for="gender">Driver's Preferences:</label>
    <select id="gender">
        <option value="any">Men or Women</option>
        <option value="men">Men</option>
        <option value="women">Women</option>
        <option value="other">Other</option>
    </select>
</div>

<div class="main-content">
    <div class="search-form">
    <form method="GET" class="search-form">
        <input type="text" name="departure" id="departure" placeholder="Departure" value="<?php echo isset($_GET['departure']) ? htmlspecialchars($_GET['departure']) : ''; ?>">
        <input type="text" name="destination" id="destination" placeholder="Destination" value="<?php echo isset($_GET['destination']) ? htmlspecialchars($_GET['destination']) : ''; ?>">
        <button type="submit" name="search" id="search">Search</button>
    </form>
    </div>
    <?php if ($stmt && $stmt->rowCount() > 0): ?>
        <div class="ride-list">
            <?php while ($ride = $stmt->fetch()): ?>
                <div class="rides">
                    <img src="images/<?php echo htmlspecialchars($ride['profile_photo_path'] ?: 'person.png'); ?>" alt="Driver" class="ride-photo">
                    <div class="ride-info">
                        <p><strong><?php echo htmlspecialchars($ride['name']); ?></strong></p>
                        <p><b>Time:</b> <?php echo htmlspecialchars($ride['time']); ?></p>
                        <p><b>Departure:</b> <?php echo htmlspecialchars($ride['departure']); ?></p>
                        <p><b>Destination:</b> <?php echo htmlspecialchars($ride['arrival']); ?></p>
                    </div>       
                    <button type="submit" name="search" class="book-btn" onclick="handleRideDetails('<?php echo $ride['ride_id']; ?>')">View Trip</button>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No rides posted yet.</p>
    <?php endif; ?>
</div>
    </div> 
<!-- Modal -->


<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="modalLabel">Sign In Required</h2>     
      </div>
      <div class="modal-body">
        <p>Please sign in to view ride details.</p>
      </div>
      <div class="close-btn-container">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         Close
    </button>
    <a href="/signin" class="btn btn-primary">Sign In</a>
    </div>
    </div>
 
  </div>
</div>

<script>
var userLoggedIn = <?php echo json_encode($userLoggedIn); ?>;
function handleRideDetails(rideId) {
    if (!userLoggedIn) {
        // Redirect to sign-in page or show a pop-up modal to sign in
        $('#successModal').modal('show'); // Example: Alert for demonstration
       // window.location.href = '/signin'; // Redirect to the sign-in page
    } else {
        // If logged in, proceed to view details or book the ride
        window.location.href = '/view-ride?ride_id=' + rideId;
    }
}
</script>
<?php require('partials/footer.php'); ?>
