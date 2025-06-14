<?php
session_start();

if (!isset($_POST['nama_produk']) || !isset($_POST['harga']) || !isset($_POST['gambar']) || !isset($_POST['jumlah'])) {
    http_response_code(400);
    echo "Data tidak lengkap.";
    exit;
}

$produk = [
    'nama_produk' => $_POST['nama_produk'],
    'harga' => (int)$_POST['harga'],
    'gambar' => $_POST['gambar'],
    'jumlah' => (int)$_POST['jumlah']
];

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Cek apakah produk sudah ada di keranjang
$found = false;
foreach ($_SESSION['keranjang'] as &$item) {
    if ($item['nama_produk'] === $produk['nama_produk']) {
        $item['jumlah'] += $produk['jumlah'];
        $found = true;
        break;
    }
}

if (!$found) {
    $_SESSION['keranjang'][] = $produk;
}

echo "Berhasil ditambahkan ke keranjang.";
