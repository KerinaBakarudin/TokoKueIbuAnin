
<?php
session_start();
include '../connect/koneksi.php'; 

// Check if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $stmt = $conn->prepare("SELECT nama FROM customer WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result(); 

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nama);
        $stmt->fetch();
        $displayName = htmlspecialchars($nama);
    } else {
        $displayName = 'sweett'; 
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    <script src="https://kit.fontawesome.com/97216fb713.js" crossorigin="anonymous"></script>
    <title>Toko Kue Ibu Anin</title>

    <style>
        * {
            font-family:'Lucida Sans';
        }

        body, html {
            height: 100%;
            margin: 0;
            color: white;
        }

        .navbar {
            background-color:rgb(255, 255, 255, 0.7); 
            transition: top 0.3s; /* Smooth transition */
        }
        .navbar.hidden {
            top: -100px; /* Hide the navbar off-screen */
        }

        .navbar-brand:hover{
            color: rgb(249, 147, 164);
        }

        .navbar-nav .nav-link {
            color: #333;
            font-size: 20px;
            font-weight: bold;
        }

        .navbar-nav .nav-link.active {
            color: #db7093;
            font-size: 20px;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover{
            color: rgb(249, 147, 164);
        }

        .navbar-text i {
            font-size: 20px;
            margin-right: 10px;
            color: #333;
        }

        .navbar-text a{
            text-decoration: none;
            
        }

        .home {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        .home img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
        }

        .content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            color: white;
            text-align: center;
            margin: 0 auto;
            background-color: rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content h3 {
            color: white;
        }

        .content span, .content p {
            color: white;
        }

        .products {
            padding: 30px 0;
            margin-top: 50px;
        }

        .products .box-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px;
        }

        .products .box {
            flex: 0 0 calc(33.33% - 16px);
            background: white;
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

        .products .box .content-box {
            padding: 16px;
            text-align: center;
        }

        .products .box .content-box h3 {
            font-size: 20px;
            color: #db7093;
            font-weight: bolder;
            padding-top: 16px;
        }

        .heading {
            text-align: center;
            font-size: 36px;
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
    <nav class="navbar navbar-expand-lg fixed-top hidden"> <!-- Add 'hidden' class here -->
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../assets/logo toko.png" width="100" height=auto/> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home-admin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products-admin.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order-admin.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="review-admin.php">Review</a>
                    </li>
                </ul>
                <span class="navbar-text">
                <a style="color: black;">
                    <i class="fa-solid fa-user" style="color: black"></i>
                    Hi, Admin
                </a>
                </span>
            </div>
        </div>
    </nav>
    
    <header class="home">
        <img src="../assets/cake.png" alt="Background Image" />
        <div class="overlay"></div>
        <div class="content">
            <h1  style="font-weight:bold;">Sweets That Slap,</h1>
            <h1 style="font-weight:bold;">You Won't Regret!</h1>

        </div>
    </header>

   <section class="products">
        <h1 class="heading">Top-tier <span>Fave</span></h1>
        <div class="box-container">
            <?php
            include '../connect/koneksi.php';
            $result = $conn->query("SELECT * FROM products WHERE id IN (7, 22, 27, 9)");
            while ($row = $result->fetch_assoc()) {
                echo '<div class="box">';
                echo '    <div class="image">';
                echo '        <img src="../admin/flower/' . $row['flowerImage'] . '" alt="' . $row['flowerName'] . '">';
                echo '        <div class="icons">';
                echo '            <a href="#" class="" data-id="' . $row['id'] . '" data-name="' . $row['flowerName'] . '" data-image="../admin/flower/' . $row['flowerImage'] . '"></a>';
                echo '        </div>';
                echo '    </div>';
                echo '    <div class="content-box">';
                echo '        <h3>' . $row['flowerName'] . '</h3>';
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


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

<script>
        // Get the navbar
        const navbar = document.querySelector('.navbar');
        // Listen for scroll events
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) { // Change 50 to the scroll position you want
                navbar.classList.remove('hidden'); // Show navbar
            } else {
                navbar.classList.add('hidden'); // Hide navbar
            }
        });
</script>
</html>
