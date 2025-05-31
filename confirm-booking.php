<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm</title>

    <style>
        * {
            font-family: 'Lucida Sans';
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background : url('assets/pict2.jpeg');
        }

        .thank-you-box {
            text-align: center;
            background-color: white;
            padding: 40px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .thank-you-box h1 {
            color: #ff6699;
            margin-bottom: 20px;
        }

        .thank-you-box p {
            color: #ff6699;
            font-size: 18px;
            margin-bottom: 30px;
        }

        .back-button {
            text-decoration: none;
            background-color: #ff6699;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #ff3366;
        }
    </style>
</head>
<body>
    <div class="thank-you-box">
        <h1>Terima kasih sudah berbelanja</h1>
        <p>Silahkan ambil pesanan Anda di toko Floriest</p>
        <a href="products.php" class="back-button">Back to Products</a>
    </div>
</body>
</html>