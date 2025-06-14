<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username'])) {
    header("Location: proses_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard ApotekQiu</title>
    <style>
        body {
            background-color: #fff;
            font-family: "Segoe UI", sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: white;
        }

        .navbar a {
            color: white;
            text-decoration;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: black;
        }

        .nav-buttons a,
        .nav-buttons span {
            text-decoration: none;
            margin-left: 15px;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: bold;
            transition: 0.3s ease;
            color: white;
        }

        .login-btn {
            color: white;
            padding: 10px 20px;
            background-color: #f44336;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            margin-left: 15px;
            font-size: 16px;
            transition: 0.3s;
        }


        .banner {
            text-align: center;
        }

        .category-icons {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin: 20px 0;
        }

        .category-icons div {
            text-align: center;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
            max-width: 1300px;
            margin: auto;
        }

        .product-card {
            border: 1px solid #ccc;
            border-radius: 15px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            position: relative;
        }

        .product-card img {
            width: 100px;
            height: auto;
        }

        .product-card p {
            font-weight: bold;
            margin-top: 10px;
        }

        .filter-btn {
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .filter-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .filter-btn.active {
            border: 2px solid #007bff;
            background-color: #e0f0ff;
            border-radius: 10px;
        }

        .out-of-stock {
            position: absolute;
            top: 10px;
            left: 10px;
            background: red;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 12px;
            z-index: 10;
        }

        .banner-slider {
            position: relative;
        }

        .banner-img {
            display: none;
            width: 100%;
            height: auto;
            position: relative;
            z-index: 1;
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

        .nav-buttons a:hover {
            background-color: #005e3f;
        }

        .nav-buttons span {
            padding: 10px 0;
        }

        .nav-center {
            background-color: #00774D;
            border-radius: 40px;
            padding: 10px 20px;
            display: flex;
            gap: 20px;
        }

        .nav-center a {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            color: white;
            transition: background 0.3s ease;
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
            text-decoration: none;
            margin-left: 15px;
            font-weight: bold;
            color: #1e1e1e;
            padding: 10px 20px;
            border-radius: 30px;
            transition: 0.3s ease;
        }

        .login-btn,
        .logout-btn {
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;

        }

        .logout-btn {
            background-color: #00774d;
        }

        .logout-btn:hover {
            background-color: #00867f;
        }

        .login-btn {
            background-color: #00774d;
        }

        .login-btn:hover {
            background-color: #005e3f;
        }

        html,
        body {
            height: 100%;
        }

        .wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #00774d;
            color: white;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
                padding: 15px 20px;
            }

            .nav-center {
                flex-direction: column;
                width: 100%;
                gap: 10px;
                margin-top: 10px;
            }

            .nav-right {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
                margin-top: 10px;
            }

            .category-icons {
                flex-wrap: wrap;
                gap: 20px;
                justify-content: center;
            }

            .product-grid {
                grid-template-columns: 1fr;
                padding: 10px;
            }

            .product-card {
                width: 100%;
            }

            .banner-img {
                height: auto;
            }

            #searchInput {
                width: 90%;
                margin-bottom: 10px;
            }

            #searchBtn {
                width: 90%;
            }

            #productModal>div {
                width: 90%;
            }

            #confirmModal>div {
                width: 90%;
            }

            .wrapper {
                padding-bottom: 50px;
                /* agar tidak kepotong tombol modal */
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="content">
            <!-- Header -->
            <div class="navbar">
                <div class="logo">
                    <img src="logo.png" alt="ApotekQiu Logo" height="50"> <!-- Ganti dengan path logo -->
                </div>

                <div class="nav-center">
                    <a href="beranda.php">Beranda</a>
                    <a href="dashboard.php" class="active">Produk</a>
                    <a href="artikel.php">Artikel</a>
                    <a href="blog.php">Tentang</a>
                </div>

                <div style="display: flex; align-items: center; justify-content: flex-end; padding: 10px 30px;">


                    <?php if (isset($_SESSION['username'])): ?>
                        <a href="keranjang.php" style="margin-right: 20px;">
                            <img src="img/Keranjang.png" alt="Keranjang"
                                style="width: 30px; height: 30px; cursor: pointer; margin-left: 50px">
                        </a>
                        <a href="logout.php" class="logout-btn">Keluar</a>
                    <?php else: ?>
                        <span>Selamat Datang!</span>
                        <a href="login.php" class="login-btn">Masuk</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Banner slider -->
            <div class="banner-slider" id="bannerSlider">
                <img class="banner-img" src="img/slide1.png" alt="Banner 1">
                <img class="banner-img" src="img/slide2.png" alt="Banner 2">
                <img class="banner-img" src="img/slide3.png" alt="Banner 3">
                <img class="banner-img" src="img/slide4.png" alt="Banner 4">
                <div class="dots" id="dotsContainer"></div>
            </div>

            <!-- Kategori -->
            <div class="category-icons">
                <div class="filter-btn" data-filter="Obat">
                    <img src="img/[category]-medicine-86.jpg" width="56" height="56" alt="Obat">
                    <p>Obat</p>
                </div>
                <div class="filter-btn" data-filter="Herbal">
                    <img src="img/[category]-herbal-9.jpg" width="56" height="56" alt="Herbal">
                    <p>Herbal</p>
                </div>
                <div class="filter-btn" data-filter="Suplemen">
                    <img src="img/[category]-suplement-40.jpg" width="56" height="56" alt="Suplemen">
                    <p>Suplemen</p>
                </div>
                <div class="filter-btn" data-filter="Nutrisi">
                    <img src="img/[category]-nutrition-64.jpg" width="56" height="56" alt="Nutrisi">
                    <p>Nutrisi</p>
                </div>
            </div>

            <!-- tombol pencarian -->
            <div style="text-align:center; margin: 20px;">
                <input type="text" id="searchInput" onkeyup="searchProduct()" placeholder="Cari nama obat..."
                    style="padding: 10px; width: 300px; border-radius: 10px; border: 1px solid #ccc;">
                <button id="searchBtn"
                    style="padding: 10px 20px; border-radius: 10px; background-color: #00a29c; color: white; border: none;"
                    onclick="searchProduct()">Cari</button>
            </div>

            <!-- Grid Produk -->
            <div class="product-grid">
                <?php
                $sql = "SELECT * FROM produk ORDER BY id DESC";
                $result = $conn->query($sql);
                while ($product = $result->fetch_assoc()):
                    ?>
                    <div class="product-card" data-category="<?= htmlspecialchars($product['kategori']) ?>"
                        data-name="<?= htmlspecialchars($product['nama_produk']) ?>"
                        data-image="<?= htmlspecialchars($product['gambar']) ?>"
                        data-description="<?= htmlspecialchars($product['deskripsi']) ?>"
                        data-composition="<?= htmlspecialchars($product['komposisi']) ?>"
                        data-price="Rp <?= number_format($product['harga'], 0, ',', '.') ?>">

                        <img src="<?= htmlspecialchars($product['gambar']) ?>" alt="Produk">
                        <p><?= htmlspecialchars($product['nama_produk']) ?></p>
                        <p>Stok: <?= (int) $product['stok'] ?></p>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Modal Produk -->
            <div id="productModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
     background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:9999;">
                <div
                    style="background:#fff; padding:30px; border-radius:10px; width:400px; text-align:left; position:relative;">
                    <span onclick="closeModal()"
                        style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:20px;">&times;</span>
                    <form id="buyForm" method="POST" action="checkout.php">
                        <img id="modalImage" src="" style="width:120px; height:auto; display:block; margin:auto;">
                        <h3 id="modalTitle" style="text-align:center; margin:15px 0;"></h3>
                        <input type="hidden" name="nama_produk" id="formNama">
                        <input type="hidden" name="harga" id="formHarga">
                        <input type="hidden" name="gambar" id="formGambar">
                        <p><strong>Deskripsi:</strong> <span id="modalDescription"></span></p>
                        <p><strong>Komposisi:</strong> <span id="modalComposition"></span></p>
                        <p><strong>Harga:</strong> Rp <span id="modalPrice"></span></p>

                        <label>Jumlah:</label>
                        <input type="number" name="jumlah" id="formJumlah" min="1" value="1" required
                            style="width:100%; padding:8px; margin-bottom:15px;">

                        <button type="button" id="confirmButton"
                            style="width:100%; padding:10px; background:#00a29c; color:white; border:none; border-radius:5px;">
                            Beli
                        </button>
                        <br>
                        <br>
                        <div style="display: flex; gap: 10px;">
                            <button type="button" id="addToCartBtn"
                                style="width:100%; padding:10px; background:#007bff; color:white; border:none; border-radius:5px; margin-bottom:10px;">
                                Tambah ke Keranjang
                            </button>
                    </form>
                </div>
            </div>

            <!-- Konfirmasi -->
            <div id="confirmModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
     background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:10000;">
                <div style="background:white; padding:20px 30px; border-radius:10px; text-align:center;">
                    <p><strong>Apakah Anda yakin ingin melanjutkan ke pembayaran?</strong></p>
                    <button id="proceedBtn"
                        style="margin:10px; padding:8px 20px; background:green; color:white; border:none; border-radius:5px;">
                        Ya, lanjutkan
                    </button>
                    <button onclick="document.getElementById('confirmModal').style.display='none'"
                        style="margin:10px; padding:8px 20px; background:red; color:white; border:none; border-radius:5px;">
                        Batal
                    </button>
                </div>
            </div>

            <script>
                // Pencarian Produk
                function searchProduct() {
                    const input = document.getElementById('searchInput').value.toLowerCase();
                    const productCards = document.querySelectorAll('.product-card');

                    productCards.forEach(card => {
                        const name = card.getAttribute('data-name').toLowerCase();
                        card.style.display = name.includes(input) ? 'block' : 'none';
                    });
                }

                // Tutup Modal
                function closeModal() {
                    document.getElementById('productModal').style.display = 'none';
                    document.getElementById('confirmModal').style.display = 'none';
                }

                // Tampilkan Produk Detail
                document.querySelectorAll('.product-card').forEach(card => {
                    card.addEventListener('click', () => {
                        const name = card.getAttribute('data-name');
                        const image = card.getAttribute('data-image');
                        const desc = card.getAttribute('data-description');
                        const comp = card.getAttribute('data-composition');
                        const priceText = card.getAttribute('data-price');
                        const price = priceText.replace(/[^\d]/g, '');

                        document.getElementById('modalTitle').innerText = name;
                        document.getElementById('modalImage').src = image;
                        document.getElementById('modalDescription').innerText = desc;
                        document.getElementById('modalComposition').innerText = comp;
                        document.getElementById('modalPrice').innerText = parseInt(price).toLocaleString('id-ID');

                        document.getElementById('formNama').value = name;
                        document.getElementById('formHarga').value = price;
                        document.getElementById('formGambar').value = image;
                        document.getElementById('formJumlah').value = 1;

                        document.getElementById('productModal').style.display = 'flex';
                    });
                });

                // Tombol beli
                document.getElementById('confirmButton').addEventListener('click', () => {
                    document.getElementById('confirmModal').style.display = 'flex';
                });

                // Konfirmasi Ya
                document.getElementById('proceedBtn').addEventListener('click', () => {
                    document.getElementById('buyForm').submit();
                });

                // Banner slider
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

                // Filter kategori
                document.querySelectorAll('.filter-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        const filter = button.getAttribute('data-filter').toLowerCase();
                        document.querySelectorAll('.product-card').forEach(card => {
                            const kategori = card.getAttribute('data-category').toLowerCase();
                            card.style.display = (filter === 'all' || kategori === filter) ? 'block' : 'none';
                        });
                    });
                });

                // Tambah ke Keranjang
                document.getElementById('addToCartBtn').addEventListener('click', function () {
                    const formData = new FormData(document.getElementById('buyForm'));

                    fetch('tambah_keranjang.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(res => res.text())
                        .then(response => {
                            alert('Produk berhasil ditambahkan ke keranjang!');
                            closeModal(); // Tutup modal
                        })
                        .catch(err => {
                            alert('Gagal menambahkan ke keranjang.');
                            console.error(err);
                        });
                });

            </script>
        </div>

        <footer style="background-color:#00774D; color:white; text-align:center; padding:20px 10px; font-size:14px;">
            &copy; 2025 ApotekQiu.
        </footer>
    </div>

</body>

</html>