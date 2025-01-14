-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Des 2024 pada 09.53
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw_bank`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_11_24_065458_create_personal_access_tokens_table', 1),
(2, '2024_11_24_084027_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawais`
--

CREATE TABLE `pegawais` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `gaji` double NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawais`
--

INSERT INTO `pegawais` (`id_pegawai`, `nama_pegawai`, `jabatan`, `gaji`, `alamat`, `tanggal_lahir`, `email`, `password`) VALUES
(1, 'adminBank', 'Manager', 15000000, 'Jalan Sudirman No. 21', '1985-10-12', 'adminBank8@gmail.com', 'adminPWbank');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjamans`
--

CREATE TABLE `peminjamans` (
  `no_peminjaman` int(11) NOT NULL,
  `suku_bunga` double NOT NULL,
  `periode_peminjaman` varchar(255) NOT NULL,
  `status_peminjaman` varchar(255) NOT NULL,
  `jumlah_peminjaman` double NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `nomor_rekening` bigint(20) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `tanggal_pelunasan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjamans`
--

INSERT INTO `peminjamans` (`no_peminjaman`, `suku_bunga`, `periode_peminjaman`, `status_peminjaman`, `jumlah_peminjaman`, `tanggal_peminjaman`, `nomor_rekening`, `id_pegawai`, `tanggal_pelunasan`) VALUES
(2, 4, '3', 'Approved', 123123, '2024-12-17', 10000004, NULL, '2025-03-17'),
(3, 4, '3', 'Approved', 100000, '2024-12-17', 10000004, 1, '2025-03-17'),
(4, 3, '6', 'Waiting', 100000, '2024-12-17', 10000004, NULL, '2025-06-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(13, 'App\\Models\\User', 2, 'Personal Access Token', '07d546f3917fda721154d31d548881c2a8382a29fc46da94e52c3a0ecd6f2896', '[\"*\"]', NULL, NULL, '2024-11-27 00:56:14', '2024-11-27 00:56:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekenings`
--

CREATE TABLE `rekenings` (
  `nomor_rekening` bigint(20) NOT NULL,
  `tipe_rekening` varchar(255) NOT NULL,
  `saldo` double NOT NULL,
  `id_nasabah` int(10) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `income` double NOT NULL,
  `pin` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekenings`
--

INSERT INTO `rekenings` (`nomor_rekening`, `tipe_rekening`, `saldo`, `id_nasabah`, `tujuan`, `income`, `pin`, `created_at`, `updated_at`) VALUES
(10000004, 'Student', 922987, 6, 'ga da', 123000, '$2y$12$CXit4F4o9RWW.RfDMTaVaOe6vJNtSOhjk568smPmE80b.eT3wi1oS', '2024-12-16 21:13:33', '2024-12-17 01:20:02'),
(10000008, 'Student', 0, 8, '11', 111111, '$2y$12$Ep4oewk4Nq5LaVJbC21xTus8bIeRt/zdPKidvo2pWYXCYEKbBD5Xq', '2024-12-17 00:34:01', '2024-12-17 00:34:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0wTxdXEqFRIVOUxT6t5zG5PCqT6r6bi2dUQ0tjHO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQnFrQzRkV2hTR3pxdzl4d1JjN1FFaVJHdTFvbWtoNHhuV3JuenBrbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9fQ==', 1734425624);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transfers`
--

CREATE TABLE `transfers` (
  `no_transfer` bigint(20) NOT NULL,
  `rekening_tujuan` varchar(255) NOT NULL,
  `jenis_transfer` varchar(255) NOT NULL,
  `jumlah_transfer` double NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `nomor_rekening` bigint(20) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transfers`
--

INSERT INTO `transfers` (`no_transfer`, `rekening_tujuan`, `jenis_transfer`, `jumlah_transfer`, `tanggal_transfer`, `nomor_rekening`, `deskripsi`) VALUES
(1, '10000003', 'Other Bank', 2500, '2024-12-16', 10000004, 'wow'),
(11, '10000003', 'Other Bank', 10000, '2024-12-16', 10000004, 'wow'),
(12, '10000003', 'AtmaBank', 2500, '2024-12-16', 10000004, 'anjay'),
(13, '10000003', 'AtmaBank', 5000, '2024-12-17', 10000004, '123'),
(15, '2500', 'Other Bank', 50000, '2024-12-17', 10000004, '12'),
(17, '12', 'Other Bank', 123, '2024-12-17', 10000004, '123'),
(18, '10000', 'Other Bank', 1, '2024-12-17', 10000004, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_nasabah` int(10) NOT NULL,
  `nama_nasabah` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_profile` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `foto_idnumber` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_nasabah`, `nama_nasabah`, `email`, `alamat`, `nomor_telepon`, `tanggal_lahir`, `password`, `foto_profile`, `id_number`, `foto_idnumber`, `created_at`, `updated_at`) VALUES
(6, '123456r', 'tes@gmail.com', 'jl ga tau', '123412341234', '2024-12-26', '$2y$12$FlxGTiNeuGZK3/VDLjNwmuWV78Wet3/nne5VnZ3qwNG9nS2hfVqBu', 'gambarProfile/user.png', '1234567890123123', 'ECard (1).png', '2024-12-05 21:13:33', '2024-12-16 22:16:35'),
(8, 'qwerty', 'qwe@gmail.com', 'jl babarsari 2', '12341234123', '2024-12-26', '$2y$12$FwpoXztzpg1QFbOcRobB8.c1ybmIxBcXlwiuwqo0a4L4GKB.t/m9K', 'gambarProfile/shinchan2.jpeg', '1111111111111111', 'MPPL critical.drawio.png', '2024-12-17 00:33:34', '2024-12-17 00:43:12');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`no_peminjaman`),
  ADD KEY `fk_peminjaman_norek` (`nomor_rekening`),
  ADD KEY `fk_peminjaman_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `rekenings`
--
ALTER TABLE `rekenings`
  ADD PRIMARY KEY (`nomor_rekening`),
  ADD KEY `fk_nasabah_rekening` (`id_nasabah`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`no_transfer`),
  ADD KEY `fk_transfer_norek` (`nomor_rekening`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_nasabah`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id_number` (`id_number`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `no_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `rekenings`
--
ALTER TABLE `rekenings`
  MODIFY `nomor_rekening` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000009;

--
-- AUTO_INCREMENT untuk tabel `transfers`
--
ALTER TABLE `transfers`
  MODIFY `no_transfer` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_nasabah` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `fk_peminjaman_norek` FOREIGN KEY (`nomor_rekening`) REFERENCES `rekenings` (`nomor_rekening`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_peminjaman_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawais` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekenings`
--
ALTER TABLE `rekenings`
  ADD CONSTRAINT `fk_nasabah_rekening` FOREIGN KEY (`id_nasabah`) REFERENCES `users` (`id_nasabah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `fk_transfer_norek` FOREIGN KEY (`nomor_rekening`) REFERENCES `rekenings` (`nomor_rekening`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
