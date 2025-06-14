<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("ID transaksi tidak ditemukan.");
}

$id = (int)$_GET['id'];
$username = $_SESSION['username'];

// Ambil data transaksi
$stmt = $conn->prepare("SELECT * FROM transaksi WHERE id = ? AND username = ?");
$stmt->bind_param("is", $id, $username);
$stmt->execute();
$result = $stmt->get_result();
$transaksi = $result->fetch_assoc();

if (!$transaksi) {
    die("Transaksi tidak ditemukan atau bukan milik Anda.");
}

// Ambil produk dari detail_transaksi
$stmt_detail = $conn->prepare("SELECT nama_produk, jumlah FROM detail_transaksi WHERE id_transaksi = ?");
$stmt_detail->bind_param("i", $id);
$stmt_detail->execute();
$result_detail = $stmt_detail->get_result();
$produk_list = [];
while ($row = $result_detail->fetch_assoc()) {
    $produk_list[] = htmlspecialchars($row['nama_produk']) . " (x" . $row['jumlah'] . ")";
}
$stmt_detail->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Pembayaran</title>
    <style>
        body { font-family: sans-serif; background: #f5f5f5; padding: 30px; }
        .box {
            background: white;
            padding: 25px;
            max-width: 600px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .btn {
            padding: 10px 20px;
            background: #00a29c;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
            cursor: pointer;
        }
        img.bukti {
            max-width: 150px;
            max-height: 150px;
            margin-top: 15px;
        }
        @media print {
            .btn { display: none; }
        }
    </style>
</head>
<body>
    <div class="box" id="cetakArea">
        <h2>Status Pembayaran</h2>

        <p><strong>Username:</strong> <?= htmlspecialchars($transaksi['username']) ?></p>
        <p><strong>Produk Dibeli:</strong><br>
            <?php foreach ($produk_list as $produk): ?>
                <?= $produk ?><br>
            <?php endforeach; ?>
        </p>

        <p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($transaksi['metode_pembayaran']) ?></p>
        <p><strong>Cara Pengambilan:</strong> <?= htmlspecialchars($transaksi['cara_pengambilan']) ?: '-' ?></p>
         <?php if ($transaksi['cara_pengambilan'] === 'Delivery'): ?>
            <p><strong>Alamat Pengiriman:</strong><br><?= nl2br(htmlspecialchars($transaksi['alamat'])) ?></p>
        <?php endif; ?>
        <p><strong>Status:</strong> <?= htmlspecialchars($transaksi['status']) ?></p>
        

        <p><strong>Tanggal Transaksi:</strong> <?= date('d-m-Y H:i', strtotime($transaksi['tanggal'])) ?></p>

        <?php if (!empty($transaksi['tanggal_acc'])): ?>
            <p><strong>Tanggal Disetujui:</strong> <?= date('d-m-Y H:i', strtotime($transaksi['tanggal_acc'])) ?></p>
        <?php endif; ?>

       

        <?php if (!empty($transaksi['gambar_bukti'])): ?>
            <p><strong>Bukti Transfer:</strong></p>
            <img src="uploads/<?= htmlspecialchars($transaksi['gambar_bukti']) ?>" class="bukti" alt="Bukti Transfer">
        <?php endif; ?>

        <hr>

        <?php if (in_array($transaksi['status'], ['Menunggu Persetujuan Admin', 'Bukti Dikirim'])): ?>
            <p>Silakan tunggu konfirmasi dari admin.</p>

        <?php elseif ($transaksi['status'] === 'Bukti Ditolak'): ?>
            <p style="color:red; font-weight:bold;">Bukti transfer Anda ditolak. Silakan upload ulang bukti transfer.</p>
            <a href="upload_bukti.php?id=<?= $transaksi['id'] ?>" class="btn">Upload Ulang Bukti</a>
            <a href="dashboard.php" class="btn">Kembali ke Dashboard</a>
            

        <?php elseif ($transaksi['status'] === 'Pembayaran Diterima'): ?>
            <p style="color:green; font-weight:bold;">Pembayaran Anda telah diterima. Terima kasih!</p>
            <button class="btn" onclick="window.print()">Cetak Bukti</button>
            <a href="dashboard.php" class="btn">Kembali ke Dashboard</a>

        <?php elseif ($transaksi['metode_pembayaran'] === 'Cash' && $transaksi['status'] === 'Ambil di Apotek'): ?>
            <p>Silakan lakukan pembayaran tunai saat pengambilan barang.</p>
            <button class="btn" onclick="window.print()">Cetak Bukti</button>
            <a href="dashboard.php" class="btn">Kembali ke Dashboard</a>

        <?php else: ?>
            <a href="dashboard.php" class="btn">Kembali ke Dashboard</a>
        <?php endif; ?>
    </div>
</body>
</html>