<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar - ApotekQiu</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: white;
            color: #222;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: white;
        }

        .logo img {
            height: 50px;
        }

        .nav-center {
            background-color: #00774D;
            border-radius: 40px;
            padding: 10px 20px;
            display: flex;
            gap: 25px;
        }

        .nav-center a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 25px;
        }

        .nav-center a.active {
            background-color: white;
            color: black;
        }

        .nav-center a:hover {
            background-color: #005e3f;
            color: white;
        }

        .nav-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 10px 30px;
        }

        .nav-right a {
            margin-left: 15px;
            font-weight: bold;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 30px;
            transition: 0.3s;
            color: #333;
        }

        .nav-right .login-btn,
        .nav-right .logout-btn {
            margin-left: 15px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 30px;
            transition: 0.3s;
            color: white;
            background-color: #00774d;
        }

        .nav-right .login-btn:hover {
            background-color: #005e3f;
        }

        .nav-right .logout-btn {
            background-color: #00774d;
        }

        .nav-right .logout-btn:hover {
            background-color: #00867f;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="logo">
            <img src="logo.png" alt="ApotekQiu Logo">
        </div>
        <div class="nav-center">
            <a href="beranda.php" class="active">Beranda</a>
            <a href="dashboard.php">Produk</a>
            <a href="artikel.php">Artikel</a>
            <a href="blog.php">Tentang</a>
        </div>

        <div class="nav-right">
            <?php if (isset($_SESSION['username'])): ?>
                <span>Hai, <?= htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="logout-btn">Keluar</a>
            <?php else: ?>
                <span>Selamat Datang!</span>
                <a href="login.php" class="login-btn">Masuk</a>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>
