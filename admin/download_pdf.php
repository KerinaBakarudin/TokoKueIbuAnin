<?php
require_once '../vendor/autoload.php'; // path ke autoload composer
include '../connect/koneksi.php';

use Dompdf\Dompdf;

// Ambil bulan dari input
if (isset($_GET['bulan'])) {
    $bulan_input = $_GET['bulan']; // format: YYYY-MM
    $bulan = date('m', strtotime($bulan_input));
    $tahun = date('Y', strtotime($bulan_input));

    $query = "SELECT * FROM orders WHERE MONTH(tanggal_pemesanan) = '$bulan' AND YEAR(tanggal_pemesanan) = '$tahun'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Error: " . mysqli_error($conn));
    }

    // HTML untuk isi PDF
    $html = '<h2 style="text-align:center;">Laporan Order - Bulan ' . date('F Y', strtotime($bulan_input)) . '</h2>';
    $html .= '<table border="1" cellspacing="0" cellpadding="5" width="100%">';
    $html .= '
        <thead>
            <tr style="background-color: #f2b5c4;">
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Email</th>
                <th>Pesanan</th>
                <th>Total Harga</th>
                <th>Tgl Pemesanan</th>
                <th>Tgl Pengambilan</th>
            </tr>
        </thead><tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        $html .= "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['alamat']}</td>
            <td>{$row['no_telpon']}</td>
            <td>{$row['email']}</td>
            <td>{$row['pesanan']}</td>
            <td>Rp. " . number_format($row['total_harga'], 2, ',', '.') . "</td>
            <td>{$row['tanggal_pemesanan']}</td>
            <td>{$row['tanggal_pengambilan']}</td>
        </tr>";
    }

    $html .= '</tbody></table>';

    // Inisialisasi Dompdf dan cetak
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    $filename = "Laporan_Order_" . $bulan . "_" . $tahun . ".pdf";
    $dompdf->stream($filename, array("Attachment" => true));
} else {
    echo "Bulan belum dipilih!";
}
?>
