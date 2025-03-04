<?php
include 'config.php'; // Include your database connection file

$user_id = $_SESSION['user_id'] ?? 1; // Simulated user ID

$query = "SELECT o.order_id, o.name, o.total_price, o.order_status, COUNT(oi.order_item_id) AS total_items
          FROM orders o
          JOIN order_items oi ON o.order_id = oi.order_id
          WHERE o.user_id = ? AND o.order_status = 'Cancelled'
          GROUP BY o.order_id";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>Name</th><th>Total Items</th><th>Total Price</th><th>Status</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['total_items'] . '</td>';
        echo '<td>₱' . number_format($row['total_price'], 2) . '</td>';
        echo '<td>' . $row['order_status'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>No cancelled orders found.</p>';
}

$stmt->close();
$conn->close();
?>