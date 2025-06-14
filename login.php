<?php
require_once "koneksi.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_assoc($result);

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header("Location: dashboard.php");
    exit();
  } else {
    $error_message = "Invalid username or password.";
  }
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Akun</title>
  <style>
    body {
      margin: 10;
      font-family: 'Segoe UI', sans-serif;
      /* background: linear-gradient(to bottom, #f0f0f1 0%, #fdfeff 100%); */
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      width: 100%;
      max-width: 400px;
      background: #fff;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .container-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .welcome-text {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #000;
    }

    h2 {
      margin-bottom: 5px;
      color: #333;
    }

    p {
      color: #666;
      font-size: 14px;
    }

    .tabs {
      margin: 15px 0;
    }

    .tabs button {
      padding: 10px 20px;
      border: none;
      background: #eee;
      cursor: pointer;
      border-radius: 5px 5px 0 0;
      margin-right: 5px;
    }

    .tabs button.active {
      background: #f0f3f6;
      color: #fff;
    }

    form {
      text-align: left;
    }

    label {
      display: block;
      margin-top: 15px;
      font-size: 14px;
      color: #444;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .remember {
      margin: 10px 0;
      font-size: 14px;
    }

    button[type="submit"] {
      width: 100%;
      padding: 12px;
      background: #005e3f;
      color: white;
      border: none;
      margin-top: 10px;
      border-radius: 5px;
      font-size: 16px;
    }

    .register-link {
      margin-top: 15px;
      text-align: center;
      font-size: 14px;
    }

    select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
  </style>
</head>

<body>
  <div class="container-wrapper">
    <h1 class="welcome-text">Selamat datang di ApotekQiu</h1>
    <div class="container">
      <div class="login-box">
        <h2>Masuk Akun</h2>
        <p>Silahkan Masuk! Untuk belanja</p>
        <div class="tabs">

        </div>
        <form action="login.php" method="post">
          <label for="nik">Nama pengguna</label>
          <input type="text" name="username" required />

          <label for="password">Password</label>
          <input type="password" name="password" required />

          <button type="submit">Masuk</button>
          <p class="register-link">Belum punya akun? <a href="register.php">Daftar Sekarang</a></p>
        </form>
      </div>
    </div>
  </div>
</body>

</html>