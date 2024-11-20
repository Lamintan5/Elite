<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'elite');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

$rentalId = $_GET['rid'] ?? '';
if (!$rentalId) {
    echo json_encode(['success' => false, 'message' => 'No rental ID provided']);
    exit();
}

// Fetch rental details
$sql = "SELECT * FROM rental WHERE rid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $rentalId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $rental = $result->fetch_assoc();
    echo json_encode(['success' => true, 'rental' => $rental]);
} else {
    echo json_encode(['success' => false, 'message' => 'Rental not found']);
}

$stmt->close();
$conn->close();
?>
