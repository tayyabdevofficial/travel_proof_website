-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 06, 2026 at 09:57 AM
-- Server version: 8.3.0
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight_hotel_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tracking_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flight_details` json DEFAULT NULL,
  `hotel_details` json DEFAULT NULL,
  `passengers` json DEFAULT NULL,
  `guests` json DEFAULT NULL,
  `special_note` text COLLATE utf8mb4_unicode_ci,
  `receive_timing` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'now',
  `flight_price` decimal(10,2) DEFAULT '0.00',
  `hotel_price` decimal(10,2) DEFAULT '0.00',
  `discount_percent` decimal(5,2) DEFAULT '0.00',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bookings_tracking_id_unique` (`tracking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `tracking_id`, `booking_type`, `full_name`, `email`, `phone`, `flight_details`, `hotel_details`, `passengers`, `guests`, `special_note`, `receive_timing`, `flight_price`, `hotel_price`, `discount_percent`, `total_amount`, `payment_method`, `payment_status`, `status`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 'AJT4MC4MXO', 'flight', 'Tayyab', 'tayyabhafeez22@gmail.com', '+923099700930', '{\"to\": \"Aalesund - Norway ( AES )\", \"from\": \"Aalborg - Denmark ( AAL )\", \"to_code\": \"AES\", \"from_code\": \"AAL\", \"passengers\": 1, \"return_date\": null, \"departure_date\": \"2026-02-21\"}', NULL, '{\"1\": {\"age\": \"20\", \"name\": \"Ali\", \"gender\": \"male\"}}', '{\"1\": {\"age\": null, \"name\": null, \"gender\": null}}', NULL, 'now', 6000.00, 4000.00, 22.22, 6000.00, 'korapay', 'paid', 'processing', 'new update on booking', '2026-02-05 11:19:36', '2026-02-05 13:51:07'),
(2, 'ZURYYU6YKB', 'hotel', 'Tayyab', 'tayyabhafeez22@gmail.com', '+923099700930', NULL, '{\"guests\": 1, \"check_in\": \"2026-01-01\", \"check_out\": \"2026-01-01\"}', '{\"1\": {\"age\": null, \"name\": null, \"gender\": null}}', '{\"1\": {\"age\": \"27\", \"name\": \"ali\", \"gender\": \"male\"}}', NULL, 'now', NULL, 4000.00, 0.00, 4000.00, 'paystack', 'paid', 'pending', NULL, '2026-02-05 14:49:06', '2026-02-05 14:49:10'),
(3, 'PK8RWMVFYL', 'flight', 'Tayyab', 'tayyabhafeez22@gmail.com', '+923099700930', '{\"to\": \"Aarhus - Denmark ( AAR )\", \"from\": \"Aalborg - Denmark ( AAL )\", \"to_code\": \"AAR\", \"from_code\": \"AAL\", \"trip_type\": \"roundtrip\", \"passengers\": 1, \"return_date\": \"2026-02-27\", \"departure_date\": \"2026-02-08\"}', NULL, '{\"1\": {\"age\": \"12\", \"name\": \"Ali\", \"gender\": \"male\"}}', '{\"1\": {\"age\": null, \"name\": null, \"gender\": null}}', NULL, 'now', 6000.00, NULL, 0.00, 6000.00, 'paystack', 'paid', 'processing', NULL, '2026-02-05 14:53:01', '2026-02-05 14:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `booking_updates`
--

DROP TABLE IF EXISTS `booking_updates`;
CREATE TABLE IF NOT EXISTS `booking_updates` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `attachments` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_updates_booking_id_foreign` (`booking_id`),
  KEY `booking_updates_admin_id_foreign` (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_updates`
--

INSERT INTO `booking_updates` (`id`, `booking_id`, `admin_id`, `status`, `message`, `attachments`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'processing', 'we are processing your requst, please wait for official confirmation from flights', NULL, '2026-02-05 13:48:42', '2026-02-05 13:48:42'),
(4, 1, 1, 'processing', NULL, '[{\"name\": \"Azeem_Shoukat_CV.docx\", \"path\": \"private/booking-updates/xVgCGcFMeR0oOXjQzXVpFfrpS2r4muMwWGvrJioC.docx\"}]', '2026-02-05 14:04:49', '2026-02-05 14:04:49'),
(5, 1, 1, 'processing', NULL, '[{\"name\": \"Azeem_Shoukat_CV.pdf\", \"path\": \"booking-updates/5AEdKFVdOl0vOVkvQX8yKHrbX5YIR9WkKwfE1pyD.pdf\"}]', '2026-02-05 14:07:17', '2026-02-05 14:07:17'),
(3, 1, 1, 'processing', NULL, '[{\"name\": \"Azeem_Shoukat_CV.pdf\", \"path\": \"private/booking-updates/IJsG24wKG8evgn35BuMNInp3fC1710TJrDvbbvW5.pdf\"}]', '2026-02-05 13:58:22', '2026-02-05 13:58:22'),
(6, 1, 1, 'processing', NULL, '[{\"name\": \"Azeem_Shoukat_CV (1).docx\", \"path\": \"booking-updates/3sD6vo4XTDKfnniR8osRmTqMOUAXUc62M1mJCpxC.docx\"}]', '2026-02-05 14:15:53', '2026-02-05 14:15:53'),
(7, 1, 1, 'processing', NULL, '[{\"name\": \"profile image.png\", \"path\": \"booking-updates/ezz2jsxwj7p6iSjBUftJOPMCrejGoDxewN3xViCC.jpg\"}]', '2026-02-05 14:16:44', '2026-02-05 14:16:44'),
(8, 3, 1, 'processing', NULL, '[{\"name\": \"profile image (1).png\", \"path\": \"booking-updates/IBztEkJql4kHICCSnR9E4AE5aboZkIPHBXpSck1B.jpg\"}]', '2026-02-05 14:54:13', '2026-02-05 14:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-a36aff27163b967fbe545732b740bae2:timer', 'i:1770305535;', 1770305535),
('laravel-cache-a36aff27163b967fbe545732b740bae2', 'i:1;', 1770305535),
('laravel-cache-admin@yabaplug.com|127.0.0.1:timer', 'i:1770305535;', 1770305535),
('laravel-cache-admin@yabaplug.com|127.0.0.1', 'i:1;', 1770305535),
('laravel-cache-c6ba1f3bd1403dd437fbbb0ca8ed5278:timer', 'i:1770305539;', 1770305539),
('laravel-cache-c6ba1f3bd1403dd437fbbb0ca8ed5278', 'i:1;', 1770305539),
('laravel-cache-admin@domnain.com|127.0.0.1:timer', 'i:1770305540;', 1770305540),
('laravel-cache-admin@domnain.com|127.0.0.1', 'i:1;', 1770305540),
('laravel-cache-4fe6573f80c951d04b943bde8006717b:timer', 'i:1770305728;', 1770305728),
('laravel-cache-4fe6573f80c951d04b943bde8006717b', 'i:1;', 1770305728),
('flight-hotel-booking-cache-4fe6573f80c951d04b943bde8006717b:timer', 'i:1770316464;', 1770316464),
('flight-hotel-booking-cache-4fe6573f80c951d04b943bde8006717b', 'i:1;', 1770316464);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Tayyab Ali', 'tayyabhafeez22@gmail.com', '03099700930', 'payment-issue', 'fasfd', '2026-02-04 12:47:30', '2026-01-15 12:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_14_170933_add_two_factor_columns_to_users_table', 1),
(5, '2026_02_05_000000_add_is_admin_to_users_table', 1),
(6, '2026_02_05_000001_create_pricings_table', 1),
(7, '2026_02_05_000002_create_bookings_table', 2),
(8, '2026_02_05_000003_add_receive_timing_to_bookings_table', 2),
(9, '2026_02_05_000004_create_contact_messages_table', 3),
(10, '2026_02_05_000006_add_consultation_fee_to_pricings_table', 4),
(11, '2026_02_05_000007_create_visa_consultations_table', 4),
(12, '2026_02_05_000008_add_status_to_bookings_table', 5),
(13, '2026_02_05_000009_create_booking_updates_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pricings`
--

DROP TABLE IF EXISTS `pricings`;
CREATE TABLE IF NOT EXISTS `pricings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `flight_price` decimal(10,2) NOT NULL,
  `hotel_price` decimal(10,2) NOT NULL,
  `combo_discount_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `consultation_fee` decimal(10,2) NOT NULL DEFAULT '50000.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricings`
--

INSERT INTO `pricings` (`id`, `flight_price`, `hotel_price`, `combo_discount_percent`, `consultation_fee`, `created_at`, `updated_at`) VALUES
(1, 5000.00, 4000.00, 30.00, 50000.00, '2026-02-05 10:27:10', '2026-02-05 14:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6dIKt2jyfKXm0kOQ9FUGTuykVsjgwEJZInmzYmmG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU3FaMlhacVpyU3NRU1ZTQ21ORk51Q2UzVWoxN1NYcnFLSlVHVHk5MSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb250YWN0IjtzOjU6InJvdXRlIjtzOjc6ImNvbnRhY3QiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1770314654),
('cpHWatIS1v0y2NAEtpPRYWemIBP6UHroJHSesj6C', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid3U2SGFteWtLd1FTdzQyamtGRUthd053S2lFQ216c2FGR0EyZzNjSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1770321330),
('ImDm1f59eKLlpX2zWBaoTX5ksQP8fm8aWtom4ERl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialpJSUlGaVp4UFRzR0hucEFxNWNsanltcTN4YmtzbDZQRG5yczA1aSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFjay9aVVJZWVU2WUtCIjtzOjU6InJvdXRlIjtzOjEwOiJ0cmFjay5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1770321113);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@domain.com', '2026-02-05 10:27:10', '$2y$12$zd0tvyzqA2nvpTQCfuSAMuQkNbAgBrlDB6P7cZzNW4YsbSgDCG9iC', 1, NULL, NULL, NULL, 'yw4NRi7Rprble7x0P9bZKIPEN2ryBqUwpmcs9KQruFPNzMqfsOX89vO5pn8l', '2026-02-05 10:27:10', '2026-02-05 10:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `visa_consultations`
--

DROP TABLE IF EXISTS `visa_consultations`;
CREATE TABLE IF NOT EXISTS `visa_consultations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visa_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `travel_date` date NOT NULL,
  `special_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visa_consultations`
--

INSERT INTO `visa_consultations` (`id`, `full_name`, `email`, `phone`, `nationality`, `destination_country`, `visa_type`, `travel_date`, `special_note`, `created_at`, `updated_at`) VALUES
(1, 'Tayyab', 'admin@domain.com', '+923099700930', 'asf', 'asd', 'student', '2026-06-10', 'fasdf', '2026-02-05 12:51:57', '2026-02-05 12:51:57');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
