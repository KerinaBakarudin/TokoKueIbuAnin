<?php
include 'connect/koneksi.php';

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telpon = $_POST['no-telpon'];
    $email = $_POST['email'];
    $pesanan = $_POST['pesanan'];
    $total_harga = $_POST['total-harga'];
    $tanggal_pemesanan = $_POST['tanggal-pemesanan'];
    $tanggal_pengambilan = $_POST['tanggal-pengambilan'];

    $update_query = "UPDATE orders SET nama='$nama', alamat='$alamat', no_telpon='$no_telpon', email='$email', pesanan='$pesanan', total_harga='$total_harga', tanggal_pemesanan='$tanggal_pemesanan', tanggal_pengambilan='$tanggal_pengambilan' WHERE id=$order_id";

    if (mysqli_query($conn, $update_query)) {
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
    <title>Edit Pesanan Kue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            font-family: 'Lucida Sans';
            box-sizing: border-box;
        }

        body {
            background-image: url('assets/Teks Paragraf Anda.png');
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            background-color: pink;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-image: url('assets/Teks Paragraf Anda.png');
            background-size: cover;
            background-position: 75%;
            background-attachment: fixed;
            filter: blur(2px);
            z-index: -1;
        }

        .container {
            margin-top: 30px;
            background-color: #fff;
            padding: 10px 40px 30px 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            width: 100%;
            max-width: 1000px;
            max-height: 600px;
        }

        h2 {
            color: #E37383;
            text-align: center;
            margin-bottom: 25px;
        }

        form {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px 30px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 6px;
            font-weight: bold;
        }

        input, select, textarea {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            color: #333;
            font-size: 1rem;
            transition: border-color 0.3s;
            resize: none;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #E37383;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .button-group {
            grid-column: 1 / -1;
            display: flex;
            justify-content: space-between;
        }

        .button-group button {
            background-color: #E37383;
            color: #fff;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 8px;
            font-size: 16px;
            width: 48%;
            transition: background-color 0.3s, transform 0.3s;
        }

        .button-group button:hover {
            background-color: #db7093;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Pesanan Kue</h2>
        <form method="POST">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
            </div>
            <div class="form-group">
                <label for="no-telpon">No. Telepon:</label>
                <input type="text" id="no-telpon" name="no-telpon" value="<?php echo htmlspecialchars($no_telpon); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group full-width">
                <label for="alamat">Alamat:</label>
                <textarea id="alamat" name="alamat" rows="1" required><?php echo htmlspecialchars($alamat); ?></textarea>
            </div>
            <div class="form-group full-width">
                <label for="pesanan">Pesanan:</label>
                <textarea id="pesanan" name="pesanan" rows="4" readonly><?php echo htmlspecialchars($pesanan); ?></textarea>
            </div>
            <div class="form-group">
                <label for="total-harga">Total Harga:</label>
                <input type="number" id="total-harga" name="total-harga" value="<?php echo htmlspecialchars($total_harga); ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal-pemesanan">Tanggal Pemesanan:</label>
                <input type="date" id="tanggal-pemesanan" name="tanggal-pemesanan" value="<?php echo htmlspecialchars($tanggal_pemesanan); ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal-pengambilan">Tanggal Pengambilan:</label>
                <input type="date" id="tanggal-pengambilan" name="tanggal-pengambilan" value="<?php echo htmlspecialchars($tanggal_pengambilan); ?>" required>
            </div>
            <div class="button-group">
                <button type="button" onclick="history.back()">Kembali</button>
                <button type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>
