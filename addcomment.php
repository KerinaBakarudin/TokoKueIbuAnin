<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Komentar</title>
    <style>
        * {
            font-family: 'Lucida Sans';
        }

        body {
            background : url('assets/cake.png');
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        h2 {
            color: #E37383;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            color: #333;
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            margin-bottom: 20px;
        }
        .rating input {
            display: none;
        }
        .rating label {
            cursor: pointer;
            width: 30px;
            height: 30px;
            color: #ccc;
            font-size: 30px;
            line-height: 30px;
            text-align: center;
            margin: 0 2px;
        }
        .rating label:before {
            content: "★";
        }
        .rating input:checked ~ label:before,
        .rating input:checked ~ label ~ label:before,
        .rating label:hover:before,
        .rating label:hover ~ label:before {
            color: #ffcc00;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
        input[type="submit"],
        input[type="button"] {
            background-color: #E37383;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #E37383;
        }
    </style>
</head>
<body>
    <form action="connect/tambah-komen.php" method="post">
        <h2>Tulis Komentar Anda</h2>
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
        
        <label for="komentar">Komentar:</label>
        <textarea id="komentar" name="komentar" rows="4" required></textarea>
        
        <label for="rating">Beri Bintang:</label>
        <div class="rating">
            <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
            <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
            <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
            <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
            <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
        </div>
        
        <div class="button-container">
            <input type="button" value="Kembali" onclick="history.back()">
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>