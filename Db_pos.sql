-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for khaled_db
 

-- Dumping structure for table khaled_db.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.cache: ~1 rows (approximately)

-- Dumping structure for table khaled_db.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.cache_locks: ~0 rows (approximately)

-- Dumping structure for table khaled_db.carts
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.carts: ~0 rows (approximately)

-- Dumping structure for table khaled_db.cart_items
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_cart_id_foreign` (`cart_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.cart_items: ~0 rows (approximately)

-- Dumping structure for table khaled_db.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.categories: ~2 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Général', NULL, '2026-08-23 15:44:17', '2026-08-23 15:44:17'),
	(2, 'Piece', NULL, '2026-08-23 16:19:44', '2026-08-23 16:19:44');

-- Dumping structure for table khaled_db.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table khaled_db.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.jobs: ~0 rows (approximately)

-- Dumping structure for table khaled_db.job_batches
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

-- Dumping data for table khaled_db.job_batches: ~0 rows (approximately)

-- Dumping structure for table khaled_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.migrations: ~11 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_08_23_160217_create_categories_table', 1),
	(5, '2026_08_23_160218_create_products_table', 1),
	(6, '2026_08_23_160219_create_product_details_table', 1),
	(7, '2026_08_23_160220_create_carts_table', 1),
	(8, '2026_08_23_160221_create_cart_items_table', 1),
	(9, '2026_08_23_160222_create_orders_table', 1),
	(10, '2026_08_23_160225_create_order_items_table', 1),
	(11, '2026_08_23_164008_create_personal_access_tokens_table', 2),
	(12, '2026_08_24_164555_add_address_to_users_table', 3);

-- Dumping structure for table khaled_db.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_wilaya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.orders: ~3 rows (approximately)
INSERT INTO `orders` (`id`, `user_id`, `order_number`, `total_amount`, `status`, `customer_name`, `customer_phone`, `customer_address`, `customer_wilaya`, `notes`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'ORD-6A8B45F70465A', 180000.00, 'pending', 'khicha yahia', '0665936276', 'حي غمرة الوسطى قمار الوادي', 'El Oued', NULL, '2026-08-23 18:11:51', '2026-08-23 18:11:51'),
	(2, NULL, 'ORD-6A8B5D9025551', 120000.00, 'pending', 'khicha yahia', '0665936276', 'حي غمرة الوسطى قمار الوادي', 'El Oued', NULL, '2026-08-23 19:52:32', '2026-08-23 19:52:32'),
	(3, NULL, 'ORD-6A8C7F95D111A', 30000.00, 'pending', 'khicha yahia', '0665936276', 'حي غمرة الوسطى قمار الوادي', 'El Oued', NULL, '2026-08-24 16:29:57', '2026-08-24 16:29:57'),
	(4, NULL, 'ORD-6A8C8198D657F', 15000.00, 'pending', 'khicha yahia', '0665936276', 'حي غمرة الوسطى قمار الوادي', 'El Oued', NULL, '2026-08-24 16:38:32', '2026-08-24 16:38:32'),
	(5, NULL, 'ORD-6A8C81CD0BE07', 180000.00, 'pending', 'khicha yahia', '0665936276', 'حي غمرة الوسطى قمار الوادي', 'El Oued', NULL, '2026-08-24 16:39:25', '2026-08-24 16:39:25'),
	(6, 2, 'ORD-6A8C8397B8C67', 50000.00, 'pending', 'khicha yahia', '0665936276', 'حي غمرة الوسطى قمار الوادي', 'El Oued', NULL, '2026-08-24 16:47:03', '2026-08-24 16:47:03');

