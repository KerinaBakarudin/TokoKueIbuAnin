<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    
    <style>
        * {
            font-family: 'Lucida Sans';
        }

    body, html {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
        background-color: #f7d9e3;
    }

    .container {
        max-width: 600px; 
        margin: auto; 
        margin-top: auto; 
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: white;
    }

    h2 {
        text-align: center;
        color: #e83e8c;
    }

    label {
        margin-bottom: 5px;
        display: block;
        color: #e83e8c;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #e83e8c;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        background-color: #e83e8c;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        background-color: #d8357e;
    }

    input[type="file"]::file-selector-button {
        background-color: #e83e8c;
    }

    </style>
</head>
<body>
    <div class="container">
    <h2>Menambahkan Produk</h2>
        <form action="addproducts.php" method="post" enctype="multipart/form-data"> 
        <label for="flowerName">Nama Produk:</label>
        <input type="text" id="flowerName" name="flowerName" required>
        
        <label for="flowerPrice">Harga:</label>
        <input type="text" id="flowerPrice" name="flowerPrice" required>
        
        <label for="flowerImage">Gambar Produk:</label>
        <input type="file" id="flowerImage" name="flowerImage" accept="image/*" required>
        
        <button type="submit">Add Product</button>
        </form>
    </div>

    <?php
    include '../connect/koneksi.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $flowerName = $_POST['flowerName'];
        $flowerPrice = $_POST['flowerPrice'];

        // File yang diunggah
        $nama_file = $_FILES['flowerImage']['name'];
        $ukuran_file = $_FILES['flowerImage']['size'];
        $tmp_file = $_FILES['flowerImage']['tmp_name'];
        $upload_dir = "flower/";
        $target_file = $upload_dir . basename($nama_file);

        // Cek apakah file berhasil diunggah
        if (move_uploaded_file($tmp_file, $target_file)) {
            $stmt = $conn->prepare("INSERT INTO products (flowerName, flowerPrice, flowerImage) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $flowerName, $flowerPrice, $nama_file);
            if ($stmt->execute()){
                header("Location: products-admin.php");
            } else{
                echo "Error: ".$stmt->error;
            }
            $stmt->close();
        } else {
            echo "<h5 style='color: red; text-align: center;'>Pengunggahan file gagal.</h5>";
        }
    }
    ?>
</body>
</html>