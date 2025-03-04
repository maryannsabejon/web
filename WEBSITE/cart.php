<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('images/bg1.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);
        }

        .logo {
            width: 90px;
        }

        .btn {
            background: #ccc;
            color: black;
            padding: 10px 15px;
            margin: 10px 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #aaa;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .checkout-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #444;
            color: white;
        }

        td img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        .qty-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn {
            background: #ccc;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 3px;
            transition: 0.3s;
        }

        .qty-btn:hover {
            background: #aaa;
        }

        .qty-input {
            width: 60px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 16px;
            margin: 0 5px;
        }

        .delete-btn {
            background: red;
            color: white;
            border: none;
            padding: 6px 10px;
            cursor: pointer;
            border-radius: 3px;
            font-size: 14px;
        }

        .delete-btn:hover {
            background: darkred;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .checkbox-container label {
            font-size: 14px;
            color: #333;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            width: 30%;
            position: relative;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .modal-content h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 30px;
            color: black;
            cursor: pointer;
        }

        .close:hover {
            color: red;
        }

        .modal-form label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        .modal-form input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .order-summary {
            background: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
        }

        .order-summary div {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }

        .checkout-btn {
            width: 100%;
            background: #333;
            color: white;
            padding: 10px;
            margin-top: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .checkout-btn:hover {
            background: #555;
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background: #ccc;
            margin: 0 5px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .tab.active {
            background: #aaa;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
        .star-rating {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .star {
            font-size: 20px;
            color: #ccc;
            cursor: pointer;
        }

        .star.checked {
            color: gold;
        }
    </style>
</head>
<body>

<header>
    <img src="images/logo2.png" class="logo">
    <h1>Happy Tote - Shopping Cart</h1>
    <button class="btn" onclick="location.href='Shop2.php'">Back to Shop</button>
</header>

<div class="container">
    <h2>Your Shopping Cart</h2>

    <div class="tabs">
        <div class="tab active" data-tab="my-order">My Order</div>
        <div class="tab" data-tab="pending">Pending</div>
        <div class="tab" data-tab="completed">Completed</div>
        <div class="tab" data-tab="cancelled">Cancelled</div>
    </div>

    <div class="tab-content active" id="my-order">
        <div class="checkout-container">
            <div class="total" id="cart-total">Total: ₱0.00</div>
            <button class="btn" onclick="showCheckoutModal()">Checkout</button>
        </div>
        <div id="cart-items"></div>
    </div>

    <div class="tab-content" id="pending">
        <h3>Pending Orders</h3>
        <div id="pending-orders"></div>
    </div>

    <div class="tab-content" id="completed">
        <h3>Completed Orders</h3>
        <div id="completed-orders"></div>
    </div>

    <div class="tab-content" id="cancelled">
        <h3>Cancelled Orders</h3>
        <div id="cancelled-orders"></div>
    </div>
</div>

<div class="modal" id="checkout-modal">
    <div class="modal-content">
        <span class="close" onclick="closeCheckoutModal()">&times;</span>
        <h2>Checkout</h2>
        <div class="modal-form">
            <label>Name:</label>
            <input type="text" id="customer-name" placeholder="Enter your name">
            <label>Address:</label>
            <input type="text" id="customer-address" placeholder="Enter your address">
            <label>Phone:</label>
            <input type="text" id="customer-phone" placeholder="Enter your phone number">
        </div>

        <h3>Order Summary</h3>
        <div class="order-summary" id="checkout-items">
            <!-- Order items will be inserted dynamically -->
        </div>

        <div class="order-summary">
            <div><strong>Total:</strong> <span id="checkout-total">₱0.00</span></div>
        </div>

        <button class="checkout-btn" onclick="completeCheckout()">Confirm Purchase</button>
    </div>
</div>
<div class="modal" id="feedback-modal">
    <div class="modal-content">
        <span class="close" onclick="closeFeedbackModal()">&times;</span>
        <h2>Give Feedback</h2>
        <div class="star-rating">
            <span class="star" data-rating="1">&#9733;</span>
            <span class="star" data-rating="2">&#9733;</span>
            <span class="star" data-rating="3">&#9733;</span>
            <span class="star" data-rating="4">&#9733;</span>
            <span class="star" data-rating="5">&#9733;</span>
        </div>
        <input type="hidden" id="star-rating" value="0">
        <button id="submit-feedback">Submit Feedback</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    loadCart();
    loadPendingOrders();
    loadCompletedOrders();
    loadCancelledOrders();
});
    function loadCart() {
        $.ajax({
            url: "load_cart.php",
            type: "GET",
            success: function (response) {
                $("#cart-items").html(response); 
                attachEventListeners(); 
                calculateTotal();
            }
        });
    }

    function loadPendingOrders() {
        $.ajax({
            url: "load_pending_orders.php",
            type: "GET",
            success: function (response) {
                $("#pending-orders").html(response);
                attachPendingEventListeners();
            }
        });
    }

    function loadCompletedOrders() {
        $.ajax({
            url: "load_completed_orders.php",
            type: "GET",
            success: function (response) {
                $("#completed-orders").html(response);
                attachCompletedEventListeners();
            }
        });
    }

    function loadCancelledOrders() {
        $.ajax({
            url: "load_cancelled_orders.php",
            type: "GET",
            success: function (response) {
                $("#cancelled-orders").html(response);
            }
        });
    }

    function attachEventListeners() {
        $(".quantity-btn").off("click").on("click", function () {
            let cart_id = $(this).data("cart-id");
            let currentQuantity = parseInt($(`.cart-quantity[data-cart-id='${cart_id}']`).val());
            let newQuantity;
            if ($(this).data("type") === "increase") {
                newQuantity = currentQuantity + 1;
            } else if ($(this).data("type") === "decrease") {
                newQuantity = currentQuantity - 1;
            }
            if (newQuantity >= 1) {
                $(`.cart-quantity[data-cart-id='${cart_id}']`).val(newQuantity);
                updateQuantity(cart_id, newQuantity); 
            }
        });
        $(".cart-quantity").off("change").on("change", function () {
            let cart_id = $(this).data("cart-id");
            let newQuantity = parseInt($(this).val());
            if (isNaN(newQuantity) || newQuantity < 1) {
                $(this).val(1);
                newQuantity = 1;
            }

            updateQuantity(cart_id, newQuantity); 
        });
        $(".remove-btn").off("click").on("click", function () {
            let cart_id = $(this).data("cart-id");
            removeItem(cart_id);
        });
    }

    function attachPendingEventListeners() {
        $(".cancel-btn").off("click").on("click", function () {
            let order_id = $(this).data("order-id");
            cancelOrder(order_id);
        });
    }

    function attachCompletedEventListeners() {
        $(".feedback-btn").off("click").on("click", function () {
            let order_item_id = $(this).data("order-item-id");
            let product_id = $(this).data("product-id");
            showFeedbackModal(order_item_id, product_id);
        });

        $(".star").off("click").on("click", function () {
            let rating = $(this).data("rating");
            $(this).siblings().removeClass("checked");
            $(this).prevAll().addBack().addClass("checked");
            $("#star-rating").val(rating);
        });
    }

    function updateQuantity(cart_id, quantity) {
        $.ajax({
            url: "config_cart.php", 
            type: "POST",
            data: {
                action: "update",
                cart_id: cart_id,
                quantity: quantity
            },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    loadCart(); 
                } else {
                    console.error(response.message); 
                }
            }
        });
    }

    function removeItem(cart_id) {
        $.ajax({
            url: "config_cart.php",
            type: "POST",
            data: { action: "remove", cart_id: cart_id },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    loadCart(); 
                }
            }
        });
    }

    function cancelOrder(order_id) {
        $.ajax({
            url: "config_order.php",
            type: "POST",
            data: { action: "cancel", order_id: order_id },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    loadPendingOrders();
                } else {
                    alert("Failed to cancel the order. Please try again.");
                }
            },
            error: function () {
                alert("An error occurred while processing your request. Please try again.");
            }
        });
    }

    function calculateTotal() {
        let totalPrice = 0;
        $(".item-check:checked").each(function () {
            let price = parseFloat($(this).data("price"));
            let quantity = parseInt($(this).closest("tr").find(".cart-quantity").val());
            totalPrice += price * quantity;
        });

        $("#cart-total").text(`Total: ₱${totalPrice.toFixed(2)}`);
    }

    $(document).on("change", "#check-all", function () {
        $(".item-check").prop("checked", $(this).prop("checked"));
        calculateTotal();
    });

    $(document).on("change", ".item-check", function () {
        $("#check-all").prop("checked", $(".item-check:checked").length === $(".item-check").length);
        calculateTotal();
    });

    $(".tab").on("click", function () {
        $(".tab").removeClass("active");
        $(this).addClass("active");

        $(".tab-content").removeClass("active");
        $("#" + $(this).data("tab")).addClass("active");
    });

    function showFeedbackModal(order_item_id, product_id) {
        // Show the feedback modal
        $("#feedback-modal").show();
        $("#feedback-modal").data("order-item-id", order_item_id);
        $("#feedback-modal").data("product-id", product_id);
    }

    function closeFeedbackModal() {
        $("#feedback-modal").hide();
    }

    function submitFeedback() {
        let order_item_id = $("#feedback-modal").data("order-item-id");
        let product_id = $("#feedback-modal").data("product-id");
        let rating = $("#star-rating").val();

        $.ajax({
            url: "submit_feedback.php",
            type: "POST",
            data: { order_item_id: order_item_id, product_id: product_id, rating: rating },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert("Thank you for your feedback!");
                    closeFeedbackModal();
                    loadCompletedOrders();
                } else {
                    alert("Failed to submit feedback. Please try again.");
                }
            },
            error: function () {
                alert("An error occurred while processing your request. Please try again.");
            }
        });
    }

    $("#feedback-modal .close").on("click", function () {
        closeFeedbackModal();
    });

    $("#submit-feedback").on("click", function () {
        submitFeedback();
    });

