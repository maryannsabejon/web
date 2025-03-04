<?php
include 'config.php';
header('Content-Type: application/json');

// Hide PHP warnings/notices (for production)
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("
            SELECT p.*, 
                   COALESCE(AVG(oi.star_rating), 0) AS rating, 
                   COALESCE(SUM(oi.quantity), 0) AS sold 
            FROM products p 
            LEFT JOIN order_items oi ON p.product_id = oi.product_id 
            WHERE p.product_id = ? 
            GROUP BY p.product_id
        ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        echo json_encode($result->fetch_assoc() ?: ["message" => "Product not found"]);
    } else {
        $stmt = $conn->prepare("
            SELECT p.*, 
                   COALESCE(AVG(oi.star_rating), 0) AS rating, 
                   COALESCE(SUM(oi.quantity), 0) AS sold 
            FROM products p 
            LEFT JOIN order_items oi ON p.product_id = oi.product_id 
            GROUP BY p.product_id 
            ORDER BY p.product_id DESC
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    }
    exit;
}
if ($method === 'POST') {
    $id    = $_POST['id'] ?? '';
    $name  = $_POST['name'] ?? '';
    $desc  = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $imagePath = '';

    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        $imagePath = $targetDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    if (!empty($id)) {
        if (empty($imagePath)) {
            $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, stock=? WHERE product_id=?");
            $stmt->bind_param("ssdii", $name, $desc, $price, $stock, $id);
        } else {
            $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, stock=?, image=? WHERE product_id=?");
            $stmt->bind_param("ssdiss", $name, $desc, $price, $stock, $imagePath, $id);
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, stock, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdss", $name, $desc, $price, $stock, $imagePath);
    }

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Product saved successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "DB Error: " . $conn->error]);
    }
    exit;
}

if ($method === 'DELETE') {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Product deleted successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error deleting product: " . $conn->error]);
        }
    }
    exit;
}

echo json_encode(["message" => "Invalid Request"]);
exit;
?>
