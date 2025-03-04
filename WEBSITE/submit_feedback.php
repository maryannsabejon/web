<?php
include 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_item_id = $_POST['order_item_id'];
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];

    $query = "UPDATE order_items SET star_rating = ? WHERE order_item_id = ? AND product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $rating, $order_item_id, $product_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to submit feedback.']);
    }

    $stmt->close();
}

$conn->close();
?>