<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tote Bag System</title>
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
    .btn-cart {
      position: relative;
    }
    .cart-count {
      position: absolute;
      top: -5px;
      right: -5px;
      background: red;
      color: white;
      font-size: 12px;
      padding: 3px 7px;
      border-radius: 50%;
    }
    .container {
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
      background-color: transparent;
      border-radius: 8px;
      box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
                  0 10px 10px rgba(0, 0, 0, 0.30);
      transition: .4s;
    }
    .container h2 {
      color: white;
    }
    #items {
      display: grid;
      grid-template-columns: repeat(4, minmax(250px, 1fr));
      gap: 20px;
      padding: 20px;
    }
    .tote-item {
      background: #444;
      color: white;
      padding: 15px;
      border: 1px solid #898989;
      border-radius: 8px;
      text-align: center;
      box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
                  10px 15px 10px rgba(0, 0, 0, 0.30);
      transition: transform 0.2s ease-in-out;
      position: relative;
    }
    .tote-item:hover {
      transform: scale(1.05);
    }
    .tote-item img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 5px;
      padding-bottom: 10px;
    }
    .rating {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
      margin: 5px 0;
    }
    .fa-star, .fa-star-half-alt {
    color: gold;
}
    .sold {
      color: #bbb;
      font-size: 14px;
    }
    .cart {
      background: #444;
      color: white;
      padding: 15px;
      border-radius: 8px;
      display: none;
    }
    @media (max-width: 768px) {
      #items {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    @media (max-width: 480px) {
      #items {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <header>
    <img src="uploads/logo2.png" class="logo">
    <h1>Happy Tote</h1>
    <div class="header-buttons">
      <button class="btn" onclick="location.href='Home.php'">Home</button>
      <button class="btn btn-cart" onclick="location.href='cart.php'">
        <i class="fa fa-shopping-cart"></i>
        <span class="cart-count" id="cart-count">0</span>
      </button>
    </div>
  </header>

  <div class="container">
    <h2>Available Tote Bags</h2>
    <div id="items">
      <!-- Products will load here via AJAX -->
    </div>
  </div>

  <div class="container cart" id="cart-container">
    <h2>Your Cart</h2>
    <div id="cart"></div>
    <div class="total" id="total">Total: ₱0.00</div>
    <button class="btn" onclick="location.href='cart.php'">Checkout</button>
  </div>

   <script>
 document.addEventListener("DOMContentLoaded", function () {
    loadProducts();
    loadCartCount();
});

function addToCart(productId, name, price) {
    fetch('add_to_cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `product_id=${productId}&name=${encodeURIComponent(name)}&price=${price}`
    })
    .then(response => response.text()) // Get raw response first
    .then(text => {
        try {
            return JSON.parse(text); // Attempt to parse JSON
        } catch (error) {
            console.error("Invalid JSON response:", text);
            throw new Error("Invalid server response");
        }
    })
    .then(data => {
        if (data.success) {
            loadCartCount();
        } else {
            alert(`Failed to add item to cart: ${data.error}`);
        }
    })
    .catch(error => console.error('Error:', error));
}


function loadCartCount() {
    fetch('get_cart_count.php')
    .then(response => response.json())
    .then(data => {
        document.getElementById('cart-count').innerText = data.count > 99 ? '99+' : data.count;
    })
    .catch(error => console.error('Error loading cart count:', error));
}

function loadProducts() {
  fetch('config_product.php')
  .then(response => response.json())
  .then(data => {
    const itemsContainer = document.getElementById('items');
    itemsContainer.innerHTML = '';
    data.forEach(product => {
      const rating = product.rating ? parseFloat(product.rating) : 0;
      const sold = product.sold ? parseInt(product.sold) : 0;
      const fullStars = Math.floor(rating);
      const halfStar = rating % 1 !== 0;
      const emptyStars = 5 - fullStars - (halfStar ? 1 : 0);

      const card = document.createElement('div');
      card.className = 'tote-item';
      card.innerHTML = `
        <img src="${product.image}" alt="${product.name}">
        <div><strong>${product.name}</strong><br>₱${parseFloat(product.price).toFixed(2)}</div>
        <div class="rating">
          ${'<i class="fa fa-star"></i>'.repeat(fullStars)}
          ${halfStar ? '<i class="fa fa-star-half-alt "></i>' : ''}
          ${'<i class="fa fa-star" style="color: #ccc;"></i>'.repeat(emptyStars)}
          <span>${rating.toFixed(1)}</span> | <span class="sold">${sold} Sold</span>
        </div>
        <button class="btn" onclick="addToCart(${product.product_id}, '${product.name.replace(/'/g, "\'")}', ${product.price})">Add to Cart</button>
      `;
      itemsContainer.appendChild(card);
    });
  })
  .catch(error => console.error('Error fetching products:', error));
}

function longPollProducts() {
  loadProducts();
  setTimeout(longPollProducts, 5000); // Poll every 5 seconds
}

document.addEventListener("DOMContentLoaded", function () {
  longPollProducts();
  loadCartCount();
});
</script>
</body>
</html>
