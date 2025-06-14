<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

// Proses update status jika ada POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi'], $_POST['id'])) {
    $id = (int) $_POST['id'];
    $aksi = $_POST['aksi'];

    if ($aksi === 'setujui') {
        $status = 'Pembayaran Diterima';
    } elseif ($aksi === 'tolak') {
        $status = 'Bukti Ditolak';
    } else {
        $status = null;
    }

    if ($status !== null) {
        $stmt = $conn->prepare("UPDATE transaksi SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: admin_transaksi.php");
    exit;
}

// Ambil detail produk dari transaksi
$query_detail = "SELECT nama_produk, jumlah FROM detail_transaksi WHERE id_transaksi = ?";
$stmt_detail = mysqli_prepare($conn, $query_detail);
mysqli_stmt_bind_param($stmt_detail, "i", $id_transaksi);
mysqli_stmt_execute($stmt_detail);
$result_detail = mysqli_stmt_get_result($stmt_detail);

while ($row = mysqli_fetch_assoc($result_detail)) {
    $nama_produk = $row['nama_produk'];
    $jumlah = $row['jumlah'];

    // Kurangi stok produk
    $update_stok = "UPDATE produk SET stok = stok - ? WHERE nama_produk = ?";
    $stmt_update = mysqli_prepare($conn, $update_stok);
    mysqli_stmt_bind_param($stmt_update, "is", $jumlah, $nama_produk);
    mysqli_stmt_execute($stmt_update);
    mysqli_stmt_close($stmt_update);
}

// Hapus semua transaksi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'hapus_semua') {
    $conn->query("DELETE FROM transaksi");
    header("Location: admin_transaksi.php");
    exit;
}

// Ambil semua transaksi
$sql = "SELECT * FROM transaksi ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi - Admin</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { margin-bottom: 20px; }
        a.button, button.button {
            padding: 5px 10px;
            background-color: #00a29c;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            margin: 2px;
        }
        button.button.red { background-color: #d9534f; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ccc; text-align: center; vertical-align: top; }
        img.bukti { max-width: 100px; max-height: 100px; }
        form.inline { display: inline; }
        small { display: block; margin-top: 4px; color: #666; }
    </style>
</head>
<body>

<h2>Riwayat Transaksi Pembeli</h2>
<a href="admin_dashboard.php" class="button">Kembali ke Dashboard</a>
<br><br>

<form method="POST" onsubmit="return confirm('Yakin ingin menghapus SEMUA data transaksi? Tindakan ini tidak bisa dibatalkan!');">
    <input type="hidden" name="aksi" value="hapus_semua">
    <button type="submit" class="button red">Hapus Semua Transaksi</button>
</form>

<br><br>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Produk</th>
            <th>Total</th>
            <th>Metode</th>
            <th>Cara Pengambilan</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Bukti Transfer</th>
            <th>Aksi</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>

            <!-- Produk -->
            <td style="text-align: left;">
                <?php 
                $id_transaksi = $row['id'];
                $sql_detail = "SELECT nama_produk, jumlah FROM detail_transaksi WHERE id_transaksi = ?";
                $stmt_detail = $conn->prepare($sql_detail);
                $stmt_detail->bind_param("i", $id_transaksi);
                $stmt_detail->execute();
                $result_detail = $stmt_detail->get_result();
                while ($detail = $result_detail->fetch_assoc()) {
                    echo htmlspecialchars($detail['nama_produk']) . " (x" . $detail['jumlah'] . ")<br>";
                }
                $stmt_detail->close();
                ?>
            </td>

            <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
            <td><?= htmlspecialchars($row['metode_pembayaran']) ?></td>
            <td><?= htmlspecialchars($row['cara_pengambilan']) ?: '-' ?></td>
            <td><?= htmlspecialchars($row['alamat']) ?: '-' ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>

            <!-- Bukti Transfer -->
            <td>
                <?php if (!empty($row['gambar_bukti'])): ?>
                    <a href="../uploads/<?= htmlspecialchars($row['gambar_bukti']) ?>" target="_blank">
                        <img src="../uploads/<?= htmlspecialchars($row['gambar_bukti']) ?>" class="bukti" alt="Bukti Transfer">
                    </a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>

            <!-- Aksi -->
            <<!-- Aksi -->
<td>
    <?php
        $status = strtolower(trim($row['status']));
        $metode = strtolower(trim($row['metode_pembayaran']));
        $pengambilan = strtolower(trim($row['cara_pengambilan']));
        $tampilkanAksi = false;

        if (
            stripos($status, 'bukti dikirim') !== false ||
            stripos($status, 'menunggu persetujuan') !== false ||
            ($metode === 'cash' && stripos($status, 'menunggu pembayaran') !== false)
        ) {
            $tampilkanAksi = true;
        }
    ?>

    <?php if ($tampilkanAksi): ?>
        <form method="POST" class="inline" onsubmit="return confirm('Setujui bukti pembayaran ini?');">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="hidden" name="aksi" value="setujui">
            <button type="submit" class="button">Setujui</button>
        </form>
        <form method="POST" class="inline" onsubmit="return confirm('Tolak bukti pembayaran ini?');">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="hidden" name="aksi" value="tolak">
            <button type="submit" class="button red">Tolak</button>
        </form>
        <?php if ($metode === 'cash'): ?>
            
        <?php endif; ?>
    <?php else: ?>
        -
    <?php endif; ?>
</td>


            <td><?= $row['tanggal'] ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>