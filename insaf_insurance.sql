-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2026 at 03:03 AM
-- Server version: 11.4.10-MariaDB-cll-lve-log
-- PHP Version: 8.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insaxwgx_swisscaree`
--

-- --------------------------------------------------------

--
-- Table structure for table `benefit_coverages`
--

CREATE TABLE `benefit_coverages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `benefit_type` enum('medical_cover','sea_mountain_rescue','emergency_evacuation','medical_repatriation','repatriation_mortal_remains','luggage','accidental_death','accidental_disability','third_party_liability') NOT NULL,
  `max_amount` decimal(10,2) NOT NULL,
  `currency` char(3) NOT NULL DEFAULT 'EUR',
  `delivery_note` varchar(255) DEFAULT NULL,
  `deductible_note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `benefit_coverages`
--

INSERT INTO `benefit_coverages` (`id`, `application_id`, `benefit_type`, `max_amount`, `currency`, `delivery_note`, `deductible_note`, `created_at`, `updated_at`) VALUES
(1, 1, 'medical_cover', 100000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(2, 1, 'sea_mountain_rescue', 20000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(3, 1, 'emergency_evacuation', 250000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(4, 1, 'medical_repatriation', 250000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(5, 1, 'repatriation_mortal_remains', 50000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(6, 1, 'luggage', 3000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(7, 1, 'accidental_death', 50000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(8, 1, 'accidental_disability', 100000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(9, 1, 'third_party_liability', 500000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(10, 2, 'medical_cover', 30000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(11, 2, 'sea_mountain_rescue', 5000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(12, 2, 'emergency_evacuation', 50000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(13, 2, 'medical_repatriation', 50000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(14, 2, 'repatriation_mortal_remains', 10000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(15, 2, 'luggage', 1000.00, 'EUR', NULL, 'Deductible of EUR 50.00 per claim', '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(16, 2, 'accidental_death', 10000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(17, 2, 'accidental_disability', 20000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(18, 2, 'third_party_liability', 100000.00, 'EUR', NULL, NULL, '2026-06-03 02:19:52', '2026-06-03 02:19:52'),
(19, 3, 'medical_cover', 30000.00, 'GBP', NULL, NULL, '2026-06-07 01:11:56', '2026-06-07 01:11:56'),
(20, 3, 'sea_mountain_rescue', 5000.00, 'GBP', NULL, NULL, '2026-06-07 01:11:56', '2026-06-07 01:11:56'),
(21, 3, 'emergency_evacuation', 50000.00, 'GBP', NULL, NULL, '2026-06-07 01:11:56', '2026-06-07 01:11:56'),
(22, 3, 'medical_repatriation', 50000.00, 'GBP', NULL, NULL, '2026-06-07 01:11:56', '2026-06-07 01:11:56'),
(23, 3, 'repatriation_mortal_remains', 10000.00, 'GBP', NULL, NULL, '2026-06-07 01:11:56', '2026-06-07 01:11:56'),
(24, 3, 'luggage', 1000.00, 'GBP', NULL, 'Deductible of GBP 50.00 per claim', '2026-06-07 01:11:56', '2026-06-07 01:11:56'),
(25, 3, 'accidental_death', 10000.00, 'GBP', NULL, NULL, '2026-06-07 01:11:56', '2026-06-07 01:11:56'),
(26, 3, 'accidental_disability', 20000.00, 'GBP', NULL, NULL, '2026-06-07 01:11:56', '2026-06-07 01:11:56'),
(27, 3, 'third_party_liability', 100000.00, 'GBP', NULL, NULL, '2026-06-07 01:11:56', '2026-06-07 01:11:56'),
(28, 7, 'medical_cover', 100000.00, 'EUR', NULL, NULL, '2026-06-07 02:16:20', '2026-06-07 02:16:20'),
(29, 7, 'sea_mountain_rescue', 20000.00, 'EUR', NULL, NULL, '2026-06-07 02:16:20', '2026-06-07 02:16:20'),
(30, 7, 'emergency_evacuation', 250000.00, 'EUR', NULL, NULL, '2026-06-07 02:16:20', '2026-06-07 02:16:20'),
(31, 7, 'medical_repatriation', 250000.00, 'EUR', NULL, NULL, '2026-06-07 02:16:20', '2026-06-07 02:16:20'),
(32, 7, 'repatriation_mortal_remains', 50000.00, 'EUR', NULL, NULL, '2026-06-07 02:16:20', '2026-06-07 02:16:20'),
(33, 7, 'luggage', 3000.00, 'EUR', NULL, 'Deductible of EUR 0.00 per claim', '2026-06-07 02:16:20', '2026-06-07 02:16:20'),
(34, 7, 'accidental_death', 50000.00, 'EUR', NULL, NULL, '2026-06-07 02:16:20', '2026-06-07 02:16:20'),
(35, 7, 'accidental_disability', 100000.00, 'EUR', NULL, NULL, '2026-06-07 02:16:20', '2026-06-07 02:16:20'),
(36, 7, 'third_party_liability', 500000.00, 'EUR', NULL, NULL, '2026-06-07 02:16:20', '2026-06-07 02:16:20'),
(37, 8, 'medical_cover', 160.00, 'EUR', NULL, NULL, '2026-06-09 14:40:44', '2026-06-09 14:40:44'),
(38, 8, 'sea_mountain_rescue', 180.00, 'EUR', NULL, NULL, '2026-06-09 14:40:44', '2026-06-09 14:40:44'),
(39, 8, 'emergency_evacuation', 130.00, 'EUR', NULL, NULL, '2026-06-09 14:40:44', '2026-06-09 14:40:44'),
(40, 8, 'medical_repatriation', 150.00, 'EUR', NULL, NULL, '2026-06-09 14:40:44', '2026-06-09 14:40:44'),
(41, 8, 'repatriation_mortal_remains', 200.00, 'EUR', NULL, NULL, '2026-06-09 14:40:44', '2026-06-09 14:40:44'),
(42, 8, 'luggage', 220.00, 'EUR', NULL, 'Deductible of EUR 100.00 per claim', '2026-06-09 14:40:44', '2026-06-09 14:40:44'),
(43, 8, 'accidental_death', 220.00, 'EUR', NULL, NULL, '2026-06-09 14:40:44', '2026-06-09 14:40:44'),
(44, 8, 'accidental_disability', 160.00, 'EUR', NULL, NULL, '2026-06-09 14:40:44', '2026-06-09 14:40:44'),
(45, 8, 'third_party_liability', 250.00, 'EUR', NULL, NULL, '2026-06-09 14:40:44', '2026-06-09 14:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('inoodex-cache-tyro:user-1:roles', 'a:1:{i:0;s:5:\"admin\";}', 1780993209),
('swisscare-cache-tyro:user-1:roles', 'a:1:{i:0;s:5:\"admin\";}', 1781069525);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `claim_number` varchar(255) NOT NULL,
  `claim_type` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `currency` char(3) NOT NULL DEFAULT 'EUR',
  `is_working` tinyint(1) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_holder` varchar(255) DEFAULT NULL,
  `iban` varchar(255) DEFAULT NULL,
  `bic_swift` varchar(255) DEFAULT NULL,
  `status` enum('pending','under_review','approved','rejected','paid') NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claim_documents`
--

CREATE TABLE `claim_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