-- Dumping structure for table khaled_db.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `unit_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.order_items: ~4 rows (approximately)
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
	(1, 1, 3, 'rav4', 2, 90000.00, '2026-08-23 18:11:51', '2026-08-23 18:11:51'),
	(2, 2, 6, 'Pneu', 2, 15000.00, '2026-08-23 19:52:32', '2026-08-23 19:52:32'),
	(3, 2, 3, 'rav4', 1, 90000.00, '2026-08-23 19:52:32', '2026-08-23 19:52:32'),
	(4, 2, 5, 'injecteur rav4', 1, 0.00, '2026-08-23 19:52:32', '2026-08-23 19:52:32'),
	(5, 3, 6, 'Pneu', 1, 15000.00, '2026-08-24 16:29:57', '2026-08-24 16:29:57'),
	(6, 3, 2, 'OSSCA 01787 Pompe à eau', 1, 15000.00, '2026-08-24 16:29:57', '2026-08-24 16:29:57'),
	(7, 4, 6, 'Pneu', 1, 15000.00, '2026-08-24 16:38:32', '2026-08-24 16:38:32'),
	(8, 5, 3, 'rav4', 2, 90000.00, '2026-08-24 16:39:25', '2026-08-24 16:39:25'),
	(9, 6, 1, 'Pompe à eau Toyota Corolla E100 Liftback 1.3 12V 72 CV Essence 2E', 1, 50000.00, '2026-08-24 16:47:03', '2026-08-24 16:47:03');

-- Dumping structure for table khaled_db.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table khaled_db.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.personal_access_tokens: ~1 rows (approximately)
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\User', 2, 'pos-sync-token', 'af7ca996e3e64ec0cf0b4adb3e988ad4d33c48aa30e91805823a22fc64f1412a', '["*"]', '2026-08-23 16:59:45', NULL, '2026-08-23 15:41:21', '2026-08-23 16:59:45');

-- Dumping structure for table khaled_db.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `price_1` decimal(12,2) NOT NULL DEFAULT '0.00',
  `price_2` decimal(12,2) NOT NULL DEFAULT '0.00',
  `price_3` decimal(12,2) NOT NULL DEFAULT '0.00',
  `price_4` decimal(12,2) NOT NULL DEFAULT '0.00',
  `current_stock` decimal(12,2) NOT NULL DEFAULT '0.00',
  `colors` text COLLATE utf8mb4_unicode_ci,
  `compatibility` text COLLATE utf8mb4_unicode_ci COMMENT 'VINs / Numéros de châssis',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` json DEFAULT NULL COMMENT 'Galerie dimages supplémentaires',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_synced` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_code_unique` (`code`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.products: ~5 rows (approximately)
INSERT INTO `products` (`id`, `code`, `name`, `slug`, `sku`, `barcode`, `type`, `material`, `category_id`, `price_1`, `price_2`, `price_3`, `price_4`, `current_stock`, `colors`, `compatibility`, `image`, `images`, `is_active`, `is_synced`, `created_at`, `updated_at`) VALUES
	(1, 'PROD-41', 'Pompe à eau Toyota Corolla E100 Liftback 1.3 12V 72 CV Essence 2E', NULL, 'Ar200', '210951709276', 'FR30', 'MTL', 1, 50000.00, 50000.00, 50000.00, 50000.00, 1500.00, '["[\\"[\\\\\\"Gris\\\\\\"]\\"]"]', '["[\\"JT152EE9000123456\\"", "\\"JT152EE1010789012\\"", "\\"JT152EP9100345678\\"", "\\"JTEGB10G100112233\\"]"]', 'products/Q9DdKqcy3xnEsO1x1EWGI1DPjfLwoYmn2HPVejwV.jpg', NULL, 1, 0, '2026-08-23 15:44:17', '2026-08-23 16:05:57'),
	(2, 'PROD-42', 'OSSCA 01787 Pompe à eau', NULL, 'AC2025', '210113168746', 'Moteur', 'Alm', 1, 15000.00, 15000.00, 15000.00, 15000.00, 150.00, '["[\\"[\\\\\\"Grr\\\\\\"]\\"]"]', '["[\\"[\\\\\\"RAV50\\\\\\"]\\"]"]', 'products/LdjHI2eYSTRsn7wnvHt8LE4RyNiRSYq21dv9N9uE.jpg', NULL, 1, 0, '2026-08-23 15:44:18', '2026-08-23 16:05:49'),
	(3, 'PROD-46', 'rav4', NULL, 'ar3', '210302818369', 'e302', 'alm', 1, 90000.00, 90000.00, 90000.00, 90000.00, 50.00, '["[\\"grs\\"]"]', '["[\\"JT152EE9000123456\\"", "\\"JT152EE1010789012\\"", "\\"JT152EP9100345678\\"", "\\"JTEGB10G100112233\\"]"]', 'products/VZWXUm8x1Uu59wL5lqhckLraOwl2B0ripf8C74uo.jpg', NULL, 1, 0, '2026-08-23 15:44:18', '2026-08-23 16:05:52'),
	(4, 'PROD-47', 'bomp d eau', NULL, NULL, '210772701935', NULL, NULL, 2, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 'products/nnpEs4LcgjYiGLtpsV6X7lhtMXtLd8u7ji8H2s2c.jpg', NULL, 1, 0, '2026-08-23 15:44:19', '2026-08-23 16:33:41'),
	(5, 'PROD-48', 'injecteur rav4', NULL, NULL, '210810353745', NULL, NULL, 2, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 'products/DCOL8qJxz0romj6XA2OByAwjA9ptEMzXHdkzFjXD.jpg', NULL, 1, 0, '2026-08-23 15:44:19', '2026-08-23 16:28:51'),
	(6, 'PROD-49', 'Pneu', NULL, 'Ar250', '210574467392', 'MTL', 'MTL', 2, 15000.00, 15000.00, 15000.00, 15000.00, 500.00, 'BLACK', 'JT152EE9000123456, JT152EE1010789012, JT152EP9100345678, JTEGB10G100112233', 'products/vbtyIOuDZjgm71hx7q4w6wMxdqB9xCM5JCEtkefA.jpg', NULL, 1, 0, '2026-08-23 16:59:45', '2026-08-23 16:59:45');

-- Dumping structure for table khaled_db.product_details
CREATE TABLE IF NOT EXISTS `product_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_details_product_id_foreign` (`product_id`),
  CONSTRAINT `product_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.product_details: ~5 rows (approximately)
INSERT INTO `product_details` (`id`, `product_id`, `title`, `content`, `is_published`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, '<h2><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Aperçu du Produit</span></h2><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Pompe de direction assistée de haute qualité :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Conçue pour assurer une assistance hydraulique fluide, garantissant un effort de braquage réduit et un contrôle précis du véhicule.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Conception robuste :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Fabriquée en aluminium résistant avec une poulie à gorges intégrée, prête à résister aux contraintes de la courroie d\'accessoires.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li></ol><h2><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Caractéristiques et Avantages</span></h2><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Direction fluide et sans effort :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Restaure la pression hydraulique d\'origine pour éliminer les points durs ou les bruits anormaux lors des manœuvres.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Fiabilité et durabilité :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Matériaux robustes garantissant une longue durée de vie et une étanchéité parfaite face aux fuites de liquide hydraulique.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Remplacement direct :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Conçue selon les dimensions d\'origine pour un montage simple et rapide sans modifications.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li></ol><h2><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Caractéristiques Techniques</span></h2><table><tbody><tr><td data-row="1"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Caractéristique</strong></td><td data-row="1"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Détail</strong></td></tr><tr><td data-row="2"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Type de pièce</strong></td><td data-row="2"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Pompe de direction assistée (avec poulie)</span></td></tr><tr><td data-row="3"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Matériau du corps</strong></td><td data-row="3"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Aluminium haute résistance</span></td></tr><tr><td data-row="4"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">État</strong></td><td data-row="4"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Pièce neuve ou reconditionnée de qualité supérieure</span></td></tr><tr><td data-row="5"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Installation</strong></td><td data-row="5"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Remplacement direct (Standard OEM)</span></td></tr></tbody></table><blockquote><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Remarque :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Il est recommandé de purger entièrement le circuit hydraulique et d\'utiliser le type de fluide de direction assistée préconisé par le constructeur lors du montage de cette pièce.</span></blockquote><p><br></p>', 1, '2026-08-23 15:44:17', '2026-08-23 15:44:17'),
	(2, 2, NULL, '<h2><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Aperçu du Produit</span></h2><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Pompe à liquide de refroidissement haute efficacité :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Cette pompe OSSCA 01787 assure une circulation optimale du liquide de refroidissement pour maintenir la température moteur dans les plages idéales, évitant ainsi toute surchauffe.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Conception robuste et fiable :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Fabriquée pour répondre aux standards de performance du constructeur, elle offre une durabilité accrue, essentielle pour la longévité de votre moteur.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li></ol><h2><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Caractéristiques et Avantages</span></h2><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Qualité équivalente à l\'origine :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> La pièce est conçue pour remplacer parfaitement les références d\'origine (OE), garantissant un ajustement précis et une compatibilité totale avec les systèmes de refroidissement Toyota.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Installation optimisée :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Grâce à sa conception respectant les spécifications constructeur, l\'installation est simplifiée, permettant un remplacement rapide et efficace.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Performance constante :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Conçue pour résister aux contraintes thermiques élevées du moteur, elle garantit une étanchéité parfaite et un flux constant de liquide.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li></ol><h2><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Caractéristiques Techniques</span></h2><table><tbody><tr><td data-row="1"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Caractéristique</strong></td><td data-row="1"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Détail</strong></td></tr><tr><td data-row="2"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Marque</strong></td><td data-row="2"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">OSSCA</span></td></tr><tr><td data-row="3"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Référence article</strong></td><td data-row="3"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">01787</span></td></tr><tr><td data-row="4"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Type de pièce</strong></td><td data-row="4"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Pompe à liquide de refroidissement (mécanique)</span></td></tr><tr><td data-row="5"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Compatibilité</strong></td><td data-row="5"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Toyota (Avensis, RAV4, Corolla, Celica, Starlet, etc.)</span></td></tr><tr><td data-row="6"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Références OE comparables</strong></td><td data-row="6"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">16100-19125, 16110-19055, 16100-19126, 16110-19065</span></td></tr></tbody></table><blockquote><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Note importante :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Il est fortement recommandé de confier l\'installation de cette pompe à un professionnel. Assurez-vous également de remplacer le liquide de refroidissement et de vérifier l\'état de la courroie d\'accessoires ou de distribution lors du montage pour garantir un fonctionnement optimal du système de refroidissement.</span></blockquote><p><br></p>', 1, '2026-08-23 15:44:18', '2026-08-23 15:44:18'),
	(3, 3, NULL, '<p><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Voici la version mise à jour de votre page Web incluant un tableau récapitulatif des spécifications techniques pour une meilleure lisibilité :</span></p><p><br></p><h2><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Aperçu du Produit</span></h2><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Injecteur de carburant haute performance :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Conçu spécifiquement pour restaurer une pulvérisation optimale du carburant et l\'efficacité de la combustion sur les moteurs Toyota RAV4 2.2 D-4D de 150 ch.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Spécifications d\'origine exactes :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Fabriqué pour répondre aux normes d\'usine, garantissant une installation simple, un débit de carburant précis et des performances moteur durables.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li></ol><h2><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Caractéristiques et Avantages</span></h2><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Économie de carburant optimisée :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Les embouts de précision aident à réduire la consommation de carburant et à minimiser les émissions polluantes à l\'échappement.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Fonctionnement moteur plus fluide :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Élimine les ratés, les hésitations et les problèmes de ralenti irrégulier en délivrant un jet de carburant propre et régulier.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Construction durable :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Conçu à partir de matériaux de haute qualité capables de résister aux pressions extrêmes et aux températures élevées des cylindres.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li></ol><h2><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Caractéristiques Techniques</span></h2><table><tbody><tr><td data-row="1"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Caractéristique</strong></td><td data-row="1"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Détail</strong></td></tr><tr><td data-row="2"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Véhicule compatible</strong></td><td data-row="2"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Toyota RAV4 III</span></td></tr><tr><td data-row="3"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Motorisation</strong></td><td data-row="3"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">2.2 D-4D (150 ch)</span></td></tr><tr><td data-row="4"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Référence pièce</strong></td><td data-row="4"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">295900-0420</span></td></tr><tr><td data-row="5"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Type de pièce</strong></td><td data-row="5"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Injecteur Diesel</span></td></tr><tr><td data-row="6"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">État</strong></td><td data-row="6"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Neuf / Reconditionné de qualité supérieure</span></td></tr></tbody></table><blockquote><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Remarque :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Une installation par un professionnel et un codage ECU (si nécessaire selon votre modèle de véhicule) sont fortement recommandés pour assurer un étalonnage parfait et un fonctionnement optimal.</span></blockquote><p><br></p>', 1, '2026-08-23 15:44:18', '2026-08-23 15:44:18'),
	(4, 4, NULL, NULL, 1, '2026-08-23 15:44:19', '2026-08-23 15:44:19'),
	(5, 5, NULL, NULL, 1, '2026-08-23 15:44:19', '2026-08-23 15:44:19'),
	(6, 6, NULL, '<h2><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Aperçu du Produit</span></h2><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Pneu/Roue haute performance :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Conçu avec soin pour offrir une excellente stabilité, une absorption efficace des chocs et une expérience de conduite sûre et confortable dans diverses conditions routières.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Conception technique avancée :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Allie une durabilité exceptionnelle à un design esthétique attrayant pour s\'adapter à différents types de véhicules et supporter les conditions de fonctionnement les plus exigeantes.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li></ol><h2><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Caractéristiques et Avantages</span></h2><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Adhérence supérieure sur route :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Les sculptures de la bande de roulement, conçues avec précision, garantissent une forte tenue de route sur surfaces sèches et mouillées, réduisant ainsi la distance de freinage.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Longévité accrue :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Fabriqué à partir de mélanges de caoutchouc de pointe résistants à l\'usure et aux coupures, garantissant une excellente endurance sur de longues distances.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Conduite silencieuse et confortable :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Contribue à réduire les bruits de roulement et les vibrations, offrant ainsi au conducteur et aux passagers un voyage plus fluide et plus calme.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><br></li></ol><h2><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Caractéristiques Techniques</span></h2><table><tbody><tr><td data-row="1"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Caractéristique</strong></td><td data-row="1"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Détail</strong></td></tr><tr><td data-row="2"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Type de produit</strong></td><td data-row="2"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Pneu / Roue de véhicule</span></td></tr><tr><td data-row="3"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Utilisation</strong></td><td data-row="3"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Conduite quotidienne / Routes variées</span></td></tr><tr><td data-row="4"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Matériau de fabrication</strong></td><td data-row="4"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Caoutchouc de haute qualité avec renfort interne durable</span></td></tr><tr><td data-row="5"><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Résistance</strong></td><td data-row="5"><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Haute résistance à la chaleur et à l\'usure</span></td></tr></tbody></table><blockquote><strong style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);">Remarque :</strong><span style="color: rgb(31, 31, 31); background-color: rgba(0, 0, 0, 0);"> Il est toujours recommandé de vérifier la dimension de pneu adaptée à votre véhicule, et de contrôler régulièrement la pression de l\'air ainsi que le parallélisme des roues pour garantir des performances et une sécurité maximales.</span></blockquote><p><br></p>', 1, '2026-08-23 16:59:45', '2026-08-23 16:59:45');

-- Dumping structure for table khaled_db.sessions
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

-- Dumping data for table khaled_db.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('BGLiJOTXCee3nCnTvArOsUZmyN3m0KXqaRKIzLnv', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJGM0dJZFkyTEFlYjdheW1DNVByYUlLR3l2NTlXanVhUjJwaEREYkE4IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImhvbWUifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIsImNhcnQiOnsiMyI6eyJuYW1lIjoicmF2NCIsInByaWNlIjoiOTAwMDAuMDAiLCJxdWFudGl0eSI6IjEiLCJpbWFnZSI6InByb2R1Y3RzXC9WWldYVW04eDFVdTU5d0w1bHFoY2tMcmFPd2wyQjByaXBmOEM3NHVvLmpwZyJ9fX0=', 1787599048);

-- Dumping structure for table khaled_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `address` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khaled_db.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@test.com', NULL, 'customer', NULL, NULL, '$2y$12$XQEPMTykLDTvhX4tNEDVU.SC2OtJlND8gT5pXYlfJjR54gH9ob5Xm', NULL, '2026-08-23 15:37:14', '2026-08-23 15:37:14'),
	(2, 'khichaya', 'khichaya@gmail.com', '0665936276', 'customer', 'حي غمرة الوسطى قمار الوادي', NULL, '$2y$12$vXUUNHMphjSysqA9hyeB9uQRBw.Q0pBdoqq1dvbD2qvEZHpZy5GW2', 'sqMVZF6PDQxhskFcahVequ4lVeym6YxHqbX0NZglxtj6dAn6eqVvUTeDnxAr', '2026-08-23 15:41:21', '2026-08-24 16:28:16');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
