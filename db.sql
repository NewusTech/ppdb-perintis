-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table ppdbsmaperintis2.biaya_daftar_ulang
CREATE TABLE IF NOT EXISTS `biaya_daftar_ulang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kelas_id` bigint(20) unsigned NOT NULL,
  `pilihan_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uang_pangkal` int(11) DEFAULT NULL,
  `uang_spp` int(11) DEFAULT NULL,
  `kaos_olahraga` int(11) DEFAULT NULL,
  `bed_lokasi_dll` int(11) DEFAULT NULL,
  `baju_seragam` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `biaya_daftar_ulang_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `biaya_daftar_ulang_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.biaya_daftar_ulang: ~5 rows (approximately)
/*!40000 ALTER TABLE `biaya_daftar_ulang` DISABLE KEYS */;
INSERT INTO `biaya_daftar_ulang` (`id`, `kelas_id`, `pilihan_pembayaran`, `uang_pangkal`, `uang_spp`, `kaos_olahraga`, `bed_lokasi_dll`, `baju_seragam`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Lunas', 3200000, 410000, 150000, 75000, 230000, '2023-03-12 09:52:13', '2023-03-12 09:52:13'),
	(2, 2, 'Lunas', 2500000, 330000, 150000, 75000, 230000, '2023-03-12 09:52:14', '2023-03-12 09:52:14'),
	(3, 2, 'Angsuran', 1500000, 330000, 150000, 75000, 230000, '2023-03-12 09:52:14', '2023-03-12 09:52:14'),
	(4, 3, 'Lunas', 2400000, 280000, 150000, 75000, 230000, '2023-03-12 09:52:14', '2023-03-12 09:52:14'),
	(5, 3, 'Angsuran', 1400000, 280000, 150000, 75000, 230000, '2023-03-12 09:52:14', '2023-03-12 09:52:14'),
	(8, 1, 'Angsuran', 700, 700, 700, 700, 7000, '2023-05-25 17:32:12', '2023-05-25 17:32:12'),
	(9, 1, 'Lunas', 3200000, 300000, 150000, 75000, 230000, '2023-05-25 18:12:57', '2023-05-25 18:12:57');
/*!40000 ALTER TABLE `biaya_daftar_ulang` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.kelas
CREATE TABLE IF NOT EXISTS `kelas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jenis_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya_pendaftaran` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.kelas: ~3 rows (approximately)
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` (`id`, `jenis_kelas`, `biaya_pendaftaran`, `created_at`, `updated_at`) VALUES
	(1, 'Executive', 120000, '2023-03-12 09:52:13', '2023-03-12 09:52:13'),
	(2, 'Regular AC', 100000, '2023-03-12 09:52:13', '2023-03-12 09:52:13'),
	(3, 'Regular Non AC', 100000, '2023-03-12 09:52:13', '2023-03-12 09:52:13');
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.migrations: ~11 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2022_02_08_171410_create_sessions_table', 1),
	(7, '2022_02_09_032205_create_permission_tables', 1),
	(8, '2022_02_11_145631_create_kelas_table', 1),
	(9, '2022_02_11_152144_create_biaya_daftar_ulang_table', 1),
	(10, '2022_02_11_152747_create_pendaftaran_table', 1),
	(11, '2022_03_01_145034_create_tata_tertib_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.model_has_roles: ~9 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 2),
	(3, 'App\\Models\\User', 3),
	(4, 'App\\Models\\User', 4),
	(5, 'App\\Models\\User', 5),
	(6, 'App\\Models\\User', 6),
	(7, 'App\\Models\\User', 7),
	(7, 'App\\Models\\User', 8),
	(7, 'App\\Models\\User', 9);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.pendaftaran
CREATE TABLE IF NOT EXISTS `pendaftaran` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `no_pendaftaran` int(11) NOT NULL,
  `kelas_id` bigint(20) unsigned NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_panggilan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` bigint(20) DEFAULT NULL,
  `kewarganegaraan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anak_ke` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dari_bersaudara` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_dalam_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_saudara_kandung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bahasa_sehari_hari` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_asal_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_ijazah` int(11) DEFAULT NULL,
  `tahun_ijazah` int(11) DEFAULT NULL,
  `no_skhu` int(11) DEFAULT NULL,
  `tahun_skhu` int(11) DEFAULT NULL,
  `no_hp_siswa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_tersebut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan_darah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penyakit_yang_pernah_diderita` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelainan_jasmani` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinggi_berat_badan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir_ayah` date DEFAULT NULL,
  `penghasilan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir_ibu` date DEFAULT NULL,
  `penghasilan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_orang_tua` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_orang_tua` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir_wali` date DEFAULT NULL,
  `alamat_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_hubungan_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penghasilan_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kesenian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `olahraga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lain_lain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `angsuran` tinyint(4) DEFAULT NULL,
  `lunas` tinyint(4) DEFAULT NULL,
  `status_pengisian_formulir` tinyint(4) DEFAULT NULL,
  `status_wawancara` tinyint(4) DEFAULT NULL,
  `status_daftar_ulang` tinyint(4) DEFAULT NULL,
  `status_pengisian_biodata` tinyint(4) DEFAULT NULL,
  `status_verifikasi` tinyint(4) DEFAULT NULL,
  `lolos_verifikasi` tinyint(4) DEFAULT NULL,
  `foto` mediumtext COLLATE utf8mb4_unicode_ci,
  `formulir_pendaftaran` mediumtext COLLATE utf8mb4_unicode_ci,
  `pernyataan_siswa_baru` mediumtext COLLATE utf8mb4_unicode_ci,
  `lembar_perjanjian` mediumtext COLLATE utf8mb4_unicode_ci,
  `kwitansi_angsuran` mediumtext COLLATE utf8mb4_unicode_ci,
  `kwitansi_lunas` mediumtext COLLATE utf8mb4_unicode_ci,
  `biaya_daftar_ulang_id` longtext COLLATE utf8mb4_unicode_ci,
  `biodata` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendaftaran_user_id_foreign` (`user_id`),
  KEY `pendaftaran_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `pendaftaran_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  CONSTRAINT `pendaftaran_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.pendaftaran: ~3 rows (approximately)
/*!40000 ALTER TABLE `pendaftaran` DISABLE KEYS */;
INSERT INTO `pendaftaran` (`id`, `user_id`, `no_pendaftaran`, `kelas_id`, `jurusan`, `catatan`, `nama_panggilan`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `nik`, `kewarganegaraan`, `anak_ke`, `dari_bersaudara`, `status_dalam_keluarga`, `jumlah_saudara_kandung`, `bahasa_sehari_hari`, `asal_sekolah`, `alamat_asal_sekolah`, `no_ijazah`, `tahun_ijazah`, `no_skhu`, `tahun_skhu`, `no_hp_siswa`, `alamat_lengkap`, `alamat_tersebut`, `golongan_darah`, `penyakit_yang_pernah_diderita`, `kelainan_jasmani`, `tinggi_berat_badan`, `nama_ayah`, `pekerjaan_ayah`, `tempat_lahir_ayah`, `tanggal_lahir_ayah`, `penghasilan_ayah`, `nama_ibu`, `pekerjaan_ibu`, `tempat_lahir_ibu`, `tanggal_lahir_ibu`, `penghasilan_ibu`, `alamat_orang_tua`, `no_hp_orang_tua`, `nama_wali`, `pekerjaan_wali`, `tempat_lahir_wali`, `tanggal_lahir_wali`, `alamat_wali`, `no_hp_wali`, `agama_wali`, `status_hubungan_wali`, `penghasilan_wali`, `kesenian`, `olahraga`, `organisasi`, `lain_lain`, `angsuran`, `lunas`, `status_pengisian_formulir`, `status_wawancara`, `status_daftar_ulang`, `status_pengisian_biodata`, `status_verifikasi`, `lolos_verifikasi`, `foto`, `formulir_pendaftaran`, `pernyataan_siswa_baru`, `lembar_perjanjian`, `kwitansi_angsuran`, `kwitansi_lunas`, `biaya_daftar_ulang_id`, `biodata`, `created_at`, `updated_at`) VALUES
	(1, 7, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-10 21:37:17', '2023-05-10 21:37:17'),
	(2, 8, 2, 1, 'IPA', 'Terima', 'toni', 'L', 'Bandar Lampung', '1990-07-18', 'Islam', 11111111111111111, 'Indonesia', '3', '3', 'Anak Kandung', '3', 'Indonesia', 'KOTABUMI', 'Perumahan Griya Antasari Permai blok i8', NULL, NULL, NULL, NULL, '+6285279737868', 'Perum griya antasari permai blok i8', 'Rumah Orang Tua', 'A', 'tidak ada', 'tidak ada', '170', 'UMAR', 'KONSULTAN', 'Kotabumi', '1967-07-18', 'F', 'YULIANA', 'IBU RUMAH TANGGA', 'Kotabumin', '1970-09-19', 'D', 'Perum griya antasari permai blok i8', '+6285279737868', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bagus', 'Suka', 'OSIS', 'Les bahasa ingris', 0, 1, 1, 1, 1, 1, 1, 1, 'berkas/2/MtD68xmBhNgxkNkxWApUevsXnp04IAkkauhn9DAK.jpg', 'berkas/2/Formulir Pendaftaran ANTONI.pdf', 'berkas/2/Surat Pernyataan Siswa Baru ANTONI.pdf', 'berkas/2/Lembar Perjanjian ANTONI.pdf', 'berkas/2/Kwitansi Angsuran ANTONI.pdf', 'berkas/2/Kwitansi Lunas ANTONI.pdf', '[{"id":8,"kaos_olahraga":700,"bed_lokasi_dll":700,"baju_seragam":7000,"uang_pangkal":700,"uang_spp":700,"kelas_id":1,"pilihan_pembayaran":"Angsuran","date":"25-05-2023","kwitansi":"berkas\\/2\\/Kwitansi Angsuran ANTONI-8.pdf"},{"id":9,"kaos_olahraga":150000,"bed_lokasi_dll":75000,"baju_seragam":230000,"uang_pangkal":3200000,"uang_spp":300000,"kelas_id":1,"pilihan_pembayaran":"Lunas","date":"25-05-2023","kwitansi":"berkas\\/2\\/Kwitansi Lunas ANTONI-9.pdf"}]', NULL, '2023-05-22 18:50:51', '2023-05-25 19:21:34'),
	(3, 9, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-22 20:16:12', '2023-05-22 20:16:12');
/*!40000 ALTER TABLE `pendaftaran` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.roles: ~7 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'super admin', 'web', '2023-03-12 09:52:14', '2023-03-12 09:52:14'),
	(2, 'pimpinan', 'web', '2023-03-12 09:52:14', '2023-03-12 09:52:14'),
	(3, 'admin pendaftaran awal', 'web', '2023-03-12 09:52:14', '2023-03-12 09:52:14'),
	(4, 'admin wawancara', 'web', '2023-03-12 09:52:14', '2023-03-12 09:52:14'),
	(5, 'admin daftar ulang', 'web', '2023-03-12 09:52:14', '2023-03-12 09:52:14'),
	(6, 'admin verifikasi', 'web', '2023-03-12 09:52:14', '2023-03-12 09:52:14'),
	(7, 'siswa', 'web', '2023-03-12 09:52:14', '2023-03-12 09:52:14');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.role_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.sessions: ~12 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('RY8VlfDRtnUIn906TfT41WPs0KJVG32MwEU8qZxP', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiNms3SXkxckxBSThqbjVoWXhYeGhRdlJ6NDhxc0FCcHZyd01YcjBFciI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJFB0dzNxMzQ3TXNLS0hOeUdoV0JJaHVrcTNVRTkwS1Q0cVFYeVZGRTg5Q0F3YjU2aXg0SUQuIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRQdHczcTM0N01zS0tITnlHaFdCSWh1a3EzVUU5MEtUNHFRWHlWRkU4OUNBd2I1Nml4NElELiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC93YXdhbmNhcmEvMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1685017528);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.tata_tertib
CREATE TABLE IF NOT EXISTS `tata_tertib` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `path` mediumtext COLLATE utf8mb4_unicode_ci,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.tata_tertib: ~2 rows (approximately)
/*!40000 ALTER TABLE `tata_tertib` DISABLE KEYS */;
INSERT INTO `tata_tertib` (`id`, `path`, `desc`, `created_at`, `updated_at`) VALUES
	(1, 'files/TATA TERTIB SMA PERINTIS 2 BANDAR LAMPUNG.pdf', NULL, '2023-03-12 09:52:17', '2023-03-12 09:52:17'),
	(2, NULL, '<ol style="list-style-type:upper-alpha;"><li>Mematuhi dan mentaati semua peraturan yang telah disepakati dan ditetapkan bersama antara siswa dan pihak sekolah (SMA Perintis 2 Bandar Lampung).</li><li>Mengawasi tingkah laku dan perbuatan anak saya diluar sekolah serta membimbingnya demi keberhasilan studinya di SMA Perintis 2 Bandar Lampung.</li><li>Menerima dengan segala sangki yang dikenakan kepada anak saya bila ternyata anak saya melanggar peraturan/tata tertib sekolah, antara lain :<ol><li>Diskorsing apabila berkelahi dengan sesama siswa SMA Perintis 2 Bandar Lampung baik di dalam maupun di luar sekolah (perkelahian pertama).&nbsp; Dan siswa yang bersangkutan wajib apel kepada wali kelas /BK/wakil&nbsp;Kepala&nbsp;sekolah bidang kesiswaan.</li><li>Dikembalikan kepada orang tua/dikeluarkan dari SMA Perintis 2 Bandar Lampung apabila mengulangi perbuatan pada poin 1 (perkelahian ke 2)</li><li>Bersedia pindah/dikeluarkan dari sekolah apabila jumlah alpa (tanpa keterangan) sebanyak 30 hari dalam 1 semester.</li><li>Tidak naik kelas apabila dalam satu tahun&nbsp;tidak mengerjakan tugas dan alpa (tanpa keterangan) lebih dari 30 hari</li><li>Diskorsing selama satu minggu apabila diketahui <strong>membawa senjata tajam</strong> (yang pertama), dikembalikan ke orang tua/dikeluarkan(membawa senjata tajam yang kedua).</li><li>Dikeluarkan dari SMA Perintis 2 Bandar Lampung apabila terbukti <strong>mengedarkan dan membawa dan menggunakan,menyimpan Narkoba/minuman keras dan tersangkut masalah Hukum ( Hukum Pidana )</strong></li><li>Siswa diberi pembinaan jika <strong>melawan guru&nbsp;</strong>dan diskorsing/dikeluarkan jika mengulang.</li><li>Diskorsing selama satu minggu apabila terbukti mengedarkan dan <strong>membawa gambar porno</strong> di dalam HP, apabila di ulangi HP di sita dan dikembalikan pada saat kenaikan kelas.</li><li>Orang Tua akan dipanggil ke sekolah apabila siswa terbukti merokok di lingkungan sekolah</li><li>Tidak diperbolehkan membawa HP berkamera, tablet dan lain-lain yang tidak ada hubungan degan pelajaran.</li><li>Membersihkan lingkungan sekolah/ tugas lain apabila terbukti tidak berpakaian seragam lengkap/baju tidak dimasukkan/sepatu tidak sesuai dengan aturan yang ditetapkan.</li><li>Tidak diperkenankan masuk kelas (jam pertama) apabila terlambat dari 15 menit.</li><li>Diskorsing selama 3 hari jika terbukti <strong>membolos pada jam belajar(wajib apel</strong>).</li><li>Diberi sanksi tugas lain bila terlambat lebih dari 15 menit.</li><li>Siswa satu kelas&nbsp;bertanggungjawab untuk membersihkan/mengcat meja-kursi yang dicoret-coret.</li><li>Dilarang makan-minum dalam kelas, bila melanggar sanksi membersihkan/menyapu kelas pada akhir pelajaran.</li><li>Sepatu warna hitam, apabila tidak berwarna hitam maka akan disita, disita pertama dikembalikan, disita kedua dengan panggilan orang tua, disita ketiga tidak bisa diambil lagi.</li><li>Sepatu yang dipakai dan diinjak bagian belakang/sepatu sandal/warna mencolok disita sekolah dan harus diambil oleh orang tua/wali.</li><li>Selain topi sekolah (OSIS) yang dipakai dilingkungan sekolah disita dan diambil oleh orang tua/wali.</li><li>Tidak menggunakan bed/lokasi, harus membeli di koperasi dan dipasng hari itu juga oleh siswa.</li><li>Gelang, kalung, anting/atribut yang tidak sesuai untuk keperluan sekolah, disita dan tidak dikemablikan(khusus pria).</li><li>Diskorsing satu minggu bila terbukti melakukan perbuatan yang mengandung unsur judi dan dikeluarkan dari sekolah bila masih mengulangi perbuatan ketiga kalinya.</li><li>Tidak diperkenankan membuat gambar/tato di anggota tubuh baik buatan maupun permanen, jika melanggar akan diproses melalui panggilan orang tua / wali.</li><li>Tidak diperbolehkan berambut Gondrong ( Bagi Laki-laki ) dan diberi warna ( Bagi Perempuan ). Bermake up dan tidak mempergunakan perhiasan yang berlebihan.</li></ol></li></ol>', '2023-03-12 09:52:17', '2023-03-12 09:52:17');
/*!40000 ALTER TABLE `tata_tertib` ENABLE KEYS */;

-- Dumping structure for table ppdbsmaperintis2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ppdbsmaperintis2.users: ~9 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `token`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
	(1, 'Superadmin', 'superadmin', 'superadmin@email.com', '2023-03-12 09:52:15', NULL, '$2y$10$Ptw3q347MsKKHNyGhWBIhukq3UE90KT4qQXyVFE89CAwb56ix4ID.', NULL, NULL, 'HQ1ohQFOVhKr5gMEp6r8Lp7k9O4IditVNtO0unWy3NtAK6wvph5mOVd1LThx', NULL, NULL, '2023-03-12 09:52:15', '2023-03-12 09:52:15'),
	(2, 'Pimpinan', 'pimpinan', 'pimpinan@email.com', '2023-03-12 09:52:15', NULL, '$2y$10$skKlHd5Ay0XTlIhuaxDCs.LOH6qwceaV14Vwwfy6NqgsU.1NucUlu', NULL, NULL, NULL, NULL, NULL, '2023-03-12 09:52:15', '2023-05-23 09:05:26'),
	(3, 'Admin Pendaftaran Awal', 'admin-pendaftaran-awal', 'admin1@email.com', '2023-03-12 09:52:15', NULL, '$2y$10$S5ocrAkIMMQx/o3G4j0SLeCBvG0Rfs1fFyLFaNEGxiE4sdfmKOdtK', NULL, NULL, NULL, NULL, NULL, '2023-03-12 09:52:15', '2023-03-12 09:52:15'),
	(4, 'Admin Wawancara', 'admin-wawancara', 'admin2@email.com', '2023-03-12 09:52:16', NULL, '$2y$10$LmfJYE2VimhxCi67lCGHDuwYQKxzUrwk4iY2YLj1R2kfd8aP31unu', NULL, NULL, NULL, NULL, NULL, '2023-03-12 09:52:16', '2023-03-12 09:52:16'),
	(5, 'Admin Daftar Ulang', 'admin-daftar-ulang', 'admin3@email.com', '2023-03-12 09:52:16', NULL, '$2y$10$G3H3Oh2v.q56gE/VXaqPC.qiOPVJnKQMdxO4jezw4xKy8p9FBYYW2', NULL, NULL, NULL, NULL, NULL, '2023-03-12 09:52:16', '2023-03-12 09:52:16'),
	(6, 'Admin Verifikasi', 'admin-verifikasi', 'admin4@email.com', '2023-03-12 09:52:17', NULL, '$2y$10$.3WlOlS300aUKgmtOX6r2uuovaytmYNM2EuESBXW/1R6rHMLzTzc6', NULL, NULL, NULL, NULL, NULL, '2023-03-12 09:52:17', '2023-03-12 09:52:17'),
	(7, 'TRI HASTUTI WIBOWO', '123456', NULL, NULL, 'GRGIY', '$2y$10$syDNFKAQJnExMDExKX5L/u7ZSMggtRW99u/EYr.0PEP6jHHxHPVyG', NULL, NULL, NULL, NULL, NULL, '2023-05-10 21:37:16', '2023-05-10 21:37:16'),
	(8, 'ANTONI', '115080068', NULL, NULL, 'JCWUU', '$2y$10$ZyDK6w86kzKIaBCQKuyWaOyYSeYKwdhlQDm9U144CPDdshZIqivtW', NULL, NULL, NULL, NULL, NULL, '2023-05-22 18:50:50', '2023-05-22 18:58:35'),
	(9, 'DIKI', '333333', NULL, NULL, 'YGKIP', '$2y$10$ejgxxI0mCV4JvuMDloRilem91pK.RF0xg9eceKtPQOveXqlRetx32', NULL, NULL, NULL, NULL, NULL, '2023-05-22 20:16:12', '2023-05-22 20:16:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
