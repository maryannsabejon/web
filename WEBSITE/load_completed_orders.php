<?php
include 'config.php'; // Include your database connection file

$user_id = $_SESSION['user_id'] ?? 1; // Simulated user ID

$query = "SELECT oi.order_item_id, oi.order_id, p.product_id, p.image, p.name, oi.price, oi.quantity, o.total_price, oi.star_rating 
          FROM order_items oi 
          JOIN products p ON oi.product_id = p.product_id 
          JOIN orders o ON oi.order_id = o.order_id 
          WHERE o.user_id = ? AND o.order_status = 'Completed'
          ORDER BY oi.order_item_id DESC"; 
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>Image</th><th>Name</th><th>Total</th><th>Rating</th><th>Action</th></tr>';
    while ($row = $result->fetch_assoc()) {
        $total = $row['price'] * $row['quantity'];
        echo '<tr>';
        echo '<td><img src="' . $row['image'] . '" alt="' . $row['name'] . '"></td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>₱' . number_format($total, 2) . '</td>';
        $disabled = ($row['star_rating'] >0) ? 'disabled' : '';
        echo '<td>';
        echo '<div class="star-rating">';
        for ($i = 1; $i <= 5; $i++) {
            $checked = ($i <= $row['star_rating']) ? 'checked' : '';
            echo '<span class="star ' . $checked . '" data-rating="' . $i . '" style="pointer-events: none;">&#9733;</span>';
        }
        echo '</div>';
        echo '</td>';
        echo '<td><button class="feedback-btn" data-order-item-id="' . $row['order_item_id'] . '" data-product-id="' . $row['product_id'] . '" ' . $disabled . '>Give Feedback</button></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>No completed orders found.</p>';
}

$stmt->close();
$conn->close();
?>