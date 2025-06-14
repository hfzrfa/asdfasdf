<?php
session_start();

$produk = [];
$total_semua = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nama_produk'])) {
    $produk[] = [
        'nama_produk' => $_POST['nama_produk'],
        'harga' => (int)($_POST['harga'] ?? 0),
        'jumlah' => (int)($_POST['jumlah'] ?? 0),
        'gambar' => $_POST['gambar'] ?? '',
        'total' => ((int)($_POST['harga'] ?? 0)) * ((int)($_POST['jumlah'] ?? 0))
    ];
    $total_semua = $produk[0]['total'];
}

elseif (!empty($_SESSION['keranjang'])) {
    foreach ($_SESSION['keranjang'] as $item) {
        $itemTotal = $item['harga'] * $item['jumlah'];
        $produk[] = [
            'nama_produk' => $item['nama_produk'],
            'harga' => $item['harga'],
            'jumlah' => $item['jumlah'],
            'gambar' => $item['gambar'],
            'total' => $itemTotal
        ];
        $total_semua += $itemTotal;
    }
} else {
   
    header("Location: keranjang.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Checkout - ApotekQiu</title>
    <style>

        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9f0f2;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            padding: 30px 40px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #00796b;
        }
        .product-info {
            display: flex;
            gap: 20px;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }
        .product-info img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 0 6px rgba(0,0,0,0.1);
        }
        .product-details {
            flex-grow: 1;
        }
        .product-details p {
            margin: 6px 0;
            font-size: 16px;
            color: #333;
        }
        .product-details p strong {
            color: #00796b;
        }

        label {
            display: block;
            margin: 18px 0 6px 0;
            font-weight: 600;
            color: #004d40;
        }

        select, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid #b2dfdb;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s ease;
            resize: vertical;
        }
        select:focus, textarea:focus {
            border-color: #00796b;
            outline: none;
        }

        textarea {
            min-height: 80px;
        }

        .hidden {
            display: none;
        }

        .btn-submit {
            margin-top: 30px;
            background-color: #00796b;
            color: white;
            border: none;
            padding: 14px 0;
            width: 100%;
            font-size: 17px;
            font-weight: 700;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0,121,107,0.4);
            transition: background-color 0.3s ease;
        }
        .btn-submit:hover {
            background-color: #004d40;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .container {
                margin: 20px 15px;
                padding: 25px 20px;
            }
            .product-info {
                flex-direction: column;
                text-align: center;
            }
            .product-info img {
                margin-bottom: 15px;
            }
        }

        .total-bayar {
            text-align: right;
            font-weight: 700;
            font-size: 18px;
            color: #00796b;
            margin-top: 10px;
            border-top: 2px solid #00796b;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Checkout Produk</h2>

        <?php foreach ($produk as $index => $p): ?>
            <div class="product-info">
                <img src="<?= htmlspecialchars($p['gambar']) ?>" alt="Gambar Produk" />
                <div class="product-details">
                    <p><strong>Produk:</strong> <?= htmlspecialchars($p['nama_produk']) ?></p>
                    <p><strong>Harga Satuan:</strong> Rp <?= number_format($p['harga'], 0, ',', '.') ?></p>
                    <p><strong>Jumlah:</strong> <?= $p['jumlah'] ?></p>
                    <p><strong>Total:</strong> Rp <?= number_format($p['total'], 0, ',', '.') ?></p>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if(count($produk) > 1): ?>
            <div class="total-bayar">Total Keseluruhan: Rp <?= number_format($total_semua, 0, ',', '.') ?></div>
        <?php endif; ?>

        <form method="POST" action="proses_pembayaran.php" id="checkoutForm" novalidate>
            <!-- Kirim data produk sebagai JSON agar bisa banyak produk -->
            <input type="hidden" name="produk" value='<?= json_encode($produk, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'>
            <input type="hidden" name="total_semua" value="<?= $total_semua ?>">

            <label for="metode">Metode Pembayaran</label>
            <select name="metode" id="metode" required>
                <option value="" disabled selected>-- Pilih Metode Pembayaran --</option>
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer Bank</option>
            </select>

            <label for="cara_pengambilan">Cara Pengambilan</label>
            <select name="cara_pengambilan" id="cara_pengambilan" required>
                <option value="" disabled selected>-- Pilih Cara Pengambilan --</option>
                <option value="Ambil di Apotek">Ambil di Apotek</option>
                <option value="Delivery">Delivery</option>
            </select>

            <div id="alamat-pengiriman" class="hidden">
                <label for="alamat">Alamat Pengiriman</label>
                <textarea name="alamat" id="alamat" placeholder="Masukkan alamat lengkap pengiriman..."></textarea>
            </div>

            <button type="submit" class="btn-submit">Lanjutkan Pembayaran</button>
        </form>
    </div>

    <script>
        const caraPengambilan = document.getElementById('cara_pengambilan');
        const alamatBox = document.getElementById('alamat-pengiriman');
        const alamatField = document.getElementById('alamat');

        caraPengambilan.addEventListener('change', function () {
            if (this.value === 'Delivery') {
                alamatBox.classList.remove('hidden');
                alamatField.setAttribute('required', 'required');
            } else {
                alamatBox.classList.add('hidden');
                alamatField.removeAttribute('required');
                alamatField.value = '';
            }
        });
    </script>
</body>
</html>
