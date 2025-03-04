<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'] ?? 1; // Simulated user ID

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve POST data
    $action = $_POST['action'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $items = json_decode($_POST['items'], true); // Decode the items array sent from the frontend

    // Check if action is "checkout"
    if ($action === "checkout") {
        // Begin transaction to ensure all actions are successful or none at all
        $conn->begin_transaction();

        try {
            // Insert the order into the orders table
            $stmt = $conn->prepare("INSERT INTO orders (user_id, name, address, phone, total_price) VALUES (?, ?, ?, ?, ?)");

            // Calculate the total price
            $total_price = 0;
            foreach ($items as $item) {
                $total_price += $item['price'] * $item['quantity'];
            }

            $stmt->bind_param("isssd", $user_id, $name, $address, $phone, $total_price);
            $stmt->execute();
            $order_id = $stmt->insert_id; // Get the last inserted order ID

            // Insert order items into the order_items table
            foreach ($items as $item) {
                $stmt_item = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                $stmt_item->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
                $stmt_item->execute();

                // After order item insertion, update cart status to 'inactive' (0) for the products purchased
                $update_cart_status = $conn->prepare("UPDATE cart SET cart_status = 0 WHERE user_id = ? AND product_id = ?");
                $update_cart_status->bind_param("ii", $user_id, $item['product_id']);
                $update_cart_status->execute();
            }

            // Commit the transaction
            $conn->commit();

            // Respond with success
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            // If any error occurs, rollback the transaction
            $conn->rollback();
            echo json_encode(['status' => 'error', 'message' => 'Failed to place order. Please try again.']);
        }
    }
}
?>