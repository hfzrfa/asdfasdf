<?php
session_start();
require_once 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Artikel - ApotekQiu</title>
  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", sans-serif;
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
      font-weight: bold;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 30px;
      transition: 0.3s;
      color: #333;
    }

    .nav-right .login-btn {
      background-color: #00774d;
      color: white;
    }

    .nav-right .login-btn:hover {
      background-color: #005e3f;
    }

    footer {
      text-align: center;
      padding: 20px;
      background-color: #00774d;
      color: white;
      margin-top: 80px;
    }

    section {
      margin: 0vh 6vw;
    }

    .container-terpopuler {
      height: 500px;
      display: flex;
      flex-direction: row;
      gap: 20px;
      margin-bottom: 80px;
    }

    .left {
      width: 70%;
      height: calc(100% - 48px);
      background-image: url('img/artikel/1.jpeg');
      background-size: cover;
      background-position: center;
      border-radius: 16px;
      padding: 24px;
      position: relative;
    }

    .title {
      width: 100%;
      color: white;
      display: flex;
      font-size: 32px;
      align-items: end;
      margin: 0;
    }

    .right-bottom .title,
    .right-top .title {
      font-size: 16px;
    }

    .dark-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: calc(100% - 48px);
      height: calc(100% - 48px);
      background: linear-gradient(to top, rgba(0, 0, 0, 0.726), transparent);
      display: flex;
      align-items: end;
      justify-content: center;
      border-radius: 16px;
      padding: 24px;
    }

    .wrapper {
      display: flex;
      flex-direction: column;
      width: 30%;
      gap: 20px;
    }

    .right-top,
    .right-bottom {
      width: 100%;
      height: 50%;
      position: relative;
    }

    .right-top {
      background-image: url('img/artikel/2.jpg');
      background-size: cover;
      background-position: center;
      border-radius: 16px;
    }

    .right-bottom {
      background-image: url('img/artikel/3.jpeg');
      background-size: cover;
      background-position: center;
      border-radius: 16px;
    }

    .card {
      width: 32%;
      height: fit-content;
    }

    .card img {
      width: 100%;
      height: 300px;
      border-radius: 16px;
      object-fit: cover;
    }

    .card h3 {
      margin: 0;
      color: #017346;
    }

    .container-terbaru {
      width: 100%;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      flex-direction: row;
      gap: 20px;
      margin-top: 20px;
    }

    .h2 {
      margin-top: 20px;
      color: #017346;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    @media (max-width: 768px) {
      .article-section {
        grid-template-columns: 1fr;
      }

      h1 {
        font-size: 28px;
      }

      h2 {
        font-size: 22px;
      }

      .navbar {
        flex-direction: column;
        gap: 10px;
        padding: 20px 10px;
        margin: -20px -10px 30px -10px;
      }
    }
  </style>
</head>

