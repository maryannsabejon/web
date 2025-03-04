<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'] ?? 1;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'];

    if ($action === "update") {
        $cart_id = $_POST['cart_id'];
        $quantity = $_POST['quantity'];

        // Ensure the quantity is at least 1
        if ($quantity < 1) {
            $quantity = 1; // Default to 1 if invalid
        }

        // Update the quantity in the cart
        $update = $conn->prepare("UPDATE cart SET quantity = ? WHERE cart_id = ? AND user_id = ?");
        $update->bind_param("iii", $quantity, $cart_id, $user_id);
        $update->execute();

        echo json_encode(["status" => "success"]);
    }

    if ($action === "remove") {
        $cart_id = $_POST['cart_id'];
        $delete = $conn->prepare("DELETE FROM cart WHERE cart_id = ? AND user_id = ?");
        $delete->bind_param("ii", $cart_id, $user_id);
        $delete->execute();
        echo json_encode(["status" => "success"]);
    }
}
?>
