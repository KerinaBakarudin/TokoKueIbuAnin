<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pemesanan Bunga</title>
    <style>
        * {
            font-family: 'Lucida Sans';
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            background-color: pink;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
        }
        h2 {
            color: #E37383;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            color: #333;
        }
        .form-group input[type="date"],
        .form-group input[type="number"] {
            padding: 8px;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
        }
        .button-group button {
            background-color: #E37383;
            color: #fff;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
            width: 48%;
        }
        .button-group button:hover {
            background-color: pink;
        }
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: pink;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulir Pemesanan Bunga</h2>
        <form id="orderForm" action="connect/booking.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="no-telpon">No. Telepon:</label>
                <input type="tel" id="no-telpon" name="no-telpon" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="pesanan">Pesanan:</label>
                <textarea id="pesanan" name="pesanan" rows="4" required readonly></textarea>
            </div>
            <div class="form-group">
                <label for="total-harga">Total Harga:</label>
                <input type="number" id="total-harga" name="total-harga" readonly>
            </div>
            <div class="form-group">
                <label for="tanggal-pemesanan">Tanggal Pemesanan:</label>
                <input type="date" id="tanggal-pemesanan" name="tanggal-pemesanan" required>
            </div>

            <div class="form-group">
                <label for="tanggal-pengambilan">Tanggal Pengambilan:</label>
                <input type="date" id="tanggal-pengambilan" name="tanggal-pengambilan" required>
            </div>

            <div class="form-group button-group">
                <button type="button" onclick="history.back()">Kembali</button>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        // Load data from localStorage to populate the form
        document.addEventListener('DOMContentLoaded', function() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            if (cart.length > 0) {
                let pesanan = cart.map(item => `${item.name} (${item.quantity})`).join(', ');
                let totalHarga = cart.reduce((acc, item) => acc + (item.price * item.quantity), 0);
                
                document.getElementById('pesanan').value = pesanan;
                document.getElementById('total-harga').value = totalHarga.toFixed(2); 
            }
        });
    </script>
</body>
</html>
