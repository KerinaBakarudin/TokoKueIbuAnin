<?php
include '../connect/koneksi.php'; // Memastikan koneksi ke database

// Memanggil kolom yang ada pada tabel aset
$query_mysql = mysqli_query($conn, "SELECT * FROM review");

if (!$query_mysql) {
    die('Query Error: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating & Review</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/97216fb713.js" crossorigin="anonymous"></script>
    <style>
        * {
            font-family: 'Lucida Sans';
        }

        body {
            margin: 0;
            padding-top: 110px;
            background: #f8f9fa;
            background-size: cover;
        }

        .container-fluid {
            background-color: pink;
        }

        .navbar {
            /* background-color: rgba(0, 0, 0, 0.4);  */
            background-color: pink;
            position: absolute;
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

        .review {
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .heading {
            margin-bottom: 30px;
            font-size: 36px;
            color: #333;
            align-self: center;
        }

        .heading span {
            color: #db7093;
        }

        .write-comment-button {
            margin-bottom: 30px;
        }

        .write-comment-button a {
            color: white;
            text-decoration: none;
        }

        .write-comment-button button {
            background-color: #db7093;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .write-comment-button button:hover {
            background-color: pink;
        }

        .box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 48px;
            justify-content: center;
        }

        .box {
            flex: 1 1 300px;
            max-width: 300px;
            background: #fff;
            box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 24px;
            position: relative;
            box-sizing: border-box;
        }

        .box .fa-quote-right {
            position: absolute;
            bottom: 24px;
            right: 24px;
            font-size: 48px;
            color: #eee;
        }

        .stars {
            margin-bottom: 16px;
        }

        .stars i {
            color: #f39c12;
            font-size: 20px;
        }

        .box p {
            color: #777;
            font-size: 16px;
            margin: 16px 0;
        }

        .user {
            display: flex;
            align-items: center;
            margin-top: 16px;
        }

        .user img {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 16px;
        }

        .user-info h3 {
            font-size: 18px;
            color: #333;
            margin: 0;
        }

        .edit-delete-icons {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 10px;
        }

        .edit-delete-icons i {
            font-size: 20px;
            cursor: pointer;
        }

        .edit-delete-icons i:hover {
            color: red;
        }

        .actions {
            position: absolute;
            top: 24px;
            right: 24px;
        }

        .actions a {
            color: #aaa;
            margin-left: 8px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .actions a:hover {
            color: pink;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../assets/logo toko.png" width="100" height=auto/> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home-admin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products-admin.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order-admin.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="review-admin.php">Review</a>
                    </li>
                </ul>
                <span class="navbar-text">
                <a  style="color: white;">
                    <i class="fa-solid fa-user"></i>
                    Hi, Admin
                </a>
                </span>
            </div>
        </div>
    </nav>

<div class="review">
    <h1 class="heading">💬 Treat <span>Talk 💬</span></h1>
    <div class="box-container"> 
        <?php while ($data = mysqli_fetch_assoc($query_mysql)) { ?>
            <div class="box">

                <div class="stars">
                    <?php 
                    $rating = $data['rating'];
                    for ($i = 0; $i < 5; $i++) { 
                        if ($i < $rating) {
                            echo '<i class="fas fa-star"></i>';
                        } else {
                            echo '<i class="far fa-star"></i>';
                        }
                    }
                    ?>
                </div>
                <p><?php echo $data['komentar']; ?></p>
                <div class="user">
                    <div class="user-info">
                        <h3><?php echo $data['nama']; ?></h3>
                    </div>
                </div>
                <span class="fas fa-quote-right"></span>
            </div>
        <?php } ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGz1mx3wcxA7xoa9r+r+NGH/tAIm9xOXt3I3gzTACEB1Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-ho+pP2FYDWkFfSAOf3p+HBOtxvEE4j23xLsZgN5eCAqBOB6Yk8BNZZAZgQw1T2KC" crossorigin="anonymous"></script>
</body>
</html>