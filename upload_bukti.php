<?php
session_start();
include 'koneksi.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['id'])) {
    die("ID transaksi tidak ditemukan.");
}
$id = (int) $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] === 0) {
        $namaFile = $_FILES['bukti']['name'];
        $tmpName = $_FILES['bukti']['tmp_name'];
        $ext = pathinfo($namaFile, PATHINFO_EXTENSION);
        $namaBaru = 'bukti_' . time() . '.' . $ext;

        $folderTujuan = 'uploads/';
        if (!is_dir($folderTujuan)) {
            mkdir($folderTujuan, 0777, true);
        }

        if (move_uploaded_file($tmpName, $folderTujuan . $namaBaru)) {
            $stmt = $conn->prepare("UPDATE transaksi SET gambar_bukti = ?, status = 'Menunggu Persetujuan Admin' WHERE id = ?");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("si", $namaBaru, $id);

            if ($stmt->execute()) {
                echo "<script>alert('✅ Bukti berhasil diupload! Menunggu konfirmasi admin.'); window.location.href='status_pembayaran.php?id=$id';</script>";
                exit;
            } else {
                die("Execute failed: " . $stmt->error);
            }
        } else {
            die("Upload gagal.");
        }
    } else {
        die("Bukti tidak valid.");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload Bukti Transfer</title>
    <style>
        body { font-family: sans-serif; background: #f5f5f5; padding: 30px; }
        .form-box {
            background: white;
            padding: 25px;
            max-width: 400px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .btn {
            padding: 10px 20px;
            background: #00a29c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="file"] { margin-bottom: 15px; }
    </style>
</head>
<body>
<div class="form-box">
    <h2>Upload Bukti Transfer</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="bukti" required><br>
        <button class="btn" type="submit">Upload</button>
    </form>
</div>
</body>
</html>