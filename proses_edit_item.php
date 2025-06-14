<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = (int) $_POST['index'];
    $jumlah = (int) $_POST['jumlah'];

    if (isset($_SESSION['keranjang'][$index]) && $jumlah > 0) {
        $_SESSION['keranjang'][$index]['jumlah'] = $jumlah;
    }
}

header("Location: keranjang.php");
exit;
