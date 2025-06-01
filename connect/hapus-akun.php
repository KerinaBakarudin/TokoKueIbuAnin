<?php
session_start();
include "koneksi.php";

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    // Jika belum login, arahkan pengguna kembali ke halaman login
    header('Location: ../login-customer.php');
    exit();
}

// Periksa apakah ID pengguna disimpan dalam sesi
if (!isset($_SESSION['user_id'])) {
    // Jika tidak, arahkan pengguna kembali ke halaman login
    header('Location: ../login-customer.php');
    exit();
}

// Ambil ID pengguna dari sesi
$user_id = $_SESSION['user_id'];

// Hapus data pengguna dari database berdasarkan ID pengguna
$query = "DELETE FROM customer WHERE id_cust = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Jika penghapusan berhasil, arahkan pengguna ke halaman login dan hapus sesi
    session_destroy();
    header('Location: ../login-customer.php');
    exit();
} else {
    // Jika penghapusan gagal, tampilkan pesan error
    echo "Error: " . mysqli_error($conn);
    exit();
}
?>
