<?php
session_start();
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - ApotekQiu</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: white;
            color: #222;
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

    <div class="banner-slider" id="bannerSlider">
        <img class="banner-img" src="img/slide1.png" alt="Banner 1">
        <img class="banner-img" src="img/slide2.png" alt="Banner 2">
        <img class="banner-img" src="img/slide3.png" alt="Banner 3">
        <img class="banner-img" src="img/slide4.png" alt="Banner 4">
        <div class="dots" id="dotsContainer"></div>
    </div>

    <section class="kategori-section">
        <div class="kategori-list">
            <div class="kategori-item" data-filter='obat'>
                <a href="dashboard.php" data>
                    <img src="img/[category]-medicine-86.jpg" alt="Obat">
                </a>
                <p>Obat</p>
            </div>
            <div class="kategori-item">
                <a href="dashboard.php">
                    <img src="img/[category]-nutrition-64.jpg" alt="Nutrisi">
                </a>
                <p>Nutrisi</p>
            </div>
            <div class="kategori-item" data-filter='herbal'>
                <a href="dashboard.php">
                    <img src="img/[category]-herbal-9.jpg" alt="Herbal">
                </a>
                <p>Herbal</p>
            </div>
            <div class="kategori-item" data-filter='suplement'>
                <a href="dashboard.php">
                    <img src="img/[category]-suplement-40.jpg" alt="Suplemen">
                </a>
                <p>Suplemen</p>
            </div>
        </div>
        <div class="kategori-ilustrasi">
            <img src="img/design1.png" alt="Ilustrasi Apotek">
        </div>
    </section>

    <footer style="background-color:#00774D; color:white; text-align:center; padding:20px 10px; font-size:14px;">
        &copy; 2025 ApotekQiu.
    </footer>

    <script>
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
    </script>

</body>

</html>