<?php
include '../connect/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $flowerName = $_POST['flowerName'];
    $flowerPrice = $_POST['flowerPrice'];
    $flowerImage = $_FILES['flowerImage']['name'];
    $target_dir = "flower/";

    // Cek apakah ada gambar baru yang diunggah
    if (!empty($flowerImage)) {
        $target_file = $target_dir . basename($flowerImage);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["flowerImage"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["flowerImage"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["flowerImage"]["tmp_name"], $target_file)) {
                $sql = "UPDATE products SET flowerName='$flowerName', flowerPrice='$flowerPrice', flowerImage='$flowerImage' WHERE id=$id";
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit;
            }
        }
    } else {
        $sql = "UPDATE products SET flowerName='$flowerName', flowerPrice='$flowerPrice' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: products-admin.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>