<body>
  <!-- Navbar Start -->
  <nav class="navbar">
    <div class="logo">
      <img src="logo.png" alt="ApotekQiu Logo" />
    </div>
    <div class="nav-center">
      <a href="beranda.php">Beranda</a>
      <a href="dashboard.php">Produk</a>
      <a href="artikel.php" class="active">Artikel</a>
      <a href="blog.php">Tentang</a>
    </div>
    <div class="nav-right">
      <?php if (isset($_SESSION['username'])): ?>
        <span>Hai, <?= htmlspecialchars($_SESSION['username']); ?></span>
        <a href="logout.php" class="login-btn">Keluar</a>
      <?php else: ?>
        <span>Selamat Datang!</span>
        <a href="login.php" class="login-btn">Masuk</a>
      <?php endif; ?>
  </nav>
  <!-- Navbar End -->

  <section>

    <h1>Artikel</h1>

    <!-- Terpopuler Start -->

    <h2>Terpopuler</h2>
    <div class="container-terpopuler">
      <a class="box left"
        href="https://health.detik.com/berita-detikhealth/d-7931419/tanda-tanda-usus-besar-rusak-kerap-diabaikan-dan-dianggap-sepele"
        target="_blank">
        <div class="dark-overlay">
          <h1 class="title">Tanda-tanda Usus Besar 'Rusak', Kerap Diabaikan dan Dianggap Sepele</h1>
        </div>
      </a>

      <div class="wrapper">
        <a class="box right-top"
          href="https://health.detik.com/berita-detikhealth/d-7931908/tanda-ginjal-rusak-yang-bisa-muncul-di-kulit-hati-hati-jika-sering-gatal"
          target="_blank">
          <div class="dark-overlay">
            <h1 class="title">Tanda Ginjal Rusak yang Bisa Muncul di Kulit, Hati-hati Jika Sering Gatal</h1>
          </div>
        </a>
        <a class="box right-bottom"
          href="https://health.detik.com/berita-detikhealth/d-7932324/dokter-harvard-ungkap-rutin-minum-ini-selama-30-hari-bisa-bikin-awet-muda"
          target="_blank">
          <div class="dark-overlay">
            <h1 class="title">Dokter Harvard Ungkap Rutin Minum Ini Selama 30 Hari Bisa Bikin Awet Muda</h1>
          </div>
        </a>
      </div>
    </div>

    <!-- Terpopuler End -->

    <!-- Terbaru Start -->

    <h2>Terbaru</h2>

    <div class="container-terbaru">
      <a class="card"
        href="https://health.detik.com/berita-detikhealth/d-7931986/benarkah-kayu-manis-bermanfaat-untuk-kesehatan-ginjal-ini-penjelasannya"
        target="_blank">
        <img src="img/artikel/4.jpeg" alt="img" />
        <h3>Benarkah Kayu Manis Bermanfaat untuk Kesehatan Ginjal? Ini Penjelasannya</h3>
        <span>25 Mei 2025</span>
      </a>
      <a class="card"
        href="https://food.detik.com/info-sehat/d-7719860/kaya-vitamin-c-ini-3-manfaat-konsumsi-belimbing-buat-kesehatan"
        target="_blank">
        <img src="img/artikel/5.jpeg" alt="img" />
        <h3>Kaya Vitamin C, Ini 3 Manfaat Konsumsi Belimbing buat Kesehatan</h3>
        <span>25 Mei 2025</span>
      </a>
      <a class="card"
        href="https://health.detik.com/berita-detikhealth/d-7931204/ini-varian-covid-yang-merebak-di-thailand-menyebar-7-kali-lebih-cepat-daripada-flu"
        target="_blank">
        <img src="img/artikel/6.jpeg" alt="img" />
        <h3>Ini Varian COVID yang Merebak di Thailand, Menyebar 7 Kali Lebih Cepat Daripada Flu</h3>
        <span>25 Mei 2025</span>
      </a>
      <a class="card"
        href="https://health.detik.com/diet/d-7918021/pejuang-body-goals-ini-cara-efektif-menurunkan-bb-tanpa-perlu-kelaparan-seharian"
        target="_blank">
        <img src="img/artikel/7.jpeg" alt="img" />
        <h3>Pejuang Body Goals, Ini Cara Efektif Menurunkan BB Tanpa Perlu Kelaparan Seharian</h3>
        <span>25 Mei 2025</span>
      </a>
      <a class="card"
        href="https://health.detik.com/berita-detikhealth/d-7932048/ahli-gizi-ungkap-3-makanan-yang-sebaiknya-tak-dikonsumsi-sebelum-tidur"
        target="_blank">
        <img src="img/artikel/8.jpeg" alt="img" />
        <h3>Ahli Gizi Ungkap 3 Makanan yang Sebaiknya Tak Dikonsumsi Sebelum Tidur</h3>
        <span>25 Mei 2025</span>
      </a>
      <a class="card"
        href="https://health.detik.com/berita-detikhealth/d-7929380/8-manfaat-daun-sirih-cina-untuk-kesehatan-kulit-hingga-pencernaan"
        target="_blank">
        <img src="img/artikel/9.jpeg" alt="img" />
        <h3>8 Manfaat Daun Sirih Cina untuk Kesehatan Kulit hingga Pencernaan</h3>
        <span>25 Mei 2025</span>
      </a>
    </div>

  </section>


  <!-- Terbaru End -->

  <!-- Footer Start -->
  <footer>@2025 ApotekQiu</footer>
  <!-- Footer End -->
  </div>
</body>

</html>