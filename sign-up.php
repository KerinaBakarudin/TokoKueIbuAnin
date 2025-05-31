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
            <h4>Create Your Account</h4>
            <form action="connect/tambah_customer.php" method="POST">
                <div class="input-box">
                    <label>Your Name</label> <br>
                    <i class="fa-solid fa-user" style="color: rgb(249, 147, 164)"></i>
                    <input type="text" name="nama" placeholder="Name" required>
                </div>

                <div class="input-box">
                    <label>Phone Number</label> <br>
                    <i class="fa fa-phone" style="color: rgb(249, 147, 164)"></i>
                    <input type="text" name="no_telepon" placeholder="Number" required>
                </div>

                <div class="input-box">
                    <label>Create Username</label> <br>
                    <i class="fa fa-user-plus" style="color: rgb(249, 147, 164)"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-box">
                    <label>Create Password</label> <br>
                    <i class="fa-solid fa-key" style="color: rgb(249, 147, 164)"></i>
                    <input type="password" name="password" placeholder="Password" required >
                </div>
                
                <div class="btn-login">
                <input type="submit" value="Create Account">
                </div>
            </form>
            <a href="login-customer.php" class="kembali">Back to Login</a>
        </div>
    </div>
</body>
</html>
