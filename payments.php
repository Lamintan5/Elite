<?php
header("Content-Type: application/json");

// Database connection
$conn = new mysqli('localhost', 'root', '', 'elite');

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Fetch vehicles
$sql = "SELECT payid, name, amount, method, time FROM payments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $vehicles = [];
    while ($row = $result->fetch_assoc()) {
        $vehicles[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $vehicles]);
} else {
    echo json_encode(['success' => true, 'data' => []]); // No vehicles
}

$conn->close();
?>
