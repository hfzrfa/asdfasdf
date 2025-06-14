<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    die("Error: User belum login.");
}
$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $produkJson = $_POST['produk'] ?? '';
    $total_semua = (int)($_POST['total_semua'] ?? 0);
    $metode = $_POST['metode'] ?? '';
    $cara_pengambilan = $_POST['cara_pengambilan'] ?? '';
    $alamat = $_POST['alamat'] ?? '';

    if (!$produkJson || !$total_semua || !$metode || !$cara_pengambilan) {
        die("Data pembayaran tidak lengkap.");
    }

    $produk = json_decode($produkJson, true);
    if (!is_array($produk)) {
        die("Data produk tidak valid.");
    }

    // Tentukan status pembayaran
    if ($metode === 'Transfer') {
        $status = 'Menunggu Bukti Transfer';
    } elseif ($metode === 'Cash') {
        $status = 'Menunggu Pembayaran Cash';
    } else {
        $status = 'Menunggu Pembayaran';
    }

    // Simpan transaksi utama
    $sql = "INSERT INTO transaksi (username, total_harga, metode_pembayaran, status, cara_pengambilan, alamat, tanggal)
            VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sissss", $username, $total_semua, $metode, $status, $cara_pengambilan, $alamat);
    if (!mysqli_stmt_execute($stmt)) {
        die("Gagal simpan transaksi: " . mysqli_stmt_error($stmt));
    }
    $id_transaksi = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);

    // Simpan detail tiap produk
    $sql_detail = "INSERT INTO detail_transaksi (id_transaksi, nama_produk, harga, jumlah, total) VALUES (?, ?, ?, ?, ?)";
    $stmt_detail = mysqli_prepare($conn, $sql_detail);
    if (!$stmt_detail) {
        die("Gagal prepare detail: " . mysqli_error($conn));
    }

    foreach ($produk as $item) {
        $nama_produk = $item['nama_produk'];
        $harga = (int)$item['harga'];
        $jumlah = (int)$item['jumlah'];
        $total = (int)$item['total'];

        mysqli_stmt_bind_param($stmt_detail, "isiii", $id_transaksi, $nama_produk, $harga, $jumlah, $total);
        mysqli_stmt_execute($stmt_detail);

    }
    mysqli_stmt_close($stmt_detail);

    unset($_SESSION['keranjang']);

    if (strtolower($metode) === 'transfer') {
        header("Location: konfirmasi_transfer.php?id=$id_transaksi");
    } else {
        header("Location: konfirmasi_cash.php?id=$id_transaksi");
    }
    exit;

} else {
    header("Location: checkout.php");
    exit;
}