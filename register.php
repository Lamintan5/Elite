<?php
session_start(); // Start the session

$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_BCRYPT);

$conn = new mysqli('localhost', 'root', '', 'elite');
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

$sql = "SELECT email FROM users WHERE BINARY email = '".$email."'";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
  
if($count == 1) {
    echo json_encode(['success' => false, 'message' => 'Email already exists. Please try a different email address.']);
} else {
    // Insert new user into the database
    $insert = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    $query = mysqli_query($conn,$insert);
    
    if($query) {
        // Get the user's ID after successful insertion
        $userId = mysqli_insert_id($conn); // Get the last inserted user ID
        
        // Store user data in the session
        $_SESSION['user'] = [
            'id' => $userId,
            'name' => $name,
            'email' => $email,
        ];
        
        echo json_encode(['success' => true, 'message' => 'Registration successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }
}

$conn->close();
?>
