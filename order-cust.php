<?php
session_start();
include 'connect/koneksi.php'; // Assuming this file contains your DB connection

// Check if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT nama FROM customer WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result(); // Store the result

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nama);
        $stmt->fetch();
        $displayName = htmlspecialchars($nama);
    } else {
        $displayName = 'sweett'; // Default if no name found
    }
    $stmt->close();
} else {
    $displayName = 'sweety';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/97216fb713.js" crossorigin="anonymous"></script>
    <title>Order</title>

    <style>
        * {
            font-family:Georgia, 'Times New Roman', Times, serif;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f8f9fa;
            background-size: cover;
        }

        .container-fluid {
            background-color: pink;
            padding: 15px;
        }

        .navbar {
            /* background-color: rgba(0, 0, 0, 0.4);  */
            background-color: pink;
            padding: 15px;
            position: absolute;
        }

        .navbar-brand {
            font-size: 30px;
            color: white;
            font-weight: bold;
        }

        .navbar-brand:hover{
            color: rgb(249, 147, 164);
        }

        .navbar-nav .nav-link {
            color: white;
            font-size: 20px;
            /* text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); */
        }

        .navbar-nav .nav-link.active {
            color:rgb(249, 147, 164);
            font-size: 20px;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover{
            color: rgb(249, 147, 164);
        }

        .navbar-text i {
            font-size: 20px;
            margin-right: 10px;
        }

        .navbar-text a{
            text-decoration: none;
            
        }

        .container {
            padding: 20px;
            margin-top: 150px;
        }

        .breadcrumb {
            margin-bottom: 20px;
        }

        .breadcrumb a {
            text-decoration: none;
            color: #000;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .shopping-bag {
            display: flex;
            justify-content: space-between;
        }

        .shopping-bag-items {
            width: 48%;
        }

        .shopping-bag-item img {
            width: 100px;
            height: auto;
        }

        .shopping-bag-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .shopping-bag-item-info {
            flex-grow: 1;
            margin-left: 20px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
        }

        .quantity-controls input {
            width: 50px;
            text-align: center;
            margin: 0 10px;
        }

        .order-summary {
            width: 48%;
            border: 1px solid #ddd;
            padding: 20px;
        }

        .order-summary h2 {
            margin: 0 0 20px;
        }

        .order-summary div {
            margin-bottom: 10px;
        }

        .checkout-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #000;
            color: #fff;
            text-align: center;
            text-decoration: none;
            margin-top: 20px;
        }

        .checkout-btn:hover {
            background-color: rgb(249, 147, 164);
        }

        .remove-btn {
            background: none;
            border: none;
            color: red;
            font-size: 1.2em;
            cursor: pointer;
        }

        
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Toko Kue Ibu Anin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="order-cust.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="review-cust.php">Review</a>
                    </li>
                </ul>
                <span class="navbar-text">
                <a href="#" style="color: white;">
                    <i class="fa-solid fa-user"></i>
                    Hi, <?= $displayName ?>
                </a>
                </span>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="shopping-bag">
            <div class="shopping-bag-items" id="shoppingBagItems">
                <!-- Items will be populated by JavaScript -->
            </div>
            <div class="order-summary">
                <h2>ORDER SUMMARY</h2>
                <div>Subtotal: Rp <span id="subtotal">0</span></div>
                <div><strong>Estimated Total: Rp <span id="estimatedTotal">0</span></strong></div>
                <a href="form-booking.php" class="checkout-btn">CHECKOUT NOW</a>
            </div>
        </div>
    </div>

    <script>
        function updateSummary() {
            let subtotal = 0;
            document.querySelectorAll('.shopping-bag-item').forEach(item => {
                const price = parseInt(item.querySelector('.quantity').dataset.price);
                const quantity = parseInt(item.querySelector('.quantity').value);
                subtotal += price * quantity;
            });
            document.getElementById('subtotal').textContent = subtotal.toLocaleString('id-ID');
            document.getElementById('estimatedTotal').textContent = subtotal.toLocaleString('id-ID');
        }

        function loadCart() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let cartItemsContainer = document.getElementById('shoppingBagItems');
            cartItemsContainer.innerHTML = '';

            cart.forEach(product => {
                let item = document.createElement('div');
                item.classList.add('shopping-bag-item');
                item.innerHTML = `
                    <img src="${product.image}" alt="${product.name}">
                    <div class="shopping-bag-item-info">
                        <h3>${product.name}</h3>
                        <p>Harga: Rp <span class="price">${parseInt(product.price).toLocaleString('id-ID')}</span></p>
                        <div class="quantity-controls">
                            <input type="number" value="${product.quantity}" min="1" class="quantity" data-price="${product.price}">
                        </div>
                    </div>
                    <button class="remove-btn"><i class="fa fa-trash"></i></button>
                `;
                cartItemsContainer.appendChild(item);
            });

            document.querySelectorAll('.quantity').forEach(input => {
                input.addEventListener('input', function () {
                    let cart = JSON.parse(localStorage.getItem('cart'));
                    let productName = this.closest('.shopping-bag-item').querySelector('h3').textContent;
                    let product = cart.find(item => item.name === productName);
                    product.quantity = parseInt(this.value);
                    localStorage.setItem('cart', JSON.stringify(cart));
                    updateSummary();
                });
            });

            document.querySelectorAll('.remove-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    let cart = JSON.parse(localStorage.getItem('cart'));
                    let productName = this.closest('.shopping-bag-item').querySelector('h3').textContent;
                    cart = cart.filter(item => item.name !== productName);
                    localStorage.setItem('cart', JSON.stringify(cart));
                    this.closest('.shopping-bag-item').remove();
                    updateSummary();
                });
            });

            updateSummary();
        }

        loadCart();
    </script>

    <footer style="background-color: rgb(249, 147, 164); color: white; padding: 40px; font-family: Arial, sans-serif; margin-top: 100px;">
        <div class="container-footer" style="display: flex; justify-content: space-between;">
            <!-- Our Stores Section -->
            <div style="flex: 1; margin-right: 15px;">
                <h5>Our Store</h5>
                <ul style="padding-left: 0; list-style: none;">
                    <li>📍 Toko Kue Ibu Anin</li>
                </ul>
            </div>

            <div style="flex: 1; margin-right: 50px;">
                <h5>Operational Hours</h5>
                <p>Everyday: 09.00 - 21.00</p>
            </div>

            <!-- Contact Us Section -->
            <div style="flex: 1; margin-right: 50px;">
                <h5>Contact Us</h5>
                <i class="fab fa-whatsapp" style="font-size: 20px;"></i> +62 812-3456-7980
            </div>

            <!-- Available On Section -->
            <div style="flex: 1;">
                <h5>Available On</h5>
                <ul style="padding-left: 0; list-style: none;">
                    <!-- <li><i class="fab fa-gojek" style="font-size: 18px;">  </i>  Toko Kue Ibu Anin</li>
                    <li><i class="fab fa-grab" style="font-size: 18px;">  </i>  TokoKueIbuAnin</li>
                    <li><i class="fab fa-shopee" style="font-size: 18px;">  </i>  TokoKueIbuAnin</li> -->
                    <li>GoFood | GrabFood | ShopeeFood</li>
                </ul>
            </div>

            <div style="flex: 1;">
                <!-- Social Media Section -->
                <h5>Social Media</h5>
                <ul style="padding-left: 0; list-style: none;">
                    <li style="margin-bottom: 5px;"><i class="fab fa-instagram" style="font-size: 18px;">  </i>  @TokoKueIbuAnin</li>
                    <li style="margin-bottom: 5px;"><i class="fab fa-tiktok" style="font-size: 18px;">  </i>  @TokoKueIbuAnin</li>
                    <li><i class="fab fa-facebook" style="font-size: 18px;">  </i>  @TokoKueIbuAnin</li>
                </ul>
            </div>
        </div>

        <!-- Copyright Notice -->
        <hr style="border: 1px solid #f1f1f1; margin-top: 20px;">
        <p style="text-align: center; margin-bottom: 10px;">Copyright &copy; 2025 Kelompok 11. All Rights Reserved.</p>
    </footer>

</body>

</html>