<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'] ?? 1; // Simulated user

$query = $conn->prepare("SELECT cart.cart_id, products.product_id, products.image, products.name, products.price, cart.quantity 
                         FROM cart 
                         JOIN products ON cart.product_id = products.product_id 
                         WHERE cart.user_id = ? and cart.cart_status = 1");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);

$total_price = 0;
$output = "<table border='1'><tr>
            <th><input type='checkbox' id='check-all'></th>
            <th>Image</th><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Action</th></tr>";

foreach ($cart_items as $item) {
    $subtotal = $item['price'] * $item['quantity'];
    $total_price += $subtotal;

    $output .= "
        <tr>
            <td><input type='checkbox' class='item-check' data-price='{$item['price']}' data-cart-id='{$item['cart_id']}' data-product-id='{$item['product_id']}'></td>
            <td><img src='{$item['image']}' width='50'></td>
            <td>{$item['name']}</td>
            <td>₱".number_format($item['price'], 2)."</td>
            <td>
                <button class='quantity-btn' data-cart-id='{$item['cart_id']}' data-type='decrease'>-</button>
                <input type='number' class='cart-quantity' data-cart-id='{$item['cart_id']}' value='{$item['quantity']}'>
                <button class='quantity-btn' data-cart-id='{$item['cart_id']}' data-type='increase'>+</button>
            </td>
            <td class='subtotal'>₱".number_format($subtotal, 2)."</td>
            <td><button class='remove-btn' data-cart-id='{$item['cart_id']}'>Remove</button></td>
        </tr>
    ";
}

$output .= "</table>";
echo $output;
?>
