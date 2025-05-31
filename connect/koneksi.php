<?php
$host = 'localhost';
$port = 3307; 
$user = 'root';
$password = '';
$database = 'toko_kue';

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $database, $port);

// Memeriksa koneksi
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
?>
