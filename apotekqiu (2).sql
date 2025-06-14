-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2025 pada 18.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotekqiu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_transaksi`, `nama_produk`, `harga`, `jumlah`, `total`) VALUES
(1, 1, 'PediaSure', 1000, 1, 1000),
(2, 1, 'Hemaviton', 1000, 1, 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `komposisi` text DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `stok` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `gambar`, `kategori`, `deskripsi`, `komposisi`, `harga`, `stok`) VALUES
(3, 'OskadonSP', 'img/obatkepala6.png', 'Obat', 'meredakan nyeri otot pada pinggang dan punggung', 'Analgesik (pereda nyeri) dan antipiretik (penurun demam)', 1000.00, 100),
(4, 'Bodrex', 'img/obatkepala4.png', 'Obat', 'meringankan sakit kepala, sakit gigi, dan menurunkan demam', 'Caffeine 50 mg dan Paracetamol 600 mg', 1000.00, 100),
(5, 'Rosuvastatin Calcium', 'img/obatdarah2.png', 'Obat', 'Menurunkan risiko penyakit kardiovaskular seperti serangan jantung dan stroke', 'Setiap tablet mengandung Rosuvastatin Calcium setara dengan Rosuvastatin 20 mg', 1000.00, 99),
(6, 'Tolak Angin', 'img/tolakangin1.jpeg', 'Herbal', 'Meredakan masuk angin\r\n\r\nMengatasi mual, perut kembung,pusing, dan meriang\r\nMembantu meningkatkan daya tahan tubuh', 'mengandung ekstrak jahe, ginseng, sambiloto, adas, daun mint, madu, royal jelly, menthol, dan vitamin C', 1000.00, 100),
(7, 'Kapsul Tewulawak', 'img/tewulawak.png', 'Herbal', 'meningkatkan nafsu makan, serta meringankan gangguan pencernaan seperti kembung dan mual', 'mengandung ekstrak rimpang temulawak (Curcuma xanthorrhiza)', 1000.00, 99),
(8, 'Blackmores', 'img/blackmores.jpeg', 'suplemen', 'membantu menjaga kesehatan jantung, fungsi otak', 'Mengandung minyak ikan alami 1000 mg yang setara dengan EPA 180 mg dan DHA 120 mg per kapsul', 1000.00, 100),
(9, 'Hemaviton', 'img/hemaviton.png', 'suplemen', 'Hemaviton membantu meningkatkan stamina, mengurangi kelelahan, dan menjaga daya tahan tubuh', 'Mengandung Multivitamin B kompleks, Vitamin C dan E, Zinc, serta Ginseng Extract', 1000.00, 97),
(10, 'PediaSure', 'img/pediasure.jpeg', 'Nutrisi', 'membantu pertumbuhan optimal, daya tahan tubuh, dan nafsu makan anak', 'mengandung protein, lemak sehat, karbohidrat, 14 vitamin, dan 14 mineral termasuk kalsium, zat besi, dan vitamin D', 1000.00, 95);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `produk` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Menunggu Pembayaran',
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `gambar_bukti` varchar(255) DEFAULT NULL,
  `cara_pengambilan` varchar(50) NOT NULL DEFAULT 'Ambil di Apotek',
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `username`, `nama_produk`, `harga`, `jumlah`, `total_harga`, `produk`, `gambar`, `tanggal`, `metode_pembayaran`, `status`, `bukti_transfer`, `gambar_bukti`, `cara_pengambilan`, `alamat`) VALUES
(1, 'rival1', NULL, NULL, NULL, 2000, NULL, NULL, '2025-06-12 21:24:08', 'Transfer', 'Pembayaran Diterima', NULL, 'bukti_1749738265.webp', 'Ambil di Apotek', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('pasien','dokter') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'rheival', '5b3bb3e5458e02aa356f2fc671ae08d9', '', '2025-05-04 08:43:28'),
(2, 'rival', 'ed29da59b3ca8a6b01b216d2973487d2', '', '2025-05-04 08:45:13'),
(3, 'eka', '79ee82b17dfb837b1be94a6827fa395a', '', '2025-05-04 09:01:08'),
(4, 'Eneng Lisnwati', 'c7a45bb2061da1d1dfc917554d558d4d', '', '2025-05-05 12:27:37'),
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '2025-05-06 17:27:53'),
(6, 'dwik', 'd28af33cdedf204c62e8c35f9fd5367c', '', '2025-05-08 09:14:02'),
(7, 'register', '$2y$10$OGqo6H9YrsTyAsuR09V7uekpjVT9t3CIKAewgE5bLECHsM48TVMNO', 'pasien', '2025-05-16 18:31:47'),
(8, 'lisna123', '$2y$10$I39jbQyDt5W5ypJo7kOHf.aN7QeI3SZd39fiVu3VpZH3TahqUIoyu', 'pasien', '2025-05-16 18:33:12'),
(11, 'rheival123', '$2y$10$ZmBV3eoUiwXn2waRTuM0uOFg22fDYZEmA6hEiIzUNzHALPdJ/EnzC', 'pasien', '2025-05-21 12:59:18'),
(12, 'oboy', '$2y$10$qXHwXEuFyzRoDBHl.GmOGejd4VemZqxPPlPcxxnDo391AV7ZBGKx.', 'pasien', '2025-05-25 11:17:19'),
(13, 'rheival1', '$2y$10$pGjGuF0bVo/Ev30s6Oxm.eNalYVWAc9e8XkgGSRjoXCymUvOsQCgG', 'pasien', '2025-05-25 15:35:21'),
(14, 'rival1', '$2y$10$RuKCi4DT8Bja0CNA3xAbEuUJ9aJHQ9zv20EGRSv.PhIfwidPdP8zK', 'pasien', '2025-05-27 08:44:29'),
(15, 'yohana', '$2y$10$2vFPwKxrHidwsvc2SMXwbeEqHXYPIUkjA0nj3jj6.mvvafMHtZrou', 'pasien', '2025-06-12 02:26:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
