<?php
include '../connect/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Lakukan query untuk mendapatkan informasi produk sebelum menghapusnya
    $result = $conn->query("SELECT * FROM products WHERE id=$id");
    $product = $result->fetch_assoc();

    if ($product) {
        // Hapus gambar dari direktori jika ada
        if (!empty($product['flowerImage']) && file_exists('flower/' . $product['flowerImage'])) {
            unlink('flower/' . $product['flowerImage']);
        }

        // Hapus produk dari database
        $sql = "DELETE FROM products WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header('Location: products-admin.php');
            exit;
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Product not found!";
    }
} else {
    echo "Invalid request!";
}

$conn->close();
?>
