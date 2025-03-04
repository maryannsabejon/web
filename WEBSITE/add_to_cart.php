<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';

header('Content-Type: application/json'); // JSON Header

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $user_id = $_SESSION['user_id'] ?? 1; // Example session user_id (replace with your session logic)

    if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
        echo json_encode(["success" => false, "error" => "Missing product_id"]);
        exit;
    }

    $product_id = intval($_POST['product_id']);
    $quantity = 1; // Default quantity
    $cart_status = 1; // 1 = active, 0 = inactive (on/off logic)

    // Check if product already in cart
    $stmt = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ? AND cart_status = ?");
    $stmt->bind_param("iii", $user_id, $product_id, $cart_status);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + $quantity;

        $updateStmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ? AND cart_status = ?");
        $updateStmt->bind_param("iiii", $new_quantity, $user_id, $product_id, $cart_status);

        if ($updateStmt->execute()) {
            echo json_encode(["success" => true, "message" => "Product quantity updated"]);
        } else {
            echo json_encode(["success" => false, "error" => $updateStmt->error]);
        }

        $updateStmt->close();
    } else {
        // If product doesn't exist → Insert new cart item
        $insertStmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity, cart_status) VALUES (?, ?, ?, ?)");
        $insertStmt->bind_param("iiii", $user_id, $product_id, $quantity, $cart_status);

        if ($insertStmt->execute()) {
            echo json_encode(["success" => true, "message" => "Product added to cart"]);
        } else {
            echo json_encode(["success" => false, "error" => $insertStmt->error]);
        }

        $insertStmt->close();
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
