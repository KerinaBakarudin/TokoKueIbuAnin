<?php
require_once 'vendor/autoload.php'; // Composer autoload Midtrans
include 'connect/koneksi.php'; // Koneksi ke database

// Mendapatkan order ID dari parameter URL
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    // Ambil data pesanan
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

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'SB-Mid-server-SaSsyQqNbHcyM-WlWUxM2I4k'; // server key sandbox
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Parameter transaksi
$params = [
    'transaction_details' => [
        'order_id' => 'ORDER-' . $order_id,
        'gross_amount' => (int) $total_harga,
    ],
    'customer_details' => [
        'first_name' => $nama,
        'email' => $email,
        'phone' => $no_telpon,
    ],
    'item_details' => [[
        'id' => 'item001',
        'price' => (int) $total_harga,
        'quantity' => 1,
        'name' => $pesanan
    ]]
];

// Mendapatkan Snap Token
$snapToken = \Midtrans\Snap::getSnapToken($params);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Pemesanan Bunga</title>
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
        .detail-group {
            margin-bottom: 15px;
        }
        .detail-group label {
            display: block;
            font-weight: bold;
        }
        .detail-group span {
            font-weight: normal;
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
    <h2>Detail Pemesanan Bunga</h2>
    <div class="detail-group">
        <label>Nama:</label>
        <span><?php echo $nama; ?></span>
    </div>
    <div class="detail-group">
        <label>Alamat:</label>
        <span><?php echo $alamat; ?></span>
    </div>
    <div class="detail-group">
        <label>No. Telepon:</label>
        <span><?php echo $no_telpon; ?></span>
    </div>
    <div class="detail-group">
        <label>Email:</label>
        <span><?php echo $email; ?></span>
    </div>
    <div class="detail-group">
        <label>Pesanan:</label>
        <span><?php echo $pesanan; ?></span>
    </div>
    <div class="detail-group">
        <label>Total Harga:</label>
        <span><?php echo 'Rp. ' . number_format($total_harga, 2, ',', '.'); ?></span>
    </div>
    <div class="detail-group">
        <label>Tanggal Pemesanan:</label>
        <span><?php echo $tanggal_pemesanan; ?></span>
    </div>
    <div class="detail-group">
        <label>Tanggal Pengambilan:</label>
        <span><?php echo $tanggal_pengambilan; ?></span>
    </div>
    <div class="button-group">
        <a href="hapus-booking.php?id=<?php echo $order_id; ?>"><button>Cancel</button></a>
        <a href="edit-booking.php?id=<?php echo $order_id; ?>"><button>Edit</button></a>
        <button id="pay-button">Bayar Sekarang</button>
    </div>
</div>

<!-- Midtrans Snap -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-zTWeA1mbkpaP7INc"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        snap.pay('<?php echo $snapToken; ?>', {
            onSuccess: function(result){
                window.location.href = "confirm-booking.php?id=<?php echo $order_id ?>";
            },
            onPending: function(result){
                window.location.href = "confirm-booking.php?id=<?php echo $order_id ?>";
            },
            onError: function(result){
                alert("Pembayaran gagal!");
                console.log(result);
            }
        });
    };
</script>
</body>
</html>
