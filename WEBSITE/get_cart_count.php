<?php
session_start();
include 'config.php';

header('Content-Type: application/json'); // Set JSON header

$user_id = $_SESSION['user_id'] ?? 1; // Replace with actual session user_id
$cart_status = 1; // 1 = active, 0 = inactive (on/off logic)

// Prepare SQL with cart_status condition
$stmt = $conn->prepare("SELECT SUM(quantity) AS total FROM cart WHERE user_id = ? AND cart_status = ?");
$stmt->bind_param("ii", $user_id, $cart_status);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Return cart count or 0 if no cart items
echo json_encode(["count" => $row['total'] ?? 0]);

$stmt->close();
$conn->close();
?>
