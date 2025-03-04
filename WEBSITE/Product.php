<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Product Management</title>
  <style>
    /* ------------------------------
       GENERAL RESET & BODY STYLES
    ------------------------------ */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }
    body {
      background-image: url('images/bg1.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      background-repeat: no-repeat;
      color: white;
    }

    /* ------------------------------
       HEADER
    ------------------------------ */
    header {
      background-color: #333;
      color: #fff;
      padding: 15px 20px;
      text-align: center;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);
      font-size: 24px;
      font-weight: bold;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    /* ------------------------------
       CONTAINER
    ------------------------------ */
    .container {
      max-width: 700px;
      margin: 40px auto;
      padding: 25px;
      background: rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(10px);
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
      text-align: left;
    }

    /* ------------------------------
       FORM FIELDS
    ------------------------------ */
    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    label {
      font-weight: bold;
      margin-bottom: 5px;
    }
    input, textarea {
      background: rgba(255, 255, 255, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.3);
      padding: 12px;
      border-radius: 5px;
      color: white;
      font-size: 16px;
      outline: none;
    }
    input::placeholder, textarea::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }

    /* Price & Stock Row */
    .row {
      display: flex;
      gap: 10px;
    }
    .input-group {
      flex: 1;
    }

    /* ------------------------------
       IMAGE PREVIEW
    ------------------------------ */
    #imagePreview {
      width: 100%;
      height: 200px;
      border-radius: 5px;
      margin-top: 5px;
      background: #222;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      color: rgba(255, 255, 255, 0.5);
      font-size: 14px;
    }
    #imagePreview img {
      max-width: 100%;
      max-height: 100%;
      object-fit: cover;
    }

    /* ------------------------------
       BUTTON STYLES
    ------------------------------ */
    .btn-row {
      display: flex;
      gap: 10px;
    }
    button {
      background: #ff9800;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s ease, transform 0.2s;
      font-size: 16px;
      margin-top: 5px;
    }
    button:hover {
      background: #e68900;
      transform: scale(1.05);
    }

    /* ------------------------------
       TABLE FOR PRODUCTS
    ------------------------------ */
    .product-table {
  width: 60%;
  margin: 25px auto; /* This horizontally centers the table */
  border-collapse: collapse;
  border-radius: 8px;
  overflow: hidden; /* For rounded corners */
  text-align: center; /* Optional: centers text within the table */
}

    .product-table thead {
      background: rgba(0, 0, 0, 0.6);
    }
    .product-table th,
    .product-table td {
      border: 1px solid rgba(255, 255, 255, 0.2);
      padding: 10px;
      text-align: center;
      background-color: #333;
    }
    .product-table th {
      font-weight: bold;
      color: #ff9800;
    }
    .product-table td {
      color: #fff;
      background: rgba(255, 255, 255, 0.1);
    }
    /* Hover effect on rows */
    .product-table tbody tr:hover {
      background: rgba(255, 255, 255, 0.15);
      transition: background 0.2s;
    }

    /* Product images in table */
    .product-table img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 5px;
    }

    /* Buttons in table cells */
    .action-btn {
      background: #ff9800;
      color: #fff;
      padding: 6px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s ease, transform 0.2s;
      font-size: 14px;
      margin: 2px;
    }
    .action-btn:hover {
      background: #e68900;
      transform: scale(1.05);
    }

    /* ------------------------------
       RESPONSIVE DESIGN
    ------------------------------ */
    @media (max-width: 480px) {
      .row {
        flex-direction: column;
      }
      .product-table th,
      .product-table td {
        font-size: 14px;
        padding: 8px;
      }
      .action-btn {
        font-size: 12px;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Product Management</h1>
  </header>

  <div class="container">
    <!-- Product Form -->
    <form id="product-form">
      <input type="hidden" id="product-id" />

      <label for="name">Product Name</label>
      <input type="text" id="name" placeholder="Enter product name" required />

      <label for="description">Description</label>
      <textarea id="description" placeholder="Enter product description" required></textarea>

      <div class="row">
        <div class="input-group">
          <label for="price">Price</label>
          <input type="number" id="price" placeholder="Enter price" step="0.01" required />
        </div>
        <div class="input-group">
          <label for="stock">Stock</label>
          <input type="number" id="stock" placeholder="Enter stock quantity" required />
        </div>
      </div>

      <label for="image">Upload Product Image</label>
      <input type="file" id="image" accept="image/*" />
      <div id="imagePreview">No Image Selected</div>

      <!-- Buttons: Save & Clear -->
      <div class="btn-row">
        <button type="submit">Save Product</button>
        <button type="button" id="clear-btn">Clear</button>
      </div>
    </form>
  </div>
    <!-- Product Table -->
    <div id="product-list"></div>
  <script>
    // Load products when page loads
    document.addEventListener('DOMContentLoaded', loadProducts);

    // Handle form submission
    document.getElementById('product-form').addEventListener('submit', function(e) {
      e.preventDefault();

      let formData = new FormData();
      formData.append('id', document.getElementById('product-id').value);
      formData.append('name', document.getElementById('name').value);
      formData.append('description', document.getElementById('description').value);
      formData.append('price', document.getElementById('price').value);
      formData.append('stock', document.getElementById('stock').value);

      let imageInput = document.getElementById('image');
      if (imageInput.files.length > 0) {
        formData.append('image', imageInput.files[0]);
      }

      fetch('config_product.php', {
        method: 'POST',
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          alert(data.message);
          loadProducts();
          clearForm(); // Clears after saving
        })
        .catch(error => console.error('Error:', error));
    });

    // Clear button event
    document.getElementById('clear-btn').addEventListener('click', clearForm);

    // Function: Clear the form
    function clearForm() {
      document.getElementById('product-form').reset();
      document.getElementById('product-id').value = '';
      document.getElementById('imagePreview').innerHTML = 'No Image Selected';
    }

    // Load & display products in a table
    function loadProducts() {
      fetch('config_product.php')
        .then(response => response.json())
        .then(data => {
          let output = `
            <table class="product-table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
          `;
          data.forEach(product => {
            let imageSrc = product.image && product.image !== 'null' ? product.image : '';
            let imageCell = imageSrc
              ? `<img src="${imageSrc}" alt="Product Image">`
              : 'No Image';

            output += `
              <tr>
                <td>${product.name}</td>
                <td>₱${product.price}</td>
                <td>${product.stock}</td>
                <td>${imageCell}</td>
                <td>
                  <button class="action-btn" onclick="editProduct('${product.product_id}','${escapeString(product.name)}','${escapeString(product.description)}','${product.price}','${product.stock}','${imageSrc}')">Edit</button>
                  <button class="action-btn" onclick="deleteProduct(${product.product_id})">Delete</button>
                </td>
              </tr>
            `;
          });
          output += `</tbody></table>`;
          document.getElementById('product-list').innerHTML = output;
        })
        .catch(error => console.error('Error loading products:', error));
    }

    // Edit Product: fill the form with product details
    function editProduct(id, name, desc, price, stock, image) {
      document.getElementById('product-id').value  = id;
      document.getElementById('name').value        = name;
      document.getElementById('description').value = desc;
      document.getElementById('price').value       = price;
      document.getElementById('stock').value       = stock;

      if (image) {
        document.getElementById('imagePreview').innerHTML = `<img src="${image}" alt="Product Image">`;
      } else {
        document.getElementById('imagePreview').innerHTML = 'No Image Selected';
      }
    }

    // Delete Product
    function deleteProduct(id) {
      if (confirm('Are you sure you want to delete this product?')) {
        fetch(`config_product.php?id=${id}`, { method: 'DELETE' })
          .then(response => response.json())
          .then(data => {
            alert(data.message);
            loadProducts();
            clearForm(); 
          })
          .catch(error => console.error('Error deleting product:', error));
      }
    }

    // Helper: Escape quotes to avoid JS errors
    function escapeString(str) {
      if (!str) return '';
      return str.replace(/'/g, "\\'").replace(/"/g, '\\"');
    }

    // Show preview of newly selected image
    document.getElementById('image').addEventListener('change', function(e) {
      const file = e.target.files[0];
      const preview = document.getElementById('imagePreview');

      if (file) {
        const reader = new FileReader();
        reader.onload = function(evt) {
          preview.innerHTML = `<img src="${evt.target.result}" alt="New Product Image">`;
        };
        reader.readAsDataURL(file);
      } else {
        preview.innerHTML = "No Image Selected";
      }
    });
  </script>
</body>
</html>
