`anggota`-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Des 2023 pada 16.41
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `anggota_id` INT(11) NOT NULL,
  `nama` VARCHAR(100) DEFAULT NULL,
  `alamat` VARCHAR(200) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `telepon` VARCHAR(20) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`anggota_id`, `nama`, `alamat`, `email`, `telepon`) VALUES
(1, 'Faizi', 'Platar', 'Faiz@uninsu.ac.id', '083956431233');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `buku_id` INT(11) NOT NULL,
  `judul` VARCHAR(100) DEFAULT NULL,
  `pengarang` VARCHAR(100) DEFAULT NULL,
  `penerbit` VARCHAR(100) DEFAULT NULL,
  `tahun_terbit` INT(11) DEFAULT NULL,
  `sinopsis` TEXT DEFAULT NULL,
  `kategori_id` INT(11) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`buku_id`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `sinopsis`, `kategori_id`) VALUES
(1, 'History of Angga', 'Faizin', 'Faizin Group', 2022, 'iya aja', 2),
(2, 'Cara Menjadi saya', 'Faizin', 'Faizin', 2023, 'conto ja', 2),
(11, 'Perjalanan Faizin', 'Faizin', 'Faizin Group', 2023, 'akhscai', 3),
(12, 'Cara Menjadi Faizin', 'Faizin', 'Faizin', 2022, 'd df df', 2),
(14, 'Rahasia Jago Ngoding', 'Angga', 'Airlangga', 2023, 'jago pokoknya', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `katalog`
--

CREATE TABLE `katalog` (
  `katalog_id` INT(11) NOT NULL,
  `buku_id` INT(11) DEFAULT NULL,
  `kategori_id` INT(11) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `katalog`
--

INSERT INTO `katalog` (`katalog_id`, `buku_id`, `kategori_id`) VALUES
(1, 1, 3),
(2, 1, 3),
(4, 2, 2),
(6, 2, 2),
(7, 2, 2),
(8, 2, 2),
(9, 2, 3),
(10, 2, 3),
(11, 2, 3),
(12, 14, 2),
(13, 14, 2),
(14, 14, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` INT(11) NOT NULL,
  `nama_kategori` VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `nama_kategori`) VALUES
(2, 'Fiksi'),
(3, 'Ilmiah'),
(5, 'History');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi_fisik_buku`
--

CREATE TABLE `lokasi_fisik_buku` (
  `lokasi_id` INT(11) NOT NULL,
  `buku_id` INT(11) DEFAULT NULL,
  `nama_lokasi` VARCHAR(100) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `peminjaman_id` INT(11) NOT NULL,
  `buku_id` INT(11) DEFAULT NULL,
  `anggota_id` INT(11) DEFAULT NULL,
  `tanggal_peminjaman` DATE DEFAULT NULL,
  `tanggal_kembali` DATE DEFAULT NULL,
  `status` ENUM('dipinjam','kembali') DEFAULT 'dipinjam'
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`peminjaman_id`, `buku_id`, `anggota_id`, `tanggal_peminjaman`, `tanggal_kembali`, `status`) VALUES
(28, 1, 1, '2023-12-05', '2023-12-08', 'kembali'),
(29, 2, 1, '2023-12-01', '2023-12-02', 'kembali'),
(30, 2, 1, '2023-12-02', '2023-12-09', 'kembali'),
(31, 1, 1, '2023-12-05', '2023-12-09', 'kembali'),
(34, 12, 1, '2023-12-08', '2023-12-08', 'kembali');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `pengembalian_id` INT(11) NOT NULL,
  `peminjaman_id` INT(11) DEFAULT NULL,
  `tanggal_pengembalian` DATE DEFAULT NULL,
  `denda` DECIMAL(10,2) DEFAULT NULL,
  `status_pengembalian` ENUM('dikembalikan','terlambat') DEFAULT 'dikembalikan'
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`pengembalian_id`, `peminjaman_id`, `tanggal_pengembalian`, `denda`, `status_pengembalian`) VALUES
(43, 28, '2023-12-08', '0.00', 'dikembalikan'),
(44, 29, '2023-12-08', '30000.00', 'terlambat'),
(46, 30, '2023-12-08', '0.00', 'dikembalikan'),
(47, 31, '2023-12-08', '0.00', 'dikembalikan'),
(48, 31, '2023-12-08', '0.00', 'dikembalikan'),
(49, 34, '2023-12-08', '0.00', 'dikembalikan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE `staff` (
  `staff_id` INT(11) NOT NULL,
  `nama` VARCHAR(100) DEFAULT NULL,
  `jabatan` VARCHAR(100) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `telepon` VARCHAR(20) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`anggota_id`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`buku_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `katalog`
--
ALTER TABLE `katalog`
  ADD PRIMARY KEY (`katalog_id`),
  ADD KEY `buku_id` (`buku_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `lokasi_fisik_buku`
--
ALTER TABLE `lokasi_fisik_buku`
  ADD PRIMARY KEY (`lokasi_id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`peminjaman_id`),
  ADD KEY `buku_id` (`buku_id`),
  ADD KEY `anggota_id` (`anggota_id`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`pengembalian_id`),
  ADD KEY `peminjaman_id` (`peminjaman_id`);

--
-- Indeks untuk tabel `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `anggota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `buku_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `katalog`
--
ALTER TABLE `katalog`
  MODIFY `katalog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `lokasi_fisik_buku`
--
ALTER TABLE `lokasi_fisik_buku`
  MODIFY `lokasi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `peminjaman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `pengembalian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`);

--
-- Ketidakleluasaan untuk tabel `katalog`
--
ALTER TABLE `katalog`
  ADD CONSTRAINT `katalog_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`buku_id`),
  ADD CONSTRAINT `katalog_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`);

--
-- Ketidakleluasaan untuk tabel `lokasi_fisik_buku`
--
ALTER TABLE `lokasi_fisik_buku`
  ADD CONSTRAINT `lokasi_fisik_buku_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`buku_id`);

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`buku_id`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`anggota_id`);

--
-- Ketidakleluasaan untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`peminjaman_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
