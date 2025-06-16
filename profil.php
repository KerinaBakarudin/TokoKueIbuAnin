<?php
session_start();
include "connect/koneksi.php";

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

// Ambil data profil pengguna dari database berdasarkan ID pengguna
$query = "SELECT * FROM customer WHERE id_cust = '$user_id'";
$result = mysqli_query($conn, $query);

// Periksa apakah data ditemukan
if ($result && mysqli_num_rows($result) > 0) {
    // Jika ditemukan, simpan data profil dalam array
    $data = mysqli_fetch_assoc($result);
} else {
    // Jika tidak ditemukan, tampilkan pesan dan keluar dari skrip
    echo "Data tidak ditemukan.";
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floriest</title>
    <script src="https://kit.fontawesome.com/97216fb713.js" crossorigin="anonymous"></script>

    <style>
        * {
            font-family: 'Lucida Sans';
        }

        body {
            margin: 0;
            background-image: url('assets/cake.png');
            background-size: cover;
            background-position: 75%;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 10px;
        }

        .login-box {
            text-align: left;
            width: 450px;
        }

        .login-box h4 {
            color: #000000;
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .login-box .profile-item {
            margin-bottom: 15px;
        }

        .profile-item label {
            font-weight: bold;
        }

        .profile-item span {
            margin-left: 10px;
        }

        .action-btn {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .action-btn button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-kembali {
            background-color: grey;
            color: #fff;
        }

        .btn-edit {
            background-color: rgb(249, 147, 164);
            color: #fff;
        }

        .btn-hapus {
            background-color: red;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="login">
        <div class="login-box">
            <h4>Your Account</h4>
            <div class="profile-item">
                <label>Your Name:</label>
                <span><?php echo $data['nama']; ?></span>
            </div>
            <div class="profile-item">
                <label>Number:</label>
                <span><?php echo $data['no_telepon']; ?></span>
            </div>
            <div class="profile-item">
                <label>Username:</label>
                <span><?php echo $data['username']; ?></span>
            </div>
            <div class="profile-item">
                <label>Password:</label>
                <span><?php echo $data['password']; ?></span>
            </div>

            <div class="action-btn">
                <a href="home.php"><button type="button" class="btn-kembali">Back</button></a>
                <a href="edit-profil.php"><button type="button" class="btn-edit">Edit Profil</button></a>
                <a href="connect/hapus-akun.php?id=<?php echo $data['id_cust']; ?>"><button type="button" class="btn-hapus">Delete</button></a>
                <a href="index.php"><button type="button" class="btn-logout">Log Out</button></a>
            </div>
    </div>
</body>
</html>
