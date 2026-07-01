-- Adminer 5.4.2 MySQL 8.4.3 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `benefit_coverages`;
CREATE TABLE `benefit_coverages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `benefit_type` enum('medical_cover','sea_mountain_rescue','emergency_evacuation','medical_repatriation','repatriation_mortal_remains','luggage','accidental_death','accidental_disability','third_party_liability') COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_amount` decimal(10,2) NOT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'EUR',
  `delivery_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deductible_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `benefit_coverages_application_id_benefit_type_unique` (`application_id`,`benefit_type`),
  CONSTRAINT `benefit_coverages_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `insurance_applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `benefit_coverages` (`id`, `application_id`, `benefit_type`, `max_amount`, `currency`, `delivery_note`, `deductible_note`, `created_at`, `updated_at`) VALUES
(55,	10,	'medical_cover',	50000.00,	'EUR',	NULL,	NULL,	'2026-07-01 04:42:50',	'2026-07-01 04:42:50'),
(56,	10,	'sea_mountain_rescue',	30000.00,	'EUR',	NULL,	NULL,	'2026-07-01 04:42:50',	'2026-07-01 04:42:50'),
(57,	10,	'emergency_evacuation',	150000.00,	'EUR',	NULL,	NULL,	'2026-07-01 04:42:50',	'2026-07-01 04:42:50'),
(58,	10,	'medical_repatriation',	50000.00,	'EUR',	NULL,	NULL,	'2026-07-01 04:42:50',	'2026-07-01 04:42:50'),
(59,	10,	'repatriation_mortal_remains',	30000.00,	'EUR',	NULL,	NULL,	'2026-07-01 04:42:50',	'2026-07-01 04:42:50'),
(60,	10,	'luggage',	1000.00,	'EUR',	NULL,	'Deductible of EUR 250.00 per claim',	'2026-07-01 04:42:50',	'2026-07-01 04:42:50'),
(61,	10,	'accidental_death',	25000.00,	'EUR',	NULL,	NULL,	'2026-07-01 04:42:50',	'2026-07-01 04:42:50'),
(62,	10,	'accidental_disability',	50000.00,	'EUR',	NULL,	NULL,	'2026-07-01 04:42:50',	'2026-07-01 04:42:50'),
(63,	10,	'third_party_liability',	500000.00,	'EUR',	NULL,	NULL,	'2026-07-01 04:42:50',	'2026-07-01 04:42:50');

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('swisscare-cache-tyro:user-1:roles',	'a:1:{i:0;s:5:\"admin\";}',	1782902844);

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `claim_documents`;
CREATE TABLE `claim_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `claim_id` bigint unsigned NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `claim_documents_claim_id_foreign` (`claim_id`),
  CONSTRAINT `claim_documents_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `claims`;
CREATE TABLE `claims` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `application_id` bigint unsigned NOT NULL,
  `claim_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `claim_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` date NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'EUR',
  `is_working` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bic_swift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','under_review','approved','rejected','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `claims_claim_number_unique` (`claim_number`),
  KEY `claims_student_id_foreign` (`student_id`),
  KEY `claims_application_id_foreign` (`application_id`),
  CONSTRAINT `claims_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `insurance_applications` (`id`) ON DELETE CASCADE,
  CONSTRAINT `claims_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `email_logs`;
