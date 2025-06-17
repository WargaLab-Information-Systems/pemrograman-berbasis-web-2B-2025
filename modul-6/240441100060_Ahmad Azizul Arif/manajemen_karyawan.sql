-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jun 2025 pada 12.45
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen_karyawan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_absensi`
--

CREATE TABLE `karyawan_absensi` (
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `departemen` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `kota_asal` varchar(100) DEFAULT NULL,
  `tanggal_absensi` date DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `karyawan_absensi`
--

INSERT INTO `karyawan_absensi` (`nip`, `nama`, `umur`, `jenis_kelamin`, `departemen`, `jabatan`, `kota_asal`, `tanggal_absensi`, `jam_masuk`, `jam_pulang`) VALUES
('355', 'zzz', 12, 'Laki-laki', 'zzzz', 'zzz', 'zzz', '2025-06-08', '08:00:00', '16:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$RzD96usEjcGEiVkEy6bUQefkHXWUyPznpiKhOyx1IDBA9KiyWZANy'),
(2, 'ha', '$2y$10$aRqnnaAaCJMYhN4mj/7yiOGJ/TaAsLhm753/FyRSAvyqfLBbQ5XFK'),
(3, 'asep', '$2y$10$Ch.FoJIFLpb76UI5T43GMeN8wVQD88OcKyKb.PL/XkTKn0p3gHE4C'),
(4, 'a', '$2y$10$QEt/v5wrLEfNfUPCqh8MruEkIZ/oNy7kMO35C29DPr2s46Q1a0Yo2'),
(5, 'aaa', '$2y$10$ONKHo.lPRaxG0PJf/LNUkeWYgVRlg26T5rLY3VdVw58cpGptdDHNO');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `karyawan_absensi`
--
ALTER TABLE `karyawan_absensi`
  ADD PRIMARY KEY (`nip`);

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
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
