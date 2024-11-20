<?php
header("Content-Type: application/json");

$conn = new mysqli('localhost', 'root', '', 'elite');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Validate other fields
$vid = $_POST['vid'];
$vehicle = $_POST['vehicle'];
$cid = $_POST['cid'];
$name = $_POST['name'];
$payid = $_POST['payid'];
$start = $_POST['start'];
$end = $_POST['end'];

if (empty($start) || empty($end) || empty($cid) || empty($vid)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit();
}

// Insert data into the rental table
$sql = "INSERT INTO rental (vid, vehicle, cid, name, payid, start, end) 
        VALUES ('$vid', '$vehicle', '$cid', '$name', '$payid', '$start', '$end')";

if ($conn->query($sql) === TRUE) {
    // Update the status of the vehicle to 'Unavailable'
    $updateSql = "UPDATE vehicles SET status = 'Unavailable' WHERE vid = '$vid'";

    if ($conn->query($updateSql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Vehicle rented successfully, status updated to Unavailable']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating vehicle status: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>
