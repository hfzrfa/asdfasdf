<?php
include 'koneksi.php';

$sql = "SELECT id, status FROM transaksi ORDER BY tanggal DESC LIMIT 20";
$result = $conn->query($sql);

echo "<h2>Data Status Transaksi Terbaru</h2>";
echo "<table border='1' cellpadding='8'>";
echo "<tr><th>ID</th><th>Status</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row['id'] . "</td><td>" . htmlspecialchars($row['status']) . "</td></tr>";
}

echo "</table>";
?>