CREATE TABLE `email_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email_type` enum('welcome_credentials','policy_issued','policy_reminder','custom') NOT NULL,
  `subject` varchar(255) NOT NULL,
  `recipient_email` varchar(255) NOT NULL,
  `status` enum('pending','sent','failed') NOT NULL DEFAULT 'pending',
  `sent_at` timestamp NULL DEFAULT NULL,
  `error_message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_logs`
--

INSERT INTO `email_logs` (`id`, `student_id`, `application_id`, `user_id`, `email_type`, `subject`, `recipient_email`, `status`, `sent_at`, `error_message`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, 'welcome_credentials', 'Welcome to Insaf Insurance - Your Login Credentials', 'student1@example.com', 'failed', NULL, 'Route [login] not defined. (View: C:\\laragon\\www\\insaf_insurance\\resources\\views\\emails\\student\\welcome.blade.php)', '2026-06-03 04:16:53', '2026-06-03 04:16:53'),
(2, 1, NULL, 1, 'welcome_credentials', 'Welcome to Insaf Insurance - Your Login Credentials', 'student1@example.com', 'failed', NULL, 'Route [login] not defined. (View: C:\\laragon\\www\\insaf_insurance\\resources\\views\\emails\\student\\welcome.blade.php)', '2026-06-03 04:28:45', '2026-06-03 04:28:45'),
(3, 1, NULL, 1, 'welcome_credentials', 'Welcome to Insaf Insurance - Your Login Credentials', 'student1@example.com', 'sent', '2026-06-03 04:29:48', NULL, '2026-06-03 04:29:48', '2026-06-03 04:29:48'),
(4, 3, NULL, 1, 'welcome_credentials', 'Welcome to Insaf Insurance - Your Login Credentials', 'hasan@example.com', 'sent', '2026-06-06 23:13:01', NULL, '2026-06-06 23:13:01', '2026-06-06 23:13:01'),
(5, 3, NULL, 1, 'welcome_credentials', 'Welcome to Insaf Insurance - Your Login Credentials', 'hasan@example.com', 'sent', '2026-06-06 23:31:53', NULL, '2026-06-06 23:31:53', '2026-06-06 23:31:53'),
(7, 1, 1, 1, 'policy_issued', 'Your Insurance Policy ISIE-XYXUWD Has Been Issued', 'student1@example.com', 'sent', '2026-06-07 01:43:20', NULL, '2026-06-07 01:43:20', '2026-06-07 01:43:20'),
(8, 3, 3, 1, 'policy_issued', 'Your Insurance Policy ISIE-VCLHAK Has Been Issued', 'hasan@example.com', 'sent', '2026-06-07 01:50:26', NULL, '2026-06-07 01:50:26', '2026-06-07 01:50:26'),
(10, 3, 7, 1, 'policy_issued', 'Your Insurance Policy ISIE-SXTKHZ Has Been Issued', 'hasan@example.com', 'sent', '2026-06-07 02:16:42', NULL, '2026-06-07 02:16:42', '2026-06-07 02:16:42'),
(11, 3, 3, 1, 'policy_issued', 'Your Insurance Policy ISIE-VCLHAK Has Been Issued', 'hasan@example.com', 'sent', '2026-06-07 05:24:36', NULL, '2026-06-07 05:24:36', '2026-06-07 05:24:36'),
(12, 3, NULL, 1, 'welcome_credentials', 'Welcome to Insaf Insurance - Your Login Credentials', 'hasan@example.com', 'sent', '2026-06-07 05:25:42', NULL, '2026-06-07 05:25:42', '2026-06-07 05:25:42'),
(13, 4, NULL, 1, 'welcome_credentials', 'Welcome to Insaf Insurance - Your Login Credentials', 'hasan1@example.com', 'failed', NULL, 'Connection could not be established with host \"sandbox.smtp.mailtrap.io:2525\": stream_socket_client(): Unable to connect to sandbox.smtp.mailtrap.io:2525 (Connection refused)', '2026-06-09 14:37:26', '2026-06-09 14:37:26'),
(14, 4, 8, 1, 'policy_issued', 'Your Insurance Policy ISIE-CTLCMF Has Been Issued', 'hasan1@example.com', 'failed', NULL, 'Connection could not be established with host \"sandbox.smtp.mailtrap.io:2525\": stream_socket_client(): Unable to connect to sandbox.smtp.mailtrap.io:2525 (Connection refused)', '2026-06-09 15:16:08', '2026-06-09 15:16:08'),
(15, 4, NULL, 1, 'welcome_credentials', 'Welcome to Insaf Insurance - Your Login Credentials', 'hasssaninoodex@gmail.com', 'sent', '2026-06-10 08:36:48', NULL, '2026-06-10 08:36:48', '2026-06-10 08:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insurance_applications`
--

CREATE TABLE `insurance_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `policy_number` varchar(255) DEFAULT NULL,
  `gic_reference` varchar(255) DEFAULT NULL,
  `first_destination` varchar(255) NOT NULL,
  `territories` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration_days` smallint(5) UNSIGNED NOT NULL,
  `premium_amount` decimal(10,2) NOT NULL,
  `currency` char(3) NOT NULL DEFAULT 'EUR',
  `paid_on` date DEFAULT NULL,
  `status` enum('draft','sent','active','expired','cancelled') NOT NULL DEFAULT 'draft',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `insurance_applications`
--

INSERT INTO `insurance_applications` (`id`, `student_id`, `user_id`, `plan_id`, `policy_number`, `gic_reference`, `first_destination`, `territories`, `start_date`, `end_date`, `duration_days`, `premium_amount`, `currency`, `paid_on`, `status`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 2, 'ISIE-XYXUWD', 'GIC-JYIUW', 'Malta', 'Worldwide', '2026-05-24', '2026-11-20', 181, 150.00, 'EUR', '2026-05-23', 'sent', 'Test application seeded by system.', '2026-06-03 02:19:52', '2026-06-09 14:33:44', '2026-06-09 14:33:44'),
(2, 2, 1, 1, 'ISIE-WEGW5A', 'GIC-YCIQU', 'Malta', 'Schengen Area', '2026-01-01', '2026-12-31', 365, 95.00, 'EUR', '2026-05-23', 'active', 'Test application seeded by system.', '2026-06-03 02:19:52', '2026-06-09 14:33:48', '2026-06-09 14:33:48'),
(3, 3, 1, 1, 'ISIE-VCLHAK', NULL, 'Malta', 'Schengen Area', '2026-01-10', '2026-12-20', 345, 150.00, 'GBP', NULL, 'sent', 'Test', '2026-06-07 01:11:56', '2026-06-09 14:33:40', '2026-06-09 14:33:40'),
(4, 1, 1, 1, 'ISIE-GMTF8C', 'TEST-D3273C', 'France', 'Schengen', '2026-07-01', '2026-08-01', 31, 50.00, 'EUR', NULL, 'sent', 'Repro test', '2026-06-07 02:02:22', '2026-06-07 02:02:22', '2026-06-07 02:02:22'),
(5, 1, 2, 1, NULL, 'TEST-D9E64B', 'France', 'Schengen', '2026-07-01', '2026-08-01', 31, 50.00, 'EUR', NULL, 'draft', 'Repro test', '2026-06-07 02:05:35', '2026-06-07 02:05:36', '2026-06-07 02:05:36'),
(6, 1, 2, 1, 'ISIE-S3YQV0', 'TEST-BB724C', 'France', 'Schengen', '2026-07-01', '2026-08-01', 31, 50.00, 'EUR', NULL, 'sent', 'Repro test', '2026-06-07 02:06:04', '2026-06-07 02:06:17', '2026-06-07 02:06:17'),
(7, 3, 1, 2, 'ISIE-SXTKHZ', NULL, 'Malta', 'Worldwide', '2025-12-01', '2026-12-01', 366, 100.00, 'EUR', NULL, 'sent', NULL, '2026-06-07 02:16:20', '2026-06-07 04:02:54', '2026-06-07 04:02:54'),
(8, 4, 1, 3, 'ISIE-CTLCMF', NULL, 'Malta', 'Malta', '2026-06-10', '2026-09-23', 106, 250.00, 'EUR', '2026-06-09', 'sent', 'This is a test', '2026-06-09 14:40:44', '2026-06-09 15:33:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `insurance_plans`
--

CREATE TABLE `insurance_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_level` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `medical_cover_max` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sea_mountain_rescue_max` decimal(10,2) NOT NULL DEFAULT 0.00,
  `emergency_evacuation_max` decimal(10,2) NOT NULL DEFAULT 0.00,
  `medical_repatriation_max` decimal(10,2) NOT NULL DEFAULT 0.00,
  `repatriation_mortal_remains_max` decimal(10,2) NOT NULL DEFAULT 0.00,
  `luggage_max` decimal(10,2) NOT NULL DEFAULT 0.00,
  `luggage_deductible` decimal(10,2) NOT NULL DEFAULT 0.00,
  `accidental_death_max` decimal(10,2) NOT NULL DEFAULT 0.00,
  `accidental_disability_max` decimal(10,2) NOT NULL DEFAULT 0.00,
  `third_party_liability_max` decimal(10,2) NOT NULL DEFAULT 0.00,
  `no_deductible_medical` tinyint(1) NOT NULL DEFAULT 1,
  `no_waiting_period` tinyint(1) NOT NULL DEFAULT 1,
  `schengen_included` tinyint(1) NOT NULL DEFAULT 1,
  `territories` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `insurance_plans`
--

INSERT INTO `insurance_plans` (`id`, `plan_name`, `plan_level`, `description`, `medical_cover_max`, `sea_mountain_rescue_max`, `emergency_evacuation_max`, `medical_repatriation_max`, `repatriation_mortal_remains_max`, `luggage_max`, `luggage_deductible`, `accidental_death_max`, `accidental_disability_max`, `third_party_liability_max`, `no_deductible_medical`, `no_waiting_period`, `schengen_included`, `territories`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Standard Europe', 'Basic', 'Essential coverage for students traveling to Europe.', 30000.00, 5000.00, 50000.00, 50000.00, 10000.00, 1000.00, 50.00, 10000.00, 20000.00, 100000.00, 1, 1, 1, 'Schengen Area', 1, '2026-06-03 02:19:51', '2026-06-09 14:33:57', '2026-06-09 14:33:57'),
(2, 'Premium Global', 'Premium', 'Comprehensive global coverage with higher limits.', 100000.00, 20000.00, 250000.00, 250000.00, 50000.00, 3000.00, 0.00, 50000.00, 100000.00, 500000.00, 1, 1, 1, 'Worldwide', 1, '2026-06-03 02:19:51', '2026-06-09 14:34:01', '2026-06-09 14:34:01'),
(3, 'Plan 1', 'Standard', 'This is a test', 160.00, 180.00, 130.00, 150.00, 200.00, 220.00, 100.00, 220.00, 160.00, 250.00, 1, 1, 1, 'Malta', 1, '2026-06-09 14:39:06', '2026-06-09 14:39:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invitation_links`
--

CREATE TABLE `invitation_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `hash` varchar(32) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invitation_referrals`
--

CREATE TABLE `invitation_referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invitation_link_id` bigint(20) UNSIGNED NOT NULL,
  `referred_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2022_05_17_181447_create_roles_table', 1),
(5, '2022_05_17_181456_create_user_roles_table', 1),
(6, '2024_01_01_000000_create_social_accounts_table', 1),
(7, '2024_01_01_000001_add_two_factor_columns_to_users_table', 1),
(8, '2024_01_01_000002_create_invitation_system_tables', 1),
(9, '2025_01_01_000001_create_media_table', 1),
(10, '2025_01_01_000001_create_privileges_table', 1),
(11, '2025_01_01_000002_create_privilege_role_table', 1),
(12, '2025_01_01_000002_create_starred_import_images_table', 1),
(13, '2025_01_01_000003_add_suspension_columns_to_users_table', 1),
(14, '2025_02_08_000000_add_profile_photo_to_users_table', 1),
(15, '2026_02_02_085518_create_personal_access_tokens_table', 1),
(16, '2026_02_03_073742_create_settings_table', 1),
(17, '2026_02_03_085903_add_is_active_to_roles_table', 1),
(18, '2026_02_15_000000_create_tyro_audit_logs_table', 1),
(19, '2026_06_03_062512_create_students_table', 1),
(20, '2026_06_03_062513_create_insurance_plans_table', 1),
(21, '2026_06_03_062515_create_insurance_applications_table', 1),
(22, '2026_06_03_062516_create_benefit_coverages_table', 1),
(23, '2026_06_03_062518_create_email_logs_table', 1),
(24, '2026_06_03_065614_create_claims_table', 1),
(25, '2026_06_03_065615_create_claim_documents_table', 1),
(26, '2026_06_03_075635_add_extra_profile_fields_to_students_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privilege_role`
--

CREATE TABLE `privilege_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `privilege_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 1, '2026-06-03 02:33:59', '2026-06-03 02:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1yJ9NfYuu8I6vUUctM8nuv34A4aX2H2uGXaKzMlm', 1, '103.88.141.51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNUtKN1ZTbGdmNG5FeXB2aUhLeVFEZEZkMWV2N1phTmVlV0dEV216RyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vbXkuc3dpc3NjYXJlZS5jb20vZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjIwOiJ0eXJvLWRhc2hib2FyZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTA6InR5cm8tbG9naW4iO2E6MTp7czo3OiJjYXB0Y2hhIjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1781062389),
('aE17iXY1vTQbSIb6iM5ZLhEvUeDdPOE7WNMBvEY4', NULL, '185.247.137.39', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGFoUmVoTUpaNmNWY292UmxEWXQ0VlN3OWo4clh6NEdnUE9kWkZSNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vbXkuc3dpc3NjYXJlZS5jb20iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781070029),
('d7BY6qPjFE53BKpnPeAj4D6UmbYHhuFvuEVWYq1k', NULL, '103.15.42.69', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieUdZNWFocDdySnk0d2JFbjRFZFpSb0RIUE5QRmFHSk1PU3duZUppOSI7czoxMDoidHlyby1sb2dpbiI7YToxOntzOjc6ImNhcHRjaGEiO2E6MTp7czo1OiJsb2dpbiI7aTo2O319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vbXkuc3dpc3NjYXJlZS5jb20vYWRtaW4vbG9naW4iO3M6NToicm91dGUiO3M6MTY6InR5cm8tbG9naW4ubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781064361),
('DwAW7zgkfsw1jUJwXZbgX01snByg9SeTnKuwO18p', NULL, '205.169.39.30', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic1ZJUTdFdnA4Q20wMW5XQnNIM1lUZHQ1OGN4aEhqNFczaEwycG9GOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vbXkuc3dpc3NjYXJlZS5jb20iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781070981),
('ohBAWVJ6bOOCIgqd0brZTjv75Dn2DwAUW5gY4pox', NULL, '103.88.141.51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDRXSzloQ29tcU9xbkcyY3JyWm5nTGFXMjdjeklKNXhFTElZYXZobCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vbXkuc3dpc3NjYXJlZS5jb20vbG9naW4iO3M6NToicm91dGUiO3M6MTM6InN0dWRlbnQubG9naW4iO319', 1781063609),
('qb0pr0pt62H9jBC6TkVDksqgLeeTXWbLasZ8xuJ3', 4, '103.88.141.51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieWlXOXhwbUExTksxRURoMnMyVjQ1ZjlhZG56bnYyb0d0eU04RGM2TCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vbXkuc3dpc3NjYXJlZS5jb20vc3R1ZGVudC9wb2xpY2llcy84IjtzOjU6InJvdXRlIjtzOjIxOiJzdHVkZW50LnBvbGljaWVzLnNob3ciO31zOjU0OiJsb2dpbl9zdHVkZW50XzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1781064927),
('ufvkEqup2GBa5JZLbFwVIadICNacglggW4wu8djA', 1, '103.88.141.51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR1hLSzM3U0p3WHNKcElaWTJ6QXF5OFNsQkhWZ3FpSW1BZ25mWHR4UiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vbXkuc3dpc3NjYXJlZS5jb20vZGFzaGJvYXJkL3N0dWRlbnRzIjtzOjU6InJvdXRlIjtzOjIwOiJhZG1pbi5zdHVkZW50cy5pbmRleCI7fXM6MTA6InR5cm8tbG9naW4iO2E6MTp7czo3OiJjYXB0Y2hhIjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1781064081),
('vG56yuKpb7E69l6K4vHlnAR6hYTfdBtJk8VtGVHV', 4, '103.88.141.51', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 11_0) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Safari/605.1.15', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiaFZkaWxJOWtxVFhsUFAxZlRoOGYxQkd0bGNjQWFjWlM4Um1ZcnRkTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vbXkuc3dpc3NjYXJlZS5jb20vc3R1ZGVudC9wb2xpY2llcy84IjtzOjU6InJvdXRlIjtzOjIxOiJzdHVkZW50LnBvbGljaWVzLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjEwOiJ0eXJvLWxvZ2luIjthOjE6e3M6NzoiY2FwdGNoYSI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo1NDoibG9naW5fc3R1ZGVudF81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1781070201),
('VTdeLTMrDHiaCG0nImnRt64rgvpRoAxFCe3lfhB8', NULL, '103.88.141.51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHVhdU1Mdk9BamhMOXFzNVh1aWFhWnNJNm9tT0Z4aTFxRkRySzJoayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vbXkuc3dpc3NjYXJlZS5jb20iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781063837),
('YzyA0ZJPVYdtV1kFFZ7BPPaHDnQ2Iwufzt8nW9hm', 1, '103.88.141.51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibFE1c09DRW1PUHVPZzBkQkN0amRKWllBWDZqeXFhNW9kWUtSZ3VBQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vbXkuc3dpc3NjYXJlZS5jb20vZGFzaGJvYXJkL3N0dWRlbnRzLzQiO3M6NToicm91dGUiO3M6MTk6ImFkbWluLnN0dWRlbnRzLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjEwOiJ0eXJvLWxvZ2luIjthOjE6e3M6NzoiY2FwdGNoYSI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1781064385),
('zW8hiAsIeQkSbM8NZhdM36snb69teSjI7N6LRWva', NULL, '20.55.61.179', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHlrVk1kVDdiNTg3MVJiaUQ5QmdmOTJVUXp4ZExQZlJBc1hRYlFSaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vbXkuc3dpc3NjYXJlZS5jb20iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781066164);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'SWISSCARE', '2026-06-03 03:00:21', '2026-06-09 12:15:26'),
(2, 'app_logo', 'uploads/settings/DcNdUIe4OLcHjYe7qz1ZtgsK6mKiQVsLafL2Q0et.jpg', '2026-06-03 03:00:21', '2026-06-10 08:49:29'),
(3, 'app_favicon', 'uploads/settings/xwBDKxwRkp6O9dtlFMN4Gl3KQRCROWqkB6jBw9xI.png', '2026-06-03 03:00:21', '2026-06-03 03:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE `social_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(255) NOT NULL,
  `provider_user_id` varchar(255) NOT NULL,
  `provider_email` varchar(255) DEFAULT NULL,
  `provider_avatar` varchar(255) DEFAULT NULL,
  `access_token` text DEFAULT NULL,
  `refresh_token` text DEFAULT NULL,
  `token_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passport_number` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `country_of_origin` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `institute_name` varchar(255) NOT NULL,
  `institute_address` text NOT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `is_company` tinyint(1) NOT NULL DEFAULT 0,
  `correspondence_firstname` varchar(255) DEFAULT NULL,
  `correspondence_lastname` varchar(255) DEFAULT NULL,
  `correspondence_gender` varchar(255) DEFAULT NULL,
  `correspondence_address_1` varchar(255) DEFAULT NULL,
  `correspondence_address_2` varchar(255) DEFAULT NULL,
  `correspondence_country` varchar(255) DEFAULT NULL,
  `correspondence_zip_code` varchar(255) DEFAULT NULL,
  `correspondence_city` varchar(255) DEFAULT NULL,
  `correspondence_country_code` varchar(10) DEFAULT NULL,
  `correspondence_phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `temporary_password` varchar(255) DEFAULT NULL,
  `password_changed` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `full_name`, `email`, `passport_number`, `date_of_birth`, `gender`, `nationality`, `country_of_origin`, `phone_number`, `institute_name`, `institute_address`, `address_2`, `zip_code`, `city`, `country_code`, `is_company`, `correspondence_firstname`, `correspondence_lastname`, `correspondence_gender`, `correspondence_address_1`, `correspondence_address_2`, `correspondence_country`, `correspondence_zip_code`, `correspondence_city`, `correspondence_country_code`, `correspondence_phone`, `password`, `temporary_password`, `password_changed`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Student 1', 'student1@example.com', 'AB123456', '2000-01-01', 'male', 'Bangladeshi', 'Bangladesh', '+8801234567890', 'International Institute by Malta', '135 Triq Hal Luqa, Rahal Gdid PLA 1501, Malta', NULL, '7890', 'Dhaka', '+ 880', 0, 'Parent', 'One', 'male', '123 Main St', NULL, 'Bangladesh', '1234', 'Dhaka', '+880', '01711111111', '$2y$12$b/m.Zgj/FQJ2Zmz2rySbIul/prfxuZKB/.4LtM9OdZpKfYhtDLR7W', NULL, 1, NULL, '2026-06-03 02:19:52', '2026-06-09 14:34:21', '2026-06-09 14:34:21'),
(2, 'Student 2', 'student2@example.com', 'B98765432', '2001-10-15', 'female', 'German', 'Germany', '+49123456789', 'University of Malta', 'Msida MSD 2080, Malta', NULL, NULL, NULL, NULL, 0, 'Contact', 'Two', NULL, '456 Berlin Ave', NULL, 'Germany', NULL, 'Berlin', NULL, '030123456', '$2y$12$YS9CBqsdgm3hCRjRtTsHZOHI7FJPzOGCs..mL5Oj9nYRWu7FQMH9i', NULL, 1, NULL, '2026-06-03 02:19:52', '2026-06-09 14:34:24', '2026-06-09 14:34:24'),
(3, 'Hasan', 'hasan@example.com', 'XYZ00000', '1999-01-01', 'male', 'Bangladeshi', 'Bangladesh', '+8801234567890', 'International Institute by Malaysia', 'Kualalampur, Malaysia', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$hu7Qy.77dUgzG9GYD9HptOffG8QpoxYnrrmr6MlKcOaFf8uM3cm9y', '1N6OVS7ivS', 0, NULL, '2026-06-06 23:12:50', '2026-06-09 14:34:18', '2026-06-09 14:34:18'),
(4, 'Md Hasan', 'hasssaninoodex@gmail.com', 'AB12345678', '2000-12-01', 'male', 'Bangladeshi', 'Bangladesh', '+8801234567890', 'University of Malta', '1234 Street, Malta', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$0B9cPnhOwTO1FEEx.JAojO6xBVwHbk8qyDK441oc.GNNz4s56iFcu', 'i0AFrvJO56', 0, NULL, '2026-06-09 14:37:19', '2026-06-10 08:36:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tyro_audit_logs`
--

CREATE TABLE `tyro_audit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(255) NOT NULL,
  `auditable_type` varchar(255) DEFAULT NULL,
  `auditable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `old_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_values`)),
  `new_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_values`)),
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tyro_audit_logs`
--

INSERT INTO `tyro_audit_logs` (`id`, `user_id`, `event`, `auditable_type`, `auditable_id`, `old_values`, `new_values`, `metadata`, `created_at`) VALUES
(1, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-03 08:22:35'),
(2, NULL, 'user.logout', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-03 08:32:36'),
(3, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\": \"hello@inoodex.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-03 08:32:46'),
(4, NULL, 'role.created', 'HasinHayder\\Tyro\\Models\\Role', 1, NULL, '{\"id\": 1, \"name\": \"admin\", \"slug\": \"admin\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": true, \"user_agent\": \"Symfony\"}', '2026-06-03 08:33:59'),
(5, NULL, 'role.assigned', 'App\\Models\\User', 1, NULL, '{\"role_id\": 1, \"role_slug\": \"admin\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": true, \"user_agent\": \"Symfony\"}', '2026-06-03 08:34:23'),
(6, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-03 10:32:06'),
(7, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-03 10:32:48'),
(8, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-03 10:34:46'),
(9, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-03 10:36:15'),
(10, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\": \"hello@inoodex.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 04:54:46'),
(11, 1, 'user.logout', 'App\\Models\\User', 1, NULL, '{\"email\": \"hello@inoodex.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 04:56:37'),
(12, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\": \"hello@inoodex.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 05:09:51'),
(13, 1, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 06:53:52'),
(14, 2, 'user.login', 'App\\Models\\User', 2, NULL, '{\"email\": \"admin@test.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": true, \"user_agent\": \"Symfony\"}', '2026-06-07 08:05:35'),
(15, 2, 'user.login', 'App\\Models\\User', 2, NULL, '{\"email\": \"admin@test.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": true, \"user_agent\": \"Symfony\"}', '2026-06-07 08:06:04'),
(16, 1, 'user.logout', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 11:22:59'),
(17, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\": \"hello@inoodex.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 11:23:14'),
(18, 1, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 11:27:10'),
(19, 1, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 11:43:02'),
(20, 1, 'user.logout', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 11:44:55'),
(21, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 11:44:59'),
(22, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 11:46:45'),
(23, NULL, 'user.logout', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 11:49:33'),
(24, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 11:49:37'),
(25, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\": \"hello@inoodex.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 11:55:44'),
(26, 1, 'user.logout', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 12:01:54'),
(27, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 12:01:59'),
(28, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\": \"hello@inoodex.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 12:13:28'),
(29, 1, 'user.logout', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 12:29:38'),
(30, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\": \"student1@example.com\"}', '{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}', '2026-06-07 12:33:46'),
(31, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\":\"student1@example.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 08:08:06'),
(32, NULL, 'user.logout', 'App\\Models\\Student', 1, NULL, '{\"email\":\"student1@example.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 08:08:13'),
(33, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 08:08:28'),
(34, 1, 'user.logout', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 08:09:22'),
(35, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 08:15:08'),
(36, 1, 'user.logout', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 08:16:32'),
(37, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 08:16:41'),
(38, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\":\"student1@example.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 08:18:17'),
(39, NULL, 'user.logout', 'App\\Models\\Student', 1, NULL, '{\"email\":\"student1@example.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 08:35:39'),
(40, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 08:43:18'),
(41, 1, 'user.logout', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 08:59:54'),
(42, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\":\"student1@example.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 10:16:21'),
(43, NULL, 'user.logout', 'App\\Models\\Student', 1, NULL, '{\"email\":\"student1@example.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 10:21:12'),
(44, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 10:21:43'),
(45, NULL, 'user.login', 'App\\Models\\Student', 2, NULL, '{\"email\":\"student2@example.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 10:22:21'),
(46, NULL, 'user.login', 'App\\Models\\Student', 1, NULL, '{\"email\":\"student1@example.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 10:24:33'),
(47, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 10:33:26'),
(48, 1, 'user.suspended', 'App\\Models\\User', 2, '{\"suspended_at\":null,\"suspension_reason\":null}', '{\"suspended_at\":\"2026-06-09T10:35:03.738762Z\",\"suspension_reason\":null}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 10:35:03'),
(49, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 10:47:56'),
(50, 1, 'user.login', 'App\\Models\\Student', 4, NULL, '{\"email\":\"hasan1@example.com\"}', '{\"ip\":\"103.88.141.55\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-09 11:13:15'),
(51, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.51\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko\\/20100101 Firefox\\/151.0\",\"is_console\":false}', '2026-06-10 03:30:32'),
(52, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.51\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko\\/20100101 Firefox\\/151.0\",\"is_console\":false}', '2026-06-10 03:32:23'),
(53, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.51\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko\\/20100101 Firefox\\/151.0\",\"is_console\":false}', '2026-06-10 03:33:08'),
(54, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.51\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko\\/20100101 Firefox\\/151.0\",\"is_console\":false}', '2026-06-10 03:53:09'),
(55, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.51\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/148.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-10 03:58:11'),
(56, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.51\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/148.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-10 04:06:02'),
(57, NULL, 'user.login', 'App\\Models\\Student', 4, NULL, '{\"email\":\"hasan1@example.com\"}', '{\"ip\":\"103.88.141.51\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/148.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-10 04:07:10'),
(58, 1, 'user.login', 'App\\Models\\User', 1, NULL, '{\"email\":\"hello@inoodex.com\"}', '{\"ip\":\"103.88.141.51\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-10 04:36:01'),
(59, 1, 'user.login', 'App\\Models\\Student', 4, NULL, '{\"email\":\"hasssaninoodex@gmail.com\"}', '{\"ip\":\"103.88.141.51\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/149.0.0.0 Safari\\/537.36\",\"is_console\":false}', '2026-06-10 04:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `tyro_media`
--

CREATE TABLE `tyro_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `webp_path` varchar(255) DEFAULT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `disk` varchar(50) NOT NULL DEFAULT 'public',
  `mime_type` varchar(100) NOT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `source_url` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tyro_starred_import_images`
--

CREATE TABLE `tyro_starred_import_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `star_key` varchar(64) NOT NULL,
  `provider` varchar(50) NOT NULL,
  `external_id` varchar(255) DEFAULT NULL,
  `alt` text DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `thumb_url` varchar(2048) DEFAULT NULL,
  `preview_url` varchar(2048) DEFAULT NULL,
  `download_url` varchar(2048) DEFAULT NULL,
  `download_location` varchar(2048) DEFAULT NULL,
  `source_url` varchar(2048) DEFAULT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payload`)),
  `starred_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `suspension_reason` text DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `use_gravatar` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `suspended_at`, `suspension_reason`, `profile_photo_path`, `use_gravatar`) VALUES
(1, 'Inoodex', 'hello@inoodex.com', '2026-06-03 02:19:51', '$2y$12$4zc4nVzLtVB9Dg.ZyYOznemOzzblh/d1rfLHsGwnEoA4UzOZO4Smm', NULL, NULL, NULL, 'AinvgvaQO3MFUmyyh2lc2U8LXyiuNHnfKSsGFEEs9Cg54NZzE1i88aLlyGPa', '2026-06-03 02:19:51', '2026-06-03 02:19:51', NULL, NULL, NULL, 0),
(2, 'Test Admin', 'admin@test.com', NULL, '$2y$12$Rqr.HguslltBZloIAilEmuOL5ge0TeZc3us8IcdFIyRNvQoLruOUq', NULL, NULL, NULL, NULL, '2026-06-07 02:05:35', '2026-06-09 14:35:03', '2026-06-09 14:35:03', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-06-03 02:34:23', '2026-06-03 02:34:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `benefit_coverages`
--
ALTER TABLE `benefit_coverages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `benefit_coverages_application_id_benefit_type_unique` (`application_id`,`benefit_type`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `claims_claim_number_unique` (`claim_number`),
  ADD KEY `claims_student_id_foreign` (`student_id`),
  ADD KEY `claims_application_id_foreign` (`application_id`);

--
-- Indexes for table `claim_documents`
--
ALTER TABLE `claim_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `claim_documents_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_logs_student_id_foreign` (`student_id`),
  ADD KEY `email_logs_application_id_foreign` (`application_id`),
  ADD KEY `email_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `insurance_applications`
--
ALTER TABLE `insurance_applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `insurance_applications_policy_number_unique` (`policy_number`),
  ADD KEY `insurance_applications_student_id_foreign` (`student_id`),
  ADD KEY `insurance_applications_user_id_foreign` (`user_id`),
  ADD KEY `insurance_applications_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `insurance_plans`
--
ALTER TABLE `insurance_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invitation_links`
--
ALTER TABLE `invitation_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invitation_links_hash_unique` (`hash`),
  ADD KEY `invitation_links_user_id_index` (`user_id`);

--
-- Indexes for table `invitation_referrals`
--
ALTER TABLE `invitation_referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invitation_referrals_invitation_link_id_index` (`invitation_link_id`),
  ADD KEY `invitation_referrals_referred_user_id_index` (`referred_user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `privileges_slug_unique` (`slug`);

--
-- Indexes for table `privilege_role`
--
ALTER TABLE `privilege_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `privilege_role_role_id_privilege_id_unique` (`role_id`,`privilege_id`),
  ADD KEY `privilege_role_privilege_id_foreign` (`privilege_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_slug_index` (`slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `social_accounts_provider_provider_user_id_unique` (`provider`,`provider_user_id`),
  ADD KEY `social_accounts_provider_provider_user_id_index` (`provider`,`provider_user_id`),
  ADD KEY `social_accounts_user_id_index` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD UNIQUE KEY `students_passport_number_unique` (`passport_number`);

--
-- Indexes for table `tyro_audit_logs`
--
ALTER TABLE `tyro_audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tyro_audit_logs_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  ADD KEY `tyro_audit_logs_user_id_index` (`user_id`),
  ADD KEY `tyro_audit_logs_event_index` (`event`);

--
-- Indexes for table `tyro_media`
--
ALTER TABLE `tyro_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tyro_media_user_id_foreign` (`user_id`);

--
-- Indexes for table `tyro_starred_import_images`
--
ALTER TABLE `tyro_starred_import_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tyro_starred_import_images_user_id_star_key_unique` (`user_id`,`star_key`),
  ADD KEY `tyro_starred_import_images_user_id_starred_at_index` (`user_id`,`starred_at`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_roles_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `benefit_coverages`
--
ALTER TABLE `benefit_coverages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `claim_documents`
--
ALTER TABLE `claim_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_logs`
--
ALTER TABLE `email_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurance_applications`
--
ALTER TABLE `insurance_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `insurance_plans`
--
ALTER TABLE `insurance_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invitation_links`
--
ALTER TABLE `invitation_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invitation_referrals`
--
ALTER TABLE `invitation_referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privilege_role`
--
ALTER TABLE `privilege_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_accounts`
--
ALTER TABLE `social_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tyro_audit_logs`
--
ALTER TABLE `tyro_audit_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tyro_media`
--
ALTER TABLE `tyro_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tyro_starred_import_images`
--
ALTER TABLE `tyro_starred_import_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `benefit_coverages`
--
ALTER TABLE `benefit_coverages`
  ADD CONSTRAINT `benefit_coverages_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `insurance_applications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `claims`
--
ALTER TABLE `claims`
  ADD CONSTRAINT `claims_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `insurance_applications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `claims_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `claim_documents`
--
ALTER TABLE `claim_documents`
  ADD CONSTRAINT `claim_documents_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD CONSTRAINT `email_logs_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `insurance_applications` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `email_logs_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `email_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `insurance_applications`
--
ALTER TABLE `insurance_applications`
  ADD CONSTRAINT `insurance_applications_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `insurance_plans` (`id`),
  ADD CONSTRAINT `insurance_applications_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `insurance_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `invitation_referrals`
--
ALTER TABLE `invitation_referrals`
  ADD CONSTRAINT `invitation_referrals_invitation_link_id_foreign` FOREIGN KEY (`invitation_link_id`) REFERENCES `invitation_links` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `privilege_role`
--
ALTER TABLE `privilege_role`
  ADD CONSTRAINT `privilege_role_privilege_id_foreign` FOREIGN KEY (`privilege_id`) REFERENCES `privileges` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `privilege_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tyro_media`
--
ALTER TABLE `tyro_media`
  ADD CONSTRAINT `tyro_media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tyro_starred_import_images`
--
ALTER TABLE `tyro_starred_import_images`
  ADD CONSTRAINT `tyro_starred_import_images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
