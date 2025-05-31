<?php
include 'koneksi.php'; // Memastikan koneksi ke database

// Mendapatkan data dari formulir
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_telpon = $_POST['no-telpon'];
$email = $_POST['email'];
$pesanan = $_POST['pesanan'];
$total_harga = $_POST['total-harga']; // Pastikan ini mengambil nilai total-harga yang dikirim dari formulir
$tanggal_pemesanan = $_POST['tanggal-pemesanan'];
$tanggal_pengambilan = $_POST['tanggal-pengambilan'];

// Memasukkan data pesanan ke dalam database
$query = "INSERT INTO orders (nama, alamat, no_telpon, email, pesanan, total_harga, tanggal_pemesanan, tanggal_pengambilan) 
          VALUES ('$nama', '$alamat', '$no_telpon', '$email', '$pesanan', '$total_harga', '$tanggal_pemesanan', '$tanggal_pengambilan')";

$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}

// Redirect ke halaman detail pesanan dengan order ID
$order_id = mysqli_insert_id($conn);
header("Location: ../order_detail.php?id=$order_id");
exit();
?>
