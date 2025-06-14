<?php
session_start();

$index = isset($_GET['index']) ? (int)$_GET['index'] : -1;

if (!isset($_SESSION['keranjang'][$index])) {
    header("Location: keranjang.php");
    exit;
}

$item = $_SESSION['keranjang'][$index];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }
        .form-container {
            max-width: 400px;
            margin: auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="number"] {
            width: 100%;
            padding: 8px;
        }
        button {
            margin-top: 15px;
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h3>Edit Jumlah Produk</h3>
    <form action="proses_edit_item.php" method="post">
        <p><strong><?= htmlspecialchars($item['nama_produk']) ?></strong></p>
        <input type="hidden" name="index" value="<?= $index ?>">
        <label for="jumlah">Jumlah:</label>
        <input type="number" id="jumlah" name="jumlah" value="<?= $item['jumlah'] ?>" min="1" required>
        <button type="submit">Simpan Perubahan</button>
    </form>
</div>

</body>
</html>
