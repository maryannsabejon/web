<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tote Bag System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* CSS styling */
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(images/bg2.jpg);
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            text-shadow: 2px #000000;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            0 10px 10px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        .logo {
            width: 90px;
            cursor: pointer;
            float: left;
            margin: 0 10px;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: transparent;
            border-radius: 8px;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            0 10px 10px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        h1 {
            text-align: center;
            margin: 20px 100px;
            text-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            0 10px 10px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        .tote-item {
            padding: 10px;
            margin-bottom: 20px;
            background-color: transparent;
            border: 1px solid #898989;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            10px 15px 10px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        .tote-item img {
            max-width: 100px;
            height: auto;
            margin-right: 20px;
            border-radius: 4px;
        }
        .tote-item button {
            padding: 15px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            20px 25px 20px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        .tote-item button:hover {
            background-color: #337536;
        }
        .cart {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 10px;
            border: 1px black;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            10px 15px 10px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        .cart-item {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: black;
            text-shadow: 0 48px 48px rgba(0, 0, 0, 0.667),
            10px 15px 10px rgba(0, 0, 0, 0.616);
            transition: .4s;
        }
        .cart-item img {
            max-width: 50px;
            height: auto;
            margin-right: 10px;
            border-radius: 4px;
            border: 1px solid black;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            20px 25px 20px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        .cart-item button {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            10px 15px 10px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        .cart-item button:hover {
            background-color: #c9302c;
        }
        .total {
            margin-top: 10px;
            text-align: right;
        }
        .checkout-btn {
            display: block;
            margin-top: 20px;
            padding: 15px 25px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            border: 3px black;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            10px 15px 10px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        .checkout-btn:hover {
            background-color: #337937;
        }
        .total {
            border: 1px solid black;
            background-color: #fff;
            color: black;
            padding: 10px 10px;
            border-radius: 8px;
            max-width: 20%;
            text-align: center;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            10px 15px 10px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        .checked {
            color: #d9ff00;
        }
        ul {
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
        }
        li {
            padding-top: 5px;
        }
        .fa {
            font-size: 26px;
            transition: .4s;
            margin: 0 3px;
        }
        .btn-home {
            width: 70px;
            height: 30px;
            cursor: pointer;
            float: right;
            border-radius: 3px;
            margin: -55px 30px;
            background-color: #acacac;
        }
    </style>
</head>
<body>
    <div class="banner-bg">
        <header>
            <div class="tote-logo">
                <img src="images/logo2.png" class="logo">
                <h1>Happy Tote</h1>
                <button class="btn-home" onclick="location.href='Home.php'">Home</button>
            </div>
        </header>

        <div class="container">
            <div id="items">
                <?php
                // Sample data for tote bags
                $toteBags = [
                    ["id" => 1, "image" => "images/bag1.jpg", "name" => "Tote Bag 1", "price" => 99.99],
                    ["id" => 2, "image" => "images/bag2.jpg", "name" => "Tote Bag 2", "price" => 99.99],
                    ["id" => 3, "image" => "images/bag3.jpg", "name" => "Tote Bag 3", "price" => 99.99],
                    ["id" => 4, "image" => "images/bag4.jpg", "name" => "Tote Bag 4", "price" => 119.99],
                    ["id" => 5, "image" => "images/bag5.jpg", "name" => "Tote Bag 5", "price" => 199.99],
                    ["id" => 6, "image" => "images/bag6.jpg", "name" => "Tote Bag 6", "price" => 149.99],
                    ["id" => 7, "image" => "images/bag7.jpg", "name" => "Tote Bag 7", "price" => 149.99],
                ];

                foreach ($toteBags as $bag) {
                    echo '<div class="tote-item" data-id="' . $bag['id'] . '">';
                    echo '<img src="' . $bag['image'] . '" alt="' . $bag['name'] . '">';
                    echo '<ul>';
                    for ($i = 0; $i < 5; $i++) {
                        echo '<li><i class="fa fa-star fa-3x' . ($i < 4 ? ' checked' : '') . '"></i></li>';
                    }
                    echo '</ul>';
                    echo '<span>' . $bag['name'] . ' - ₱' . number_format($bag['price'], 2) . '</span>';
                    echo '<button onclick="addToCart(' . $bag['id'] . ')">Add to Cart</button>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <div class="container">
            <h2>Your Cart</h2>
            <div id="cart" class="cart"></div>
            <div class="total" id="total"></div>
            <button class="checkout-btn" onclick="checkout()">Checkout</button>
        </div>
    </div>


    <script>
        let cartItems = [];

        function addToCart(itemId) {
            const itemExists = cartItems.find(item => item.id === itemId);
            if (itemExists) {
                itemExists.quantity++;
            } else {
                cartItems.push({ id: itemId, quantity: 1 });
            }
            renderCart();
        }

        function removeFromCart(itemId) {
            const itemIndex = cartItems.findIndex(item => item.id === itemId);
            if (itemIndex !== -1) {
                cartItems[itemIndex].quantity--;
                if (cartItems[itemIndex].quantity === 0) {
                    cartItems.splice(itemIndex, 1);
                }
                renderCart();
            }
        }

        function renderCart() {
            const cartElement = document.getElementById('cart');
            cartElement.innerHTML = '';
            let totalPrice = 0;
            cartItems.forEach(item => {
                const itemPrice = getItemPrice(item.id);
                totalPrice += itemPrice * item.quantity;
                cartElement.innerHTML += `
                    <div class="cart-item" data-id="${item.id}">
                        <img src="images/bag1.jpg" alt="Tote Bag ${item.id}"> 
                        <span>Tote Bag ${item.id} - Quantity: ${item.quantity}</span>
                        <button onclick="removeFromCart(${item.id})">Remove</button>
                    </div>
                `;
            });
            document.getElementById('total').innerHTML = `Total: ₱${totalPrice.toFixed(2)}`;
        }

        function getItemPrice(itemId) {
            switch (itemId) {
                case 1: return 99.99;
                case 2: return 99.99;
                case 3: return 99.99;
                case 4: return 119.99;
                case 5: return 199.99;
                case 6: return 149.99;
                case 7: return 149.99;
                default: return 0;
            }
        }

        function checkout() {
            alert('Thank you for shopping with us! Pay at the Counter');
            cartItems = [];
            renderCart();
        }

        renderCart(); // Render cart on page load
    </script>
</body>
</html>