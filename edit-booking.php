<?php
include 'connect/koneksi.php'; // Memastikan koneksi ke database

// Mendapatkan order ID dari parameter URL
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    
    // Memanggil data pesanan dari database berdasarkan ID
    $query = "SELECT * FROM orders WHERE id = $order_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query Error: ' . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nama = $row['nama'];
        $alamat = $row['alamat'];
        $no_telpon = $row['no_telpon'];
        $email = $row['email'];
        $pesanan = $row['pesanan'];
        $total_harga = $row['total_harga'];
        $tanggal_pemesanan = $row['tanggal_pemesanan'];
        $tanggal_pengambilan = $row['tanggal_pengambilan'];
    } else {
        die('Order not found');
    }
} else {
    die('No order ID provided');
}

// Proses form edit pesanan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang diinputkan pengguna
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telpon = $_POST['no-telpon'];
    $email = $_POST['email'];
    $pesanan = $_POST['pesanan'];
    $total_harga = $_POST['total-harga'];
    $tanggal_pemesanan = $_POST['tanggal-pemesanan'];
    $tanggal_pengambilan = $_POST['tanggal-pengambilan'];

    // Update data pesanan ke database
    $update_query = "UPDATE orders SET nama='$nama', alamat='$alamat', no_telpon='$no_telpon', email='$email', pesanan='$pesanan', total_harga='$total_harga', tanggal_pemesanan='$tanggal_pemesanan', tanggal_pengambilan='$tanggal_pengambilan' WHERE id=$order_id";

    if (mysqli_query($conn, $update_query)) {
        // Redirect kembali ke halaman detail pesanan setelah berhasil update
        header("Location: order_detail.php?id=$order_id");
        exit();
    } else {
        echo "<script>alert('Gagal mengupdate data pesanan: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan Bunga</title>
    <style>
        * {
            font-family: 'Lucida Sans';
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: pink;
            color: #333;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
        }

        h2 {
            color: #E37383;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            color: #333;
        }

        .form-group input[type="date"],
        .form-group input[type="number"] {
            padding: 8px;
        }

        .button-group {
            text-align: center;
            margin-top: 20px;
        }

        .button-group button {
            background-color: #E37383;
            color: #fff;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
            margin-right: 10px;
        }

        .button-group button:hover {
            background-color: pink;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Pesanan Bunga</h2>
        <form id="editOrderForm" action="" method="POST">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" value="<?php echo $alamat; ?>" required>
            </div>
            <div class="form-group">
                <label for="no-telpon">No. Telepon:</label>
                <input type="tel" id="no-telpon" name="no-telpon" value="<?php echo $no_telpon; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="pesanan">Pesanan:</label>
                <textarea id="pesanan" name="pesanan" rows="4" readonly><?php echo $pesanan; ?></textarea>
            </div>
            <div class="form-group">
                <label for="total-harga">Total Harga:</label>
                <input type="number" id="total-harga" name="total-harga" value="<?php echo $total_harga; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal-pemesanan">Tanggal Pemesanan:</label>
                <input type="date" id="tanggal-pemesanan" name="tanggal-pemesanan" value="<?php echo $tanggal_pemesanan; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal-pengambilan">Tanggal Pengambilan:</label>
                <input type="date" id="tanggal-pengambilan" name="tanggal-pengambilan" value="<?php echo $tanggal_pengambilan; ?>" required>
            </div>
            <div class="button-group">
                <button type="submit">Simpan Perubahan</button>
                <button onclick="window.location.href='order_detail.php?id=<?php echo $order_id; ?>'">Batal</button>
            </div>
        </form>
    </div>
</body>
</html>
