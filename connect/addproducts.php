<?php
include 'koneksi.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flowerName = $_POST['flowerName'];
    $flowerPrice = $_POST['flowerPrice'];
    
    // Memeriksa apakah file gambar telah diunggah
    if (isset($_FILES['flowerImage']) && $_FILES['flowerImage']['error'] === UPLOAD_ERR_OK) {
        $flowerImage = $_FILES['flowerImage']['name'];
        $flowerImageTmp = $_FILES['flowerImage']['tmp_name'];
        $flowerImageSize = $_FILES['flowerImage']['size'];
        $flowerImageType = $_FILES['flowerImage']['type'];
        
        // Memindahkan file gambar yang diunggah ke direktori yang diinginkan
        $uploadDir = 'uploads/';
        $uploadPath = $uploadDir . $flowerImage;

        if (!move_uploaded_file($flowerImageTmp, $uploadPath)) {
            die("Gagal mengunggah file.");
        }
    } else {
        die("File gambar tidak diunggah atau terdapat kesalahan.");
    }

    // Menyimpan data produk ke database
    $stmt = $conn->prepare("INSERT INTO products (flowerName, flowerPrice, flowerImage) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $flowerName, $flowerPrice, $uploadPath);
    $stmt->execute();
    
    $stmt->close();

    // Redirect ke halaman lain setelah menambahkan produk
    header("Location: ../home.php");
    exit();
}
?>
