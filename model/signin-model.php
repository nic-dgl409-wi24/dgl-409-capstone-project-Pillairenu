<?php
// Start the session
session_start();
require_once('../Database.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       echo $email = $_POST['email'];
       echo  $password = $_POST['password'];

        // Prepare SQL statement to select the user
     $stmt = $pdo->prepare("
        SELECT u.user_id, u.email, u.password, r.role_name 
        FROM users u
        INNER JOIN user_roles ur ON u.user_id = ur.user_id
        INNER JOIN roles r ON ur.role_id = r.role_id
        WHERE u.email = ?
    ");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
//var_dump($user);
echo  $user['password'];
        // Verify user exists and password is correct
        if ($user && ($password === $user['password'])) {
           
            $_SESSION['user_id'] = $user['user_id']; // Store user id in session
            $_SESSION['role'] = $user['role_name']; // Storing the role name in the session

            // Redirect based on role
            switch ($user['role_name']) {
                case 'driver':
                    header('Location: /driver-dashboard');
                    break;
                case 'passenger':
                    header('Location: /passenger-dashboard');
                    break;
                case 'admin':
                    header('Location: /admin-dashboard');
                    break;
                default:
                    // Handle other roles or a default case
                    header('Location: /');
                    break;
            }
            exit();
        } else {
            // Invalid password
            // Consider redirecting back to the sign-in page with an error message
            echo "Invalid email or password.";
        }
    } else {
        // No user found
        // Consider redirecting back to the sign-in page with an error message
        echo "Invalid email or password.";
    }
?>
