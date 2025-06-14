<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index - ApotekQiu</title>
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
            background-color: #00774D;
            color: white;
        }

        .nav-right .login-btn:hover {
            background-color: #005e3f;
        }

        .nav-right .signup-btn {
            background-color: #fff;
            color: #00774D;
            border: 2px solid #00794F;
        }

        .nav-right .signup-btn:hover {
            background-color: #00774D;
        }

        .banner-slider {
            position: relative;
        }

        .banner-img {
            display: none;
            width: 100%;
            height: auto;
        }

        .banner-img.active {
            display: block;
        }

        .dots {
            position: absolute;
            bottom: 15px;
            width: 100%;
            text-align: center;
            z-index: 2;
        }

        .dot {
            height: 12px;
            width: 12px;
            margin: 0 5px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
        }

        .dot.active {
            background-color: #333;
        }

        .kategori-section {
            padding: 60px 10%;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 60px;
        }

        .kategori-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .kategori-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #ccc;
            padding: 25px;
            border-radius: 15px;
            width: 140px;
            transition: 0.3s ease;
        }

        .kategori-item:hover {
            transform: scale(1.05);
            border-color: #00774D;
        }

        .kategori-item img {
            height: 60px;
            margin-bottom: 10px;
        }

        .kategori-ilustrasi img {
            height: 280px;
            max-width: 100%;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #00774D;
            color: white;
        }

        @media screen and (max-width: 768px) {
            .kategori-section {
                flex-direction: column;
                align-items: center;
            }

            .kategori-list {
                grid-template-columns: repeat(2, 1fr);
            }

            .kategori-ilustrasi img {
                height: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <img src="Logo.png" alt="ApotekQiu Logo">
        </div>
        <div class="nav-center">
            <a href="index.php" class="active">Beranda</a>
            <a href="dashboard.php" id="produkLink">Produk</a>
            <a href="artikel.php">Artikel</a>
            <a href="blog.php">Blog</a>
        </div>
        <div class="nav-right">
            <a href="login.php" class="login-btn">Masuk</a>
            <a href="register.php" class="signup-btn">Daftar</a>
        </div>
    </div>

    <div class="banner-slider" id="bannerSlider">
        <img class="banner-img" src="img/slide1.png" alt="Banner 1">
        <img class="banner-img" src="img/slide2.png" alt="Banner 2">
        <img class="banner-img" src="img/slide3.png" alt="Banner 3">
        <img class="banner-img" src="img/slide4.png" alt="Banner 4">
        <div class="dots" id="dotsContainer"></div>
    </div>

    <section class="kategori-section">
        <div class="kategori-list">
            <div class="kategori-item">
                <img src="img/[category]-medicine-86.jpg" alt="Obat">
                <p>Obat</p>
            </div>
            <div class="kategori-item">
                <img src="img/[category]-nutrition-64.jpg" alt="Nutrisi">
                <p>Nutrisi</p>
            </div>
            <div class="kategori-item">
                <img src="img/[category]-herbal-9.jpg" alt="Herbal">
                <p>Herbal</p>
            </div>
            <div class="kategori-item">
                <img src="img/[category]-suplement-40.jpg" alt="Suplemen">
                <p>Suplemen</p>
            </div>
        </div>
        <div class="kategori-ilustrasi">
            <img src="img/design1.png" alt="Ilustrasi Apotek">
        </div>
    </section>

    <footer>
        ©2025 ApotekQiu
    </footer>

    <script>
        // Banner logic
        let bannerIndex = 0;
        const banners = document.querySelectorAll('.banner-img');
        const dotsContainer = document.getElementById('dotsContainer');
        let dots = [];

        function showBanner(n) {
            banners.forEach((b, i) => {
                b.style.display = i === n ? 'block' : 'none';
                dots[i].className = i === n ? 'dot active' : 'dot';
            });
        }

        function nextBanner() {
            bannerIndex = (bannerIndex + 1) % banners.length;
            showBanner(bannerIndex);
        }

        banners.forEach((_, i) => {
            const dot = document.createElement('span');
            dot.className = i === 0 ? 'dot active' : 'dot';
            dot.onclick = () => {
                bannerIndex = i;
                showBanner(bannerIndex);
            };
            dotsContainer.appendChild(dot);
            dots.push(dot);
        });

        showBanner(bannerIndex);
        setInterval(nextBanner, 4000);

        // Proteksi akses Produk
        document.getElementById('produkLink').addEventListener('click', function (e) {
            e.preventDefault();
            alert("Silakan login terlebih dahulu untuk mengakses produk.");
            window.location.href = "login.php";
        });
    </script>
</body>

</html>