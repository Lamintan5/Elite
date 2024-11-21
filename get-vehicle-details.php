<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'elite');
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

$vehicleId = $_GET['id'];
$sql = "SELECT * FROM vehicles WHERE vid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $vehicleId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $vehicle = $result->fetch_assoc();
    echo json_encode($vehicle);
} else {
    echo json_encode(['error' => 'Vehicle not found']);
}

$stmt->close();
$conn->close();
?>
