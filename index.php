<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Kue Ibu Anin</title>
    <style>
        * {
            font-family:'Lucida Sans';
        }

        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        /* Tambahkan elemen blur di belakang konten */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('assets/Teks Paragraf Anda.png');
            background-size: cover;
            background-position: 75%;
            background-attachment: fixed;
            filter: blur(3px); /* Ubah intensitas blur di sini */
            z-index: 0;
        }

        /* Konten tetap terlihat di atas gambar */
        body > * {
            position: relative;
            z-index: 1;
        }


         h1 {
            font-size: 2.5rem;
            color:   #c94f71;
            margin-bottom: 1.5rem; /* space between h1 and div */
            text-align: center;
            text-shadow: 3px 3px 6px rgba(154, 154, 154, 0.8);

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

        .role h4 {
            font-weight: 600;
            color: #7c2a40;
            margin-bottom: 1rem;
            }

        .login-options a {
            display: inline-block;
            margin: 0.5rem 1rem;
            text-decoration: none;
            padding: 0.6rem 1.4rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            user-select: none;
            cursor: pointer;
        }

        .btn-login-customer {
            background-color: #f9c0cb;
            color: #7c2a40;
            border: 2px solid #c94f71;
        }
        .btn-login-customer:hover {
            background-color: #c94f71;
            color: white;
        }
        .btn-login-admin {
            background-color: #f2b8a0;
            color: #662d22;
            border: 2px solid #d97a5e;
        }
        .btn-login-admin:hover {
            background-color: #d97a5e;
            color: white;
        }
    </style>
</head>

<body>
    
    <div class="login">
        <h1>Welcome to Toko Kue Ibu Anin</h1>
        <div class="role">
        <h4>Heyo! Choose Your Role 😎</h4>
        <div class="login-options">
            <a href="login-customer.php" class="btn-login-customer">🛒 Pelanggan 💖</a>
            <a href="login-admin.php" class="btn-login-admin">👩‍💼 Pegawai ✨</a>
        </div>
        </div>
    </div>
</body>
</html>