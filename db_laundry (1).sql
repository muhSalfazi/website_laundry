-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jan 2024 pada 10.18
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
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_register` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_lengkap`, `no_telp`, `email`, `created_at`, `id_register`) VALUES
(9, 'salman fauzi', '', '', '2023-12-22 20:39:24', 41);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `jenis_laundry` enum('kiloan','satuan','paketan','karpet') NOT NULL,
  `jenis_layanan` enum('cuci+setrika','setrika','karpet','cuci') NOT NULL,
  `layanan_antar` enum('antar jemput','tidak') NOT NULL,
  `alamat` varchar(255) NOT NULL DEFAULT '--',
  `nama_produk` varchar(255) NOT NULL,
  `resi_pesanan` varchar(255) NOT NULL,
  `proses_laundry` enum('menunggu','diproses','selesai') NOT NULL DEFAULT 'menunggu',
  `status_pembayaran` enum('belumbayar','DP','lunas') NOT NULL DEFAULT 'belumbayar',
  `jumlah_barang` int(50) NOT NULL,
  `total_harga` int(50) NOT NULL,
  `jumlah_bayar` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jumlah_kilo` int(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `order_view_all`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `order_view_all` (
`id_order` int(11)
,`nama_pelanggan` varchar(255)
,`jenis_laundry` enum('kiloan','satuan','paketan','karpet')
,`jenis_layanan` enum('cuci+setrika','setrika','karpet','cuci')
,`layanan_antar` enum('antar jemput','tidak')
,`alamat` varchar(255)
,`nama_produk` varchar(255)
,`resi_pesanan` varchar(255)
,`proses_laundry` enum('menunggu','diproses','selesai')
,`status_pembayaran` enum('belumbayar','DP','lunas')
,`jumlah_barang` int(50)
,`total_harga` int(50)
,`jumlah_bayar` int(100)
,`created_at` timestamp
,`jumlah_kilo` int(100)
,`no_telp` varchar(15)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `order_view_month`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `order_view_month` (
`id_order` int(11)
,`nama_pelanggan` varchar(255)
,`jenis_laundry` enum('kiloan','satuan','paketan','karpet')
,`jenis_layanan` enum('cuci+setrika','setrika','karpet','cuci')
,`layanan_antar` enum('antar jemput','tidak')
,`alamat` varchar(255)
,`nama_produk` varchar(255)
,`resi_pesanan` varchar(255)
,`proses_laundry` enum('menunggu','diproses','selesai')
,`status_pembayaran` enum('belumbayar','DP','lunas')
,`jumlah_barang` int(50)
,`total_harga` int(50)
,`jumlah_bayar` int(100)
,`created_at` timestamp
,`jumlah_kilo` int(100)
,`no_telp` varchar(15)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `order_view_today`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `order_view_today` (
`id_order` int(11)
,`nama_pelanggan` varchar(255)
,`jenis_laundry` enum('kiloan','satuan','paketan','karpet')
,`jenis_layanan` enum('cuci+setrika','setrika','karpet','cuci')
,`layanan_antar` enum('antar jemput','tidak')
,`alamat` varchar(255)
,`nama_produk` varchar(255)
,`resi_pesanan` varchar(255)
,`proses_laundry` enum('menunggu','diproses','selesai')
,`status_pembayaran` enum('belumbayar','DP','lunas')
,`jumlah_barang` int(50)
,`total_harga` int(50)
,`jumlah_bayar` int(100)
,`created_at` timestamp
,`jumlah_kilo` int(100)
,`no_telp` varchar(15)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `order_view_year`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `order_view_year` (
`id_order` int(11)
,`nama_pelanggan` varchar(255)
,`jenis_laundry` enum('kiloan','satuan','paketan','karpet')
,`jenis_layanan` enum('cuci+setrika','setrika','karpet','cuci')
,`layanan_antar` enum('antar jemput','tidak')
,`alamat` varchar(255)
,`nama_produk` varchar(255)
,`resi_pesanan` varchar(255)
,`proses_laundry` enum('menunggu','diproses','selesai')
,`status_pembayaran` enum('belumbayar','DP','lunas')
,`jumlah_barang` int(50)
,`total_harga` int(50)
,`jumlah_bayar` int(100)
,`created_at` timestamp
,`jumlah_kilo` int(100)
,`no_telp` varchar(15)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL DEFAULT '--',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `edit_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_lengkap`, `no_telp`, `alamat`, `username`, `password`, `email`, `created_at`, `edit_at`) VALUES
(45, 'salman muhamaad', '08129414', 'perum puri kosambi 2', 'salfazi', '$2y$10$t/qkwvIYYhkm4Z1E.PVOQu200gtX5qUXUwp2pWbd8gb4u8d0Kv9n2', 'if22.muhamadfauzi@mhs.ubpkarawang.ac.id', '2024-01-06 17:10:17', NULL);

--
-- Trigger `pelanggan`
--
DELIMITER $$
CREATE TRIGGER `after_delete_pelanggan` AFTER DELETE ON `pelanggan` FOR EACH ROW BEGIN
    DELETE FROM register WHERE id_pelanggan = OLD.id_pelanggan;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_pelanggan` AFTER INSERT ON `pelanggan` FOR EACH ROW BEGIN
    INSERT INTO register (nama_lengkap, no_telp, alamat, username, password, email, role, created_at, id_pelanggan)
    VALUES (NEW.nama_lengkap, NEW.no_telp, NEW.alamat, NEW.username, NEW.password, NEW.email, 'pelanggan', NOW(), NEW.id_pelanggan);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_pelanggan` AFTER UPDATE ON `pelanggan` FOR EACH ROW BEGIN
    UPDATE register
    SET nama_lengkap = NEW.nama_lengkap,
        no_telp = NEW.no_telp,
        alamat = NEW.alamat,
        username = NEW.username,
        password = NEW.password,
        email = NEW.email
    WHERE id_pelanggan = NEW.id_pelanggan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pelanggan_view_all`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pelanggan_view_all` (
`id_pelanggan` int(11)
,`nama_lengkap` varchar(255)
,`no_telp` varchar(15)
,`alamat` varchar(255)
,`username` varchar(255)
,`password` varchar(255)
,`email` varchar(255)
,`created_at` timestamp
,`edit_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pelanggan_view_month`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pelanggan_view_month` (
`id_pelanggan` int(11)
,`nama_lengkap` varchar(255)
,`no_telp` varchar(15)
,`alamat` varchar(255)
,`username` varchar(255)
,`password` varchar(255)
,`email` varchar(255)
,`created_at` timestamp
,`edit_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pelanggan_view_today`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pelanggan_view_today` (
`id_pelanggan` int(11)
,`nama_lengkap` varchar(255)
,`no_telp` varchar(15)
,`alamat` varchar(255)
,`username` varchar(255)
,`password` varchar(255)
,`email` varchar(255)
,`created_at` timestamp
,`edit_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pelanggan_view_year`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pelanggan_view_year` (
`id_pelanggan` int(11)
,`nama_lengkap` varchar(255)
,`no_telp` varchar(15)
,`alamat` varchar(255)
,`username` varchar(255)
,`password` varchar(255)
,`email` varchar(255)
,`created_at` timestamp
,`edit_at` timestamp
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `register`
--

CREATE TABLE `register` (
  `id_register` int(11) NOT NULL,
  `nama_lengkap` varchar(225) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','pelanggan') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_pelanggan` int(11) DEFAULT NULL,
  `code_expiry` timestamp NOT NULL DEFAULT current_timestamp(),
  `verification_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `register`
--

INSERT INTO `register` (`id_register`, `nama_lengkap`, `no_telp`, `alamat`, `username`, `password`, `email`, `role`, `created_at`, `id_pelanggan`, `code_expiry`, `verification_code`) VALUES
(41, 'salman fauzi', '', '', 'fauzi', '$2y$10$.eRtgJCZ421cQ9YFCwwdretfxYwXAsMCNdmKfJVInZxs/Wm2CH2GS', '', 'admin', '2023-12-22 20:39:24', NULL, '0000-00-00 00:00:00', ''),
(59, 'salman muhamaad', '08129414', 'perum puri kosambi 2', 'salfazi', '$2y$10$t/qkwvIYYhkm4Z1E.PVOQu200gtX5qUXUwp2pWbd8gb4u8d0Kv9n2', 'if22.muhamadfauzi@mhs.ubpkarawang.ac.id', 'pelanggan', '2024-01-06 17:10:17', 45, '2024-01-06 17:10:17', '');

--
-- Trigger `register`
--
DELIMITER $$
CREATE TRIGGER `register_after_delete` AFTER DELETE ON `register` FOR EACH ROW BEGIN
    IF OLD.role = 'admin' THEN
        DELETE FROM admin WHERE id_register = OLD.id_register;
    END IF;
    -- Tambahkan logika hapus untuk role lain jika diperlukan
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `register_after_insert` AFTER INSERT ON `register` FOR EACH ROW BEGIN
    IF NEW.role = 'admin' THEN
        INSERT INTO admin ( nama_lengkap,no_telp, email, created_at,id_register)
        VALUES (NEW.nama_lengkap, NEW.no_telp, NEW.email, NEW.created_at,NEW.id_register);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `register_after_update` AFTER UPDATE ON `register` FOR EACH ROW BEGIN
    IF NEW.role = 'admin' THEN
        UPDATE admin
        SET
            nama_lengkap = NEW.nama_lengkap,
            no_telp = NEW.no_telp,
            email = NEW.email,
            created_at = NEW.created_at
        WHERE id_register = NEW.id_register;
    END IF;
    -- Tambahkan logika update untuk role lain jika diperlukan
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_barang`
--

CREATE TABLE `stok_barang` (
  `id_stok_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `total_barang` int(50) NOT NULL,
  `image` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `edit_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stok_barang`
--

INSERT INTO `stok_barang` (`id_stok_barang`, `nama_barang`, `kode_barang`, `total_barang`, `image`, `created_at`, `edit_at`) VALUES
(77, 'sabun', 'Barang_3492.VJH.1703930929', 12, 'upload/1703930929-7b7d3a95f906df31a7afc29906ca43e0-rinso.jpeg', '2023-12-30 10:08:49', NULL),
(78, 'sabun', 'Barang_8108.VBA.1704405524', 12, 'upload/1704405524-86470e3c9a8dce4410511cd149f3927a-rinso.jpeg', '2024-01-04 21:58:44', NULL);

-- --------------------------------------------------------

--
-- Struktur untuk view `order_view_all`
--
DROP TABLE IF EXISTS `order_view_all`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_view_all`  AS SELECT `order`.`id_order` AS `id_order`, `order`.`nama_pelanggan` AS `nama_pelanggan`, `order`.`jenis_laundry` AS `jenis_laundry`, `order`.`jenis_layanan` AS `jenis_layanan`, `order`.`layanan_antar` AS `layanan_antar`, `order`.`alamat` AS `alamat`, `order`.`nama_produk` AS `nama_produk`, `order`.`resi_pesanan` AS `resi_pesanan`, `order`.`proses_laundry` AS `proses_laundry`, `order`.`status_pembayaran` AS `status_pembayaran`, `order`.`jumlah_barang` AS `jumlah_barang`, `order`.`total_harga` AS `total_harga`, `order`.`jumlah_bayar` AS `jumlah_bayar`, `order`.`created_at` AS `created_at`, `order`.`jumlah_kilo` AS `jumlah_kilo`, `order`.`no_telp` AS `no_telp` FROM `order` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `order_view_month`
--
DROP TABLE IF EXISTS `order_view_month`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_view_month`  AS SELECT `order`.`id_order` AS `id_order`, `order`.`nama_pelanggan` AS `nama_pelanggan`, `order`.`jenis_laundry` AS `jenis_laundry`, `order`.`jenis_layanan` AS `jenis_layanan`, `order`.`layanan_antar` AS `layanan_antar`, `order`.`alamat` AS `alamat`, `order`.`nama_produk` AS `nama_produk`, `order`.`resi_pesanan` AS `resi_pesanan`, `order`.`proses_laundry` AS `proses_laundry`, `order`.`status_pembayaran` AS `status_pembayaran`, `order`.`jumlah_barang` AS `jumlah_barang`, `order`.`total_harga` AS `total_harga`, `order`.`jumlah_bayar` AS `jumlah_bayar`, `order`.`created_at` AS `created_at`, `order`.`jumlah_kilo` AS `jumlah_kilo`, `order`.`no_telp` AS `no_telp` FROM `order` WHERE month(`order`.`created_at`) = month(curdate()) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `order_view_today`
--
DROP TABLE IF EXISTS `order_view_today`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_view_today`  AS SELECT `order`.`id_order` AS `id_order`, `order`.`nama_pelanggan` AS `nama_pelanggan`, `order`.`jenis_laundry` AS `jenis_laundry`, `order`.`jenis_layanan` AS `jenis_layanan`, `order`.`layanan_antar` AS `layanan_antar`, `order`.`alamat` AS `alamat`, `order`.`nama_produk` AS `nama_produk`, `order`.`resi_pesanan` AS `resi_pesanan`, `order`.`proses_laundry` AS `proses_laundry`, `order`.`status_pembayaran` AS `status_pembayaran`, `order`.`jumlah_barang` AS `jumlah_barang`, `order`.`total_harga` AS `total_harga`, `order`.`jumlah_bayar` AS `jumlah_bayar`, `order`.`created_at` AS `created_at`, `order`.`jumlah_kilo` AS `jumlah_kilo`, `order`.`no_telp` AS `no_telp` FROM `order` WHERE cast(`order`.`created_at` as date) = curdate() ;

-- --------------------------------------------------------

--
-- Struktur untuk view `order_view_year`
--
DROP TABLE IF EXISTS `order_view_year`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_view_year`  AS SELECT `order`.`id_order` AS `id_order`, `order`.`nama_pelanggan` AS `nama_pelanggan`, `order`.`jenis_laundry` AS `jenis_laundry`, `order`.`jenis_layanan` AS `jenis_layanan`, `order`.`layanan_antar` AS `layanan_antar`, `order`.`alamat` AS `alamat`, `order`.`nama_produk` AS `nama_produk`, `order`.`resi_pesanan` AS `resi_pesanan`, `order`.`proses_laundry` AS `proses_laundry`, `order`.`status_pembayaran` AS `status_pembayaran`, `order`.`jumlah_barang` AS `jumlah_barang`, `order`.`total_harga` AS `total_harga`, `order`.`jumlah_bayar` AS `jumlah_bayar`, `order`.`created_at` AS `created_at`, `order`.`jumlah_kilo` AS `jumlah_kilo`, `order`.`no_telp` AS `no_telp` FROM `order` WHERE year(`order`.`created_at`) = year(curdate()) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelanggan_view_all`
--
DROP TABLE IF EXISTS `pelanggan_view_all`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelanggan_view_all`  AS SELECT `pelanggan`.`id_pelanggan` AS `id_pelanggan`, `pelanggan`.`nama_lengkap` AS `nama_lengkap`, `pelanggan`.`no_telp` AS `no_telp`, `pelanggan`.`alamat` AS `alamat`, `pelanggan`.`username` AS `username`, `pelanggan`.`password` AS `password`, `pelanggan`.`email` AS `email`, `pelanggan`.`created_at` AS `created_at`, `pelanggan`.`edit_at` AS `edit_at` FROM `pelanggan` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelanggan_view_month`
--
DROP TABLE IF EXISTS `pelanggan_view_month`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelanggan_view_month`  AS SELECT `pelanggan`.`id_pelanggan` AS `id_pelanggan`, `pelanggan`.`nama_lengkap` AS `nama_lengkap`, `pelanggan`.`no_telp` AS `no_telp`, `pelanggan`.`alamat` AS `alamat`, `pelanggan`.`username` AS `username`, `pelanggan`.`password` AS `password`, `pelanggan`.`email` AS `email`, `pelanggan`.`created_at` AS `created_at`, `pelanggan`.`edit_at` AS `edit_at` FROM `pelanggan` WHERE month(`pelanggan`.`created_at`) = month(curdate()) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelanggan_view_today`
--
DROP TABLE IF EXISTS `pelanggan_view_today`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelanggan_view_today`  AS SELECT `pelanggan`.`id_pelanggan` AS `id_pelanggan`, `pelanggan`.`nama_lengkap` AS `nama_lengkap`, `pelanggan`.`no_telp` AS `no_telp`, `pelanggan`.`alamat` AS `alamat`, `pelanggan`.`username` AS `username`, `pelanggan`.`password` AS `password`, `pelanggan`.`email` AS `email`, `pelanggan`.`created_at` AS `created_at`, `pelanggan`.`edit_at` AS `edit_at` FROM `pelanggan` WHERE cast(`pelanggan`.`created_at` as date) = curdate() ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelanggan_view_year`
--
DROP TABLE IF EXISTS `pelanggan_view_year`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelanggan_view_year`  AS SELECT `pelanggan`.`id_pelanggan` AS `id_pelanggan`, `pelanggan`.`nama_lengkap` AS `nama_lengkap`, `pelanggan`.`no_telp` AS `no_telp`, `pelanggan`.`alamat` AS `alamat`, `pelanggan`.`username` AS `username`, `pelanggan`.`password` AS `password`, `pelanggan`.`email` AS `email`, `pelanggan`.`created_at` AS `created_at`, `pelanggan`.`edit_at` AS `edit_at` FROM `pelanggan` WHERE year(`pelanggan`.`created_at`) = year(curdate()) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `fk_register_admin` (`id_register`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id_register`),
  ADD KEY `fk_register_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`id_stok_barang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `register`
--
ALTER TABLE `register`
  MODIFY `id_register` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `id_stok_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_register_admin` FOREIGN KEY (`id_register`) REFERENCES `register` (`id_register`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `fk_register_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
