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

// Periksa apakah metode request adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan dari formulir
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_telepon = mysqli_real_escape_string($conn, $_POST['no_telepon']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query update untuk mengupdate data profil pengguna
    $query = "UPDATE customer SET nama='$nama', no_telepon='$no_telepon', username='$username', password='$password' WHERE id_cust='$user_id'";
    
    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Jika berhasil diupdate, arahkan pengguna kembali ke halaman profil
        header('Location: ../home.php');
        exit();
    } else {
        // Jika gagal diupdate, tampilkan pesan error
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    // Jika metode request bukan POST, arahkan pengguna kembali ke halaman profil
    header('Location: ../home.php');
    exit();
}
?>
