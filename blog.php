<?php
session_start();
include("navbar.php");
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
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    margin-bottom: 0;
  }
</style>

<body>

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