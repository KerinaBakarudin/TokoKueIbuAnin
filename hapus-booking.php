<?php
include 'connect/koneksi.php'; // Memastikan koneksi ke database

// Mendapatkan order ID dari parameter URL
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    
    // Hapus data pesanan dari database berdasarkan ID
    $delete_query = "DELETE FROM orders WHERE id = $order_id";

    if (mysqli_query($conn, $delete_query)) {
        header("Location: order-cust.php");
        exit();
    } else {
        echo "<script>alert('Gagal menghapus pesanan: " . mysqli_error($conn) . "');</script>";
    }
} else {
    die('No order ID provided');
}

?>
