<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: admin_dashboard.php");
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM produk WHERE id = $id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if (!$product) {
    header("Location: admin_dashboard.php");
    exit;
}

if (isset($_POST['submit'])) {
    $nama_produk = $_POST['nama_produk'];
    $gambar = $_POST['gambar'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $komposisi = $_POST['komposisi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $stmt = $conn->prepare("UPDATE produk SET nama_produk=?, gambar=?, kategori=?, deskripsi=?, komposisi=?, harga=?, stok=? WHERE id=?");
    $stmt->bind_param("sssssdii", $nama_produk, $gambar, $kategori, $deskripsi, $komposisi, $harga, $stok, $id);


    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Gagal memperbarui produk!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Edit Produk</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
        .container {
            background: white;
            padding: 30px 40px;
            margin: 40px 0;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #555;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1.5px solid #ddd;
            font-size: 15px;
            transition: border-color 0.3s ease;
            resize: vertical;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
        }
        button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            font-size: 17px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background: #0056b3;
        }
        .error {
            margin-top: 15px;
            color: #d93025;
            font-weight: 600;
            text-align: center;
        }
        .back-link {
            display: block;
            margin-top: 30px;
            text-align: center;
            color: #007bff;
            font-weight: 600;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Produk</h2>

    <?php if(isset($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" id="nama_produk" name="nama_produk" required value="<?= htmlspecialchars($product['nama_produk']) ?>">

        <label for="gambar">Gambar (path):</label>
        <input type="text" id="gambar" name="gambar" placeholder="contoh: img/produk1.png" required value="<?= htmlspecialchars($product['gambar']) ?>">

        <label for="kategori">Kategori:</label>
        <input type="text" id="kategori" name="kategori" required value="<?= htmlspecialchars($product['kategori']) ?>">

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" rows="4"><?= htmlspecialchars($product['deskripsi']) ?></textarea>

        <label for="komposisi">Komposisi:</label>
        <textarea id="komposisi" name="komposisi" rows="3"><?= htmlspecialchars($product['komposisi']) ?></textarea>

        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" step="0.01" required value="<?= htmlspecialchars($product['harga']) ?>">

        <label for="stok">Stok:</label>
        <input type="number" id="stok" name="stok" required value="<?= htmlspecialchars($product['stok']) ?>">

        <button type="submit" name="submit">Simpan Perubahan</button>
    </form>

    <a class="back-link" href="admin_dashboard.php">← Kembali ke Dashboard</a>
</div>

</body>
</html>
