-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jan 2024 pada 01.54
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

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id_order`, `nama_pelanggan`, `jenis_laundry`, `jenis_layanan`, `layanan_antar`, `alamat`, `nama_produk`, `resi_pesanan`, `proses_laundry`, `status_pembayaran`, `jumlah_barang`, `total_harga`, `jumlah_bayar`, `created_at`, `jumlah_kilo`, `no_telp`) VALUES
(2, '  salman muhamaad', 'paketan', 'setrika', 'antar jemput', 'perum puri kosambi 2 blok cb 51 79/17', 'paket setrika', 'JT.1703862092', 'menunggu', 'belumbayar', 0, 0, 0, '2023-12-29 15:01:32', 0, '0987810291942'),
(6, '  salman muhamaad', 'kiloan', 'cuci', 'antar jemput', 'perum puri kosambi 2 blok cb 51 79/17', 'Reguler', 'QC.1703920059', 'menunggu', 'belumbayar', 0, 0, 0, '2023-12-30 07:07:39', 0, '0987810291942'),
(7, '  salman muhamaad', 'kiloan', 'cuci+setrika', 'antar jemput', 'perum puri kosambi 2 blok cb 51 79/17', '2 hari', 'IQ.1703929330', 'menunggu', 'belumbayar', 0, 0, 0, '2023-12-30 09:42:10', 0, '0987810291942'),
(8, '  salman', 'kiloan', 'cuci+setrika', 'antar jemput', 'perum puri kosambi 2', '2 hari', 'SV.1704060925', 'menunggu', 'belumbayar', 0, 0, 0, '2023-12-31 22:15:25', 0, '89090123'),
(9, '  salman', 'kiloan', 'cuci+setrika', 'antar jemput', 'perum puri kosambi 2', '2 hari', 'EO.1704061040', 'menunggu', 'belumbayar', 0, 0, 0, '2023-12-31 22:17:20', 0, '89090123'),
(10, '  salman', 'satuan', 'cuci+setrika', 'antar jemput', 'perum puri kosambi 2', 'sprey,selimut', 'KH.1704061098', 'menunggu', 'belumbayar', 0, 0, 0, '2023-12-31 22:18:18', 0, '89090123'),
(11, '  salman', 'kiloan', 'cuci+setrika', 'tidak', '--', '2 hari', 'XV.1704061335', 'menunggu', 'belumbayar', 0, 0, 0, '2023-12-31 22:22:15', 0, '89090123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
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
(36, 'salman', '89090123', 'perum puri kosambi 2', 'salman', '$2y$10$RHjHjehhJp.5YF4w.1p8NOIJWIjV7XGUoG3E.t.Az/CYDYrQVeFQu', 'salmanfauzi5123@gmail.com', '2023-12-31 21:26:55', NULL),
(37, 'salman muhamaad', '0977898', 'perum puri kosambi 2', 'salfazi', '$2y$10$uPZUfSJPO72ey35u2pbuaOdIhFcohUcaJbF/ptcgEd6I/MQUJh7H.', 'if22.muhamadfauzi@mhs.ubpkarawang.ac.id', '2023-12-31 21:28:25', NULL);

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
(50, 'salman', '89090123', 'perum puri kosambi 2', 'salman', '$2y$10$dtkq0AOjv6P1UzUMybb2F.mPIzX1SNJkgf7Bw48Td2n05Rkuq5kJC', 'salmanfauzi5123@gmail.com', 'pelanggan', '2023-12-31 21:26:55', 36, '2024-01-02 00:32:35', '4016e4'),
(51, 'salman muhamaad', '0977898', 'perum puri kosambi 2', 'salfazi', '$2y$10$EVXIDxaVddDU6PkAtpOnMOZCxJ3Ve4tMCfM2uywUOoZv9AfOA1mmO', 'if22.muhamadfauzi@mhs.ubpkarawang.ac.id', 'pelanggan', '2023-12-31 21:28:25', 37, '2023-12-29 00:49:29', '892428');

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
(77, 'sabun', 'Barang_3492.VJH.1703930929', 12, 'upload/1703930929-7b7d3a95f906df31a7afc29906ca43e0-rinso.jpeg', '2023-12-30 10:08:49', NULL);

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
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `register`
--
ALTER TABLE `register`
  MODIFY `id_register` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `id_stok_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

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
