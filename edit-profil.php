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
            background-image: url('assets/bg-flower.jpg');
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
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-box .input-box{
            padding: 5px;
        }

        .login-box h4 {
            color: #000000;
            font-weight: bold;
            margin-bottom: 30px;
            font-size: 20px;
        }

        .login-box form {
            width: 100%;
        }

        .login-box .kembali {
            color: rgb(249, 147, 164);
            font-size: small;
            margin-top: 5px;
        }

        .input-box {
            position: relative;
            margin-bottom: 25px;
        }

        .input-box label {
            margin-left: 0px;
            margin-bottom: 5px;
        }


        .input-box input {
            width: 50%;
            height: 45px;
            border-width: 2px; 
            border-style: solid; 
            border-color: rgb(249, 147, 164); 
            border-radius: 25px;
            padding: 0 50px;
            font-size: 1em;
            background-color: #ffffff;
        }


        .input-box input:focus,
        .input-box input:valid {
            border-color: rgb(255, 255, 255);
        }

        .btn-login {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 5px 250px;
        }

        .btn-login input[type="submit"] {
            padding: 10px 20px;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            border-radius: 10px;
            font-size: 16px;
            background-color: rgb(249, 147, 164);
            border: none;
            cursor: pointer;
        }

        .btn-login input[type="submit"]:hover {
            background-color: pink; 
        }
    </style>
</head>

<body>
    <div class="login">
        <div class="login-box">
            <h4>Your Account</h4>
            <form action="connect/edit-profil.php" method="POST">
                <div class="input-box">
                    <label>Your Name</label> <br>
                    <i class="fa-solid fa-user" style="color: rgb(249, 147, 164)"></i>
                    <input type="text" name="nama" value="<?php echo $data['nama']; ?>">
                </div>

                <div class="input-box">
                    <label>Phone Number</label> <br>
                    <i class="fa fa-phone" style="color: rgb(249, 147, 164)"></i>
                    <input type="text" name="no_telepon" value="<?php echo $data['no_telepon']; ?>">
                </div>

                <div class="input-box">
                    <label>Username</label> <br>
                    <i class="fa fa-user-plus" style="color: rgb(249, 147, 164)"></i>
                    <input type="text" name="username" value="<?php echo $data['username']; ?>">
                </div>
                <div class="input-box">
                    <label>Password</label> <br>
                    <i class="fa-solid fa-key" style="color: rgb(249, 147, 164)"></i>
                    <input type="password" name="password" value="<?php echo $data['password']; ?>">
                </div>
                
                <div class="btn-login">
                <input type="submit" value="Save">
                </div>
            </form>
            <a href="profil.php" class="kembali">Back</a>
        </div>
    </div>
</body>
</html>
