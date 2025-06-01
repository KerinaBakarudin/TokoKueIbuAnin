<?php
include 'koneksi.php'; // Memastikan koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $komentar = $_POST['komentar'];
    $rating = $_POST['rating'];

    // Query untuk mengupdate data review
    $query = "UPDATE review SET nama = '$nama', komentar = '$komentar', rating = '$rating' WHERE id = '$id'";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        echo "Review berhasil diperbarui.";
        header('Location: ../review-cust.php'); // Redirect ke halaman review setelah update
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
