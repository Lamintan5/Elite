<?php
header("Content-Type: application/json");

$conn = new mysqli('localhost', 'root', '', 'elite');

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

$sql = "SELECT vid, make, model, year, status, price FROM vehicles";
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
