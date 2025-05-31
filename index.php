<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floriest</title>
    <style>
        * {
            font-family: 'Lucida Sans';
        }

        body {
            margin: 0;
            background-image: url('assets/bakery.jpg');
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

        .login-options {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-login-customer,
        .btn-login-admin {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 10px 20px;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            border-radius: 15px;
            font-size: 16px;
            width: 150px; 
            height: 20px; 
            background-color: rgb(249, 147, 164); 
        }

        .btn-login-customer:hover,
        .btn-login-admin:hover {
            background-color: pink;
        }
    </style>
</head>

<body>
    <div class="login">
        <div class="role">
            <h4>Welcome, Choose Your Role</h4>
            <div class="login-options">
                <a href="login-customer.php" class="btn-login-customer">Pelanggan</a>
                <a href="login-admin.php" class="btn-login-admin">Pegawai</a>
            </div>
        </div>
    </div>
</body>
</html>
