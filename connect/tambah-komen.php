<?php
session_start();
include "koneksi.php";

// Mengambil data dari form
$nama = $_POST['nama'];
$komentar = $_POST['komentar'];
$rating = $_POST['rating'];

// Menyiapkan dan mengeksekusi pernyataan SQL
$sql = "INSERT INTO review (nama, komentar, rating) VALUES ('$nama', '$komentar', '$rating')";

if ($conn->query($sql) === TRUE) {
    header('Location: ../review-cust.php');
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
