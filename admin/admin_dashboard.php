<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM produk WHERE id = $id");
    header("Location: admin_dashboard.php");
    exit;
}

// Fetch all products
$sql = "SELECT * FROM produk ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: center;
        }

        img {
            width: 80px;
        }

        a.button {
            padding: 5px 10px;
            background-color: #00a29c;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        a.button:hover {
            background-color: #00867f;
        }
    </style>
</head>

<body>
    <h2>Dashboard Admin - Kelola Produk</h2>
    <a href="tambah_produk.php" class="button">Tambah Produk Baru</a>
    <a href="admin_transaksi.php" class="button">Lihat Riwayat Pembelian</a>
    <a href="logout.php" class="button" style="background-color:red;">Keluar</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Gambar</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Komposisi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($product = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= htmlspecialchars($product['nama_produk']) ?></td>
                    <td><img src="<?= htmlspecialchars($product['gambar']) ?>" alt="Gambar"></td>
                    <td><?= htmlspecialchars($product['kategori']) ?></td>
                    <td><?= htmlspecialchars($product['deskripsi']) ?></td>
                    <td><?= htmlspecialchars($product['komposisi']) ?></td>
                    <td>Rp <?= number_format($product['harga'], 0, ',', '.') ?></td>
                    <td><?= $product['stok'] ?></td>
                    <td>
                        <a href="edit_produk.php?id=<?= $product['id'] ?>" class="button">Edit</a>
                        <br>
                        <br>
                        <a href="admin_dashboard.php?delete=<?= $product['id'] ?>"
                            onclick="return confirm('Yakin ingin hapus produk ini?')" class="button"
                            style="background-color: red;">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>