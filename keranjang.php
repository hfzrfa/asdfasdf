<?php
session_start();
$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 15px;
            border-radius: 8px;
        }

        .item-info {
            flex: 1;
        }

        .item-info h4 {
            margin: 0;
        }

        .item-info p {
            margin: 5px 0;
        }

        .item-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }


        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .total {
            text-align: right;
            font-size: 18px;
            margin-top: 20px;
            font-weight: bold;
        }

        .checkout-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            float: right;
            text-decoration: none;
            border-radius: 5px;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #777;
        }

        .clearfix {
            clear: both;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Keranjang Belanja</h2>

    <?php if (empty($keranjang)): ?>
        <div class="empty">
            <p>Keranjang Anda kosong.</p>
            <a href="dashboard.php" class="checkout-btn" style="background:#007bff;">Kembali Belanja</a>
        </div>
    <?php else: ?>
        <?php
        $total_semua = 0;
        foreach ($keranjang as $index => $item):
            $total = $item['harga'] * $item['jumlah'];
            $total_semua += $total;
        ?>
            <div class="cart-item">
                <img src="<?= htmlspecialchars($item['gambar']) ?>" alt="Produk">
                <div class="item-info">
                    <h4><?= htmlspecialchars($item['nama_produk']) ?></h4>
                    <p>Harga: Rp<?= number_format($item['harga'], 0, ',', '.') ?></p>
                    <p>Jumlah: <?= $item['jumlah'] ?></p>
                    <p>Total: Rp<?= number_format($total, 0, ',', '.') ?></p>
                </div>
                <div class="item-actions">
                    <form action="edit_item.php" method="get" style="display:inline;">
                        <input type="hidden" name="index" value="<?= $index ?>">
                        <button type="submit" class="btn-delete" style="background-color:#ffc107;">Edit</button>
                    </form>
                    <form action="hapus_item.php" method="post">
                        <input type="hidden" name="index" value="<?= $index ?>">
                        <button type="submit" class="btn-delete">Hapus</button>
                    </form>
                    <br>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="total">
            Total Belanja: Rp<?= number_format($total_semua, 0, ',', '.') ?>
        </div>
        <br>
        <a href="checkout.php" class="checkout-btn">Checkout</a>

        <div class="clearfix"></div>
    <?php endif; ?>
</div>

</body>
</html>
