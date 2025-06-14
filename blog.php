<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tentang Kami</title>
</head>

<style>
  body {
    font-family: "Segoe UI", sans-serif;
    margin: 0;
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
    background-color: #00774d;
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
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 30px;
    transition: 0.3s;
    color: #333;
  }

  .nav-right .login-btn,
  .nav-right .logout-btn {
    color: white;
    padding: 10px 20px;
    border-radius: 30px;
    text-decoration: none;
  }

  .nav-right .logout-btn {
    background-color: #00774d;
  }

  .nav-right .login-btn {
    background-color: #00774d;
  }

  .nav-right .login-btn:hover {
    background-color: #005e3f;
  }



  h1 {
    color: #333;
  }

  p {
    color: #555;
    line-height: 1.6;
  }

  .body {
    font-size: 22px;
  }

  section {
    padding: 0 5vw;
  }

  .container {
    display: flex;
    justify-content: space-between;
    border: #333 1px solid;
    border-radius: 8px;
  }

  .left,
  .right {
    width: 48%;
    background-color: #fff;
    padding: 32px;
    border-radius: 8px;
  }

  .left h1,
  .right h1 {
    color: black;
  }

  form {
    display: flex;
    flex-direction: column;
  }

  input,
  textarea {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
  }

  button {
    padding: 10px;
    background-color: black;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  button:hover {
    background-color: #555;
  }

  footer {
    text-align: center;
    padding: 20px;
    background-color: #00774d;
    color: white;
    margin-top: 80px;
  }
</style>

<body>

  <!-- Navbar Start -->
  <nav class="navbar">
    <div class="logo">
      <img src="logo.png" alt="ApotekQiu Logo" />
    </div>
    <div class="nav-center">
      <a href="beranda.php">Beranda</a>
      <a href="dashboard.php">Produk</a>
      <a href="artikel.php">Artikel</a>
      <a href="blog.php" class="active">Tentang</a>
    </div>
    <div class="nav-right">
      <?php if (isset($_SESSION['username'])): ?>
        <span>Hai, <?= htmlspecialchars($_SESSION['username']); ?></span>
        <a href="logout.php" class="logout-btn">Keluar</a>
      <?php else: ?>
        <span>Selamat Datang!</span>
        <a href="login.php" class="login-btn">Masuk</a>
      <?php endif; ?>
  </nav>
  <!-- Navbar End -->

  <section>
    <h1>Tentang ApotekQiu</h1>
    <p class="body">
      Selamat datang di ApotekQiu, mitra terpercaya Anda dalam kesehatan dan
      kesejahteraan keluarga. Sejak didirikan pada tahun 2025, kami
      berkomitmen untuk menyediakan produk farmasi berkualitas tinggi, layanan
      konsultasi kesehatan, dan edukasi medis kepada masyarakat.
    </p>
    <br />
    <p class="body">
      Kami bukan sekadar apotek biasa—kami adalah pusat layanan kesehatan yang
      siap membantu Anda dengan solusi obat, suplemen, dan perawatan medis
      yang tepat.
    </p>

    <div class="container">
      <div class="left">
        <div class="div">
          <h1>Alamat</h1>
          <p>
            Titan Center 12th Floor Jalan Boulevard Bintaro Block B7/B1 No. 05
            Bintaro Jaya Sector 7 Tangerang Selatan 15424, Indonesia.
          </p>
        </div>


      </div>
      <div class="right">
        <div>
          <h1>Kontak</h1>
          <p>
            Whatsapp: 08174979622 <br />
            Hotline: 021-22213737 <br />
            Mail: cs@apotekqiu.com
          </p>
        </div>
      </div>
    </div>
  </section>
  <footer>@2025 ApotekQiu</footer>
</body>

</html>