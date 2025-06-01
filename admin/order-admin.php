<?php
include '../connect/koneksi.php'; // Memastikan koneksi ke database

// Query untuk mengambil data orders dari database
$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
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
    <title>Floriest</title>

    <style>
        * {
            font-family: 'Lucida Sans';
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: pink;
            color: #333;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #db7093;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .container {
            margin-top:150px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            width: 100%;
            max-width: 1100px;
        }

        h2 {
            color: #E37383;
            text-align: center;
        }
        
        
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Floriest</a>
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
                    <i class="fa-solid fa-user" style="color: white"></i>
                    Hi, Admin
                </span>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <h2>Daftar Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Email</th>
                    <th>Pesanan</th>
                    <th>Total Harga</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Tanggal Pengambilan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mengambil data dari hasil query dan menampilkannya dalam tabel
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['nama']}</td>";
                    echo "<td>{$row['alamat']}</td>";
                    echo "<td>{$row['no_telpon']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['pesanan']}</td>";
                    echo "<td>Rp. " . number_format($row['total_harga'], 2, ',', '.') . "</td>";
                    echo "<td>{$row['tanggal_pemesanan']}</td>";
                    echo "<td>{$row['tanggal_pengambilan']}</td>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>