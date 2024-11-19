<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    // <?php   
    // Check if the user is logged in
    $isLoggedIn = isset($_SESSION['user']); // Boolean to check session

    // if ($isLoggedIn) {
        // Access user data from the session
       // $user = $_SESSION['user'];
        // echo "<h1>Welcome, " . htmlspecialchars($user['name']) . "!</h1>";
        // echo "<p>Email: " . htmlspecialchars($user['email']) . "</p>";
        // echo '<a href="logout.php"><button>Logout</button></a>';
    // } else {
        // Show login button if not logged in
        // echo "<h1>You are not logged in.</h1>";
        // echo '<a href="auth.html"><button>Login</button></a>';
    //}
    // ?>
</body>
</html>
