<?php
require_once "koneksi.php";

$error = ""; // Untuk menyimpan pesan error
$username = ""; // Untuk menyimpan input username
$success = false; // Untuk notif sukses

// Cek jika redirect setelah registrasi sukses
if (isset($_GET['status']) && $_GET['status'] === 'success') {
    $success = true;
}

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            position: relative;
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
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #00472f;
        }

        .register-link {
            margin-top: 15px;
            font-size: 14px;
            text-align: center;
        }
        
        /* Success Popup Styling */
        .success-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.7);
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.2);
            text-align: center;
            width: 350px;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .success-popup.active {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
            visibility: visible;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: #66BB6A;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .success-icon i {
            font-size: 40px;
            color: white;
        }
        
        .success-title {
            color: #333;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .success-desc {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }
        
        .success-button {
            background-color: #005e3f;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 80%;
        }
        
        .success-button:hover {
            background-color: #00472f;
        }
        
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        @keyframes checkmark {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }
        
        .checkmark-animation {
            animation: checkmark 0.5s ease-in-out forwards;
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

<!-- Success Popup -->
<div class="overlay" id="overlay"></div>
<div class="success-popup" id="successPopup">
    <div class="success-icon">
        <i class="fas fa-check checkmark-animation"></i>
    </div>
    <div class="success-title">Registrasi Berhasil!</div>
    <div class="success-desc">Akun Anda telah berhasil dibuat. Silakan login untuk melanjutkan.</div>
    <button class="success-button" id="loginButton">Login Sekarang</button>
</div>

<?php if ($success): ?>
<script>
    // Show success popup with animation
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.getElementById('overlay');
        const successPopup = document.getElementById('successPopup');
        const loginButton = document.getElementById('loginButton');
        
        // Display popup with animation
        setTimeout(function() {
            overlay.classList.add('active');
            successPopup.classList.add('active');
        }, 300);
        
        // Button click handler
        loginButton.addEventListener('click', function() {
            window.location.href = "login.php";
        });
    });
</script>
<?php endif; ?>
</body>
</html>