<?php
header("Content-Type: application/json");

$conn = new mysqli('localhost', 'root', '', 'elite');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Validate and upload image
if (isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $imagePath = 'uploads/' . basename($image['name']);
    if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
        echo json_encode(['success' => false, 'message' => 'Failed to upload image']);
        exit();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No image uploaded']);
    exit();
}

// Validate other fields
$make = $_POST['make'];
$model = $_POST['model'];
$year = $_POST['year'];
$price = $_POST['price'];
$description = $_POST['description'];

if (empty($make) || empty($model) || empty($year) || empty($price)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit();
}

// Insert data into the database
$sql = "INSERT INTO vehicles (image, make, model, year, price, status, description) 
        VALUES ('$imagePath', '$make', '$model', '$year', '$price', 'Available', '$description')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Vehicle added successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>
