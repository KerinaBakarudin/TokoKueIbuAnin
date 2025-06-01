<?php
include 'connect/koneksi.php'; // Memastikan koneksi ke database

// Memeriksa apakah ID Review ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data review dari database berdasarkan ID
    $query = "SELECT * FROM review WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Periksa apakah data ditemukan
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "Data review tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}
?>

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
            background-image: url('assets/Teks Paragraf Anda.png');            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-image: url('assets/cake.png');
            background-size: cover;
            background-position: 75%;
            background-attachment: fixed;
            filter: blur(2px);
            z-index: -1;
            transform: translateZ(0); /* fix for some rendering issues */
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
    <form action="connect/edit-komen.php" method="post">
        <h2>Edit Komentar Anda</h2>
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>">
        
        <label for="komentar">Komentar:</label>
        <textarea id="komentar" name="komentar" rows="4"><?php echo $data['komentar']; ?></textarea>
        
        <label for="rating">Beri Bintang:</label>
        <div class="rating">
            <?php for ($i = 5; $i >= 1; $i--): ?>
                <input type="radio" id="star<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" <?php echo ($data['rating'] == $i) ? 'checked' : ''; ?>>
                <label for="star<?php echo $i; ?>"></label>
            <?php endfor; ?>
        </div>
        
        <div class="button-container">
            <input type="button" value="Kembali" onclick="history.back()">
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>