CREATE TABLE `email_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `application_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `email_type` enum('welcome_credentials','policy_issued','policy_reminder','custom','policy_download') COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','sent','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `sent_at` timestamp NULL DEFAULT NULL,
  `error_message` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email_logs_student_id_foreign` (`student_id`),
  KEY `email_logs_application_id_foreign` (`application_id`),
  KEY `email_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `email_logs_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `insurance_applications` (`id`) ON DELETE SET NULL,
  CONSTRAINT `email_logs_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `email_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
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


DROP TABLE IF EXISTS `insurance_applications`;
CREATE TABLE `insurance_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `plan_id` bigint unsigned NOT NULL,
  `policy_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gic_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `territories` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration_days` smallint unsigned NOT NULL,
  `premium_amount` decimal(10,2) NOT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'EUR',
  `paid_on` date DEFAULT NULL,
  `status` enum('draft','sent','active','expired','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `insurance_applications_policy_number_unique` (`policy_number`),
  KEY `insurance_applications_student_id_foreign` (`student_id`),
  KEY `insurance_applications_user_id_foreign` (`user_id`),
  KEY `insurance_applications_plan_id_foreign` (`plan_id`),
  CONSTRAINT `insurance_applications_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `insurance_plans` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `insurance_applications_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `insurance_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `insurance_applications` (`id`, `student_id`, `user_id`, `plan_id`, `policy_number`, `gic_reference`, `first_destination`, `territories`, `start_date`, `end_date`, `duration_days`, `premium_amount`, `currency`, `paid_on`, `status`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10,	6,	1,	2,	'ISIE-WEGW5A',	'REF-1234',	'Malta',	'Worldwide',	'2026-07-01',	'2026-07-02',	2,	500.00,	'EUR',	NULL,	'draft',	NULL,	'2026-07-01 04:42:50',	'2026-07-01 04:42:50',	NULL);

DROP TABLE IF EXISTS `insurance_plans`;
CREATE TABLE `insurance_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `medical_cover_max` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sea_mountain_rescue_max` decimal(10,2) NOT NULL DEFAULT '0.00',
  `emergency_evacuation_max` decimal(10,2) NOT NULL DEFAULT '0.00',
  `medical_repatriation_max` decimal(10,2) NOT NULL DEFAULT '0.00',
  `repatriation_mortal_remains_max` decimal(10,2) NOT NULL DEFAULT '0.00',
  `luggage_max` decimal(10,2) NOT NULL DEFAULT '0.00',
  `luggage_deductible` decimal(10,2) NOT NULL DEFAULT '0.00',
  `accidental_death_max` decimal(10,2) NOT NULL DEFAULT '0.00',
  `accidental_disability_max` decimal(10,2) NOT NULL DEFAULT '0.00',
  `third_party_liability_max` decimal(10,2) NOT NULL DEFAULT '0.00',
  `no_deductible_medical` tinyint(1) NOT NULL DEFAULT '1',
  `no_waiting_period` tinyint(1) NOT NULL DEFAULT '1',
  `schengen_included` tinyint(1) NOT NULL DEFAULT '1',
  `territories` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `insurance_plans` (`id`, `plan_name`, `plan_level`, `description`, `medical_cover_max`, `sea_mountain_rescue_max`, `emergency_evacuation_max`, `medical_repatriation_max`, `repatriation_mortal_remains_max`, `luggage_max`, `luggage_deductible`, `accidental_death_max`, `accidental_disability_max`, `third_party_liability_max`, `no_deductible_medical`, `no_waiting_period`, `schengen_included`, `territories`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2,	'International student health insurance Europe',	'Standard',	'Comprehensive global coverage with higher limits.',	50000.00,	30000.00,	150000.00,	50000.00,	30000.00,	1000.00,	250.00,	25000.00,	50000.00,	500000.00,	1,	1,	1,	'Worldwide',	1,	'2026-06-03 02:19:51',	'2026-06-11 00:18:32',	NULL);

DROP TABLE IF EXISTS `invitation_links`;
CREATE TABLE `invitation_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `hash` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invitation_links_hash_unique` (`hash`),
  KEY `invitation_links_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `invitation_referrals`;
CREATE TABLE `invitation_referrals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invitation_link_id` bigint unsigned NOT NULL,
  `referred_user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invitation_referrals_invitation_link_id_index` (`invitation_link_id`),
  KEY `invitation_referrals_referred_user_id_index` (`referred_user_id`),
  CONSTRAINT `invitation_referrals_invitation_link_id_foreign` FOREIGN KEY (`invitation_link_id`) REFERENCES `invitation_links` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
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


DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
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


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'0001_01_01_000000_create_users_table',	1),
(2,	'0001_01_01_000001_create_cache_table',	1),
(3,	'0001_01_01_000002_create_jobs_table',	1),
(4,	'2022_05_17_181447_create_roles_table',	1),
(5,	'2022_05_17_181456_create_user_roles_table',	1),
(6,	'2024_01_01_000000_create_social_accounts_table',	1),
(7,	'2024_01_01_000001_add_two_factor_columns_to_users_table',	1),
(8,	'2024_01_01_000002_create_invitation_system_tables',	1),
(9,	'2025_01_01_000001_create_media_table',	1),
(10,	'2025_01_01_000001_create_privileges_table',	1),
(11,	'2025_01_01_000002_create_privilege_role_table',	1),
(12,	'2025_01_01_000002_create_starred_import_images_table',	1),
(13,	'2025_01_01_000003_add_suspension_columns_to_users_table',	1),
(14,	'2025_02_08_000000_add_profile_photo_to_users_table',	1),
(15,	'2026_02_02_085518_create_personal_access_tokens_table',	1),
(16,	'2026_02_03_073742_create_settings_table',	1),
(17,	'2026_02_03_085903_add_is_active_to_roles_table',	1),
(18,	'2026_02_15_000000_create_tyro_audit_logs_table',	1),
(19,	'2026_06_03_062512_create_students_table',	1),
(20,	'2026_06_03_062513_create_insurance_plans_table',	1),
(21,	'2026_06_03_062515_create_insurance_applications_table',	1),
(22,	'2026_06_03_062516_create_benefit_coverages_table',	1),
(23,	'2026_06_03_062518_create_email_logs_table',	1),
(24,	'2026_06_03_065614_create_claims_table',	1),
(25,	'2026_06_03_065615_create_claim_documents_table',	1),
(26,	'2026_06_03_075635_add_extra_profile_fields_to_students_table',	1),
(27,	'2026_06_09_111646_add_soft_deletes_to_users_table',	2),
(28,	'2026_06_11_000001_add_institute_phone_to_students_table',	3),
(29,	'2026_06_23_000001_add_policy_download_to_email_type_enum',	4),
(30,	'2026_07_01_000001_make_institute_fields_nullable',	5);

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `privilege_role`;
CREATE TABLE `privilege_role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `privilege_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `privilege_role_role_id_privilege_id_unique` (`role_id`,`privilege_id`),
  KEY `privilege_role_privilege_id_foreign` (`privilege_id`),
  CONSTRAINT `privilege_role_privilege_id_foreign` FOREIGN KEY (`privilege_id`) REFERENCES `privileges` (`id`) ON DELETE CASCADE,
  CONSTRAINT `privilege_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `privileges`;
CREATE TABLE `privileges` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `privileges_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_slug_index` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'admin',	1,	'2026-06-03 02:33:59',	'2026-06-03 02:33:59');

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
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

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('MKDUzOtVLikisfhieN7Qt9j8EKJyD1RP6LDLBQcK',	1,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36',	'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRzI4TnphNTJxTzZhWEVZZ2p6RXJSQ3Q3aEhhMHF2SE5FcUtBT2twaCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjU5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkL2FwcGxpY2F0aW9ucy8xMC9wZGYtcHJldmlldyI7czo1OiJyb3V0ZSI7czozMDoiYWRtaW4uYXBwbGljYXRpb25zLnBkZi1wcmV2aWV3Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMDoidHlyby1sb2dpbiI7YToxOntzOjc6ImNhcHRjaGEiO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',	1782902633),
('Y6zH8SSl2RBOBGzUhtvuXN7B7ri3o1YhlfeaVDvB',	1,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36',	'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaVMyUmRUWTZYVktDaFNjVUdCQmdGN29MSjc3OEF1d3BwZGlaRmd3cyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvc3R1ZGVudHMiO3M6NToicm91dGUiO3M6MjA6ImFkbWluLnN0dWRlbnRzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMDoidHlyby1sb2dpbiI7YToxOntzOjc6ImNhcHRjaGEiO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',	1782895215);

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1,	'app_name',	'SWISSCARE',	'2026-06-03 03:00:21',	'2026-06-09 03:12:31'),
(2,	'app_logo',	'uploads/settings/slfH1MVVbmuiLSK8mNFY9jP5iB5zA5P76NqhtEas.jpg',	'2026-06-03 03:00:21',	'2026-06-11 01:56:35'),
(3,	'app_favicon',	'uploads/settings/xwBDKxwRkp6O9dtlFMN4Gl3KQRCROWqkB6jBw9xI.png',	'2026-06-03 03:00:21',	'2026-06-03 03:00:21');

DROP TABLE IF EXISTS `social_accounts`;
CREATE TABLE `social_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` text COLLATE utf8mb4_unicode_ci,
  `refresh_token` text COLLATE utf8mb4_unicode_ci,
  `token_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `social_accounts_provider_provider_user_id_unique` (`provider`,`provider_user_id`),
  KEY `social_accounts_provider_provider_user_id_index` (`provider`,`provider_user_id`),
  KEY `social_accounts_user_id_index` (`user_id`),
  CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_of_origin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_address` text COLLATE utf8mb4_unicode_ci,
  `institute_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_company` tinyint(1) NOT NULL DEFAULT '0',
  `correspondence_firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_address_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_address_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_country_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temporary_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_changed` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_email_unique` (`email`),
  UNIQUE KEY `students_passport_number_unique` (`passport_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `students` (`id`, `full_name`, `email`, `passport_number`, `date_of_birth`, `gender`, `nationality`, `country_of_origin`, `phone_number`, `institute_name`, `institute_address`, `institute_phone`, `address_2`, `zip_code`, `city`, `country_code`, `is_company`, `correspondence_firstname`, `correspondence_lastname`, `correspondence_gender`, `correspondence_address_1`, `correspondence_address_2`, `correspondence_country`, `correspondence_zip_code`, `correspondence_city`, `correspondence_country_code`, `correspondence_phone`, `password`, `temporary_password`, `password_changed`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6,	'Jesse Lockman',	'hasssaninoodex@gmail.com',	'286',	'2026-02-13',	'other',	'San Ramon',	'Monaco',	'605-688-9670',	NULL,	'73667 Pfannerstill Passage',	'672-645-1444',	NULL,	'15941',	'Normal',	'Mozambiqueawevtw',	0,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'$2y$12$FqVdCz6CPe5VWnjFPY.e/.hQUJlPl.dn3ku6FKcwPPNKV9Q7wRz32',	'1wJiO59BtX',	0,	NULL,	'2026-07-01 02:40:14',	'2026-07-01 02:40:14',	NULL);

DROP TABLE IF EXISTS `tyro_audit_logs`;
CREATE TABLE `tyro_audit_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auditable_id` bigint unsigned DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tyro_audit_logs_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `tyro_audit_logs_user_id_index` (`user_id`),
  KEY `tyro_audit_logs_event_index` (`event`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tyro_audit_logs` (`id`, `user_id`, `event`, `auditable_type`, `auditable_id`, `old_values`, `new_values`, `metadata`, `created_at`) VALUES
(1,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-03 08:22:35'),
(2,	NULL,	'user.logout',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-03 08:32:36'),
(3,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-03 08:32:46'),
(4,	NULL,	'role.created',	'HasinHayder\\Tyro\\Models\\Role',	1,	NULL,	'{\"id\": 1, \"name\": \"admin\", \"slug\": \"admin\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": true, \"user_agent\": \"Symfony\"}',	'2026-06-03 08:33:59'),
(5,	NULL,	'role.assigned',	'App\\Models\\User',	1,	NULL,	'{\"role_id\": 1, \"role_slug\": \"admin\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": true, \"user_agent\": \"Symfony\"}',	'2026-06-03 08:34:23'),
(6,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-03 10:32:06'),
(7,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-03 10:32:48'),
(8,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-03 10:34:46'),
(9,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-03 10:36:15'),
(10,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 04:54:46'),
(11,	1,	'user.logout',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 04:56:37'),
(12,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 05:09:51'),
(13,	1,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 06:53:52'),
(14,	2,	'user.login',	'App\\Models\\User',	2,	NULL,	'{\"email\": \"admin@test.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": true, \"user_agent\": \"Symfony\"}',	'2026-06-07 08:05:35'),
(15,	2,	'user.login',	'App\\Models\\User',	2,	NULL,	'{\"email\": \"admin@test.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": true, \"user_agent\": \"Symfony\"}',	'2026-06-07 08:06:04'),
(16,	1,	'user.logout',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 11:22:59'),
(17,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 11:23:14'),
(18,	1,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 11:27:10'),
(19,	1,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 11:43:02'),
(20,	1,	'user.logout',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 11:44:55'),
(21,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 11:44:59'),
(22,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 11:46:45'),
(23,	NULL,	'user.logout',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 11:49:33'),
(24,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 11:49:37'),
(25,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 11:55:44'),
(26,	1,	'user.logout',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 12:01:54'),
(27,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 12:01:59'),
(28,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 12:13:28'),
(29,	1,	'user.logout',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 12:29:38'),
(30,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-07 12:33:46'),
(31,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 04:01:38'),
(32,	1,	'user.logout',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 05:47:20'),
(33,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 05:47:27'),
(34,	1,	'user.logout',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 07:11:43'),
(35,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 07:12:32'),
(36,	NULL,	'user.logout',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 07:20:10'),
(37,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 07:24:58'),
(38,	NULL,	'user.logout',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 07:25:04'),
(39,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 07:25:20'),
(40,	1,	'user.logout',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 07:25:26'),
(41,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 07:54:24'),
(42,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 08:19:08'),
(43,	NULL,	'user.logout',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 08:22:32'),
(44,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 08:28:43'),
(45,	NULL,	'user.logout',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 08:29:19'),
(46,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 09:10:58'),
(47,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 09:12:01'),
(48,	1,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-09 10:17:50'),
(49,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-10 03:36:10'),
(50,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-10 04:33:11'),
(51,	1,	'user.logout',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-10 04:33:15'),
(52,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-10 04:51:07'),
(53,	1,	'user.logout',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-10 05:34:25'),
(54,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-10 05:34:49'),
(55,	NULL,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-10 08:03:32'),
(56,	NULL,	'user.logout',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-10 08:03:52'),
(57,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-10 08:19:26'),
(58,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-11 03:47:41'),
(59,	1,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-11 04:10:17'),
(60,	1,	'user.login',	'App\\Models\\Student',	1,	NULL,	'{\"email\": \"student1@example.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-11 04:40:04'),
(61,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-23 07:02:00'),
(62,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-29 06:45:30'),
(63,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-29 12:09:38'),
(64,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36\"}',	'2026-06-30 03:57:27'),
(65,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36\"}',	'2026-07-01 08:17:20'),
(66,	1,	'user.login',	'App\\Models\\User',	1,	NULL,	'{\"email\": \"hello@inoodex.com\"}',	'{\"ip\": \"127.0.0.1\", \"is_console\": false, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36\"}',	'2026-07-01 10:42:23');

DROP TABLE IF EXISTS `tyro_media`;
CREATE TABLE `tyro_media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `webp_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `mime_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint unsigned NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_url` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tyro_media_user_id_foreign` (`user_id`),
  CONSTRAINT `tyro_media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tyro_starred_import_images`;
CREATE TABLE `tyro_starred_import_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `star_key` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` text COLLATE utf8mb4_unicode_ci,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb_url` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preview_url` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_url` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_location` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_url` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` json DEFAULT NULL,
  `starred_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tyro_starred_import_images_user_id_star_key_unique` (`user_id`,`star_key`),
  KEY `tyro_starred_import_images_user_id_starred_at_index` (`user_id`,`starred_at`),
  CONSTRAINT `tyro_starred_import_images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_roles_user_id_role_id_unique` (`user_id`,`role_id`),
  KEY `user_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	'2026-06-03 02:34:23',	'2026-06-03 02:34:23');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `suspension_reason` text COLLATE utf8mb4_unicode_ci,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `use_gravatar` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `suspended_at`, `suspension_reason`, `profile_photo_path`, `use_gravatar`, `deleted_at`) VALUES
(1,	'Inoodex',	'hello@inoodex.com',	'2026-06-03 02:19:51',	'$2y$12$4zc4nVzLtVB9Dg.ZyYOznemOzzblh/d1rfLHsGwnEoA4UzOZO4Smm',	NULL,	NULL,	NULL,	'HXBIbGw7caIhfZXTtgHcBZb3MEIroptD3zDE1VzYU721CHxm6PEvmdge2pXi',	'2026-06-03 02:19:51',	'2026-06-03 02:19:51',	NULL,	NULL,	NULL,	0,	NULL);

-- 2026-07-01 11:00:00 UTC
