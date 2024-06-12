-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2024 pada 08.47
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eigen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `book`
--

CREATE TABLE `book` (
  `codeb` varchar(10) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `stock` int(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `book`
--

INSERT INTO `book` (`codeb`, `title`, `author`, `stock`, `created_at`, `updated_at`) VALUES
('HOB-83', 'The Hobbit, or There and Back Again', 'J.R.R. Tolkien', 1, '2024-06-10 06:44:09', '2024-06-10 06:44:09'),
('JK-45', 'Harry Potter', 'J.K Rowling', 1, '2024-06-10 06:44:09', '2024-06-10 06:44:09'),
('NRN-7', 'The Lion, the Witch and the Wardrobe', 'C.S. Lewis', 1, '2024-06-10 06:44:09', '2024-06-10 06:44:09'),
('SHR-1', 'A Study in Scarlet', 'Arthur Conan Doyle', 1, '2024-06-10 06:44:09', '2024-06-10 06:44:09'),
('TW-11', 'Twilight', 'Stephenie Meyer', 1, '2024-06-10 06:44:09', '2024-06-10 06:44:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inputs`
--

CREATE TABLE `inputs` (
  `id` int(2) NOT NULL,
  `jenis` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inputs`
--

INSERT INTO `inputs` (`id`, `jenis`) VALUES
(1, 'xc'),
(2, 'dz'),
(3, 'bbb'),
(4, 'dz');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `codem` varchar(4) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `stts` varchar(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`codem`, `name`, `stts`, `created_at`, `updated_at`) VALUES
('M001', 'ANGGA', 'TIDAK', '2024-06-10 06:44:57', '2024-06-10 06:44:57'),
('M002', 'FERRY', 'TIDAK', '2024-06-10 06:44:57', '2024-06-10 06:44:57'),
('M003', 'PUTRI', 'TIDAK', '2024-06-10 06:44:57', '2024-06-10 06:44:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trxkembali`
--

CREATE TABLE `trxkembali` (
  `idtrx` varchar(20) NOT NULL,
  `tgltrx` date DEFAULT NULL,
  `codem` varchar(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `trxkembali`
--

INSERT INTO `trxkembali` (`idtrx`, `tgltrx`, `codem`, `created_at`, `updated_at`) VALUES
('KM202406110001', '2024-06-11', 'M001', '2024-06-11 02:58:23', '2024-06-11 02:58:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trxkembalidetail`
--

CREATE TABLE `trxkembalidetail` (
  `idtrx` varchar(20) NOT NULL,
  `codeb` varchar(10) NOT NULL,
  `jmlkembali` int(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `trxkembalidetail`
--

INSERT INTO `trxkembalidetail` (`idtrx`, `codeb`, `jmlkembali`, `created_at`, `updated_at`) VALUES
('KM202406110001', 'HOB-83', 1, '2024-06-11 02:58:23', '2024-06-11 02:58:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trxpinjam`
--

CREATE TABLE `trxpinjam` (
  `idtrx` varchar(20) NOT NULL,
  `tgltrx` date DEFAULT NULL,
  `codem` varchar(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `trxpinjam`
--

INSERT INTO `trxpinjam` (`idtrx`, `tgltrx`, `codem`, `created_at`, `updated_at`) VALUES
('PJ202406100001', '2024-06-10', 'M001', '2024-06-10 08:06:57', '2024-06-10 08:06:57'),
('PJ202406110001', '2024-06-11', 'M003', '2024-06-10 16:48:21', '2024-06-10 16:48:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trxpinjamdetail`
--

CREATE TABLE `trxpinjamdetail` (
  `idtrx` varchar(20) NOT NULL,
  `codeb` varchar(10) NOT NULL,
  `jmlpinjam` int(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `trxpinjamdetail`
--

INSERT INTO `trxpinjamdetail` (`idtrx`, `codeb`, `jmlpinjam`, `created_at`, `updated_at`) VALUES
('PJ202406100001', 'HOB-83', 1, '2024-06-10 08:06:57', '2024-06-10 08:06:57'),
('PJ202406100001', 'JK-45', 1, '2024-06-10 08:06:57', '2024-06-10 08:06:57'),
('PJ202406110001', 'TW-11', 1, '2024-06-10 16:48:21', '2024-06-10 16:48:21');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`codeb`);

--
-- Indeks untuk tabel `inputs`
--
ALTER TABLE `inputs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`codem`);

--
-- Indeks untuk tabel `trxkembali`
--
ALTER TABLE `trxkembali`
  ADD PRIMARY KEY (`idtrx`);

--
-- Indeks untuk tabel `trxkembalidetail`
--
ALTER TABLE `trxkembalidetail`
  ADD PRIMARY KEY (`idtrx`,`codeb`);

--
-- Indeks untuk tabel `trxpinjam`
--
ALTER TABLE `trxpinjam`
  ADD PRIMARY KEY (`idtrx`);

--
-- Indeks untuk tabel `trxpinjamdetail`
--
ALTER TABLE `trxpinjamdetail`
  ADD PRIMARY KEY (`idtrx`,`codeb`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `inputs`
--
ALTER TABLE `inputs`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
