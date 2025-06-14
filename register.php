<?php
require_once "koneksi.php";

$error = ""; // Untuk menyimpan pesan error
$username = ""; // Untuk menyimpan input username

// Cek jika redirect setelah registrasi sukses
$success = isset($_GET['status']) && $_GET['status'] === 'success';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $check = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($check->num_rows > 0) {
        $error = "Akun dengan username tersebut sudah terdaftar. Silakan <a href='login.php'>login di sini</a>.";
    } else {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            // Redirect agar tidak insert ulang saat refresh
            header('Location: register.php?status=success');
            exit();
        } else {
            $error = "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-bottom: 10px;
            color: #333;
            text-align: center;
        }

        .error-message {
            background-color: #fdecea;
            color: #b71c1c;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: center;
        }

        form label {
            display: block;
            margin-top: 10px;
            font-size: 14px;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #005e3f;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .register-link {
            margin-top: 15px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Daftar Akun ApotekQiu</h2>
    <p style="text-align: center;">Silakan isi data untuk membuat akun baru</p>

    <?php if (!empty($error)): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>

    <form action="register.php" method="post">
        <label for="username">Nama Pengguna</label>
        <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" required>

        <label for="password">Password</label>
        <input type="password" name="password" required>

        <button type="submit">Daftar</button>
    </form>

    <p class="register-link">Sudah punya akun? <a href="login.php">Login Sekarang</a></p>
</div>

<?php if ($success): ?>
    <script>
        alert("Registrasi berhasil! Silakan login.");
        window.location.href = "login.php";
    </script>
<?php endif; ?>
</body>
</html>
