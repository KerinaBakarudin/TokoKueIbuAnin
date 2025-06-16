<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pemesanan Kue</title>
    <style>
        * {
            font-family:'Lucida Sans';
            box-sizing: border-box;

        }

        body {
            background-image: url('assets/Teks Paragraf Anda.png');
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            background-color: pink;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-image: url('assets/Teks Paragraf Anda.png');
            background-size: cover;
            background-position: 75%;
            background-attachment: fixed;
            filter: blur(2px);
            z-index: -1;
            transform: translateZ(0); /* fix for some rendering issues */
        }

        .container {
            margin-top: 30px;
            background-color: #fff;
            padding: 10px 40px 30px 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            width: 100%;
            max-width: 1000px;
            max-height: 600px;
            transition: transform 0.3s;
        } 
        
        h2 {
            color: #E37383;
            text-align: center;
            margin-bottom: 25px;
        }
        form {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px 30px;
        }
        .form-group {
            display: flex;
            flex-direction: column; 
        }
         label {
            margin-bottom: 6px;
            font-weight: bold;
        }

        input, select, textarea {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            color: #333;
            font-size: 1rem;
            transition: border-color 0.3s;
            resize: none;
        }
        input[type="date"], input[type="number"] {
            padding: 10px;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #E37383;
        }
        .full-width {
            grid-column: 1 / -1;
        }
        .button-group {
            grid-column: 1 / -1;
            display: flex;
            justify-content: space-between;
        }
        .button-group button {
            background-color: #E37383;
            color: #fff;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 8px;
            font-size: 16px;
            width: 48%;
            transition: background-color 0.3s, transform 0.3s;
        }
        .button-group button:hover {
            background-color: #db7093;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulir Pemesanan Kue</h2><br>
        <form id="orderForm" action="connect/booking.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="no-telpon">No. Telepon:</label>
                <input type="tel" id="no_telpon" name="no_telpon" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
             <div class="form-group full-width">
                <label for="alamat">Alamat:</label>
                <textarea id="alamat" name="alamat" rows="1" required></textarea>
            </div>
            <div class="form-group full-width">
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

            <div class="button-group">
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