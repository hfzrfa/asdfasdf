<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    die("Error: User belum login.");
}

if (!isset($_GET['id'])) {
    die("ID transaksi tidak ditemukan.");
}

$id_transaksi = (int)$_GET['id'];
$sql = "SELECT * FROM transaksi WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_transaksi);
$stmt->execute();
$transaksi = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$transaksi || strtolower($transaksi['metode_pembayaran']) !== 'cash') {
    die("Transaksi tidak valid atau bukan pembayaran cash.");
}


$sql_produk = "SELECT * FROM detail_transaksi WHERE id_transaksi = ?";
$stmt_produk = $conn->prepare($sql_produk);
$stmt_produk->bind_param("i", $id_transaksi);
$stmt_produk->execute();
$produk = $stmt_produk->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt_produk->close();


?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pembayaran Cash</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 30px;
        }
        .info, .produk, .alert {
            margin-bottom: 30px;
        }
        .info p {
            margin: 8px 0;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #e9f5ff;
            color: #333;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 12px;
            font-size: 17px;
        }
        .alert {
            background-color: #fff3cd;
            border-left: 5px solid #ffc107;
            padding: 20px;
            border-radius: 8px;
            font-size: 16px;
            line-height: 1.6;
        }
        .btn-back {
            display: inline-block;
            background-color: #007BFF;
            color: white;
            padding: 12px 18px;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    
    <h2>Konfirmasi Pembayaran - Cash</h2>

    <div class="info">
        <p><strong>ID Transaksi:</strong> <?= $transaksi['id'] ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($transaksi['status']) ?></p>
        <p><strong>Cara Pengambilan:</strong> <?= htmlspecialchars($transaksi['cara_pengambilan']) ?></p>
    </div>

    <div class="produk">
        <h3>Produk yang Dibeli</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produk as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['nama_produk']) ?></td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td><?= $item['jumlah'] ?></td>
                        <td>Rp <?= number_format($item['total'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="total">Total Pembayaran: Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></div>
    </div>

   <div class="alert">
    <strong>Informasi:</strong><br>
    Anda memilih metode pembayaran <strong>di tempat (Cash)</strong>.<br>
    <?php if (strtolower($transaksi['cara_pengambilan']) === 'ambil di apotek'): ?>
        Tunggu Hingga Admin menyetujui pesanan Anda,Setelah itu,Silakan datang ke <strong>ApotekQiu</strong> dan tunjukkan <strong>ID Transaksi</strong> Anda kepada petugas <Strong>ApotekQiu</Strong>.
    <?php else: ?>
        Tunggu persetujuan admin terlebih dahulu. Jika sudah disetujui, barang akan segera dikirim ke alamat Anda. Jangan lupa siapkan uang tunai sebesar: <strong>Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></strong> dan bayarkan kepada kurir saat barang sampai.
    <?php endif; ?>
</div>


    <a href="dashboard.php" class="btn-back">← Kembali ke Dashboard</a>
        <div style="text-align: center; margin-top: 30px;">
        <button onclick="window.print()" style="background-color: #3b5bdb; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;">
            Cetak Bukti Transaksi
        </button>
    </div>

</div>

</body>
</html>