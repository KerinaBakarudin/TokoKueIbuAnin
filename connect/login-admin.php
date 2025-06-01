<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Mengecek kondisi jika user ada atau tidak
    $sql_user = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $cek_user = mysqli_num_rows($sql_user);

    if ($cek_user > 0) {
        $_SESSION['login'] = true;
        header('Location: ../admin/home-admin.php');
        exit();
    } else {
        header('Location: ../admin/login-admin.php');
        exit();
    }
} else {
    header('Location: ../admin/login-admin.php');
    exit();
}
?>
