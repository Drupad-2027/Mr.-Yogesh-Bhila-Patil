<?php
// Database connection
$conn = new mysqli("localhost", "db_user", "db_pass", "db_name");

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success'=>false, 'error'=>'Database connection failed']));
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$name = $conn->real_escape_string($data['name']);
$message = $conn->real_escape_string($data['message']);
$rating = intval($data['rating']);

// Insert into reviews table
$sql = "INSERT INTO reviews (name, message, rating) VALUES ('$name', '$message', $rating)";
if($conn->query($sql)){
    echo json_encode(['success' => true]);
}else{
    echo json_encode(['success' => false, 'error'=>$conn->error]);
}

$conn->close();
?>