function showCheckoutModal() {
    let selectedItems = [];
    let totalAmount = 0;

    $(".item-check:checked").each(function () {
        let cart_id = $(this).data("cart-id");
        let product_id = $(this).data("product-id");
        let productName = $(this).closest("tr").find("td:nth-child(3)").text();
        let productPrice = parseFloat($(this).data("price"));
        let quantity = parseInt($(this).closest("tr").find(".cart-quantity").val());
        let subtotal = productPrice * quantity;
        totalAmount += subtotal;

        selectedItems.push({
            cart_id: cart_id,
            product_id: product_id,
            name: productName,
            price: productPrice,
            quantity: quantity,
            subtotal: subtotal
        });
    });

    if (selectedItems.length === 0) {
        alert("Please select items to checkout.");
        return;
    }

    let checkoutItemsHtml = "";
    selectedItems.forEach(function (item) {
        checkoutItemsHtml += `
            <div class="order-item">
                <strong>${item.name}</strong>  ₱${item.price}  x ${item.quantity} - ₱${item.subtotal.toFixed(2)}
            </div>
        `;
    });

    $("#checkout-items").html(checkoutItemsHtml);
    $("#checkout-total").text(`₱${totalAmount.toFixed(2)}`);

    $("#checkout-modal").show();
}

