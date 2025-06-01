<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Mengecek kondisi jika user ada atau tidak
    $sql_user = mysqli_query($conn, "SELECT * FROM customer WHERE username='$username' AND password='$password'");
    $cek_user = mysqli_num_rows($sql_user);

    if ($cek_user > 0) {
        // Jika login berhasil, simpan ID pengguna ke dalam session
        $user_data = mysqli_fetch_assoc($sql_user);
        $_SESSION['user_id'] = $user_data['id_cust'];
        
        // Atur session login menjadi true
        $_SESSION['login'] = true;
        
        // Arahkan pengguna ke halaman beranda
        header('Location: ../home.php');
        exit();
    } else {
        // Jika login gagal, arahkan pengguna kembali ke halaman login
        header('Location: ../login-customer.php');
        exit();
    }
} else {
    // Jika metode request bukan POST, arahkan pengguna kembali ke halaman login
    header('Location: ../login-customer.php');
    exit();
}
?>
