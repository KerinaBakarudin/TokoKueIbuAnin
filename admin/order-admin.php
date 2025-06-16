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
    <title>Orders</title>

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
                        <a class="nav-link active" href="order-admin.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="review-admin.php">Review</a>
                    </li>
                </ul>
                <span class="navbar-text">
                <a style="color: white;">
                    <i class="fa-solid fa-user" style="color: white"></i>
                    Hi, Admin
                </a>
                </span>
            </div>
        </div>
    </nav>

    
    <div class="container">
    <h2>Daftar Orders</h2>

    <div class="d-flex justify-content-end mb-4" style="width: 100%;">
        <form method="GET" action="download_pdf.php" class="d-flex align-items-end" style="max-width: 400px;">
            <div class="me-3" style="flex-grow: 1;">
                <label for="bulan" class="form-label">Pilih Bulan:</label>
                <input type="month" name="bulan" id="bulan" class="form-control" required>
            </div>
            <div>
                <button type="submit" class="btn btn-danger">Download PDF</button>
            </div>
        </form>
    </div>


    <!-- Tabel Orders -->
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