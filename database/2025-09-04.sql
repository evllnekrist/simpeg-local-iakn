-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               9.1.0 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for simpeg_local
CREATE DATABASE IF NOT EXISTS `simpeg_local` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `simpeg_local`;

-- Dumping structure for table simpeg_local.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.cache: ~0 rows (approximately)

-- Dumping structure for table simpeg_local.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.cache_locks: ~0 rows (approximately)

-- Dumping structure for table simpeg_local.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table simpeg_local.jabatan
CREATE TABLE IF NOT EXISTS `jabatan` (
  `kode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.jabatan: ~19 rows (approximately)
INSERT INTO `jabatan` (`kode`, `nama`, `kategori`) VALUES
	('1520', 'Pranata Hubungan Masyarakat', 'JFT Kehumasan'),
	('1525', 'Auditor', 'JFT Auditor'),
	('1528', 'Pengembang Teknologi Pembelajaran', 'JFT PTP (Kemendikbud)'),
	('1530', 'Perencana', 'JFT Perencana'),
	('1535', 'Pranata Komputer', 'JFT Pranata Komputer'),
	('1538', 'Arsiparis', 'JFT Arsiparis'),
	('1540', 'Pustakawan', 'JFT Pustakawan'),
	('1561', 'Asisten Ahli', 'JFT Dosen (Ahli Pertama)'),
	('1562', 'Lektor', 'JFT Dosen (Ahli Muda)'),
	('1563', 'Lektor Kepala', 'JFT Dosen (Ahli Madya)'),
	('5202', 'Analis Kebijakan', 'JFT Analis Kebijakan'),
	('5210', 'Analis SDM Aparatur', 'JFT Analis SDM'),
	('5240', 'Analis Pengelola Keuangan APBN', 'JFT Keuangan APBN'),
	('C-1561', 'Calon Dosen Asisten Ahli', 'CPNS (Menuju JFT Ahli Pertama)'),
	('KABAG-ULA', 'Kepala Bagian Umum dan Layanan Akademik', 'Jabatan Struktural (Administrator)'),
	('KARO-KAUAK', 'Kepala Biro Administrasi Umum, Akademik, dan Kemahasiswaan', 'Jabatan Struktural (JPT Pratama)'),
	('operator_layanan_operasional', 'Operator Layanan Operasional', 'Jabatan Pelaksana Umum'),
	('penata_layanan_operasional', 'Penata Layanan Operasional', 'Jabatan Pelaksana Umum'),
	('pengelola_layanan_operasional', 'Pengelola Layanan Operasional', 'Jabatan Pelaksana Umum');

-- Dumping structure for table simpeg_local.jenis_jabatan
CREATE TABLE IF NOT EXISTS `jenis_jabatan` (
  `kode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.jenis_jabatan: ~12 rows (approximately)
INSERT INTO `jenis_jabatan` (`kode`, `nama`, `keterangan`) VALUES
	('1', 'JPT Madya', 'Jabatan Pimpinan Tinggi (JPT) Madya'),
	('2', 'JPT Pratama', 'Jabatan Pimpinan Tinggi Pratama'),
	('3', 'Administrator', 'Jabatan Administrator'),
	('4', 'Pengawas', 'Jabatan Pengawas'),
	('5', 'JF Ahli Madya', 'Jabatan Fungsional Ahli Madya'),
	('6', 'JF Ahli Muda', 'Jabatan Fungsional Ahli Muda'),
	('7', 'JF Ahli Pertama', 'Jabatan Fungsional Ahli Pertama'),
	('8', 'JF Terampil (Pelaksana/Analis)', 'Jabatan Fungsional Terampil/Pelaksana'),
	('91', 'CPNS Calon Dosen', 'CPNS untuk JFT Dosen (sementara)'),
	('92', 'JFT Dosen (Ahli Pertama – Madya)', 'Jabatan Fungsional Tertentu (Dosen)'),
	('93', 'CPNS Calon JF Ahli Pertama', 'CPNS calon JF umum (bukan hanya dosen)'),
	('99', 'Pelaksana (Non-JF)', 'Jabatan Pelaksana Umum (non fungsional)');

-- Dumping structure for table simpeg_local.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.jobs: ~0 rows (approximately)

-- Dumping structure for table simpeg_local.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.job_batches: ~0 rows (approximately)

-- Dumping structure for table simpeg_local.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `request` json DEFAULT NULL,
  `response` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logs_created_by_foreign` (`created_by`),
  CONSTRAINT `logs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.logs: ~32 rows (approximately)
INSERT INTO `logs` (`id`, `subject`, `description`, `request`, `response`, `created_at`, `created_by`) VALUES
	(1, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-07-03 01:21:23', 1),
	(2, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-07-03 07:39:34', 1),
	(3, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-07-03 07:39:46', 1),
	(4, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-07-07 07:40:46', 1),
	(5, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-07-08 08:06:32', 1),
	(6, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-07-08 08:19:59', 1),
	(7, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-07-09 02:25:24', 1),
	(8, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-07-09 07:53:17', 1),
	(9, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-07-10 02:17:30', 1),
	(10, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-07-10 08:14:47', 1),
	(11, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-07-23 10:16:42', 1),
	(12, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-07-23 10:20:10', 1),
	(13, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-08-04 09:02:27', 1),
	(14, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-08-27 01:53:26', 1),
	(15, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-08-27 07:29:22', 1),
	(16, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-08-28 02:21:14', 1),
	(17, 'Tambah Peran', NULL, '{"name": "Dev Test 2", "is_enabled": "on", "description": "2635284639"}', '{"data": {"output": {"id": 21, "name": "Dev Test 2", "created_at": "2025-08-28T03:06:03.000000Z", "updated_at": "2025-08-28T03:06:03.000000Z", "description": "2635284639"}, "output_img": 1, "output_permission": null}, "status": true, "message": "Berhasil menyimpan data"}', '2025-08-28 03:06:03', NULL),
	(18, 'Tambah Peran', NULL, '{"name": "Dev Test 3", "is_enabled": "on", "description": "....lllkkkjjjj", "menu_action": ["1"]}', '{"data": {"output": {"id": 23, "name": "Dev Test 3", "created_at": "2025-08-28T03:08:39.000000Z", "updated_at": "2025-08-28T03:08:39.000000Z", "description": "....lllkkkjjjj"}, "output_img": 1, "output_permission": {"1": {"id": 7, "role_id": 23, "created_at": "2025-08-28T03:08:39.000000Z", "is_enabled": true, "updated_at": "2025-08-28T03:08:39.000000Z", "menu_action_id": "1"}}}, "status": true, "message": "Berhasil menyimpan data"}', '2025-08-28 03:08:39', NULL),
	(19, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-08-28 03:55:00', 1),
	(20, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-08-28 03:58:49', 1),
	(21, 'Tambah Peran', NULL, '{"name": "Readonly", "is_enabled": "on", "description": "....fy", "menu_action": ["1", "2", "3", "4", "5", "6"]}', '{"data": {"output": {"id": 25, "name": "Readonly", "created_at": "2025-08-28T04:07:20.000000Z", "updated_at": "2025-08-28T04:07:20.000000Z", "description": "....fy"}, "output_img": 1, "output_permission": {"1": {"id": 8, "role_id": 25, "created_at": "2025-08-28T04:07:20.000000Z", "is_enabled": true, "updated_at": "2025-08-28T04:07:20.000000Z", "menu_action_id": "1"}, "2": {"id": 9, "role_id": 25, "created_at": "2025-08-28T04:07:20.000000Z", "is_enabled": true, "updated_at": "2025-08-28T04:07:20.000000Z", "menu_action_id": "2"}, "3": {"id": 10, "role_id": 25, "created_at": "2025-08-28T04:07:20.000000Z", "is_enabled": true, "updated_at": "2025-08-28T04:07:20.000000Z", "menu_action_id": "3"}, "4": {"id": 11, "role_id": 25, "created_at": "2025-08-28T04:07:20.000000Z", "is_enabled": true, "updated_at": "2025-08-28T04:07:20.000000Z", "menu_action_id": "4"}, "5": {"id": 12, "role_id": 25, "created_at": "2025-08-28T04:07:20.000000Z", "is_enabled": true, "updated_at": "2025-08-28T04:07:20.000000Z", "menu_action_id": "5"}, "6": {"id": 13, "role_id": 25, "created_at": "2025-08-28T04:07:20.000000Z", "is_enabled": true, "updated_at": "2025-08-28T04:07:20.000000Z", "menu_action_id": "6"}}}, "status": true, "message": "Berhasil menyimpan data"}', '2025-08-28 04:07:20', NULL),
	(22, 'Tambah Peran', NULL, '{"name": "Readonly 2", "is_enabled": "on", "description": "123", "menu_action": ["5"]}', '{"data": {"output": {"id": 26, "name": "Readonly 2", "created_at": "2025-08-28T04:08:32.000000Z", "updated_at": "2025-08-28T04:08:32.000000Z", "description": "123"}, "output_img": 1, "output_permission": {"5": {"id": 14, "role_id": 26, "created_at": "2025-08-28T04:08:32.000000Z", "is_enabled": true, "updated_at": "2025-08-28T04:08:32.000000Z", "menu_action_id": "5"}}}, "status": true, "message": "Berhasil menyimpan data"}', '2025-08-28 04:08:32', NULL),
	(23, 'Edit Peran', NULL, '{"id": "23", "name": "Dev Test 3", "description": "....lllkkkjjjj", "menu_action": ["1", "6"]}', '{"data": {"id": "23", "data": {"name": "Dev Test 3", "updated_by": 1, "description": "....lllkkkjjjj"}, "output": 1}, "status": true, "message": "Berhasil mengubah data"}', '2025-08-28 04:17:03', 1),
	(24, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-08-28 07:20:36', 1),
	(25, 'Edit Peran', NULL, '{"name": "admin7", "is_enabled": "on", "description": "Development Admin", "menu_action": ["1", "7", "12", "17", "2", "8", "13", "18", "3", "9", "14", "19", "4", "10", "15", "20", "22", "23", "5", "11", "16", "21", "24", "25", "6"]}', '{"data": {"id": "2", "data": {"name": "admin7", "is_enabled": "on", "updated_by": 1, "description": "Development Admin"}, "output": 1}, "status": true, "message": "Berhasil mengubah data"}', '2025-08-28 07:25:47', 1),
	(26, 'Edit Peran', NULL, '{"name": "admin7", "is_enabled": "on", "description": "Development Admin", "menu_action": ["1", "7", "12", "17", "2", "8", "13", "18", "3", "9", "14", "19", "4", "10", "15", "20", "22", "23", "5", "11", "16", "21", "24", "25", "6"]}', '{"data": {"id": "2", "data": {"name": "admin7", "is_enabled": "on", "updated_by": 1, "description": "Development Admin"}, "output": 1}, "status": true, "message": "Berhasil mengubah data"}', '2025-08-28 07:44:23', 1),
	(27, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-08-28 07:52:26', 1),
	(30, 'Hapus Peran', NULL, '21', '{"data": {"id": 21, "name": "Dev Test 2", "created_at": "2025-08-28T03:06:03.000000Z", "created_by": null, "deleted_at": null, "deleted_by": null, "is_enabled": "on", "updated_at": "2025-08-28T03:06:03.000000Z", "updated_by": null, "description": "2635284639"}, "status": true, "message": "Berhasil menghapus data"}', '2025-08-28 08:12:18', NULL),
	(31, 'Hapus Peran', NULL, '16', '{"data": {"id": 16, "name": "Dev Test", "created_at": "2025-08-28T02:51:56.000000Z", "created_by": null, "deleted_at": null, "deleted_by": null, "is_enabled": "on", "updated_at": "2025-08-28T02:51:56.000000Z", "updated_by": null, "description": "2635284639"}, "status": true, "message": "Berhasil menghapus data"}', '2025-08-28 08:12:31', NULL),
	(32, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-09-01 03:41:47', 1),
	(33, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-09-01 06:49:33', 1),
	(34, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-09-04 02:34:42', 1),
	(35, 'Login Berhasil', 'ev.attoff@gmail.com', NULL, NULL, '2025-09-04 07:17:10', 1);

-- Dumping structure for table simpeg_local.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_menu_with_action` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `display_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.menus: ~8 rows (approximately)
INSERT INTO `menus` (`id`, `parent_id`, `name`, `slug`, `icon`, `is_menu_with_action`, `sort_order`, `is_enabled`, `display_type`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, NULL, 'Operasional', NULL, NULL, 0, 0, 1, 'divider-text', NULL, NULL, NULL, NULL, NULL, NULL),
	(2, NULL, 'Pengaturan', '', '', 0, 0, 1, 'divider-text', NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 2, 'Kelola Akses', '/roles', 'scan-face', 1, 1, 1, '', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 2, 'Group Pengguna', '/user-groups', 'component', 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 2, 'Pengguna', '/users', 'smile', 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 1, 'Statistik', '/statistics', 'candlestick-chart', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 1, 'Data Kepegawaian', '/employees', 'building-2', 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 1, 'Log App', '/logs', 'file-clock', 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table simpeg_local.menu_actions
CREATE TABLE IF NOT EXISTS `menu_actions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_actions_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_actions_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.menu_actions: ~25 rows (approximately)
INSERT INTO `menu_actions` (`id`, `menu_id`, `name`, `slug`, `label`, `is_enabled`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 3, 'read-list', '/role', 'Daftar Data', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 4, 'read-list', '/user-group', 'Daftar Data', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 5, 'read-list', '/user', 'Daftar Data', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 6, 'read-list', '/statistic', 'Daftar Data', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 7, 'read-list', '/employee', 'Daftar Data', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 8, 'read-list', '/log', 'Daftar Data', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 3, 'add', '/role', 'Tambah', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 4, 'add', '/user-group', 'Tambah', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 5, 'add', '/user', 'Tambah', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 6, 'add', '/statistic', 'Tambah', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 7, 'add', '/employee', 'Tambah', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 3, 'edit', '/role', 'Edit', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 4, 'edit', '/user-group', 'Edit', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 5, 'edit', '/user', 'Edit', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 6, 'edit', '/statistic', 'Edit', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(16, 7, 'edit', '/employee', 'Edit', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, 3, 'delete', '/role', 'Hapus', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, 4, 'delete', '/user-group', 'Hapus', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, 5, 'delete', '/user', 'Hapus', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(20, 6, 'delete', '/statistic', 'Hapus', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(21, 7, 'delete', '/employee', 'Hapus', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, 6, 'export_csv', '/statistic', 'Ekspor CSV', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, 6, 'export_pdf', '/statistic', 'Ekspor PDF', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, 7, 'export_csv', '/employee', 'Ekspor CSV', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(25, 7, 'export_pdf', '/employee', 'Ekspor PDF', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table simpeg_local.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.migrations: ~19 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_06_24_040826_create_oauth_auth_codes_table', 1),
	(5, '2025_06_24_040827_create_oauth_access_tokens_table', 1),
	(6, '2025_06_24_040828_create_oauth_refresh_tokens_table', 1),
	(7, '2025_06_24_040829_create_oauth_clients_table', 1),
	(8, '2025_06_24_040830_create_oauth_device_codes_table', 1),
	(9, '2025_06_25_015548_create_pegawai_table', 2),
	(10, '2025_06_25_015926_create_pangkat_golongan_table', 2),
	(11, '2025_06_25_020020_create_jenis_jabatan_table', 2),
	(12, '2025_06_25_020119_create_jabatan_table', 2),
	(13, '2025_06_25_020119_create_penempatan_table', 2),
	(14, '2025_07_01_000001_add_extra_fields_to_users_table', 3),
	(15, '2025_07_01_103649_create_user_groups_table', 4),
	(16, '2025_07_01_110609_create_menus_table', 5),
	(17, '2025_07_01_110615_create_menu_actions_table', 6),
	(18, '2025_07_01_110626_create_role_permissions_table', 7),
	(19, '2025_07_01_145604_create_roles_table', 8),
	(20, '2025_07_01_145605_create_role_permissions_table', 9),
	(22, '2025_07_02_150926_create_logs_table', 10),
	(23, '2025_07_03_082313_create_options_table', 11);

-- Dumping structure for table simpeg_local.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.oauth_access_tokens: ~7 rows (approximately)
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('056c53ec539622abf0d047684e60caf6c3eec796332a33da41d84e192eac6bc4b24d2d0755c085e2', 1, '0197a01f-9e8e-73a3-9daf-93413e56fae9', 'auth_token', '[]', 0, '2025-08-28 07:52:26', '2025-08-28 07:52:26', '2026-08-28 14:52:26'),
	('45fc8e94f11ef411a9ce5dfbd89f2526c43ba5f767607f5118a2fca54fda4fbafe6713275dfd5036', 1, '0197a01f-9e8e-73a3-9daf-93413e56fae9', 'auth_token', '[]', 0, '2025-09-04 02:34:45', '2025-09-04 02:34:45', '2026-09-04 09:34:45'),
	('47d0e00ceb9400053bc479704787409456f213994cf3d61af0e4701cae9771604874c5a16d6157ba', 1, '0197a01f-9e8e-73a3-9daf-93413e56fae9', 'auth_token', '[]', 0, '2025-09-01 03:41:49', '2025-09-01 03:41:49', '2026-09-01 10:41:49'),
	('6d180d7aeaaf5bfdaacf0f38b12e7952934a836791ac871b6286914105ab85a67326090c5067c25d', 1, '0197a01f-9e8e-73a3-9daf-93413e56fae9', 'auth_token', '[]', 0, '2025-09-01 06:49:33', '2025-09-01 06:49:33', '2026-09-01 13:49:33'),
	('a1122527d9e9ba7171c46182041c7c1182d1a891284653da8da6292acb6419c0b6d1e6930aaaf388', 1, '0197a01f-9e8e-73a3-9daf-93413e56fae9', 'auth_token', '[]', 0, '2025-08-28 07:20:36', '2025-08-28 07:20:36', '2026-08-28 14:20:36'),
	('b4265f610d55238a9cfce95012d531a075f2d1118af1a97920d20c181fab8982d93bd652fd604205', 1, '0197a01f-9e8e-73a3-9daf-93413e56fae9', 'auth_token', '[]', 0, '2025-09-04 07:17:10', '2025-09-04 07:17:10', '2026-09-04 14:17:10'),
	('d3f4c7927ed8b7eb711d4a7e7a1645da9762e8e832aa0326483da542cb8549647482bb64db6872d0', 1, '0197a01f-9e8e-73a3-9daf-93413e56fae9', 'SimpegLocalIAKN', '[]', 0, '2025-06-30 20:06:34', '2025-06-30 20:06:34', '2026-07-01 03:06:34'),
	('f78c6742e2c93da6b2b5bd46642475a30f9541bb40bfd51beda3725d70058ae98490241b75c950d3', 1, '0197a01f-9e8e-73a3-9daf-93413e56fae9', 'auth_token', '[]', 0, '2025-08-28 03:58:52', '2025-08-28 03:58:52', '2026-08-28 10:58:52');

-- Dumping structure for table simpeg_local.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.oauth_auth_codes: ~0 rows (approximately)

-- Dumping structure for table simpeg_local.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_uris` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `grant_types` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_owner_type_owner_id_index` (`owner_type`,`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.oauth_clients: ~0 rows (approximately)
INSERT INTO `oauth_clients` (`id`, `owner_type`, `owner_id`, `name`, `secret`, `provider`, `redirect_uris`, `grant_types`, `revoked`, `created_at`, `updated_at`) VALUES
	('0197a01f-9e8e-73a3-9daf-93413e56fae9', NULL, NULL, 'SIMPEG LOKAL - IAKN', '$2y$12$JXuOj..W58hY/.ShIdFgKeNwMMGemoX2hRBsbLpT9X/JKhSI0Mt/W', 'users', '[]', '["personal_access"]', 0, '2025-06-23 21:08:36', '2025-06-23 21:08:36');

-- Dumping structure for table simpeg_local.oauth_device_codes
CREATE TABLE IF NOT EXISTS `oauth_device_codes` (
  `id` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_code` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `user_approved_at` datetime DEFAULT NULL,
  `last_polled_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `oauth_device_codes_user_code_unique` (`user_code`),
  KEY `oauth_device_codes_user_id_index` (`user_id`),
  KEY `oauth_device_codes_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.oauth_device_codes: ~0 rows (approximately)

-- Dumping structure for table simpeg_local.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.oauth_refresh_tokens: ~0 rows (approximately)

-- Dumping structure for table simpeg_local.options
CREATE TABLE IF NOT EXISTS `options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `img_main` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.options: ~15 rows (approximately)
INSERT INTO `options` (`id`, `type`, `value`, `value2`, `label`, `description`, `img_main`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'STATUS_PEGAWAI', 'aktif', NULL, 'Aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'STATUS_PEGAWAI', 'tugas belajar', NULL, 'Tugas Belajar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'JENIS_PEGAWAI', 'administrasi', NULL, 'Administrasi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'JENIS_PEGAWAI', 'dosen', NULL, 'Dosen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 'JENIS_PEGAWAI', 'honorer', NULL, 'Honorer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 'STATUS_KEPEGAWAIAN', 'pns', NULL, 'PNS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 'STATUS_KEPEGAWAIAN', 'pppk', NULL, 'PPPK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 'STATUS_KEPEGAWAIAN', 'honorer', NULL, 'Honorer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 'JENIS_KELAMIN', 'p', NULL, 'Perempuan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 'JENIS_KELAMIN', 'l', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 'STATUS_PERKAWINAN', 'kawin', NULL, 'Kawin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 'STATUS_PERKAWINAN', 'belum_kawin', NULL, 'Belum Kawin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 'AGAMA', 'islam', NULL, 'Islam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 'AGAMA', 'kristen', NULL, 'Kristen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 'AGAMA', 'hindu', NULL, 'Hindu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table simpeg_local.pangkat_golongan
CREATE TABLE IF NOT EXISTS `pangkat_golongan` (
  `combined` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruang` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`golongan`,`ruang`,`combined`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.pangkat_golongan: ~19 rows (approximately)
INSERT INTO `pangkat_golongan` (`combined`, `golongan`, `ruang`, `pangkat`) VALUES
	('II.b', 'II', 'b', 'Pengatur Muda Tk. I'),
	('II.c', 'II', 'c', 'Pengatur'),
	('II.d', 'II', 'd', 'Pengatur Tk. I'),
	('III.a', 'III', 'a', 'Penata Muda'),
	('III.b', 'III', 'b', 'Penata Muda Tk. I'),
	('III.c', 'III', 'c', 'Penata'),
	('III.d', 'III', 'd', 'Penata Tk. I'),
	('IV.a', 'IV', 'a', 'Pembina'),
	('IV.b', 'IV', 'b', 'Pembina Tk. I'),
	('IV.c', 'IV', 'c', 'Pembina Utama Muda'),
	('IV.d', 'IV', 'd', 'Pembina Utama Madya'),
	('IV.e', 'IV', 'e', 'Pembina Utama'),
	('IX', 'IX', '', 'IX'),
	('V', 'V', '', 'V'),
	('VI', 'VI', '', 'VI'),
	('VII', 'VII', '', 'VII'),
	('X', 'X', '', 'X'),
	('XI', 'XI', '', 'XI'),
	('XII', 'XII', '', 'XII');

-- Dumping structure for table simpeg_local.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table simpeg_local.pegawai
CREATE TABLE IF NOT EXISTS `pegawai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_perkawinan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `kelurahan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kabupaten` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_pegawai` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_kepegawaian` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan_ruang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas_jabatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_jabatan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_terakhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan_terakhir` text COLLATE utf8mb4_unicode_ci,
  `penempatan` int DEFAULT NULL,
  `nip_atasan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmt_nip` date DEFAULT NULL,
  `tmt` date DEFAULT NULL,
  `karpeg` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `karis` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kpe` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taspen` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nuptk` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nidn` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rekening` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_rekening` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.pegawai: ~152 rows (approximately)
INSERT INTO `pegawai` (`id`, `status`, `nip`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_perkawinan`, `hp`, `email`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `jenis_pegawai`, `status_kepegawaian`, `golongan_ruang`, `kelas_jabatan`, `jenis_jabatan`, `jabatan`, `pendidikan_terakhir`, `jabatan_terakhir`, `penempatan`, `nip_atasan`, `tmt_nip`, `tmt`, `karpeg`, `karis`, `kpe`, `taspen`, `npwp`, `nuptk`, `nidn`, `no_rekening`, `bank_rekening`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'aktif', '197006262005012004', '6271036606700003', 'Telhalia, M.Th., D.Th', 'Palangka Raya', '1970-06-26', 'p', 'kristen', NULL, '081250846726', 'Telhalia70@gmail.com', 'Jl. G.Obos XIV No. 138b', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'IV.b', '13', '92', '1563', 'S3', 'Rektor', 37, '', '2005-01-01', '2024-06-01', NULL, NULL, NULL, NULL, '683243752711000', NULL, '2026067002', '024301009674501', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'aktif', '197702262006042001', '6271046602770002', 'Dr. Prasetiawati, M.Th', 'Tumbang Habaon', '1977-02-26', 'p', 'kristen', NULL, '085246903260', 'Prasetiawati77@gmail.com', 'Jl. RTA. Milono KM.8,5, Komplek Kereng Indah Permai II No 13 Kel Sabaru, Kec Sebangau', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'IV.a', '13', '92', '1563', 'S3', 'Wakil Rektor Bidang Akademik, Kemahasiswaan, Kelembagaan dan Kerja sama', 13, '19700626 200501 2 00', '2006-04-01', '2024-12-01', NULL, NULL, NULL, NULL, '683243802711000', NULL, '2026027701', '024301035019509', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'aktif', '197306212006042001', '6271036106730004', 'Tirta Susila, D.Th', 'Palangka Raya', '1973-06-21', 'p', 'kristen', NULL, '085249331930', 'tirtasusila@yahoo.co.id', 'Jl. Yogyakarta Komp. Betang Griya Blok A No. 36', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '13', '92', '1563', 'S3', 'Wakil Rektor Bidang Administrasi Umum, Perencanaan dan Keuangan', 37, '19700626 200501 2 00', '2006-04-01', '2024-04-01', NULL, NULL, NULL, NULL, '142791599711000', NULL, '2021067302', '024301045809504', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'aktif', '196711161989031004', '3175081611670003', 'Dr. Suwarsono S.PAK., M.M', 'Gunung Kidul', '1967-11-16', 'l', 'kristen', NULL, '081310803725', 'suwarsonowarnomartoyo@gmail.com', 'Jl. Tampung Penyang', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'IV.c', '14', '2', 'UNKNOWN', 'S3', 'Kepala Biro Administrasi Umum, Akademik dan Kemahasiswaan', 4, '19700626 200501 2 00', '1989-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '497491084005000', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 'aktif', '196807052006041002', '6271040507680002', 'Suprianto, S.PAK.', 'Aruk,Kapuas', '1968-07-05', 'l', 'kristen', NULL, '08125153246', 'suprianto.staknpky@gmail.com', 'Jl. Panenga Raya VII', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'IV.a', '11', '99', 'UNKNOWN', 'S1', '', 2, '19700626 200501 2 02', '2006-04-01', '2021-04-01', NULL, NULL, NULL, NULL, '142790773711000', NULL, '', '024301045614501', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 'aktif', '197705052008011018', '7318050505770006', 'Dr. Maidiantius Tanyid, M.Th', 'Makassar', '1977-05-05', 'l', 'kristen', NULL, '082271488811', 'tanyid@gmail.com', 'Jl. Buntu Pantan Tana Toraja', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'IV.b', '13', '92', '1563', 'S3', 'Direktur Pascasarjana', 37, '19641102 200003 2 01', '2008-01-01', '2024-06-01', NULL, NULL, NULL, NULL, '', NULL, '2205057701', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 'aktif', '197606152023211011', '6171031506760012', 'Urbanus, M.Th ', 'Kab. Sintang', '1976-06-15', 'l', 'kristen', NULL, '085252539090', 'urbanusdaud@gmail.com', 'JL. Kesehatan Komplek Sehat Sejahtera No. A3, Kel. Kota Baru, Kec. Pontianak Selatan', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', 'Pelaksana Tugas Wakil Direktur Pascasarjana', 6, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '15.388.046.3-701.000', NULL, '2315067601', '56901006420509', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 'aktif', '197402202006042001', '6271016002740002', 'Dr. Rina Teriasi, S.Th., M.Si.', 'Kasongan', '1974-02-20', 'p', 'kristen', NULL, '081349202152', 'rinateriasi@gmail.com', 'Jl.Manunggal IV No.73, Kel. Langkai, Kec. Pahandut', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '13', '92', '1563', 'S3', 'Dekan Fakultas Keguruan dan Ilmu Pendidikan Kristen', 9, '19700626 200501 2 00', '2006-04-01', '2020-10-01', NULL, NULL, NULL, NULL, '688071323711000', NULL, '2220027401', '024301035229502', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 'aktif', '197208252006042003', '6271036508720004', 'Dr. Stynie Nova Tumbol, M.Th ', 'Ternate', '1972-08-25', 'p', 'kristen', NULL, '082157928655', 'stynienova@gmail.com', 'Jl. Kalibata Blok K No. 03', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S3', 'Dekan Fakultas Ilmu Sosial Keagamaan Kristen', 13, '19700626 200501 2 00', '2006-04-01', '2017-10-01', NULL, NULL, NULL, NULL, '683243794711000', NULL, '2025087201', '454201009600534', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 'aktif', '197009061995121001', '6271030609700004', 'Berth Penny Pahan, M.Pd.', 'Banjarmasin', '1970-09-06', 'l', 'kristen', NULL, '081255100846', 'berthpenny@yahoo.co.id', 'Jl. Bukit Raya No 87', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'IV.b', '11', '92', '1562', 'S2', 'Dekan Fakultas Seni Keagamaan Kristen', 8, '19700626 200501 2 00', '1995-12-01', '2017-04-01', NULL, NULL, NULL, NULL, '688071315711000', NULL, '2012079302', '454101008589537', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 'aktif', '199307122019032019', '3278085207930010', 'Silvia Rahmelia, M.Pd', 'Kota Tasikmalaya', '1993-07-12', 'p', 'kristen', NULL, '081220473715', 'silviarahmelia@gmail.com', 'Jl. G Obos No 70', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', 'Wakil Dekan Bidang Akademik, Kemahasiswaan, Kelembagaan dan Kerja Sama Fakultas Keguruan dan Ilmu Pendidikan Kristen', 6, '19770226 200604 2 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '737515304425000', NULL, '', '760001013875536', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 'aktif', '199006272019032015', '6271036706900008', 'Yoan Colina, M.AP', 'Palangka Raya', '1990-06-27', 'p', 'kristen', NULL, '082132323028', '199006272019032015@kemenag.go.id', 'Jl. Antang 1 No.73', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', 'Wakil Dekan Bidang Administrasi Umum, Perencanaan dan Keuangan Fakultas Keguruan dan Ilmu Pendidikan Kristen', 34, '19770226 200604 2 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '794732396711000', NULL, '2027069002', '216801006474506', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 'aktif', '198506252009011011', '6271032506850006', 'Pribadyo Prakosa, S.Si., M.Si.Teol', 'Palangka Raya', '1985-06-25', 'l', 'kristen', NULL, '081328731564', 'pribadyo25@gmail.com', 'Jl. Damang Leman No.2, Kel. Menteng, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S2', 'Wakil Dekan Bidang Akademik, Kemahasiswaan, Kelembagaan dan Kerja Sama Fakultas Ilmu Sosial Keagamaan Kristen', 7, '19720825 200604 2 00', '2009-01-01', '2020-04-01', NULL, NULL, NULL, NULL, '155999568711000', NULL, '2025068502', '024301045624506', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 'aktif', '198506172019032009', '6208055706850001', 'Sri Angellyna, M.Th', 'Kab. Kotawaringin Barat', '1985-06-17', 'p', 'kristen', NULL, '085248213667', 'sriangellyna17@gmail.com', 'Jl. Cilik Riwut Gg Bethel No 02', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', 'Wakil Dekan Bidang Administrasi Umum, Perencanaan dan Keuangan Fakuktas Ilmu Sosial Keagamaan', 7, '19720825 200604 2 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '168132074711000', NULL, '2017068503', '790301006446538', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 'aktif', '197804132009122001', '6271035304780005', 'Merilyn, M.Th', 'Palangka Raya', '1978-04-13', 'p', 'kristen', NULL, '085348507171', 'merilynyohannis@yahoo.co.id', 'Jl. G.Obos XVII Komp. Timitra 29', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S2', 'Wakil Dekan Bidang Akademik, Kemahasiswaan dan Administrasi Umum Fakultas Seni Keagaaman Kristen', 7, '19720825 200604 2 00', '2009-12-01', '2020-10-01', NULL, NULL, NULL, NULL, '156482358711000', NULL, '2013047802', '343401002060505', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(16, 'aktif', '199010262019032021', '1208076610900002', 'Oktani Haloho, M.Sc', 'Kab. Simalungun', '1990-10-26', 'p', 'kristen', NULL, '082370757470', 'oktanihaloho@gmail.com', 'Jl. Tampung Penyang II A RTA.Milono Km.6 Perum Kayzar B No 9', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', 'Ketua Lembaga Penjaminan Mutu', 34, '19641102 200003 2 01', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '669097586117000', NULL, '2026109002', '454401016605531', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, 'aktif', '198605252023212046', '5312106505860001', 'Merry Bendelina Asalaka, S.Si-Teol., M.Pd', 'Kab. Sumba Barat', '1986-05-25', 'p', 'kristen', NULL, '082136873478', 'merryasalaka@gmail.com', 'Jl. Tampung Penyang', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', 'Sekretaris Lembaga Penjaminan Mutu', 33, '19770226 200604 2 00', '2023-08-01', '2023-08-01', NULL, NULL, NULL, NULL, '804712180926000', NULL, '2025058604', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, 'aktif', '198308022015032003', '6271034208830003', 'Riwu Wulan, S.T, M.Pd', 'Kotawaringin Barat', '1983-08-02', 'p', 'kristen', NULL, '081330296185', 'riwuwulan@gmail.com', 'Jl. Taurus VII No.345, Kel. Menteng, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S2', 'Ketua Lembaga Penelitian dan Pengabdian Kepada Masyarakat', 33, '19770226 200604 2 00', '2015-03-01', '2024-04-01', NULL, NULL, NULL, NULL, '597870260711000', NULL, '2002088302', '759901004655538', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, 'aktif', '199510132022032006', '8171025310950006', 'Sharon Michelle O Pattiasina, S.Si.Teol., M.Si', 'Ambon', '1995-10-13', 'p', 'kristen', NULL, '085244097776', 'michellepattiasina1013@gmail.com', 'Hative Kecil', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', 'Sekretaris Lembaga Penelitian dan Pengabdian Kepada Masyarakat', 31, '19720825 200604 2 00', '2022-03-01', '2022-03-01', NULL, NULL, NULL, NULL, '638305706711000', NULL, '2013109501', '024301120949504', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(20, 'aktif', '197507222011011001', '3321022207750002', 'Julidi Lahagu, S.Th', 'Nias', '1975-07-22', 'l', 'kristen', NULL, '081326606089', 'julidilahagu1975@gmail.com', 'Jl. Tampung Penyang RTA.Milono Km.6 Perum Kayzar B5     ', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.d', '9', '99', '1540', 'S1', 'Kepala UPT Perpustakaan', 19, '19641102 200003 2 00', '2011-01-01', '2023-04-01', NULL, NULL, NULL, NULL, '578794513515000', NULL, '', '001601000317531', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(21, 'aktif', '198106252009011009', '6271032506810004', 'Joni Saputra, S.T., M.Kom', 'Palangka Raya', '1981-06-25', 'l', 'kristen', NULL, '081347583989', 'elchid2000@gmail.com', 'Jl. Temanggung Tilung I No. 21        ', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S2', 'Kepala UPT Teknologi Informasi dan Pangkalan Data', 33, '19700626 200501 2 00', '2009-01-01', '2019-04-01', NULL, NULL, NULL, NULL, '899967491711000', NULL, '2025068101', '024301045634501', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, 'aktif', '198709172019032005', '6271035709870001', 'Lelly Sepniwati, M.Hum', 'Kab. Kotawaringin Timur', '1987-09-17', 'p', 'kristen', NULL, '081357800859', 'lellyspnwt@gmail.com', 'Jl. Jati Raya 2 No. 21, Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', 'Kepala UPT Bahasa', 32, '19720825 200604 2 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '902308147711000', NULL, '1117098702', '793701008175536', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, 'aktif', '196610162000032002', '3471035610660001', 'Dra. Sri Gunarti Sabdaningrum, M.Pd.K', 'Sambon', '1966-10-16', 'p', 'kristen', NULL, '08123387132', '', 'Jl. Tampung Penyang', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'IV.a', '9', '92', '1561', 'S2', 'Kepala Satuan Pengawas Internal (SPI)', 0, '19700626 200501 2 00', '2000-03-01', '2014-04-01', NULL, NULL, NULL, NULL, '', NULL, '', '024701019742502', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, 'aktif', '198711232020121008', '7171092311870005', 'Fernando Dorothius Pongoh, S.Si., M.Si', 'Manado', '1987-11-23', 'l', 'kristen', NULL, '089698597423', 'fernando.pongoh@gmail.com', 'Jl. Kalibata IIa Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', 'Sekretaris Satuan Pengawas Internal (SPI)', 32, '19720825 200604 2 00', '2020-12-01', '2020-12-01', NULL, NULL, NULL, NULL, '804012490821000', NULL, '2023118701', '024301112532509', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(25, 'aktif', '199404152019032025', '7317115504940002', 'Wirastiani Binti Yusup, M.Pd', 'Sabah', '1994-04-15', 'p', 'kristen', NULL, '085349959307', 'wirastiani94@gmail.com', 'Jl. Strawbery Raya No 02', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', 'Ketua Jurusan Keguruan Ilmu Pendidikan Kristen Fakultas Keguruan dan Ilmu Pendidikan Kristen', 33, '19770226 200604 2 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '904559994803000', NULL, '2015049401', '454401016725535', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(26, 'aktif', '199303292019032023', '6201026903930001', 'Ratih Sulistyowati, M.Pd', 'Kab. Kotawaringin Barat', '1993-03-29', 'p', 'kristen', NULL, '082220218500', 'ratihsw@iaknpky.ac.id', 'Jl. RA Kartini No. 34 Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', 'Ketua Jurusan Pendidikan Seni/ Konseling Fakultas Keguruan dan Ilmu Pendidikan Kristen', 35, '19770226 200604 2 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '904491412713000', NULL, '2029039301', '760001013869535', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(27, 'aktif', '198201262009011013', '6271032601820001', 'Lianto, M.Th', 'Jaar', '1982-01-26', 'l', 'kristen', NULL, '082157960077', 'lilovejc.anto8@gmail.com', 'Jl. Sangga Buana II No.18, Kel. Palangka, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S2', 'Ketua Jurusan Ilmu Keagamaan Kristen Fakultas Ilmu Sosial Keagamaan Kristen', 7, '19720825 200604 2 00', '2009-01-01', '2020-10-01', NULL, NULL, NULL, NULL, '899967509711000', NULL, '2226018201', '024301045616503', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(28, 'aktif', '199207272019032030', '6271016707920007', 'Yolantya Widyasari, M.I.Kom', 'Palangka Raya', '1992-07-27', 'p', 'kristen', NULL, '082155578282', 'yolantyawidyasari@iaknpky.ac.id', 'Jl. Putri Karindang Perum No. 12', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', 'Ketua Jurusan Ilmu Sosial Keagamaan Fakultas Ilmu Sosial Keagamaan Kristen', 9, '19720825 200604 2 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '742919160711000', NULL, '2027079203', '793701008683539', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(29, 'aktif', '198502192018011001', '6171051902850004', 'Pransinartha, M.A', 'Palangka Raya', '1985-02-19', 'l', 'kristen', NULL, '0816226492', 'pransinartha@gmail.com', 'Jl. Pipit III No 66 Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S2', 'Ketua Jurusan Musik Gereja dan Peribadatan Kristen Fakultas Seni Keagamaan Kristen', 8, '19700906 199512 1 00', '2018-01-01', '2024-06-01', NULL, NULL, NULL, NULL, '681521936421000', NULL, '2019028501', '454401014460537', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(30, 'aktif', '199010022023212032', '6271044210900001', 'Dwi Sartica, S.Pd., M.Pd', 'Palangka Raya', '1990-10-02', 'p', 'kristen', NULL, '081318151002', 'dwisartica02@gmail.com', 'Jl. Tingang VII A-2 Ujung', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', 'Sekretaris Jurusan Keguruan Ilmu Pendidikan Kristen Fakultas Keguruan dan Ilmu Pendidikan Kristen', 36, '19770226 200604 2 00', '2023-08-01', '2023-08-01', NULL, NULL, NULL, NULL, '860428630711000', NULL, '2002109002', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(31, 'aktif', '198612162020121008', '6107081612860001', 'Lukas, M.Pd.K', 'Bengkayang', '1986-12-16', 'l', 'kristen', NULL, '081328021129', 'lukasjubata@gmail.com', 'Jl. Pemandu Raya Perum Kingland VB No. 13, RT/RW 001/003 Kel. Sabaru Kec. Sabangau Kota Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', 'Koordinator Prodi Pendidikan Agama Kristen Jurusan Keguruan Ilmu Pendidikan Kristen Fakultas Keguruan dan Ilmu Pendidikan Kristen', 6, '19720825 200604 2 00', '2020-12-01', '2020-12-01', NULL, NULL, NULL, NULL, '412574584711000', NULL, '2016128604', '024301112535507', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(32, 'aktif', '199512172020122022', '7102095712950001', 'Della Gita Van Gobel, M.Pd', 'Minahasa', '1995-12-17', 'p', 'kristen', NULL, '085217588040', 'dellavango@gmail.com', 'Jl. Jaga II, RT/RW 000/000 Kel. Karumenga Kec. Langowan Utara Kab. Minahasa Sulawesi Utara', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', 'Koordinator Prodi Pendidikan Kristen Anak Usia Dini (PKAUD) Jurusan Keguruan Ilmu Pendidikan Kristen Fakultas Keguruan dan Ilmu Pendidikan Kristen', 6, '19720825 200604 2 00', '2020-12-01', '2020-12-01', NULL, NULL, NULL, NULL, '412459109711000', NULL, '2017129501', '024301112528500', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(33, 'aktif', '199001242019081001', '6271032401900001', 'Chris Apandie, M.Pd', 'Palangka Raya', '1990-01-24', 'l', 'kristen', NULL, '085249120127', 'capandie@gmail.com', 'Jl. G Obos No 70', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', 'Koordinator Prodi Manajemen Pendidikan Kristen Jurusan Keguruan Ilmu Pendidikan Kristen Fakultas Keguruan dan Ilmu Pendidikan Kristen', 33, '19720825 200604 2 00', '2019-08-01', '2024-12-01', NULL, NULL, NULL, NULL, '914976113711000', NULL, '2024019003', '760001013874530', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(34, 'aktif', '198701082019032007', '6271034801870004', 'Isabella Jeniva, M.Si', 'Palangka Raya', '1987-01-08', 'p', 'kristen', NULL, '081253988112', 'isabellajeniva@gmail.com', 'Jl. Sapan XI No. 450', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', 'Sekretaris Jurusan Pendidikan Seni/ Konseling Kristen Fakultas Keguruan dan Ilmu Pendidikan Kristen', 31, '19770226 200604 2 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '904488079711000', NULL, '2008018702', '793701008468531', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(35, 'aktif', '199508022023212040', '6301094208950001', 'Ellysa Juang Agusti, M.Pd', 'Kab. Tanah Laut', '1995-08-02', 'p', 'kristen', NULL, '081344539625', 'Ellysajuang2602@gmail.com', 'JL. Desa Durian Bungkuk, RT.005/ RW.005, Kec. Batu Ampar, Kab. Tanah Laut Kalsel', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', 'Koordinator Prodi Pendidikan Musik Gereja Jurusan Pendidikan Seni/ Konseling Fakultas Keguruan dan Ilmu Pendidikan Kristen', 35, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '', NULL, '2002089501', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(36, 'aktif', '198610302023212039', '6271037010860004', 'Lisa Maneli, M.Psi', 'Palangka Raya', '1986-10-30', 'p', 'kristen', NULL, '081348155515', 'manelisa86@gmail.com', 'JL. Antang II No. 054, RT/RW. 003/018, Kel. Palangka, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', 'Koordinator Prodi Bimbingan dan Konseling Kristen Jurusan Pendidikan Seni/ Konseling Fakultas Keguruan dan Ilmu Pendidikan Kristen', 9, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '808028369711000', NULL, '9922010515', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(37, 'aktif', '198604252020121007', '6271034103880005', 'Aprianto Wirawan, M.Th', 'Palangka Raya', '1986-04-25', 'l', 'kristen', NULL, '085249508656', 'wirawanaprianto@gmail.com', 'Jl. G.Obos VIII No. 127, RT. 002/ RW.012. Kel. Menteng Kec. Jekan Raya Kota Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', 'Sekretaris Jurusan Ilmu Keagamaan Kristen Fakultas Ilmu Sosial Keagamaan Kristen', 7, '19720825 200604 2 00', '2020-12-01', '2020-12-01', NULL, NULL, NULL, NULL, '571074947713000', NULL, '2025048602', '024301112536503', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(38, 'aktif', '197401112023212004', '6271035101740003', 'Ebariani, M.Th', 'Kab. Barito Timur', '1974-01-11', 'p', 'kristen', NULL, '081349167865', 'mawinei74@gmail.com', 'JL. Pinguin VII No. 565, RT.001/012, Kelurahan Bukit Tunggal, Kecamatan Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', 'Koordinator Prodi Teologi Jurusan Ilmu Keagamaan Kristen Fakultas Ilmu Sosial Keagamaan Kristen', 7, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '202617965711000', NULL, '9922010525', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(39, 'aktif', '199303152020122023', '6271034103880005', 'Maria Veronica, M.Ag', 'Kapuas', '1993-03-15', 'p', 'kristen', NULL, '085249109846', 'mariaveronicamv93@gmail.com', 'Jl. Kapuas Seberang II, RT/RW 003/000 Kel. Sei Pasah Kec. Kapuas Hilir Kapuas', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', 'Koordinator Prodi Pastoral Konseling Jurusan Ilmu Keagamaan Kristen Fakultas Ilmu Sosial Keagamaan Kristen', 9, '19720825 200604 2 00', '2020-12-01', '2020-12-01', NULL, NULL, NULL, NULL, '412429250711000', NULL, '2015059301', '024301112533505', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(40, 'aktif', '196805232023211003', '6203012305680001', 'Yosef Darmasatria Bakti, M.Min', 'Kab. Bengkayang', '1968-05-23', 'l', 'kristen', NULL, '081349477725', 'yosefdsb1968@gmail.com', 'JL. Menteng VI No. 1 B, RT/RW. 001/011, Kel. Menteng, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', 'Koordinator Prodi Kepemimpinan Kristen Jurusan Ilmu Keagamaan Kristen Fakultas Ilmu Sosial Keagamaan Kristen', 7, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '61.565.486.0-711.000', NULL, '9922010523', '7599-01006779-53-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(41, 'aktif', '199104022019032010', '6271034204910001', 'Danella Merdiasi, M.Psi', 'Palangka Raya', '1991-04-02', 'p', 'kristen', NULL, '085249236080', 'danellamerdiasi@gmail.com', 'Jl. Rajawali VI No 7', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', 'Sekretaris Jurusan Ilmu Sosial Keagamaan Fakultas Ilmu Sosial Keagamaan Kristen', 32, '19720825 200604 2 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '902403633711000', NULL, '2002049101', '454101021909538', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(42, 'aktif', '198312142019031003', '6210021412830001', 'Deri Susanto, M.Si', 'Kuala Kurun', '1983-12-14', 'l', 'kristen', NULL, '082157365052', 'derisusanto83@gmail.com', 'Jl. Brigjen Katamso No 76 Kuala Kurun', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', 'Koordinator Prodi Sosiologi Agama Jurusan Ilmu Sosial Keagamaan Fakultas Ilmu Sosial Keagamaan Kristen', 31, '19720825 200604 2 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '817321383711000', NULL, '1114128303', '105301011041502', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(43, 'aktif', '198304152023211026', '6271031504830004', 'Kukuh Pribadi, M.Psi', 'Palangka Raya', '1983-04-15', 'l', 'kristen', NULL, '08122846492', 'ku2hpri@gmail.com', 'JL. Beliang No. 40AB, RT/RW. 001/022, Kelurahan Palangka, Kecamatan Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', 'Koordinator Prodi Psikologi Kristen Jurusan Ilmu Sosial Keagamaan Fakultas Ilmu Sosial Keagamaan Kristen', 32, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '92.957.457.2-711.000', NULL, '2015048304', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(44, 'aktif', '199212032023212045', '6271034312920004', 'Elvira, M.Sn', 'Palangka Raya', '1992-12-03', 'p', 'kristen', NULL, '085248759918', 'mandau.talawang03@gmail.com', 'Jl. Damang Bahandang Balau No. 03', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', 'Sekretaris Jurusan Musik Gereja dan Peribadatan Kristen Fakultas Seni Keagamaan Kristen', 30, '19700906 199512 1 00', '2023-08-01', '2023-08-01', NULL, NULL, NULL, NULL, '949592307711000', NULL, '0003129201', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(45, 'aktif', '199210242020122009', '1277026410920005', 'Octa Maria Sihombing, M.Pd', 'Padangsidimpuan', '1992-10-24', 'p', 'kristen', NULL, '085296729655', 'octa.maria24@gmail.com', 'Jl. Teuku Umar Gg. Martabe Kel. Losung Kec. Padangsidimpuan Selatan Kota Padangsidimpuan Sumatera Utara', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', 'Koordinator Program Studi Musik Gereja Jurusan Musik Gereja dan Peribadatan Kristen FSKK', 35, '19700906 199512 1 00', '2020-12-01', '2020-12-01', NULL, NULL, NULL, NULL, '412477564711000', NULL, '2024109201', '024301112529506', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(46, 'aktif', '198904062022032002', '1207234604890003', 'Frisca Aries BR. Lumban Tobing, S.Pd., M.Sn', 'Medan', '1989-04-06', 'p', 'kristen', NULL, '081351464159', '198904062022032002@kemenag.go.id', 'Jl. Tampung Penyang', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', 'Koordinator Program Studi Seni Pertunjukan Keagamaan Jurusan Musik Gereja dan Peribadatan Kristen FSKK', 8, '19700906 199512 1 00', '2022-03-01', '2022-03-01', NULL, NULL, NULL, NULL, '', NULL, '2006048903', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(47, 'aktif', '198901142022032001', '6271015401890001', 'Anggita Deodora Siten, S.Psi., M.Psi', 'Palangka Raya', '1989-01-14', 'p', 'kristen', NULL, '081349062410', 'anggita.deodora89@gmail.com', 'Jl. Temanggung Tandang No. 55', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', 'Kepala Pusat Penelitian pada Lembaga Penelitian dan Pengabdian Kepada Masyarakat', 32, '19720825 200604 2 00', '2022-03-01', '2022-03-01', NULL, NULL, NULL, NULL, '638004663711000', NULL, '2014018901', '024301120948508', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(48, 'aktif', '198503152015031003', '3573021503850008', 'Matius Timan Herdi Ginting, M.Pd.K', 'Malang', '1985-03-15', 'l', 'kristen', NULL, '085233336652', 'bangmatz@yahoo.co.id', 'Jl. Surung VI No. D1', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S2', 'Kepala Pusat Pengabdian Kepada Masyarakat pada Lembaga Penelitian dan Pengabdian Kepada Masyarakat', 6, '19770226 200604 2 00', '2015-03-01', '2024-08-01', NULL, NULL, NULL, NULL, '', NULL, '2015038502', '005101004631531', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(49, 'aktif', '197702162023211004', '1211151602770001', 'Kalip, M.Pd.K', 'Kab. Sintang', '1977-02-16', 'l', 'kristen', NULL, '081265816664', 'kalipsiburian71@gmail.com', 'JL. Rimo Bunga No. 19 Panji Bako, RT/RW. Desa Sitinjo II, Kec. Sitinjo, Kabupaten Dairi - Sidikalang', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', 'Kepala Pusat Audit Mutu Internal dan Pengendalian Mutu pada Lembaga Penjaminan Mutu', 6, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '', NULL, '2316027701', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(50, 'aktif', '199002162023212047', '6271035602900001', 'Komala Sari, M.Th', 'Palangka Raya', '1990-02-16', 'p', 'kristen', NULL, '081254066780', 'komalakomala1990@gmail.com', 'JL. Batu Suli VB No. 42B, RT.003/ RW.015, Kelurahan Palangka, Kecamatan Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', 'Kepala Pusat Pengembangan Dokumen Sistem Penjaminan Mutu Internal pada Lembaga Penjamin Mutu', 7, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '764158804711000', NULL, '2016029001', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(51, 'aktif', '198004092011011005', '3277010904800036', 'Dr. Yamowa\'a Bate\'e, M.Th', 'Ombolata/Nias', '1980-04-09', 'l', 'kristen', NULL, '081573022155', 'yamowaa@yahoo.co.id', 'Jl. Tangkalasa No 14 Mahir Mahar Km 8 ', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'IV.a', '13', '92', '1563', 'S3', '', 12, '19690630 200801 1 00', '2011-01-01', '2024-06-01', NULL, NULL, NULL, NULL, '250080314711000', NULL, '2209048001', '051701011173500', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(52, 'aktif', '197602222006042002', '6271026907930002', 'Dr. Setinawati,M.Th', 'Kuala Kurun', '1976-02-22', 'p', 'kristen', NULL, '081250607111', 'stnsetinawati@gmail.com', 'Jl. Putri Junjung Buih VI No. 4', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'IV.a', '13', '92', '1563', 'S3', '', 12, '19720825 200604 2 00', '2006-04-01', '2023-10-01', NULL, NULL, NULL, NULL, '688071331711000', NULL, '2222027601', '024301045319509', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(53, 'aktif', '196411022000032003', '6271034211640003', 'Dr. Sanasintani, S.Th., M.Pd', 'Tampa', '1964-11-02', 'p', 'kristen', NULL, '081349156887', 'christianbelly@yahoo.co.id', 'Jl. Menteng 22, No.30', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '13', '92', '1563', 'S3', '', 37, '19700626 200501 2 00', '2000-03-01', '2024-06-01', NULL, NULL, NULL, NULL, '683243828711000', NULL, '2202116401', '454201009892539', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(54, 'aktif', '197701052006042003', '6271014501770006', 'Dr. Evi Mariani,S.Fil, MA', 'Palangka Raya', '1977-01-05', 'p', 'kristen', NULL, '085390498685', 'evi_mariani777@yahoo.com', 'Jl. Bajau Ranju No 14', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S3', '', 13, '19770226 200604 2 00', '2006-04-01', '2024-08-01', NULL, NULL, NULL, NULL, '683243786711000', NULL, '0005017706', '454201010178538', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(55, 'aktif', '197603162011012002', '6271035603760002', 'Dr. Sarmauli, M.Th', 'Bengkulu', '1976-03-16', 'p', 'kristen', NULL, '082156782292', 'uli_rahul2002@yahoo.com', 'Jl. Tampung Penyang Perum Lewu Lampang Batarung No. A/10', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '13', '92', '1563', 'S3', '', 12, '19770226 200604 2 00', '2011-01-01', '2018-10-01', NULL, NULL, NULL, NULL, '584851950711000', NULL, '2216037601', '343401002251504', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(56, 'aktif', '196906302008011007', '6171023006690002', 'Dr. Wilson, M.Th', 'Pelaik-Sintang', '1969-06-30', 'l', 'kristen', NULL, '082111201995/08', 'bukitrhemaong@gmail.com', 'Jl. RTA.Milono,km.9,5 (jl.Taheta, Blok D/I), Kel. Kereng Bangkirai, Kec. Sebangau', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S3', '', 37, '19700626 200501 2 00', '2008-01-01', '2015-10-01', NULL, NULL, NULL, NULL, '683243737711000', NULL, '2230066901', '024301045621508', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(57, 'aktif', '197703262008011007', '6271032603770006', 'Dr. Agus Surya, M.Th.', 'Pontianak', '1977-03-26', 'l', 'kristen', NULL, '082116451454', 'agus080311@gmail.com', 'Jl. Temanggung Tilung VII, Kel. Menteng, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '13', '92', '1563', 'S3', '', 13, '19770226 200604 2 00', '2008-01-01', '2024-12-01', NULL, NULL, NULL, NULL, '683243844711000', NULL, '2226037701', '024301045633505', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(58, 'aktif', '196408101992031011', '6271031008640005', 'Drs. Rudie, M.Pd', 'Kapuas Hulu', '1964-08-10', 'l', 'kristen', NULL, '082155042748', 'rudielautt@gmail.com', 'Jl. Sapan XI No. 70 RT/RW: 008/009, Kel. Bukit Tunggal, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'IV.b', '11', '92', '1562', 'S2', '', 34, '19641102 200003 2 02', '1992-03-01', '2012-04-01', NULL, NULL, NULL, NULL, '697482206711000', NULL, '2010086403', '024301081815505', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(59, 'aktif', '196109231993031001', '6271042309610001', 'Sugiyanto, S.PAK., M.Th', 'Tumbang Talaken', '1961-09-23', 'l', 'kristen', NULL, '081254608383/08', 'sugiyanto.stakn@gmail.com', 'Jl.Perak II No. 23 Kereng bangkirai, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'IV.a', '11', '92', '1562', 'S2', '', 8, '19700906 199512 1 00', '1993-03-01', '2006-04-01', NULL, NULL, NULL, NULL, '688071307711000', NULL, '2023096101', '024301045612509', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(60, 'aktif', '196201011982011001', '3318170101620007', 'Dr. Stephanus Prihadi, M.Th', 'Pati', '1962-01-01', 'l', 'kristen', NULL, '085325262933', 'stephanustayu@yahoo.co.id', 'Perum Tayu Kulon Sejahtera Blok B No. 6 Tayu, Kel. Giling, Kec. Gunungwungkal, Pati/ Doho ujung Kalampangan', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'IV.a', '11', '92', '1562', 'S3', '', 11, '19770226 200604 2 00', '1982-01-01', '2007-10-01', NULL, NULL, NULL, NULL, '473455053507000', NULL, '2001016244', '340501020174537', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(61, 'aktif', '196502192005011002', '6271031902650001', 'Yuel,S.PAK, M.Th', 'Puruk Cahu', '1965-02-19', 'l', 'kristen', NULL, '081251620870', 'siliptas@yahoo.com', 'Jl. Pratama No.5 RTA.Milono Km.7, Kel. Menteng, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S2', '', 6, '19641102 200003 2 02', '2005-01-01', '2017-10-01', NULL, NULL, NULL, NULL, '683243760711000', NULL, '2219026501', '024301045637509', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(62, 'tugas belajar', '197508122009011006', '6271031208750004', 'Agus Budi Handoko,S.Th, M.Sn', 'Surakarta', '1975-08-12', 'l', 'kristen', NULL, '081390046003', 'handokoagusbudi@gmail.com', 'Jl. Sapan Raya, Kel. Bukit Tunggal, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S2', '', 30, '19700906 199512 1 00', '2009-01-01', '2022-04-01', NULL, NULL, NULL, NULL, '155587215711000', NULL, '2212087501', '343401022266539', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(63, 'tugas belajar', '198601032015032003', '1802204301860003', 'Indah Sriwijayanti, M.Si.Teol', 'Panjirejo', '1986-01-03', 'p', 'kristen', NULL, '085828391314', 'indahsriwijayanti@yahoo.co.id', 'Jl. Damang Leman No.2, Kel. Menteng, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S2', '', 6, '19770226 200604 2 00', '2015-03-01', '2022-10-01', NULL, NULL, NULL, NULL, '732619460711000', NULL, '2003018601', '138401000357501', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(64, 'aktif', '198111102014031001', '5371021011810002', 'Rinto Hasiholan Hutapea, M.Th', 'Sibolga', '1981-11-10', 'l', 'kristen', NULL, '081310083870', 'rintohutapea81@gmail.com', 'Jl. Jati Raya 1 Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S2', '', 33, '19641102 200003 2 02', '2014-03-01', '2024-06-01', NULL, NULL, NULL, NULL, '251538542404000', NULL, '2210118101', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(65, 'aktif', '198011212008011004', '6271032111800003', 'Jeffry Simson Supardi, M.Psi', 'Malang', '1980-11-21', 'l', 'kristen', NULL, '081349208808', 'jeffrysimson@gmail.com', 'Jl. Jati No.80, Kel. Panarung, Kec. Pahandut', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S2', '', 32, '19720825 200604 2 00', '2008-01-01', '2024-06-01', NULL, NULL, NULL, NULL, '683243869711000', NULL, '2021118001', '454201000387503', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(66, 'aktif', '198403242009012011', '6271016403840005', 'Lilyantie,S.Th, M.Si', 'Palangka Raya', '1984-03-24', 'p', 'kristen', NULL, '081251567699', 'lilyantie@yahoo.co.id', 'Jl. Yos Sudarso No. 043 ', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.d', '11', '92', '1562', 'S2', '', 31, '19720825 200604 2 00', '2009-01-01', '2024-06-01', NULL, NULL, NULL, NULL, '899967442711000', NULL, '2224038401', '024301045635507', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(67, 'tugas belajar', '197412222008012009', '6271036212740001', 'Karolina, S.Th, M.Si', 'Palangka Raya', '1974-12-22', 'p', 'kristen', NULL, '085845156203', 'karolinajapar74@gmail.com', 'Jl. RTA Milono Km. 8', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', '', 9, '19720825 200604 2 00', '2008-01-01', '2017-10-01', NULL, NULL, NULL, NULL, '683243851711000', NULL, '2222127401', '024301045625502', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(68, 'aktif', '198610292018012001', '6271036910860003', 'Eva Inriani, M.Th', 'Gunung Mas', '1986-10-29', 'p', 'kristen', NULL, '085828633439', 'pdteva10@gmail.com', 'Jl. Mutiara No. 16, Kel. Bukit Tunggal, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', '', 11, '19720825 200604 2 00', '2018-01-01', '2022-04-01', NULL, NULL, NULL, NULL, '840245260711000', NULL, '2029108601', '454401014464531', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(69, 'aktif', '198512222019032008', '6210026212850001', 'Desi Natalia, M.Si', 'Palangka Raya', '1985-12-22', 'p', 'kristen', NULL, '081348930269', 'desi.nataliaahad@gmail.com', 'Jl. G.Obos VIII Komplek 4 Sekawan No. 01', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', '', 31, '19720825 200604 2 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '543783518711000', NULL, '1122128503', '760001001775504', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(70, 'aktif', '198811222019031011', '3275051211880010', 'Daido Tri Sampurna Lumban Raja, M.Th', 'Jakarta', '1988-11-22', 'l', 'kristen', NULL, '082159207758', 'daidolumbanraja@gmail.com', 'Jl. Perumahan Graha Nusa Batam Blok No 9', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', '', 11, '19700906 199512 1 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '', NULL, '2322118801', '793701008473536', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(71, 'tugas belajar', '199212082019032019', '5104024812920005', 'Ni Nyoman Astrini Utami, M.Hum', 'Kab. Ganyar', '1992-12-08', 'p', 'hindu', NULL, '081257585150', 'ninyomanastriniutami@gmail.com', 'Jl. Yos Sudarso No 112 Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', '', 35, '19700906 199512 1 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '', NULL, '2008129202', '760001013873534', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(72, 'tugas belajar', '199209302019031010', '6271033009920001', 'Putra Andino Nugrahhu, M.Pd', 'Banjarmasin', '1992-09-30', 'l', 'kristen', NULL, '085249205056', 'nugrahhuputraandino@gmail.com', 'JL. Rajawali VI NO. 8        ', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', '', 35, '19700906 199512 1 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '', NULL, '0030099201', '759901010305537', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(73, 'tugas belajar', '199010162019031010', '6271031610900001', 'Defri Triadi, M.Si', 'Palangka Raya', '1990-10-16', 'l', 'kristen', NULL, '081244525709', 'defritriadi@gmail.com', 'JL. Tiung II No. 19        ', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', '', 33, '19770226 200604 2 00', '2019-03-01', '2023-10-01', NULL, NULL, NULL, NULL, '751068305711000', NULL, '2016109001', '216801006539500', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(74, 'aktif', '198803012019032012', '6271034103880005', 'Tiavone Theressa Andiny, M.Si', 'Palangka Raya', '1988-03-01', 'p', 'kristen', NULL, '085348334004', 'tia.andiny88iaknpky@gmail.com', 'Jl. Sepakat III No H77 Perum Bangas Permai', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S2', '', 11, '19720825 200604 2 00', '2019-03-01', '2024-08-01', NULL, NULL, NULL, NULL, '', NULL, '2001038803', '454101021911535', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(75, 'aktif', '196609182005012003', '6271035809660001', 'Dr. Silipta, S.PAK., M.Th', 'Kotawaringin Timur', '1966-09-18', 'p', 'kristen', NULL, '081352837447', 'siliptas@yahoo.com', 'Jl. Pratama No.5 RTA.Milono Km.7        ', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.c', '11', '92', '1562', 'S3', '', 34, '19770226 200604 2 00', '2005-01-01', '2024-10-01', NULL, NULL, NULL, NULL, '683243778711000', NULL, '2218096601', '454401002642533', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(76, 'tugas belajar', '198604202015032002', '9101016004860001', 'Latupeirissa Risvan, S.Si.Teol, M.Si', 'Merauke', '1986-04-20', 'p', 'kristen', NULL, '085343132666', 'r_latupeirissa@yahoo.co.id', 'Jl. Tampung Penyang', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '11', '92', '1562', 'S2', '', 12, '19720825 200604 2 00', '2015-03-01', '2016-06-01', NULL, NULL, NULL, NULL, '736200122954000', NULL, '2020048602', '030801035550501', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(77, 'aktif', '198909192019031011', '3275061909890014', 'Reynhard Malau, M.Th', 'Jakarta', '1989-09-19', 'l', 'kristen', NULL, '085286503260', 'reynhardmalau@gmail.com', 'Jl. RTA Milono Km 4,5', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', '', 7, '19720825 200604 2 00', '2019-03-01', '2020-03-01', NULL, NULL, NULL, NULL, '829575711427000', NULL, '2319098901', '793701008471534', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(78, 'aktif', '199307292019082001', '6271026907930002', 'Cristi Devi Darnita, M.A.', 'Palangka Raya', '1993-07-29', 'p', 'kristen', NULL, '082153739201', 'cristidevidarnita@gmail.com', 'Jl. Yos Sudarso No. 978        ', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', '', 11, '19700906 199512 1 00', '2019-08-01', '2019-08-01', NULL, NULL, NULL, NULL, '752285171711000', NULL, '2029079301', '778901006446530', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(79, 'tugas belajar', '198810082020122016', '1607104810880008', 'Yane Octavia Rismawati Wainarisi, M.Th', 'Pontianak', '1988-10-08', 'p', 'kristen', NULL, '085210984401', 'yaneoctavia@gmail.com', 'Jl. Sukamakmur RT/RW 022/010 Kel. Air Batu Kec. Talang Kelapa Kab. Banyuasin Sumatera Selatan', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', '', 7, '19720825 200604 2 00', '2020-12-01', '2020-12-01', NULL, NULL, NULL, NULL, '347352593314OOO', NULL, '2008108804', '575701000370502', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(80, 'aktif', '198903192020121010', '1202151903890002', 'Alfonso Munte, M.Pd.K', 'Palembang', '1989-03-19', 'l', 'kristen', NULL, '085393594845', 'alfonsomunthe@gmail.com', 'Jl. Pelajar IV No.11a Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', '', 6, '19770226 200604 2 00', '2020-12-01', '2020-12-01', NULL, NULL, NULL, NULL, '668865843009000', NULL, '2019038902', '024301112534501', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(81, 'aktif', '199301142020122020', '6203055404930001', 'Yola Pradita, M.Th', 'Kapuas', '1993-01-14', 'p', 'kristen', NULL, '082251315058', 'yolapradita14@gmail.com', 'Jl. Hiu Putih XII, RT/RW 006/010 Kel. Bukit Tunggal Kec. Jekan Raya Kota Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PNS', 'III.b', '9', '92', '1561', 'S2', '', 9, '19720825 200604 2 00', '2020-12-01', '2020-12-01', NULL, NULL, NULL, NULL, '412765612711000', NULL, '2014019303', '452401007787536', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(82, 'aktif', '197809032009012008', '6271034309780002', 'Fitrisiswanty, S.E., M.Si', 'Palangka Raya', '1978-09-03', 'p', 'kristen', NULL, '085249192799', 'fitrisiswanty@gmail.com', 'Jl. Cendana No. 16', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.d', '10', '99', '1528', 'S2', '', 24, '19671116 198903 1 00', '2009-01-01', '2021-04-01', NULL, NULL, NULL, NULL, '156481863711000', NULL, '', '024301045632509', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(83, 'aktif', '198107152009012016', '6271015507810008', 'Friska Muliani, S.IP.', 'Palangka Raya', '1981-07-15', 'p', 'kristen', NULL, '081349209896', 'friskaleandrotito@gmail.com', 'Jl. Darmosugondo Gg. Rahmat No.02        ', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.d', '10', '99', '5210', 'S1', '', 4, '19671116 198903 1 00', '2009-01-01', '2021-04-01', NULL, NULL, NULL, NULL, '899967475711000', NULL, '', '024301028664509', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(84, 'aktif', '199304292019031011', '6271032904930007', 'Agri Apriliando, S.T', 'Palangka Raya', '1993-04-29', 'l', 'kristen', NULL, '085249441182', 'agripriliando@gmail.com', 'Jl. Badak IX No 10 B Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.b', '8', '99', '1535', 'S1', '', 18, '19671116 198903 1 00', '2019-03-01', '2025-06-01', NULL, NULL, NULL, NULL, '839022654711000', NULL, '', '454101001750501', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(85, 'aktif', '198904242019031010', '6208052404890001', 'Arther Evert Samuel, S.E', 'Jakarta', '1989-04-24', 'l', 'kristen', NULL, '085252973618', '54moeel@gmail.com', 'Jl. Mutiara V No. 16', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.b', '8', '99', '1530', 'S1', '', 4, '19671116 198903 1 00', '2019-03-01', '2023-04-01', NULL, NULL, NULL, NULL, '904196136713000', NULL, '', '714601007715532', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(86, 'aktif', '198704242020122013', '6203016404870002', 'Kronika Novie Welianti, S.H', 'Kuala Kapuas', '1987-04-24', 'p', 'kristen', NULL, '085251472666/08', 'KronikaNW@Gmail.com', 'Jl. Kalibata Blok D Jalur 1 No. K2 Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.b', '8', '99', '5210', 'S1', '', 4, '19671116 198903 1 00', '2020-12-01', '2024-12-01', NULL, NULL, NULL, NULL, '155996705711000', NULL, '', '024301112530507', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(87, 'aktif', '199301012020121021', '6271030101930005', 'Raymond Gomgom Sitorus, S.Kom', 'Palangka Raya', '1993-01-01', 'l', 'kristen', NULL, '081345374932', '199301012020121021@kemenag.go.id', 'Jl. Bromo No. 15, RT/RW 03/14 Kel. Palangka Kec. Jekan Raya Kota Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.a', '8', '99', '1535', 'S1', '', 14, '19671116 198903 1 00', '2020-12-01', '2020-12-01', NULL, NULL, NULL, NULL, '807186077711000', NULL, '', '760001018529538', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(88, 'aktif', '198312242008031002', '6210022412830000', 'Devid Prianata, S.E', 'Barito Selatan', '1983-12-24', 'l', 'kristen', NULL, '081348997245', 'devidprianata@gmail.com', 'Jl. G.Obos VIII Komplek 4 Sekawan No. 01', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.d', '10', '99', '1530', 'S1', '', 4, '19680705 200604 1 00', '2009-03-01', '2019-10-01', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(89, 'aktif', '198608152008012001', '6271035508860010', 'Ika Agustina, S.E., M.Si.', 'Palangka Raya', '1986-08-15', 'p', 'kristen', NULL, '085246496959', 'ika.iaknpalangkaraya@gmail.com', 'Jl. Sultan Badarudin No. 28 Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'IV.a', '9', '99', 'UNKNOWN', 'S2', '', 10, '19671116 198903 1 00', '2008-01-01', '2024-04-01', NULL, NULL, NULL, NULL, '683243877711000', NULL, '', '024301045626508', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(90, 'aktif', '198306172009011009', '6271031706830009', 'Junadi Djojoatmodjo, S.E., M.Si.', 'Palangka Raya', '1983-06-17', 'l', 'kristen', NULL, '085249331562', 'junadi_hera@yahoo.com', 'Jl. RTA.Milono Km.8 Perum Fajar Permai I No. 25', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'IV.a', '9', '99', 'UNKNOWN', 'S2', '', 23, '19671116 198903 1 00', '2009-01-01', '2025-04-01', NULL, NULL, NULL, NULL, '144822277711000', NULL, '', '024301045618505', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(91, 'aktif', '198204222011012012', '6271036204820010', 'Gracesilya Veronica Barus, S.E.', 'Buntut Bali, Kab.Katingan', '1982-04-22', 'p', 'kristen', NULL, '082255343932', 'gracesilya_barus@yahoo.com', 'Jl.  G.Obos VIIIB', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.d', '8', '99', '5240', 'S1', '', 4, '19671116 198903 1 00', '2011-01-01', '2023-04-01', NULL, NULL, NULL, NULL, '161191457711000', NULL, '', '454401000263503', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(92, 'aktif', '197911262005012008', '6271036611790002', 'Trissia Noveta, S.Hut.', 'Kasongan', '1979-11-26', 'p', 'kristen', NULL, '085346672827', 'lenamuhaling@gmail.com', 'Jl. Aries V No. 22      ', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.d', '7', '8', 'UNKNOWN', 'S1', '', 2, '19680705 200604 1 00', '2005-01-01', '2020-04-01', NULL, NULL, NULL, NULL, '683243836711000', NULL, '', '024301045622504', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(93, 'aktif', '198105052005012013', '6271014505810016', 'Meilena Salom Muhaling, S.Si.', 'Banyumas', '1981-05-05', 'p', 'kristen', NULL, '0816288885', 'trissia_noveta@kemenag.go.id', 'Jl. RTA.Milono Km.8 Perumahan Kereng Indah Permai        ', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.d', '7', '8', 'UNKNOWN', 'S1', '', 19, '19680705 200604 1 00', '2005-01-01', '2020-04-01', NULL, NULL, NULL, NULL, '144819612711000', NULL, '', '024301045613505', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(94, 'aktif', '198003182009011003', '6271041803800002', 'Jhonny Rouland, S.E.', 'Jakarta', '1980-03-18', 'l', 'kristen', NULL, '081254004855', 'jhonny.roulnd@gmail.com', 'Jl. Basir Jahan XII RTA.Milono Km.9        ', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.d', '7', '8', 'UNKNOWN', 'S1', '', 4, '19671116 198903 1 00', '2009-01-01', '2021-04-01', NULL, NULL, NULL, NULL, '899967483711000', NULL, '', '024301045636503', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(95, 'aktif', '197911092011011003', '6704030911790001', 'Edward Dabukke, M.Pd', 'Dairi', '1979-11-09', 'l', 'kristen', NULL, '081317000368', 'eddeuli@gmail.com', 'Jl. Matal Blok B No. 26 Perum Matal RTA. Milono Km. 9', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.d', '7', '8', 'UNKNOWN', 'S2', '', 2, '19680705 200604 1 00', '2011-01-01', '2023-04-01', NULL, NULL, NULL, NULL, '578851818411000', NULL, '', '454401002635536', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(96, 'aktif', '198305032010011023', '6212010305830003', 'Jayewardeni, S.Ds', 'Barito Selatan', '1983-05-30', 'l', 'kristen', NULL, '081351226044', 'jayewardeni@gmail.com', 'Jl. Temanggung Tilung XXII BTN No. 35 Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.d', '6', '8', 'UNKNOWN', 'S1', '', 2, '19680705 200604 1 00', '2010-01-01', '2020-04-01', NULL, NULL, NULL, NULL, '577948185714000', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(97, 'aktif', '198701302007012001', '6271017001870002', 'Yudeniririn Kunanto, S.IP., M.Si', 'Palangka Raya', '1987-01-30', 'p', 'kristen', NULL, '081253845587', 'yudeniririn@gmail.com', 'Jl. Eboni No. 09 Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'IV.a', '6', '8', 'UNKNOWN', 'S2', '', 14, '19680705 200604 1 00', '2007-01-01', '2024-12-01', NULL, NULL, NULL, NULL, '151626322711000', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(98, 'aktif', '197707062005012015', '6271034607770003', 'Netanya, A.Md., S.Pd.K.', 'Tumbang Lapan', '1977-07-06', 'p', 'kristen', NULL, '081352843088', 'netanetanya@gmail.com', 'Jl. Kalibata 1 No. 7', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.d', '7', '8', 'UNKNOWN', 'S1', '', 23, '19680705 200604 1 00', '2005-01-01', '2025-04-01', NULL, NULL, NULL, NULL, '144142668711000', NULL, '', '024301040775506', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(99, 'aktif', '198703142015032004', '6271025403870001', 'Nanisusantie, S.Th.', 'Palangka Raya', '1987-03-14', 'p', 'kristen', NULL, '082240577614', 'nanisusantie87@gmail.com', 'Jl. Cilik Riwut Km.29 No.23        ', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.c', '7', '8', 'UNKNOWN', 'S1', '', 3, '19680705 200604 1 00', '2015-03-01', '2023-04-01', NULL, NULL, NULL, NULL, '597870210711000', NULL, '', '778901001156538', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(100, 'aktif', '198802132010011004', '6210021302880002', 'Andika Petrus, S.Kep., M.A.P', 'Kurun', '1988-02-13', 'l', 'kristen', NULL, '082153225523', '198802132010011004@kemenag.go.id', 'Jl. Ais Nasution Kec. Kurun', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.d', '6', '8', 'UNKNOWN', 'S2', '', 2, '19680705 200604 1 00', '2010-01-01', '2024-10-01', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(101, 'aktif', '197808152014111001', '6271031508780007', 'Philips Yacobus Tampa, S.E., M.A.P', 'Minahasa', '1978-08-15', 'l', 'kristen', NULL, '08115215878', 'minahasaboy@gmail.com', 'Jl. Tangkasiang No.002        ', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.b', '7', '8', 'UNKNOWN', 'S2', '', 4, '19680705 200604 1 00', '2014-11-01', '2023-04-01', NULL, NULL, NULL, NULL, '157986522711000', NULL, '', '024301081840500', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(102, 'aktif', '197801092005012008', '6271042910640001', 'Ani Wawei, A.Md.', 'Buntok', '1978-01-09', 'p', 'kristen', NULL, '085387709588', 'ani.wawei@gmail.com', 'Jl. Haruan No.6        ', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.b', '6', '8', 'UNKNOWN', 'D3', '', 16, '19680705 200604 1 00', '2005-01-01', '2017-04-01', NULL, NULL, NULL, NULL, '168527893711000', NULL, '', '024301045661508', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(103, 'aktif', '199104172020121017', '6203051704910002', 'Julianto, SE', 'Gunung Mas', '1991-04-17', 'l', 'islam', NULL, '082251685370', 'Juliantoplasma@yahoo.com', 'Jl. Suka Mangkahai Gg. Padat Karya RT. 3 Mandomai Kapuas Barat', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.b', '7', '8', 'UNKNOWN', 'S1', 'Petugas Pengelola Barang Milik Negara', 4, '19680705 200604 1 00', '2020-12-01', '2025-04-01', NULL, NULL, NULL, NULL, '733227151711000', NULL, '', '452401015348538', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(104, 'aktif', '196803152014112004', '6271035503680005', 'Etik Purnama, S.S.I', 'Barito Timur', '1968-03-15', 'p', 'kristen', NULL, '081345513050', 'etikpurnama76@gmail.com', 'Jl. Garuda X No.21        ', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.a', '7', '8', 'UNKNOWN', 'S1', '', 19, '19680705 200604 1 00', '2014-11-01', '2024-04-01', NULL, NULL, NULL, NULL, '160127031711000', NULL, '', '024301081817507', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(105, 'aktif', '197212262007011016', '6704030911790001', 'Natalis Ingat', 'Ampah', '1972-12-26', 'l', 'kristen', NULL, '085249028643', 'nnatali351@gmail.com', 'Jl. Unkrip No.22 Palangka Raya        ', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'III.a', '5', '8', 'UNKNOWN', 'SMA', '', 4, '19671116 198903 1 00', '2007-01-01', '2025-04-01', NULL, NULL, NULL, NULL, '155435092711000', NULL, '', '024301045615507', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(106, 'aktif', '196901072014111002', '6271010701690002', 'Reflie Ventie Runtu', 'Minahasa', '1969-01-07', 'l', 'kristen', NULL, '089696222232', '196901072014111002@kemenag.go.id', 'Jl. RTA.MilonoKm.7 Langkai Permai III No.5        ', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PNS', 'II.c', '5', '8', 'UNKNOWN', 'SMA', '', 23, '19680705 200604 1 00', '2014-11-01', '2023-04-01', NULL, NULL, NULL, NULL, '746923788711000', NULL, '', '024301081841506', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(107, 'aktif', '199611032023211002', '6271030311960001', 'Kurniawan Netanyahu, M.A', 'Kab. Kapuas', '1996-11-03', 'l', 'kristen', NULL, '081391451588', 'Kurniawanneta.ig@gmail.com', 'Jl. Garuda No 014', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', '', 31, '19720825 200604 2 00', '2023-08-01', '2023-08-01', NULL, NULL, NULL, NULL, '53.143.429.8-711.000', NULL, '2003119601', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(108, 'aktif', '199311272023212034', '1276016711930002', 'Nova Lady Simanjuntak, M.Pd', 'Tebing Tinggi', '1993-11-27', 'p', 'kristen', NULL, '081222406225', 'novaladysimanjuntak27@gmail.com', 'Jl. Tampung Penyang V No. 23', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', '', 30, '19700906 199512 1 00', '2023-08-01', '2023-08-01', NULL, NULL, NULL, NULL, '501186811711000', NULL, '2027119303', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(109, 'aktif', '197911242023211006', '3274042411790008', 'Agus Sutrisno Muljono, S.Psi., M.Si', 'Cirebon', '1979-11-24', 'l', 'kristen', NULL, '081221953123', 'agussutrisnomuljono79@gmail.com', 'JL. Raden Saleh I No. 7A, RT/RW. 004/007, Kel. Menteng, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', '', 32, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '804313138711000', NULL, '2024117903', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(110, 'aktif', '196912232023212005', '6372056312690001', 'Citra Dewi, M.Th', 'Kab. Pulang Pisau', '1969-12-23', 'p', 'kristen', NULL, '081256064604', 'cdewi3621@gmail.com', 'JL. Bajau Ranju No. 38 B, RT/RW. 003/010, Kel. Langkai, Kec. Pahandut', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', '', 36, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '840337521711000', NULL, '2023126901', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(111, 'aktif', '199003292023212040', '6271036903900002', 'Yuherlita Marneci, M.Pd.K', 'Kab. Katingan', '1990-03-29', 'p', 'kristen', NULL, '083141831248', 'yuherlitamarneci001@gmail.com', 'JL. Piranha 8, RT/RW. 00/016, Kel/Desa. Bukit Tunggal, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', '', 6, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '839570884711000', NULL, '9922010520', '24301023742530', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(112, 'aktif', '198908082023211029', '6271010808890008', 'Agus Gelu Libur, S.Pd.K', 'Kab. Flores Timur', '1989-08-08', 'l', 'kristen', NULL, '082148532744', 'agusgelu4@gmail.com', 'JL. Lamtoro Gung II  Blok A. No A 11', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'X', '8', '99', '1538', 'S1', '', 4, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '766920466711000', NULL, '', '24301023738531', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(113, 'aktif', '198912112023212050', '6271045112890001', 'Elisa Theresia, S.Th', 'Kab. Kapuas', '1989-12-11', 'p', 'kristen', NULL, '085349415836', 'elisanessy@gmail.com', 'JL. Matal Gg Sariau No. 07 RT/RW. 004/001 Kel. Sabaru, Kec. Sabangau', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1538', 'S1', '', 4, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '72.250.957.5-711.000', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(114, 'aktif', '199308042023212039', '6213014408930001', 'Hendayani, S.T', 'Kab. Barito Timur', '1993-08-04', 'p', 'kristen', NULL, '082136099148', 'hendayanii04@gmail.com', 'JL. Lamtoro Gung, Jl. Haka 31 No. 1595', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1535', 'S1', '', 4, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(115, 'aktif', '199605022023212034', '6206024205930001', 'Loure Florentina, S.T', 'Palangka Raya', '1996-05-02', 'p', 'kristen', NULL, '081347977601', 'loureflo02@gmail.com', 'JL. G.Obos 25 Jl. Abimanyu No. 41', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1535', 'S1', '', 4, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(116, 'aktif', '199103272023211034', '6271012703910005', 'Yan Patria Pandu Arista, S.Kom', 'Kab. Karanganyar', '1991-03-27', 'l', 'kristen', NULL, '081347812994', 'yan.patria1991@gmail.com', 'JL. Tampung Penyang Perum Kayzar  Estate No. A.01, Kel. Menteng, Kec. Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1530', 'S1', '', 4, '', '2023-12-01', '2024-01-01', NULL, NULL, NULL, NULL, '80.931.382.8-711.000', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(117, 'aktif', '199612212024211014', '6213052112960002', 'Chrismas Debianto, S.Pd.', 'Banjarmasin', '1996-12-21', 'l', 'kristen', NULL, '082352127683', 'debrianharinata@gmail.com', 'Jl. Sulawesi Gang Nusantara No. 48, Kota Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1538', 'S1', '', 18, '', '2024-03-01', '2024-05-01', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(118, 'aktif', '198512092024212019', '6271014912850006', 'Remi Anggela, S.Pd.K.', 'Palangka Raya', '1985-12-09', 'p', 'kristen', NULL, '082255357080', 'anggelaremi@gmail.com', 'Jl. Bukit Pinang No. 160', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1538', 'S1', '', 15, '', '2024-03-01', '2024-05-01', NULL, NULL, NULL, NULL, '76.668.765.1-711.000', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(119, 'aktif', '199404152024212040', '6271015504940001', 'Andika Silviana, S.T.', 'Palangka Raya', '1994-04-15', 'p', 'kristen', NULL, '085246911417', 'Echavi.ev@gmail.com', 'Jl. Temannggung Kanyapi II B', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '5210', 'S1', '', 4, '', '2024-03-01', '2024-05-01', NULL, NULL, NULL, NULL, '839304664711000', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(120, 'aktif', '198611172024211014', '3201371711860002', 'Yafet Bintang Fajar Wailan Sinjal, S.Sn.', 'Jakarta Selatan', '1986-11-17', 'l', 'kristen', NULL, '085778138939', 'Sinjal.yafet@gmail.com', 'Jl. Green Kemang Residence Blok B, No. 11, RT.002/RW.01, Kel. Pabuaran, Kec. Kemang, Kab. Bogor, Jawa Barat', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1520', 'S1', '', 4, '', '2024-03-01', '2024-05-01', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(121, 'aktif', '199603162024211013', '6271031603960010', 'Deniel Marcho Eli Katparu, S.T.', 'Gunung Mas', '1996-03-16', 'l', 'kristen', NULL, '082352695266', 'deniel.marcho@gmail.com', 'Jl. Sei Rangit No. 02', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1535', 'S1', '', 4, '', '2024-03-01', '2024-05-01', NULL, NULL, NULL, NULL, '94.324.169.5-711.000', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(122, 'aktif', '198911142024212033', '6271035411890006', 'Novita Erianti, S.T.', 'Palangka Raya', '1989-11-14', 'p', 'kristen', NULL, '082250239819', 'novita.erianti89@gmail.com', 'Jl. B.Koetin BBA No. 71', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1535', 'S1', '', 28, '', '2024-03-01', '2024-05-01', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(123, 'aktif', '‌197608182025211005', '6211011808760001', 'Dr. Agustiman, M.Min', 'Kab. Kapuas', '1976-08-18', 'l', 'kristen', NULL, '081352715074', 'agustiman5@gmail.com', 'Jl. Antang 1 No 12 Kelurahan Palangka. Kecamatan Jekan Raya. Kota Palangkaraya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'XII', '11', '92', '1562', 'S3', '', 6, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(124, 'aktif', '‌197909282025211011', '6271032809790002', 'Dr. Kilat Kasanang, M.Th', 'Kab. Kapuas', '1979-09-28', 'l', 'kristen', NULL, '082256006639', 'kilatdamai65@gmail.com', 'Jl. Garuda VI No.09, Kel.Palangka, Kec.Jekan Raya, Kota Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'XII', '11', '92', '1562', 'S3', '', 8, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(125, 'aktif', '‌197606012025211004', '6205050106760005', '‌Jonny Meyer, M.Th', 'Jakarta', '1976-06-01', 'l', 'kristen', NULL, '081385253919', 'jonnymeyerpanjaitan01@gmail.com', 'Jl. Matal', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', '', 11, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(126, 'aktif', '‌198406192025212005', '6271035906840004', 'Sinta Nurlela, M.Pd', 'Kab. Gunung Mas', '1984-06-19', 'p', 'kristen', NULL, '085820463040', 'nurlelasinta92@gmail.com', 'Jl. Virgo II No. 65 Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'PPPK', 'X', '9', '92', '1561', 'S2', '', 6, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(127, 'aktif', '‌199401012025211020', '6210020101940002', 'Deprianto, S.Pd', 'Tewang Pajangan', '1994-01-01', 'l', 'kristen', NULL, '0895338860868', 'depriantodepri8@gmail.com', 'Jl. Surung Raya', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1538', 'S1', '', 26, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(128, 'aktif', '‌197109242025211001', '6271012409710002', 'Hari Sonedi, S.Hut', 'Palangka Raya', '1971-09-24', 'l', 'kristen', NULL, '082145500971', 'jhinkuy56@gmail.com', 'Jl. Ibie Kasan No. 05', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1538', 'S1', '', 14, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(129, 'aktif', '‌199506092025212016', '6271014906950003', '‌I Gusti Ayu Aldyth Alodia, S.Kom', 'Tumbang Samba', '1995-06-09', 'l', 'kristen', NULL, '0895349690019', 'igstayu.aldyth@gmail.com', 'Jl. Nyai Rendem', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1535', 'S1', '', 29, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(130, 'aktif', '‌199005062025212013', '6271034605900006', 'Meila Frensisca, S.Kom', 'Palangka Raya', '1990-05-06', 'p', 'kristen', NULL, '081321200990', 'frensangel@gmail.com', 'Jl. Bukit Raya IX.C. GG.1 NO.02', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1535', 'S1', '', 4, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(131, 'aktif', '‌199408142025212012', '6271035408940009', 'Monica augina, S.E', 'Palangka Raya', '1994-08-14', 'p', 'kristen', NULL, '081357042409', 'auginamoca@gmail.com', 'Jl. Antang II', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '5202', 'S1', '', 4, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(132, 'aktif', '‌199107092025212022', '6271034907910001', 'Vinny Maria Yulianty, S.T', 'Kab. Kapuas', '1991-07-09', 'p', 'kristen', NULL, '085249168680', 'vinnymaria13@gmail.com', 'Jl. Sangga Buana I', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '8', '99', '1535', 'S1', '', 26, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(133, 'aktif', '‌199110272025211007', '6271012710910004', 'Antonius Prinando Saputra, S.Pd.K', 'Batapah', '1991-10-27', 'l', 'kristen', NULL, '082251565977', 'antoniuspera@gmail.com', 'Jl. Putri Junjung Buih III No.20', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '7', '8', 'penata_layanan_operasional', 'S1', '', 26, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(134, 'aktif', '‌198702272025211023', '6271012702870007', 'Depi, S.Pd.K', 'Maliku', '1987-02-27', 'l', 'kristen', NULL, '085249043480', 'depidep872@gmail.com', 'Jl. Candra Buana/GG. Pandan Sari', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '7', '8', 'penata_layanan_operasional', 'S1', '', 23, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(135, 'aktif', '‌198506212025211010', '6203102106850003', 'Erick Kristianson, S.Pd', 'Maliku Baru', '1985-06-21', 'l', 'kristen', NULL, '085252900898', 'erickristianson144@gmail.com', 'Jl. G.Obos Komplek DPRD', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '7', '8', 'penata_layanan_operasional', 'S1', '', 14, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(136, 'aktif', '‌198304232025211013', '6210062304830001', 'Frilli Sua Renro, S.Pd.K', 'Palingkau', '1983-04-23', 'l', 'kristen', NULL, '081349209896', 'frillisuarenro@gmail.com', 'Jl. Anggrek KPR No. 8 RT/RW: 004/003', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '7', '8', 'penata_layanan_operasional', 'S1', '', 29, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(137, 'aktif', '‌198502092025211010', '6211020902850001', 'Hendro, S.Pd.K', 'Bahaur', '1985-02-09', 'l', 'kristen', NULL, '085349475410', 'hendropky22@gmail.com', 'Jl. Matal Gg. Sariau', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '7', '8', 'penata_layanan_operasional', 'S1', '', 24, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(138, 'aktif', '‌198410222025211014', '6271032210840008', 'Liven Stifanus, SP', 'Sampit', '1984-10-22', 'l', 'kristen', NULL, '085249056673', 'livenstifanus8@gmail.com', 'Jl. Rajawali V', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '7', '8', 'penata_layanan_operasional', 'S1', '', 24, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(139, 'aktif', '‌198204182025211017', '6271031804820005', 'Sandro, S.Th', 'Mandomai', '1982-04-18', 'l', 'kristen', NULL, '082255907417', 'gloriavoice72@gmail.com', 'Jl.Bangka GG.Kalimantan No.3', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '7', '8', 'penata_layanan_operasional', 'S1', '', 14, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(140, 'aktif', '‌198908032025211014', '6271010308890001', 'Trikashu Awatnu, S.Kom', 'Kab. Gunung Mas', '1989-08-03', 'l', 'kristen', NULL, '085249130233', 'trikashu@yahoo.com', 'Jl G. Obos III No. 94 Palangka Raya', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '7', '8', 'penata_layanan_operasional', 'S1', '', 18, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(141, 'aktif', '‌198901122025211012', '6271010308890001', 'Wardana Kussuma, S.Pd', 'Palangka Raya', '1989-01-12', 'l', 'kristen', NULL, '085387831111', 'wardananr@gmail.com', 'Jl. Patih Tiup II', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'IX', '7', '8', 'penata_layanan_operasional', 'S1', '', 26, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(142, 'aktif', '‌199609182025211010', '6271031809960004', 'Beni, A.Md, KA', 'Palangka Raya', '1996-09-18', 'l', 'kristen', NULL, '082155791301', 'benidiecast96@gmail.com', 'Jl. Mahir-Mahar II A / Bondol I Nomor 01', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'VII', '6', '8', 'pengelola_layanan_operasional', 'DII', '', 16, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(143, 'aktif', '‌198209172025211012', '6271031709820011', 'Setiawan Yardi', 'Palangka Raya', '1982-09-17', 'l', 'kristen', NULL, '', 'awangyardi@gmail.com', 'Jl. B. Koetin BBA No.05', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'V', '5', '8', 'operator_layanan_operasional', 'SMA', '', 2, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(144, 'aktif', '‌198504242025211013', '6271042404850001', 'Vivin', 'Palangka Raya', '1985-04-24', 'l', 'kristen', NULL, '08115246677', 'vivinpky244@gmail.com', 'Jl. Sri Rejeki No. 5 RT/RW 002/004', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'PPPK', 'V', '5', '8', 'operator_layanan_operasional', 'SMA', '', 2, '', '2025-03-01', '2025-05-27', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(145, 'aktif', '199303262025051001', '8101172603930006', '‌Andre Marcel Toisuta, M.A', 'Ambon', '1993-03-26', 'l', 'kristen', NULL, '0895366234555', 'andremarceltoisuta@gmail.com', 'Jl Gurami Putih 1 No.2a RT/RW 05/25', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'CPNS', 'III.b', '9', '91', '1561', 'S2', '', 8, '197009061995121001', '2025-05-01', '2025-06-02', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(146, 'aktif', '199610092025051006', '3274040910960003', '‌Andreas Setiawan, M. Th', 'Cirebon', '1996-10-09', 'l', 'kristen', NULL, '08562191827', 'andreproviden@gmail.com', 'Jl. Tampung Penyang Perumahan Tribrata No. 8. RT/RW 003/013, Kelurahan Menteng, Kecamatan Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'CPNS', 'III.b', '9', '91', '1561', 'S2', '', 7, '197208252006042003', '2025-05-01', '2025-06-02', NULL, NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(147, 'aktif', '199207042025052004', '6271014407920011', '‌Dewani Dama Shinta, M.Si', 'Palangka Raya', '1992-07-04', 'p', 'kristen', NULL, '085959778002', 'dewanidamashinta@gmail.com', 'Jl. Kecipir/Adonis Samad Komp. Borneo Sejahtera, Kelurahan Panarung, Kecamatan Pahandut', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'CPNS', 'III.b', '9', '91', '1561', 'S2', '', 32, '197208252006042003', '2025-05-01', '2025-06-02', NULL, NULL, NULL, NULL, '76.197.451.8-711.000', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(148, 'aktif', '199902112025051005', '1206012202990004', '‌Yoges Mahendra Saragih, M.Pd', 'Kabanjahe', '1999-02-11', 'l', 'kristen', NULL, '085658366842', 'yogesmahendra72@gmail.com', 'Jl. Tampung Penyang, Kelurahan Menteng, Kecamatan Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Dosen', 'CPNS', 'III.b', '9', '91', '1561', 'S2', '', 6, '197402202006042001', '2025-05-01', '2025-06-02', NULL, NULL, NULL, NULL, '1206012201990004', NULL, '2311029901', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(149, 'aktif', '199603302025052008', '6206027003960002', '‌Evelline Kristiani, S.Kom', 'Tumbang Manggo', '1996-03-30', 'p', 'kristen', NULL, '085173380671', 'ev.attoff@gmail.com', 'Jl. Aries Blok C No 6, Kelurahan Kasongan Lama, Katingan Hilir', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'CPNS', 'III.a', '8', '93', '1535', 'S1', '', 4, '196711161989031004', '2025-05-01', '2025-06-02', NULL, NULL, NULL, NULL, '85.787.459.8-712.000', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(150, 'aktif', '199202082025051003', '1571070802920061', '‌Hosea Paniroi Panjaitan, S.E', 'Jambi', '1992-02-08', 'l', 'kristen', NULL, '081241324232', 'hosea.p.panjaitan@gmail.com', 'Jl. Rawamangun Muka Barat Blok A.10 RT.001 RW.012, Kelurahan Rawamangun, Kecamatan Pulogadung  ', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'CPNS', 'III.a', '8', '93', '1525', 'S1', '', 24, '196711161989031004', '2025-05-01', '2025-06-02', NULL, NULL, NULL, NULL, '85.219.481.0-331.000', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(151, 'aktif', '199204202025052001', '1271216004920003', '‌Imelda Apriani Barus, S.E', 'Sumbul', '1992-04-20', 'p', 'kristen', NULL, '081263372866', 'imeldaaprianibarus@gmail.com', 'Jl. Kalibata II, Perum Asyifa Residence Blok C No 7 ', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'CPNS', 'III.a', '8', '93', '1525', 'S1', '', 24, '196711161989031004', '2025-05-01', '2025-06-02', NULL, NULL, NULL, NULL, '74.071.633.7-121.000', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(152, 'aktif', '199411242025052002', '6213076411940001', '‌Vita Novita, S.E', 'Balikpapan', '1994-11-24', 'p', 'kristen', NULL, '085350002950', 'vitanh4@gmail.com', 'Jl. Menteng XIX No 10A, Kelurahan Menteng, Kecamatan Jekan Raya', NULL, NULL, NULL, NULL, NULL, 'Administrasi', 'CPNS', 'III.a', '8', '93', '5240', 'S1', '', 4, '196711161989031004', '2025-05-01', '2025-06-02', NULL, NULL, NULL, NULL, '90.811.389.7-714.000', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table simpeg_local.penempatan
CREATE TABLE IF NOT EXISTS `penempatan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.penempatan: ~37 rows (approximately)
INSERT INTO `penempatan` (`id`, `nama`) VALUES
	(1, 'Biro Administrasi Umum, Akademik dan Kemahasiswaan'),
	(2, 'Bagian Umum dan Layanan Akademik'),
	(3, 'FSKK'),
	(4, 'Biro AUAK'),
	(5, 'Sub Bagian Perencanaan, Keuangan dan Akuntansi'),
	(6, 'Pendidikan Agama Kristen'),
	(7, 'Teologi'),
	(8, 'Musik Gereja'),
	(9, 'Pastoral Konseling'),
	(10, 'FKIPK'),
	(11, 'Kepemimpinan Kristen'),
	(12, 'Teologi S2'),
	(13, 'PAK S2'),
	(14, 'Pascasarjana'),
	(15, 'Lembaga Penjamin Mutu'),
	(16, 'Lembaga Penelitian Pengabdian Masyarakat'),
	(17, 'Unit Bahasa'),
	(18, 'Unit TIPD'),
	(19, 'Unit Perpustakaan'),
	(20, 'FISIKK'),
	(21, 'Ruang WK I'),
	(22, 'Ruang WK II'),
	(23, 'Tata Usaha Fakultas FISKK'),
	(24, 'Satuan Pengawas Internal'),
	(25, 'Keuangan'),
	(26, 'Tata Usaha Fakultas FKIPK'),
	(27, 'Fakultas Keguruan dan Ilmu Pendidikan Kristen'),
	(28, 'Fakultas Ilmu Sosial Keagamaan Kristen'),
	(29, 'Fakultas Seni Keagamaan Kristen'),
	(30, 'Seni Pertunjukan Keagamaan'),
	(31, 'Sosiologi Agama'),
	(32, 'Psikologi Kristen'),
	(33, 'Manajemen Pendidikan Kristen'),
	(34, 'Pendidikan Kristen Anak Usia Dini'),
	(35, 'Pendidikan Musik Gereja'),
	(36, 'Bimbingan dan Konseling Kristen'),
	(37, 'PAK S3');

-- Dumping structure for table simpeg_local.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_enabled` tinytext COLLATE utf8mb4_unicode_ci,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.roles: ~5 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `description`, `is_enabled`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'admin', 'Admin', 'on', NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'admin7', 'Development Admin', 'on', NULL, 1, NULL, NULL, '2025-08-28 07:44:23', NULL),
	(16, 'Dev Test', '2635284639', 'on', NULL, NULL, NULL, '2025-08-28 02:51:56', '2025-08-28 08:12:31', '2025-08-28 08:12:31'),
	(21, 'Dev Test 2', '2635284639', 'on', NULL, NULL, NULL, '2025-08-28 03:06:03', '2025-08-28 08:12:18', '2025-08-28 08:12:18'),
	(25, 'Readonly', '....fy', 'on', NULL, NULL, NULL, '2025-08-28 04:07:20', '2025-08-28 04:07:20', NULL);

-- Dumping structure for table simpeg_local.role_permissions
CREATE TABLE IF NOT EXISTS `role_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `menu_id` bigint unsigned DEFAULT NULL,
  `menu_action_id` bigint unsigned NOT NULL,
  `is_allowed` tinyint(1) NOT NULL DEFAULT '0',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_permissions_menu_action_id_foreign` (`menu_action_id`),
  KEY `role_permissions_role_id_foreign` (`role_id`) USING BTREE,
  CONSTRAINT `role_permissions_menu_action_id_foreign` FOREIGN KEY (`menu_action_id`) REFERENCES `menu_actions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.role_permissions: ~66 rows (approximately)
INSERT INTO `role_permissions` (`id`, `role_id`, `menu_id`, `menu_action_id`, `is_allowed`, `is_enabled`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 2, 3, 1, 1, 0, NULL, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:25:47'),
	(2, 2, 4, 2, 1, 0, NULL, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:25:47'),
	(3, 2, 5, 3, 1, 0, NULL, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:25:47'),
	(4, 2, 6, 4, 1, 0, NULL, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:25:47'),
	(5, 2, 7, 6, 1, 0, NULL, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:25:47'),
	(6, 2, 8, 5, 1, 0, NULL, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:25:47'),
	(8, 25, NULL, 1, 0, 1, NULL, NULL, NULL, '2025-08-28 04:07:20', '2025-08-28 04:07:20', NULL),
	(9, 25, NULL, 2, 0, 1, NULL, NULL, NULL, '2025-08-28 04:07:20', '2025-08-28 04:07:20', NULL),
	(10, 25, NULL, 3, 0, 1, NULL, NULL, NULL, '2025-08-28 04:07:20', '2025-08-28 04:07:20', NULL),
	(11, 25, NULL, 4, 0, 1, NULL, NULL, NULL, '2025-08-28 04:07:20', '2025-08-28 04:07:20', NULL),
	(12, 25, NULL, 5, 0, 1, NULL, NULL, NULL, '2025-08-28 04:07:20', '2025-08-28 04:07:20', NULL),
	(13, 25, NULL, 6, 0, 1, NULL, NULL, NULL, '2025-08-28 04:07:20', '2025-08-28 04:07:20', NULL),
	(17, 2, NULL, 1, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(18, 2, NULL, 7, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(19, 2, NULL, 12, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(20, 2, NULL, 17, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(21, 2, NULL, 2, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(22, 2, NULL, 8, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(23, 2, NULL, 13, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(24, 2, NULL, 18, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(25, 2, NULL, 3, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(26, 2, NULL, 9, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(27, 2, NULL, 14, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(28, 2, NULL, 19, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(29, 2, NULL, 4, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(30, 2, NULL, 10, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(31, 2, NULL, 15, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(32, 2, NULL, 20, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(33, 2, NULL, 22, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(34, 2, NULL, 23, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(35, 2, NULL, 5, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(36, 2, NULL, 11, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(37, 2, NULL, 16, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(38, 2, NULL, 21, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(39, 2, NULL, 24, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(40, 2, NULL, 25, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(41, 2, NULL, 6, 0, 1, NULL, NULL, NULL, '2025-08-28 07:25:47', '2025-08-28 07:44:23', '2025-08-28 07:44:23'),
	(42, 2, NULL, 1, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(43, 2, NULL, 7, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(44, 2, NULL, 12, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(45, 2, NULL, 17, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(46, 2, NULL, 2, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(47, 2, NULL, 8, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(48, 2, NULL, 13, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(49, 2, NULL, 18, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(50, 2, NULL, 3, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(51, 2, NULL, 9, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(52, 2, NULL, 14, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(53, 2, NULL, 19, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(54, 2, NULL, 4, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(55, 2, NULL, 10, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(56, 2, NULL, 15, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(57, 2, NULL, 20, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(58, 2, NULL, 22, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(59, 2, NULL, 23, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(60, 2, NULL, 5, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(61, 2, NULL, 11, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(62, 2, NULL, 16, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(63, 2, NULL, 21, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(64, 2, NULL, 24, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(65, 2, NULL, 25, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL),
	(66, 2, NULL, 6, 0, 1, NULL, NULL, NULL, '2025-08-28 07:44:23', '2025-08-28 07:44:23', NULL);

-- Dumping structure for table simpeg_local.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('2L48anTAGkO0aZ7flp9rwwyw2fr7JT5fWVcFW2q4', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo3OntzOjE1OiJyb2xlX3Blcm1pc3Npb24iO2E6Mjp7aToxO2E6NDp7czo0OiJuYW1lIjtzOjExOiJPcGVyYXNpb25hbCI7czoxMjoiZGlzcGxheV90eXBlIjtzOjEyOiJkaXZpZGVyLXRleHQiO3M6NDoiaWNvbiI7TjtzOjg6ImNoaWxkcmVuIjthOjM6e2k6MDthOjY6e3M6NDoibmFtZSI7czo5OiJTdGF0aXN0aWsiO3M6MTI6ImRpc3BsYXlfdHlwZSI7TjtzOjQ6Imljb24iO3M6MTc6ImNhbmRsZXN0aWNrLWNoYXJ0IjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NjoicGVybWl0IjthOjY6e2k6MDthOjEyOntzOjI6ImlkIjtpOjQ7czo3OiJtZW51X2lkIjtpOjY7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjEwOiIvc3RhdGlzdGljIjtzOjU6ImxhYmVsIjtzOjExOiJEYWZ0YXIgRGF0YSI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjE7YToxMjp7czoyOiJpZCI7aToxMDtzOjc6Im1lbnVfaWQiO2k6NjtzOjQ6Im5hbWUiO3M6MzoiYWRkIjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6NjoiVGFtYmFoIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6MjthOjEyOntzOjI6ImlkIjtpOjE1O3M6NzoibWVudV9pZCI7aTo2O3M6NDoibmFtZSI7czo0OiJlZGl0IjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6NDoiRWRpdCI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjM7YToxMjp7czoyOiJpZCI7aToyMDtzOjc6Im1lbnVfaWQiO2k6NjtzOjQ6Im5hbWUiO3M6NjoiZGVsZXRlIjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6NToiSGFwdXMiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aTo0O2E6MTI6e3M6MjoiaWQiO2k6MjI7czo3OiJtZW51X2lkIjtpOjY7czo0OiJuYW1lIjtzOjEwOiJleHBvcnRfY3N2IjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6MTA6IkVrc3BvciBDU1YiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aTo1O2E6MTI6e3M6MjoiaWQiO2k6MjM7czo3OiJtZW51X2lkIjtpOjY7czo0OiJuYW1lIjtzOjEwOiJleHBvcnRfcGRmIjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6MTA6IkVrc3BvciBQREYiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9fXM6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjE7YTo2OntzOjQ6Im5hbWUiO3M6MTY6IkRhdGEgS2VwZWdhd2FpYW4iO3M6MTI6ImRpc3BsYXlfdHlwZSI7TjtzOjQ6Imljb24iO3M6MTA6ImJ1aWxkaW5nLTIiO3M6NDoic2x1ZyI7czo5OiIvZW1wbG95ZWUiO3M6NjoicGVybWl0IjthOjY6e2k6MDthOjEyOntzOjI6ImlkIjtpOjU7czo3OiJtZW51X2lkIjtpOjc7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjk6Ii9lbXBsb3llZSI7czo1OiJsYWJlbCI7czoxMToiRGFmdGFyIERhdGEiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToxO2E6MTI6e3M6MjoiaWQiO2k6MTE7czo3OiJtZW51X2lkIjtpOjc7czo0OiJuYW1lIjtzOjM6ImFkZCI7czo0OiJzbHVnIjtzOjk6Ii9lbXBsb3llZSI7czo1OiJsYWJlbCI7czo2OiJUYW1iYWgiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToyO2E6MTI6e3M6MjoiaWQiO2k6MTY7czo3OiJtZW51X2lkIjtpOjc7czo0OiJuYW1lIjtzOjQ6ImVkaXQiO3M6NDoic2x1ZyI7czo5OiIvZW1wbG95ZWUiO3M6NToibGFiZWwiO3M6NDoiRWRpdCI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjM7YToxMjp7czoyOiJpZCI7aToyMTtzOjc6Im1lbnVfaWQiO2k6NztzOjQ6Im5hbWUiO3M6NjoiZGVsZXRlIjtzOjQ6InNsdWciO3M6OToiL2VtcGxveWVlIjtzOjU6ImxhYmVsIjtzOjU6IkhhcHVzIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6NDthOjEyOntzOjI6ImlkIjtpOjI0O3M6NzoibWVudV9pZCI7aTo3O3M6NDoibmFtZSI7czoxMDoiZXhwb3J0X2NzdiI7czo0OiJzbHVnIjtzOjk6Ii9lbXBsb3llZSI7czo1OiJsYWJlbCI7czoxMDoiRWtzcG9yIENTViI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjU7YToxMjp7czoyOiJpZCI7aToyNTtzOjc6Im1lbnVfaWQiO2k6NztzOjQ6Im5hbWUiO3M6MTA6ImV4cG9ydF9wZGYiO3M6NDoic2x1ZyI7czo5OiIvZW1wbG95ZWUiO3M6NToibGFiZWwiO3M6MTA6IkVrc3BvciBQREYiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9fXM6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjI7YTo2OntzOjQ6Im5hbWUiO3M6NzoiTG9nIEFwcCI7czoxMjoiZGlzcGxheV90eXBlIjtOO3M6NDoiaWNvbiI7czoxMDoiZmlsZS1jbG9jayI7czo0OiJzbHVnIjtzOjQ6Ii9sb2ciO3M6NjoicGVybWl0IjthOjE6e2k6MDthOjEyOntzOjI6ImlkIjtpOjY7czo3OiJtZW51X2lkIjtpOjg7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjQ6Ii9sb2ciO3M6NToibGFiZWwiO3M6MTE6IkRhZnRhciBEYXRhIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fX1zOjg6ImNoaWxkcmVuIjthOjA6e319fX1pOjI7YTo0OntzOjQ6Im5hbWUiO3M6MTA6IlBlbmdhdHVyYW4iO3M6MTI6ImRpc3BsYXlfdHlwZSI7czoxMjoiZGl2aWRlci10ZXh0IjtzOjQ6Imljb24iO3M6MDoiIjtzOjg6ImNoaWxkcmVuIjthOjM6e2k6MDthOjY6e3M6NDoibmFtZSI7czoxMjoiS2Vsb2xhIEFrc2VzIjtzOjEyOiJkaXNwbGF5X3R5cGUiO3M6MDoiIjtzOjQ6Imljb24iO3M6OToic2Nhbi1mYWNlIjtzOjQ6InNsdWciO3M6NToiL3JvbGUiO3M6NjoicGVybWl0IjthOjQ6e2k6MDthOjEyOntzOjI6ImlkIjtpOjE7czo3OiJtZW51X2lkIjtpOjM7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjU6Ii9yb2xlIjtzOjU6ImxhYmVsIjtzOjExOiJEYWZ0YXIgRGF0YSI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjE7YToxMjp7czoyOiJpZCI7aTo3O3M6NzoibWVudV9pZCI7aTozO3M6NDoibmFtZSI7czozOiJhZGQiO3M6NDoic2x1ZyI7czo1OiIvcm9sZSI7czo1OiJsYWJlbCI7czo2OiJUYW1iYWgiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToyO2E6MTI6e3M6MjoiaWQiO2k6MTI7czo3OiJtZW51X2lkIjtpOjM7czo0OiJuYW1lIjtzOjQ6ImVkaXQiO3M6NDoic2x1ZyI7czo1OiIvcm9sZSI7czo1OiJsYWJlbCI7czo0OiJFZGl0IjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6MzthOjEyOntzOjI6ImlkIjtpOjE3O3M6NzoibWVudV9pZCI7aTozO3M6NDoibmFtZSI7czo2OiJkZWxldGUiO3M6NDoic2x1ZyI7czo1OiIvcm9sZSI7czo1OiJsYWJlbCI7czo1OiJIYXB1cyI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO319czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6MTthOjY6e3M6NDoibmFtZSI7czoxNDoiR3JvdXAgUGVuZ2d1bmEiO3M6MTI6ImRpc3BsYXlfdHlwZSI7TjtzOjQ6Imljb24iO3M6OToiY29tcG9uZW50IjtzOjQ6InNsdWciO3M6MTE6Ii91c2VyLWdyb3VwIjtzOjY6InBlcm1pdCI7YTo0OntpOjA7YToxMjp7czoyOiJpZCI7aToyO3M6NzoibWVudV9pZCI7aTo0O3M6NDoibmFtZSI7czo5OiJyZWFkLWxpc3QiO3M6NDoic2x1ZyI7czoxMToiL3VzZXItZ3JvdXAiO3M6NToibGFiZWwiO3M6MTE6IkRhZnRhciBEYXRhIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6MTthOjEyOntzOjI6ImlkIjtpOjg7czo3OiJtZW51X2lkIjtpOjQ7czo0OiJuYW1lIjtzOjM6ImFkZCI7czo0OiJzbHVnIjtzOjExOiIvdXNlci1ncm91cCI7czo1OiJsYWJlbCI7czo2OiJUYW1iYWgiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToyO2E6MTI6e3M6MjoiaWQiO2k6MTM7czo3OiJtZW51X2lkIjtpOjQ7czo0OiJuYW1lIjtzOjQ6ImVkaXQiO3M6NDoic2x1ZyI7czoxMToiL3VzZXItZ3JvdXAiO3M6NToibGFiZWwiO3M6NDoiRWRpdCI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjM7YToxMjp7czoyOiJpZCI7aToxODtzOjc6Im1lbnVfaWQiO2k6NDtzOjQ6Im5hbWUiO3M6NjoiZGVsZXRlIjtzOjQ6InNsdWciO3M6MTE6Ii91c2VyLWdyb3VwIjtzOjU6ImxhYmVsIjtzOjU6IkhhcHVzIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fX1zOjg6ImNoaWxkcmVuIjthOjA6e319aToyO2E6Njp7czo0OiJuYW1lIjtzOjg6IlBlbmdndW5hIjtzOjEyOiJkaXNwbGF5X3R5cGUiO047czo0OiJpY29uIjtzOjU6InNtaWxlIjtzOjQ6InNsdWciO3M6NToiL3VzZXIiO3M6NjoicGVybWl0IjthOjQ6e2k6MDthOjEyOntzOjI6ImlkIjtpOjM7czo3OiJtZW51X2lkIjtpOjU7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjU6Ii91c2VyIjtzOjU6ImxhYmVsIjtzOjExOiJEYWZ0YXIgRGF0YSI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjE7YToxMjp7czoyOiJpZCI7aTo5O3M6NzoibWVudV9pZCI7aTo1O3M6NDoibmFtZSI7czozOiJhZGQiO3M6NDoic2x1ZyI7czo1OiIvdXNlciI7czo1OiJsYWJlbCI7czo2OiJUYW1iYWgiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToyO2E6MTI6e3M6MjoiaWQiO2k6MTQ7czo3OiJtZW51X2lkIjtpOjU7czo0OiJuYW1lIjtzOjQ6ImVkaXQiO3M6NDoic2x1ZyI7czo1OiIvdXNlciI7czo1OiJsYWJlbCI7czo0OiJFZGl0IjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6MzthOjEyOntzOjI6ImlkIjtpOjE5O3M6NzoibWVudV9pZCI7aTo1O3M6NDoibmFtZSI7czo2OiJkZWxldGUiO3M6NDoic2x1ZyI7czo1OiIvdXNlciI7czo1OiJsYWJlbCI7czo1OiJIYXB1cyI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO319czo4OiJjaGlsZHJlbiI7YTowOnt9fX19fXM6NjoiX3Rva2VuIjtzOjQwOiJDY0FLSTBkVXJ4RExjemU1Q2xUeHRMYUh6WU9naGVtY01ZeWhLc1NjIjtzOjM6InVybCI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9lbXBsb3llZS8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjEwOiJfdG9rZW5fYXBpIjtzOjEwMjc6ImV5SjBlWEFpT2lKS1YxUWlMQ0poYkdjaU9pSlNVekkxTmlKOS5leUpoZFdRaU9pSXdNVGszWVRBeFppMDVaVGhsTFRjellUTXRPV1JoWmkwNU16UXhNMlUxTm1aaFpUa2lMQ0pxZEdraU9pSTJaREU0TUdRM1lXVmhZV1kxWW1aa1lXRmpaakJtTXpoaU1USmxOemsxTWprek5HRTRNelkzT1RGaFl6ZzNNV0kyTWpnMk9URTBNVEExWVdJNE5XRTJOek15TmpBNU1HTTFNRFkzWXpJMVpDSXNJbWxoZENJNk1UYzFOamN3T1RNM015NHpOelE1TWpJc0ltNWlaaUk2TVRjMU5qY3dPVE0zTXk0ek56UTVNalVzSW1WNGNDSTZNVGM0T0RJME5UTTNNeTR6TmpVME1Ua3NJbk4xWWlJNklqRWlMQ0p6WTI5d1pYTWlPbHRkZlEuV1lxS3lQQzZiTGlqbGw4QjZFdjZ4Ml8zeTZYN2xuLUQtb0VRSVR0T2tqMWRZMEphdnB5RVFIS0FKT2h2T3M1djY4TEo3aEVrVVR0UEFKdkRfTC1KR1VxbFpiNWo5N2diODNoRlFxOV9ldFQ2dUI3VEh4aGtWRGlocjVkMXVnUV9CNnE2V1RxbEZCZ2ZQWGpMVzNIdlUwaEVYNmJ1WjVmMTRHRDVRcnc3aWJ0SWp5Vl83UndhQUFwa0l6YkNQNVZ6cGlYb2ZmQjMxbC1MVllIQVlUNnU3b01zblJuU3pBODBDYnlfZmVnUlNKU2pST0pPeFVFY0V1X2xhTDhYelphSjF2ZHp6OE40OTRqMklyQlB1VUhjT012R0hpazJXOGZLVUFZYUtfMFRHd3JjdTZ2QVFKZlhYVXpoT05KVTc0b0VucWtfV2ZqN3JwdWx5UkhQZ2t2ZF9qM2NBSVlNeG54SXhzRUctTEdPZVdMSG9tdmtLLVBUQlE0S0FhZFVqc1ZVcU53dHRtd1JRWlRKbWVFQkctekIySzhMdEdkMnhHYmVoTDhHOWdxZkh1MFhoMnByVW9MSkdWandWV09xUThrY0FaXy1Nc1JwTlJOTnZRbVc2ek05NnZjT0tXb01YRTNEMk5SNlMwRFpPNFNhNlhiZXR1OGZRdlBIRTZTaDU3OWVzVVhoTnd0MG5hOHdlbXVEcFdsSXRiRkprRFNhZFRNLUtCVlUwMWlwYVhLUUFjVE5qZGVSNjBxZFNPajFUeTM3UGlfQ3lZTmtFZzF2U2ZERWZTS3UyNjRxZlRELTljeUVpcEFOeldjRVdnbW4tamZxWUtsaEhzbHFLRjN5OGhIQjZtdGo4U2J6bjZxaU05OTRKX1lEYnRBdTRVbG9jV0k4N09tZ04xZEdaMGMiO30=', 1756715871),
	('3DRAHkrjSUQh4xLDseEb3WhKi6rJYb3r9V6YkU3Q', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo3OntzOjE1OiJyb2xlX3Blcm1pc3Npb24iO2E6Mjp7aToxO2E6NDp7czo0OiJuYW1lIjtzOjExOiJPcGVyYXNpb25hbCI7czoxMjoiZGlzcGxheV90eXBlIjtzOjEyOiJkaXZpZGVyLXRleHQiO3M6NDoiaWNvbiI7TjtzOjg6ImNoaWxkcmVuIjthOjM6e2k6MDthOjY6e3M6NDoibmFtZSI7czo5OiJTdGF0aXN0aWsiO3M6MTI6ImRpc3BsYXlfdHlwZSI7TjtzOjQ6Imljb24iO3M6MTc6ImNhbmRsZXN0aWNrLWNoYXJ0IjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NjoicGVybWl0IjthOjY6e2k6MDthOjEyOntzOjI6ImlkIjtpOjQ7czo3OiJtZW51X2lkIjtpOjY7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjEwOiIvc3RhdGlzdGljIjtzOjU6ImxhYmVsIjtzOjExOiJEYWZ0YXIgRGF0YSI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjE7YToxMjp7czoyOiJpZCI7aToxMDtzOjc6Im1lbnVfaWQiO2k6NjtzOjQ6Im5hbWUiO3M6MzoiYWRkIjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6NjoiVGFtYmFoIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6MjthOjEyOntzOjI6ImlkIjtpOjE1O3M6NzoibWVudV9pZCI7aTo2O3M6NDoibmFtZSI7czo0OiJlZGl0IjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6NDoiRWRpdCI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjM7YToxMjp7czoyOiJpZCI7aToyMDtzOjc6Im1lbnVfaWQiO2k6NjtzOjQ6Im5hbWUiO3M6NjoiZGVsZXRlIjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6NToiSGFwdXMiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aTo0O2E6MTI6e3M6MjoiaWQiO2k6MjI7czo3OiJtZW51X2lkIjtpOjY7czo0OiJuYW1lIjtzOjEwOiJleHBvcnRfY3N2IjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6MTA6IkVrc3BvciBDU1YiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aTo1O2E6MTI6e3M6MjoiaWQiO2k6MjM7czo3OiJtZW51X2lkIjtpOjY7czo0OiJuYW1lIjtzOjEwOiJleHBvcnRfcGRmIjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6MTA6IkVrc3BvciBQREYiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9fXM6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjE7YTo2OntzOjQ6Im5hbWUiO3M6MTY6IkRhdGEgS2VwZWdhd2FpYW4iO3M6MTI6ImRpc3BsYXlfdHlwZSI7TjtzOjQ6Imljb24iO3M6MTA6ImJ1aWxkaW5nLTIiO3M6NDoic2x1ZyI7czo5OiIvZW1wbG95ZWUiO3M6NjoicGVybWl0IjthOjY6e2k6MDthOjEyOntzOjI6ImlkIjtpOjU7czo3OiJtZW51X2lkIjtpOjc7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjk6Ii9lbXBsb3llZSI7czo1OiJsYWJlbCI7czoxMToiRGFmdGFyIERhdGEiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToxO2E6MTI6e3M6MjoiaWQiO2k6MTE7czo3OiJtZW51X2lkIjtpOjc7czo0OiJuYW1lIjtzOjM6ImFkZCI7czo0OiJzbHVnIjtzOjk6Ii9lbXBsb3llZSI7czo1OiJsYWJlbCI7czo2OiJUYW1iYWgiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToyO2E6MTI6e3M6MjoiaWQiO2k6MTY7czo3OiJtZW51X2lkIjtpOjc7czo0OiJuYW1lIjtzOjQ6ImVkaXQiO3M6NDoic2x1ZyI7czo5OiIvZW1wbG95ZWUiO3M6NToibGFiZWwiO3M6NDoiRWRpdCI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjM7YToxMjp7czoyOiJpZCI7aToyMTtzOjc6Im1lbnVfaWQiO2k6NztzOjQ6Im5hbWUiO3M6NjoiZGVsZXRlIjtzOjQ6InNsdWciO3M6OToiL2VtcGxveWVlIjtzOjU6ImxhYmVsIjtzOjU6IkhhcHVzIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6NDthOjEyOntzOjI6ImlkIjtpOjI0O3M6NzoibWVudV9pZCI7aTo3O3M6NDoibmFtZSI7czoxMDoiZXhwb3J0X2NzdiI7czo0OiJzbHVnIjtzOjk6Ii9lbXBsb3llZSI7czo1OiJsYWJlbCI7czoxMDoiRWtzcG9yIENTViI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjU7YToxMjp7czoyOiJpZCI7aToyNTtzOjc6Im1lbnVfaWQiO2k6NztzOjQ6Im5hbWUiO3M6MTA6ImV4cG9ydF9wZGYiO3M6NDoic2x1ZyI7czo5OiIvZW1wbG95ZWUiO3M6NToibGFiZWwiO3M6MTA6IkVrc3BvciBQREYiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9fXM6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjI7YTo2OntzOjQ6Im5hbWUiO3M6NzoiTG9nIEFwcCI7czoxMjoiZGlzcGxheV90eXBlIjtOO3M6NDoiaWNvbiI7czoxMDoiZmlsZS1jbG9jayI7czo0OiJzbHVnIjtzOjQ6Ii9sb2ciO3M6NjoicGVybWl0IjthOjE6e2k6MDthOjEyOntzOjI6ImlkIjtpOjY7czo3OiJtZW51X2lkIjtpOjg7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjQ6Ii9sb2ciO3M6NToibGFiZWwiO3M6MTE6IkRhZnRhciBEYXRhIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fX1zOjg6ImNoaWxkcmVuIjthOjA6e319fX1pOjI7YTo0OntzOjQ6Im5hbWUiO3M6MTA6IlBlbmdhdHVyYW4iO3M6MTI6ImRpc3BsYXlfdHlwZSI7czoxMjoiZGl2aWRlci10ZXh0IjtzOjQ6Imljb24iO3M6MDoiIjtzOjg6ImNoaWxkcmVuIjthOjM6e2k6MDthOjY6e3M6NDoibmFtZSI7czoxMjoiS2Vsb2xhIEFrc2VzIjtzOjEyOiJkaXNwbGF5X3R5cGUiO3M6MDoiIjtzOjQ6Imljb24iO3M6OToic2Nhbi1mYWNlIjtzOjQ6InNsdWciO3M6NToiL3JvbGUiO3M6NjoicGVybWl0IjthOjQ6e2k6MDthOjEyOntzOjI6ImlkIjtpOjE7czo3OiJtZW51X2lkIjtpOjM7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjU6Ii9yb2xlIjtzOjU6ImxhYmVsIjtzOjExOiJEYWZ0YXIgRGF0YSI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjE7YToxMjp7czoyOiJpZCI7aTo3O3M6NzoibWVudV9pZCI7aTozO3M6NDoibmFtZSI7czozOiJhZGQiO3M6NDoic2x1ZyI7czo1OiIvcm9sZSI7czo1OiJsYWJlbCI7czo2OiJUYW1iYWgiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToyO2E6MTI6e3M6MjoiaWQiO2k6MTI7czo3OiJtZW51X2lkIjtpOjM7czo0OiJuYW1lIjtzOjQ6ImVkaXQiO3M6NDoic2x1ZyI7czo1OiIvcm9sZSI7czo1OiJsYWJlbCI7czo0OiJFZGl0IjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6MzthOjEyOntzOjI6ImlkIjtpOjE3O3M6NzoibWVudV9pZCI7aTozO3M6NDoibmFtZSI7czo2OiJkZWxldGUiO3M6NDoic2x1ZyI7czo1OiIvcm9sZSI7czo1OiJsYWJlbCI7czo1OiJIYXB1cyI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO319czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6MTthOjY6e3M6NDoibmFtZSI7czoxNDoiR3JvdXAgUGVuZ2d1bmEiO3M6MTI6ImRpc3BsYXlfdHlwZSI7TjtzOjQ6Imljb24iO3M6OToiY29tcG9uZW50IjtzOjQ6InNsdWciO3M6MTE6Ii91c2VyLWdyb3VwIjtzOjY6InBlcm1pdCI7YTo0OntpOjA7YToxMjp7czoyOiJpZCI7aToyO3M6NzoibWVudV9pZCI7aTo0O3M6NDoibmFtZSI7czo5OiJyZWFkLWxpc3QiO3M6NDoic2x1ZyI7czoxMToiL3VzZXItZ3JvdXAiO3M6NToibGFiZWwiO3M6MTE6IkRhZnRhciBEYXRhIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6MTthOjEyOntzOjI6ImlkIjtpOjg7czo3OiJtZW51X2lkIjtpOjQ7czo0OiJuYW1lIjtzOjM6ImFkZCI7czo0OiJzbHVnIjtzOjExOiIvdXNlci1ncm91cCI7czo1OiJsYWJlbCI7czo2OiJUYW1iYWgiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToyO2E6MTI6e3M6MjoiaWQiO2k6MTM7czo3OiJtZW51X2lkIjtpOjQ7czo0OiJuYW1lIjtzOjQ6ImVkaXQiO3M6NDoic2x1ZyI7czoxMToiL3VzZXItZ3JvdXAiO3M6NToibGFiZWwiO3M6NDoiRWRpdCI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjM7YToxMjp7czoyOiJpZCI7aToxODtzOjc6Im1lbnVfaWQiO2k6NDtzOjQ6Im5hbWUiO3M6NjoiZGVsZXRlIjtzOjQ6InNsdWciO3M6MTE6Ii91c2VyLWdyb3VwIjtzOjU6ImxhYmVsIjtzOjU6IkhhcHVzIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fX1zOjg6ImNoaWxkcmVuIjthOjA6e319aToyO2E6Njp7czo0OiJuYW1lIjtzOjg6IlBlbmdndW5hIjtzOjEyOiJkaXNwbGF5X3R5cGUiO047czo0OiJpY29uIjtzOjU6InNtaWxlIjtzOjQ6InNsdWciO3M6NToiL3VzZXIiO3M6NjoicGVybWl0IjthOjQ6e2k6MDthOjEyOntzOjI6ImlkIjtpOjM7czo3OiJtZW51X2lkIjtpOjU7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjU6Ii91c2VyIjtzOjU6ImxhYmVsIjtzOjExOiJEYWZ0YXIgRGF0YSI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjE7YToxMjp7czoyOiJpZCI7aTo5O3M6NzoibWVudV9pZCI7aTo1O3M6NDoibmFtZSI7czozOiJhZGQiO3M6NDoic2x1ZyI7czo1OiIvdXNlciI7czo1OiJsYWJlbCI7czo2OiJUYW1iYWgiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToyO2E6MTI6e3M6MjoiaWQiO2k6MTQ7czo3OiJtZW51X2lkIjtpOjU7czo0OiJuYW1lIjtzOjQ6ImVkaXQiO3M6NDoic2x1ZyI7czo1OiIvdXNlciI7czo1OiJsYWJlbCI7czo0OiJFZGl0IjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6MzthOjEyOntzOjI6ImlkIjtpOjE5O3M6NzoibWVudV9pZCI7aTo1O3M6NDoibmFtZSI7czo2OiJkZWxldGUiO3M6NDoic2x1ZyI7czo1OiIvdXNlciI7czo1OiJsYWJlbCI7czo1OiJIYXB1cyI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO319czo4OiJjaGlsZHJlbiI7YTowOnt9fX19fXM6NjoiX3Rva2VuIjtzOjQwOiJmU3o5a3drNGZKYnZWaTdBV2w2NjhhT2dXYUNNNldTOW5zbEVMaXJBIjtzOjM6InVybCI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9lbXBsb3llZS9hZGQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTA6Il90b2tlbl9hcGkiO3M6MTAyNToiZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKU1V6STFOaUo5LmV5SmhkV1FpT2lJd01UazNZVEF4WmkwNVpUaGxMVGN6WVRNdE9XUmhaaTA1TXpReE0yVTFObVpoWlRraUxDSnFkR2tpT2lKaU5ESTJOV1kyTVRCa05UVXlNemhoT1dObVkyVTVOVEF4TW1RMU16RmhNRGMxWmpKa01URXhPR0ZtTVdFNU56a3lNR1F5TUdNeE9ERm1ZV0k0T1RneVpEa3pZbVEyTlRKbVpEWXdOREl3TlNJc0ltbGhkQ0k2TVRjMU5qazNNREl6TUM0eU1UazBNalFzSW01aVppSTZNVGMxTmprM01ESXpNQzR5TVRrME16VXNJbVY0Y0NJNk1UYzRPRFV3TmpJek1DNHlNRE0yTml3aWMzVmlJam9pTVNJc0luTmpiM0JsY3lJNlcxMTkuWDJ5TGt4d3RWUFlqVFhqMXVNWURaY1VibmFxZW14RU96TVlIWkVoMVdTYVV5RHhtbER1b2Z4ZTJ2NnNqUi1ZbHpuQ2lGZUNwS3JkbFFKazVxeHBQeVIxT1ZlR2pZbVNONXloZm0xWjI5U21KaE1JWkRFWDNvTlZDOGxoa0dCMG5lcWVBZVd4b0k5bXpuc0RCcjBnUW1wUGpHSUVDVkVHX1NJYVBwZHRQZ0dwZHRrR2lLdzdrMUFhQzdRZDFYcUMtaWlNaUFHMzVLWlQ5RmFfVUFGUnJwcHljdno3OVo0T19UeDJucEFWemlJSlRDZVcya2hLaWgzcEJaSlI5blN6Z0hfN05va3Zubmh6U0VjMnl5X0JWUUxwYll2M0djMUt1ek1KZFY5SkhFVXhFM2xMTXF5RDRYYk9tQ1NzU3JwY1Q1V1lBWDlhcVJfQkhuWEx3ekRIOXZsTnJDSldDR0c2N21aNkNFZkdxZlJmQWlyc0c0eFlGbFdFcjc4Z0U5RWRZbWw5VFVZSl9ndTNZUjRyX0NHeEU3bkZSMEQwUXhsV0RZSkZWMFkxcjFsSVdRYjhCSWNGQjJockVIanFIdkJ6T2w5MEVFcGZJbVhYYTVlMEoxQk9tZGZSSF9TLXprZ2NxU21JSWI5eFRPbUZLNDhqeHlTNWtDX3VQLVAtZEVMMWttLWpZYVZnSWJjSFBFSDJxMXpEQmRIM1g2OGpmY0thWFFaZlVMRGU3dk1WMWlHVGlNRExyd0NFb0h3OTJLSnBvaHM4cU43V0E4dnNuMVQ1VG42THRocUdydjlZakRrQU9ab21EVHlmamZsakpvYWZtM1QxNWdMczBiLUxnWEFQN09NNnI3ck5GcG5qVC1rLUZrXzAtWGtQNjZmS2JrRXRRVmY4QkFDbmJfek0iO30=', 1756970314),
	('Xg69Wp2rQkk4lHRXoaBZbm6VFy3DVzjPDYX1dugE', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo2OntzOjE1OiJyb2xlX3Blcm1pc3Npb24iO2E6Mjp7aToxO2E6NDp7czo0OiJuYW1lIjtzOjExOiJPcGVyYXNpb25hbCI7czoxMjoiZGlzcGxheV90eXBlIjtzOjEyOiJkaXZpZGVyLXRleHQiO3M6NDoiaWNvbiI7TjtzOjg6ImNoaWxkcmVuIjthOjM6e2k6MDthOjY6e3M6NDoibmFtZSI7czo5OiJTdGF0aXN0aWsiO3M6MTI6ImRpc3BsYXlfdHlwZSI7TjtzOjQ6Imljb24iO3M6MTc6ImNhbmRsZXN0aWNrLWNoYXJ0IjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NjoicGVybWl0IjthOjY6e2k6MDthOjEyOntzOjI6ImlkIjtpOjQ7czo3OiJtZW51X2lkIjtpOjY7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjEwOiIvc3RhdGlzdGljIjtzOjU6ImxhYmVsIjtzOjExOiJEYWZ0YXIgRGF0YSI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjE7YToxMjp7czoyOiJpZCI7aToxMDtzOjc6Im1lbnVfaWQiO2k6NjtzOjQ6Im5hbWUiO3M6MzoiYWRkIjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6NjoiVGFtYmFoIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6MjthOjEyOntzOjI6ImlkIjtpOjE1O3M6NzoibWVudV9pZCI7aTo2O3M6NDoibmFtZSI7czo0OiJlZGl0IjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6NDoiRWRpdCI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjM7YToxMjp7czoyOiJpZCI7aToyMDtzOjc6Im1lbnVfaWQiO2k6NjtzOjQ6Im5hbWUiO3M6NjoiZGVsZXRlIjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6NToiSGFwdXMiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aTo0O2E6MTI6e3M6MjoiaWQiO2k6MjI7czo3OiJtZW51X2lkIjtpOjY7czo0OiJuYW1lIjtzOjEwOiJleHBvcnRfY3N2IjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6MTA6IkVrc3BvciBDU1YiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aTo1O2E6MTI6e3M6MjoiaWQiO2k6MjM7czo3OiJtZW51X2lkIjtpOjY7czo0OiJuYW1lIjtzOjEwOiJleHBvcnRfcGRmIjtzOjQ6InNsdWciO3M6MTA6Ii9zdGF0aXN0aWMiO3M6NToibGFiZWwiO3M6MTA6IkVrc3BvciBQREYiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9fXM6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjE7YTo2OntzOjQ6Im5hbWUiO3M6MTY6IkRhdGEgS2VwZWdhd2FpYW4iO3M6MTI6ImRpc3BsYXlfdHlwZSI7TjtzOjQ6Imljb24iO3M6MTA6ImJ1aWxkaW5nLTIiO3M6NDoic2x1ZyI7czo5OiIvZW1wbG95ZWUiO3M6NjoicGVybWl0IjthOjY6e2k6MDthOjEyOntzOjI6ImlkIjtpOjU7czo3OiJtZW51X2lkIjtpOjc7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjk6Ii9lbXBsb3llZSI7czo1OiJsYWJlbCI7czoxMToiRGFmdGFyIERhdGEiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToxO2E6MTI6e3M6MjoiaWQiO2k6MTE7czo3OiJtZW51X2lkIjtpOjc7czo0OiJuYW1lIjtzOjM6ImFkZCI7czo0OiJzbHVnIjtzOjk6Ii9lbXBsb3llZSI7czo1OiJsYWJlbCI7czo2OiJUYW1iYWgiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToyO2E6MTI6e3M6MjoiaWQiO2k6MTY7czo3OiJtZW51X2lkIjtpOjc7czo0OiJuYW1lIjtzOjQ6ImVkaXQiO3M6NDoic2x1ZyI7czo5OiIvZW1wbG95ZWUiO3M6NToibGFiZWwiO3M6NDoiRWRpdCI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjM7YToxMjp7czoyOiJpZCI7aToyMTtzOjc6Im1lbnVfaWQiO2k6NztzOjQ6Im5hbWUiO3M6NjoiZGVsZXRlIjtzOjQ6InNsdWciO3M6OToiL2VtcGxveWVlIjtzOjU6ImxhYmVsIjtzOjU6IkhhcHVzIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6NDthOjEyOntzOjI6ImlkIjtpOjI0O3M6NzoibWVudV9pZCI7aTo3O3M6NDoibmFtZSI7czoxMDoiZXhwb3J0X2NzdiI7czo0OiJzbHVnIjtzOjk6Ii9lbXBsb3llZSI7czo1OiJsYWJlbCI7czoxMDoiRWtzcG9yIENTViI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjU7YToxMjp7czoyOiJpZCI7aToyNTtzOjc6Im1lbnVfaWQiO2k6NztzOjQ6Im5hbWUiO3M6MTA6ImV4cG9ydF9wZGYiO3M6NDoic2x1ZyI7czo5OiIvZW1wbG95ZWUiO3M6NToibGFiZWwiO3M6MTA6IkVrc3BvciBQREYiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9fXM6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjI7YTo2OntzOjQ6Im5hbWUiO3M6NzoiTG9nIEFwcCI7czoxMjoiZGlzcGxheV90eXBlIjtOO3M6NDoiaWNvbiI7czoxMDoiZmlsZS1jbG9jayI7czo0OiJzbHVnIjtzOjQ6Ii9sb2ciO3M6NjoicGVybWl0IjthOjE6e2k6MDthOjEyOntzOjI6ImlkIjtpOjY7czo3OiJtZW51X2lkIjtpOjg7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjQ6Ii9sb2ciO3M6NToibGFiZWwiO3M6MTE6IkRhZnRhciBEYXRhIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fX1zOjg6ImNoaWxkcmVuIjthOjA6e319fX1pOjI7YTo0OntzOjQ6Im5hbWUiO3M6MTA6IlBlbmdhdHVyYW4iO3M6MTI6ImRpc3BsYXlfdHlwZSI7czoxMjoiZGl2aWRlci10ZXh0IjtzOjQ6Imljb24iO3M6MDoiIjtzOjg6ImNoaWxkcmVuIjthOjM6e2k6MDthOjY6e3M6NDoibmFtZSI7czoxMjoiS2Vsb2xhIEFrc2VzIjtzOjEyOiJkaXNwbGF5X3R5cGUiO3M6MDoiIjtzOjQ6Imljb24iO3M6OToic2Nhbi1mYWNlIjtzOjQ6InNsdWciO3M6NToiL3JvbGUiO3M6NjoicGVybWl0IjthOjQ6e2k6MDthOjEyOntzOjI6ImlkIjtpOjE7czo3OiJtZW51X2lkIjtpOjM7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjU6Ii9yb2xlIjtzOjU6ImxhYmVsIjtzOjExOiJEYWZ0YXIgRGF0YSI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjE7YToxMjp7czoyOiJpZCI7aTo3O3M6NzoibWVudV9pZCI7aTozO3M6NDoibmFtZSI7czozOiJhZGQiO3M6NDoic2x1ZyI7czo1OiIvcm9sZSI7czo1OiJsYWJlbCI7czo2OiJUYW1iYWgiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToyO2E6MTI6e3M6MjoiaWQiO2k6MTI7czo3OiJtZW51X2lkIjtpOjM7czo0OiJuYW1lIjtzOjQ6ImVkaXQiO3M6NDoic2x1ZyI7czo1OiIvcm9sZSI7czo1OiJsYWJlbCI7czo0OiJFZGl0IjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6MzthOjEyOntzOjI6ImlkIjtpOjE3O3M6NzoibWVudV9pZCI7aTozO3M6NDoibmFtZSI7czo2OiJkZWxldGUiO3M6NDoic2x1ZyI7czo1OiIvcm9sZSI7czo1OiJsYWJlbCI7czo1OiJIYXB1cyI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO319czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6MTthOjY6e3M6NDoibmFtZSI7czoxNDoiR3JvdXAgUGVuZ2d1bmEiO3M6MTI6ImRpc3BsYXlfdHlwZSI7TjtzOjQ6Imljb24iO3M6OToiY29tcG9uZW50IjtzOjQ6InNsdWciO3M6MTE6Ii91c2VyLWdyb3VwIjtzOjY6InBlcm1pdCI7YTo0OntpOjA7YToxMjp7czoyOiJpZCI7aToyO3M6NzoibWVudV9pZCI7aTo0O3M6NDoibmFtZSI7czo5OiJyZWFkLWxpc3QiO3M6NDoic2x1ZyI7czoxMToiL3VzZXItZ3JvdXAiO3M6NToibGFiZWwiO3M6MTE6IkRhZnRhciBEYXRhIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6MTthOjEyOntzOjI6ImlkIjtpOjg7czo3OiJtZW51X2lkIjtpOjQ7czo0OiJuYW1lIjtzOjM6ImFkZCI7czo0OiJzbHVnIjtzOjExOiIvdXNlci1ncm91cCI7czo1OiJsYWJlbCI7czo2OiJUYW1iYWgiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToyO2E6MTI6e3M6MjoiaWQiO2k6MTM7czo3OiJtZW51X2lkIjtpOjQ7czo0OiJuYW1lIjtzOjQ6ImVkaXQiO3M6NDoic2x1ZyI7czoxMToiL3VzZXItZ3JvdXAiO3M6NToibGFiZWwiO3M6NDoiRWRpdCI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjM7YToxMjp7czoyOiJpZCI7aToxODtzOjc6Im1lbnVfaWQiO2k6NDtzOjQ6Im5hbWUiO3M6NjoiZGVsZXRlIjtzOjQ6InNsdWciO3M6MTE6Ii91c2VyLWdyb3VwIjtzOjU6ImxhYmVsIjtzOjU6IkhhcHVzIjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fX1zOjg6ImNoaWxkcmVuIjthOjA6e319aToyO2E6Njp7czo0OiJuYW1lIjtzOjg6IlBlbmdndW5hIjtzOjEyOiJkaXNwbGF5X3R5cGUiO047czo0OiJpY29uIjtzOjU6InNtaWxlIjtzOjQ6InNsdWciO3M6NToiL3VzZXIiO3M6NjoicGVybWl0IjthOjQ6e2k6MDthOjEyOntzOjI6ImlkIjtpOjM7czo3OiJtZW51X2lkIjtpOjU7czo0OiJuYW1lIjtzOjk6InJlYWQtbGlzdCI7czo0OiJzbHVnIjtzOjU6Ii91c2VyIjtzOjU6ImxhYmVsIjtzOjExOiJEYWZ0YXIgRGF0YSI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO31pOjE7YToxMjp7czoyOiJpZCI7aTo5O3M6NzoibWVudV9pZCI7aTo1O3M6NDoibmFtZSI7czozOiJhZGQiO3M6NDoic2x1ZyI7czo1OiIvdXNlciI7czo1OiJsYWJlbCI7czo2OiJUYW1iYWgiO3M6MTA6ImlzX2VuYWJsZWQiO2k6MTtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoiZGVsZXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czoxMDoiZGVsZXRlZF9hdCI7Tjt9aToyO2E6MTI6e3M6MjoiaWQiO2k6MTQ7czo3OiJtZW51X2lkIjtpOjU7czo0OiJuYW1lIjtzOjQ6ImVkaXQiO3M6NDoic2x1ZyI7czo1OiIvdXNlciI7czo1OiJsYWJlbCI7czo0OiJFZGl0IjtzOjEwOiJpc19lbmFibGVkIjtpOjE7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6ImRlbGV0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO3M6MTA6ImRlbGV0ZWRfYXQiO047fWk6MzthOjEyOntzOjI6ImlkIjtpOjE5O3M6NzoibWVudV9pZCI7aTo1O3M6NDoibmFtZSI7czo2OiJkZWxldGUiO3M6NDoic2x1ZyI7czo1OiIvdXNlciI7czo1OiJsYWJlbCI7czo1OiJIYXB1cyI7czoxMDoiaXNfZW5hYmxlZCI7aToxO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJkZWxldGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjEwOiJkZWxldGVkX2F0IjtOO319czo4OiJjaGlsZHJlbiI7YTowOnt9fX19fXM6NjoiX3Rva2VuIjtzOjQwOiJrM3ZXZ2RFSDJvNUE0d3JEUWN4NU8wcEdCQXJ4NzI2bHRpbkxzT2VpIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2VtcGxveWVlL2FkZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxMDoiX3Rva2VuX2FwaSI7czoxMDI3OiJleUowZVhBaU9pSktWMVFpTENKaGJHY2lPaUpTVXpJMU5pSjkuZXlKaGRXUWlPaUl3TVRrM1lUQXhaaTA1WlRobExUY3pZVE10T1dSaFppMDVNelF4TTJVMU5tWmhaVGtpTENKcWRHa2lPaUkwTldaak9HVTVOR1l4TVdWbU5ERXhZVGxqWlRWa1ptSmtPRGxtTWpVeU5tTTBNMkpoTldZM05qYzJNRGRtTlRFeE9HRXlabU5oTlRSbVpHRTBabUpoWm1VMk56RXpNamMxWkdaa05UQXpOaUlzSW1saGRDSTZNVGMxTmprMU16STROaTQyTWpJNU9EVXNJbTVpWmlJNk1UYzFOamsxTXpJNE5pNDJNakk1T1RJc0ltVjRjQ0k2TVRjNE9EUTRPVEk0TlM0Mk5qa3hOemNzSW5OMVlpSTZJakVpTENKelkyOXdaWE1pT2x0ZGZRLktrc0N5alA0YldxOFVpeVJKOTkwOEFuSTZVc2NCdWxKNklNSF9MX2hRclhHazZ3MkQxWkdoR1FlOHZJZWN4bEV0WGtGY2VkOFJhaDNaMEUtRFVUV2R1ZldrYTBub09Id2QtOV9oMFl0bjVaeVg1VW1OLXBiMUJoM1RkSkFpWlNHRFpwU0Y1QmJuU3dNdkdKUUdoM0x2NTNNUzUzWHdNd1pWOWgzTU1yRlVwQ0VjQllPUGxoR2lCNEtNcnNGbFZvQmtzbUkyNHlvYmZhWV91Uld5TjVRRGZqRzNubVlibUNzMWpjaF80N3hqby1WSVA3RTJaV0ZZU0ljazB6blZub21KTjU5V1VjWkNSWi15UkVUMkU1YUFJQkwxR0FtTUJaOG5qazlSbmJ3bDQ1a1ZDdEhfT21FUXFYMWw5UUxyRERqTFNVQWlQOEZueW1lbWlLU2UzdUZTWEhaeHpRWnU5RTJVT2ZLSWpmd0xSMmRGMVlNcHQwZzE4Z0FDU2ljSnNxN2tjdTM0cUk0Nm54ZWlpY04yS0FwWkpuelI2WlhuRFBmVjRLSXltaHIzOExnUmlFX2V0NndaMTNmekd2QmVSdDBwcVhrODVpU3ZGTnlSMy1CMTY3YTdnaVpob2hsbWdZNFlSNU5NeVZQSjVydXpjelA2UHc1LXhiczBxY3pvUnlKczEzLWlyVkVYNWpFbmxrSjRSOF9wZDhmOUJ1TlFYYVdRTWNyYktMZ2pGTDE4MGVjWWRIb01XZUpyc3BUTEVlcUNxXzFENlBVaTRDdGxMeDFNbHh0TFA5TVFKYzFsWDl5RnBOMzNZMjVvbFhQaDlIc245aFhoR01sSHdGdWFvMnk0bExMT1VoTDZFTXBlUVY5THJlWllHZDh1dTQ4UU04YlhiZHFUZld6ZUdnIjt9', 1756957026);

-- Dumping structure for table simpeg_local.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` smallint unsigned NOT NULL,
  `user_group_id` smallint unsigned NOT NULL,
  `img_main` text COLLATE utf8mb4_unicode_ci,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role_id`, `user_group_id`, `img_main`, `is_enabled`, `created_at`, `updated_at`) VALUES
	(1, 'Evelline Krist.', 'ev.attoff@gmail.com', NULL, '$2y$12$Cyq.9Cpq3gChtaR4jrLrE.RURYmPagaBfZWfhuO1TNXzb3N2c6/kq', NULL, 2, 2, NULL, 1, '2025-06-30 20:06:30', '2025-06-30 20:06:30');

-- Dumping structure for table simpeg_local.user_groups
CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_group_id` smallint unsigned DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_main` text COLLATE utf8mb4_unicode_ci,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_groups_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simpeg_local.user_groups: ~2 rows (approximately)
INSERT INTO `user_groups` (`id`, `parent_group_id`, `nickname`, `fullname`, `email`, `phone`, `img_main`, `is_enabled`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, NULL, 'IAKN', 'Institut Agama Kristen Negeri (IAKN) Palangka Raya', 'staknpalangkaraya.2010@gmail.com', NULL, 'image/body.png', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, NULL, 'Kepegawaian', 'Kepegawaian', '', NULL, 'image/kepegawaian.webp', 1, NULL, NULL, NULL, NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
