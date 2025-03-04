<?php
include 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $order_id = $_POST['order_id'];

    if ($action === 'cancel') {
        $query = "UPDATE orders SET order_status = 'Cancelled' WHERE order_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $order_id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to cancel the order.']);
        }

        $stmt->close();
    }
}

$conn->close();
?>