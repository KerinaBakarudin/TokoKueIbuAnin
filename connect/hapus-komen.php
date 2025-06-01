<?php
include 'koneksi.php'; // Memastikan koneksi ke database

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus review berdasarkan ID
    $query = "DELETE FROM review WHERE id = '$id'";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        echo "Review berhasil dihapus.";
        header('Location: ../review-cust.php'); // Redirect ke halaman review setelah penghapusan
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}
?>
