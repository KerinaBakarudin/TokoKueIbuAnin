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
    <title>Products</title>
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

        .products {
            padding: 30px 0;
            margin-top: 120px;
        }

        .add-product-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 200px;
            margin-bottom: 30px;
            padding: 10px 20px;
            background-color: #db7093;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-product-btn i {
            margin-right: 10px;
        }

        .add-product-btn:hover {
            background-color: #c65382;
        }

        .products .box-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px;
        }

        .products .box {
            flex: 0 0 calc(33.33% - 16px);
            background: #fff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border: 1.6px solid rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s;
            margin-bottom: 24px;
            max-width: 250px;
        }

        .products .box:hover {
            transform: translateY(-10px);
        }

        .products .box .image {
            position: relative;
            text-align: center;
            padding-top: 16px;
            height: 200px; 
        }

        .products .box .image img {
            height: 200px; 
            width: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .products .box:hover .image img {
            transform: scale(1.1);
        }

        .products .box .image .icons {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            background: rgba(255, 20, 147, 0.8);
            padding: 10px;
            transition: background 0.3s;
            opacity: 0;
            visibility: hidden;
        }

        .products .box:hover .image .icons {
            opacity: 1;
            visibility: visible;
        }

        .products .box .image .icons a {
            height: 40px;
            line-height: 40px;
            font-size: 20px;
            color: #fff;
            text-decoration: none;
            padding: 0 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            margin: 0 5px;
        }

        .products .box .image .icons a:hover {
            background: #333;
        }

        .products .box .content {
            padding: 16px;
            text-align: center;
        }

        .products .box .content h3 {
            font-size: 20px;
            color: pink;
            font-weight: bolder;
            padding-top: 16px;
        }

        .products .box .content .price {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }

        .heading {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .heading span {
            color: #db7093;
        }

        .button-container {
            display: flex;
            justify-content: flex-end; 
            padding: 0 105px;
            margin-bottom: 2px; 
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
                        <a class="nav-link active" href="products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order-cust.php">Order</a>
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

    <section class="products">
        <h1 class="heading">The Sweet Stuff We Baked With ❤️, <span>Just for You</span></h1>
        <div class="box-container">
            <?php
            include 'connect/koneksi.php';
            $result = $conn->query("SELECT * FROM products");
            while ($row = $result->fetch_assoc()) {
                echo '<div class="box">';
                echo '    <div class="image">';
                echo '        <img src="admin/flower/' . $row['flowerImage'] . '" alt="' . $row['flowerName'] . '">';
                echo '        <div class="icons">';
                echo '            <a href="#" class="fa-solid fa-cart-shopping add-to-cart" data-id="' . $row['id'] . '" data-name="' . $row['flowerName'] . '" data-price="' . $row['flowerPrice'] . '" data-image="admin/flower/' . $row['flowerImage'] . '"></a>';
                echo '        </div>';
                echo '    </div>';
                echo '    <div class="content">';
                echo '        <h3>' . $row['flowerName'] . '</h3>';
                echo '        <div class="price">Rp.' . number_format($row['flowerPrice'], 0, ',', '.') . '</div>';
                echo '    </div>';
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <footer style="background-color: rgb(249, 147, 164); color: white; padding: 40px; font-family: Arial, sans-serif;">
        <div class="container" style="display: flex; justify-content: space-between;">
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

<script>
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let productId = this.dataset.id;
            let product = cart.find(item => item.id === productId);

            if (product) {
                product.quantity++;
            } else {
                product = {
                    id: this.dataset.id,
                    name: this.dataset.name,
                    price: this.dataset.price,
                    image: this.dataset.image,
                    quantity: 1
                };
                cart.push(product);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            alert('Product added to cart');
        });
    });
</script>

</html>