<?php
header("Content-Type: application/json");

$conn = new mysqli('localhost', 'root', '', 'elite');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

$vid = $_POST['vid'];
$vehicle = $_POST['vehicle'];
$cid = $_POST['cid'];
$name = $_POST['name'];
$payid = $_POST['payid'];
$start = $_POST['start'];
$end = $_POST['end'];
$amount = $_POST['amount'];
$method = $_POST['method'];

if (empty($start) || empty($end) || empty($cid) || empty($vid) || empty($amount) || empty($method)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit();
}

$conn->begin_transaction();

try {
    $rentalSql = "INSERT INTO rental (vid, vehicle, cid, name, payid, start, end) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($rentalSql);
    $stmt->bind_param('sssssss', $vid, $vehicle, $cid, $name, $payid, $start, $end);

    if (!$stmt->execute()) {
        throw new Exception('Error inserting rental data: ' . $stmt->error);
    }

    $updateSql = "UPDATE vehicles SET status = 'Unavailable' WHERE vid = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param('s', $vid);

    if (!$stmt->execute()) {
        throw new Exception('Error updating vehicle status: ' . $stmt->error);
    }

    $paymentSql = "INSERT INTO payments (cid, name, amount, method) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($paymentSql);
    $stmt->bind_param('ssds', $cid, $name, $amount, $method);

    if (!$stmt->execute()) {
        throw new Exception('Error inserting payment data: ' . $stmt->error);
    }

    $conn->commit();

    echo json_encode(['success' => true, 'message' => 'Vehicle rented successfully, status updated to Unavailable, and payment recorded']);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>