function closeCheckoutModal() {
    $("#checkout-modal").hide();
}

function completeCheckout() {
    let name = $("#customer-name").val();
    let address = $("#customer-address").val();
    let phone = $("#customer-phone").val();

    if (!name || !address || !phone) {
        alert("Please fill in all the fields.");
        return;
    }

    let selectedItems = [];
    $(".item-check:checked").each(function () {
        let cart_id = $(this).data("cart-id");
        let product_id = $(this).data("product-id");
        let productName = $(this).closest("tr").find("td:nth-child(3)").text();
        let quantity = parseInt($(this).closest("tr").find(".cart-quantity").val());
        let price = parseFloat($(this).data("price"));

        selectedItems.push({
            cart_id: cart_id,
            product_id: product_id,
            name: productName,
            quantity: quantity,
            price: price
        });
    });

    $.ajax({
        url: "complete_checkout.php",
        type: "POST",
        data: {
            action: "checkout",
            name: name,
            address: address,
            phone: phone,
            items: JSON.stringify(selectedItems)
        },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                alert("Your order has been placed successfully!");
                loadCart();
                closeCheckoutModal(); 
            } else {
                alert("Something went wrong. Please try again.");
            }
        },
        error: function () {
            alert("An error occurred while processing your order. Please try again.");
        }
    });
}

</script>

</body>
</html>
