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
            font-family: 'Lucida Sans';
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

        .navbar-brand {
            font-size: 30px;
        }

        .navbar-nav .nav-link {
            color: white;
            font-size: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .navbar-nav .nav-link.active {
            color: white;
            font-size: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .navbar-text i {
            font-size: 20px;
            margin-right: 10px;
        }

        .products {
            padding: 30px 0;
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
            font-size: 36px;
            color: #333;
            margin-bottom: 30px;
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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Floriest</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order-cust.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="review-cust.php">Review</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <i class="fa-solid fa-user" style="color: white"></i>
                    Hi, Flover
                </span>
            </div>
        </div>
    </nav>

    <section class="products">
        <h1 class="heading">Our <span>Products</span></h1>
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