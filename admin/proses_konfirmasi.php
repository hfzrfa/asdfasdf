<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

$id = (int)($_GET['id'] ?? 0);
$aksi = $_GET['aksi'] ?? '';

if ($id && in_array($aksi, ['setujui', 'tolak'])) {
    if ($aksi === 'setujui') {
        $status = 'Pembayaran Diterima';
    } else {
        $status = 'Bukti Ditolak';
    }

    $stmt = $conn->prepare("UPDATE transaksi SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    header("Location: admin_transaksi.php");
    exit;
} else {
    echo "Aksi tidak valid.";
}
?>
