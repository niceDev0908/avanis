-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 08, 2020 at 03:00 PM
-- Server version: 5.7.31-0ubuntu0.16.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avanis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Hello First message from admin', NULL, '2020-09-22 01:45:14', '2020-09-22 01:45:14'),
(2, 1, 3, 'Second Messages from admin', NULL, '2020-09-22 01:47:24', '2020-09-22 01:47:24'),
(3, 3, 1, 'First message to Admin', NULL, '2020-09-22 01:47:24', '2020-09-22 01:47:24'),
(4, 2, 1, 'First message to Admin from user', NULL, '2020-09-22 01:47:24', '2020-09-22 01:47:24'),
(5, 1, 3, 'Message send email testing from admin side so user receive email', NULL, '2020-09-22 02:37:41', '2020-09-22 02:37:41'),
(6, 1, 4, 'Hi Mitchell', NULL, '2020-09-25 03:50:23', '2020-09-25 03:50:23'),
(8, 3, 1, 'Typing Message as Kristina Angel and sending to Site Admin \"Super Admin\"', NULL, '2020-10-08 03:16:05', '2020-10-08 03:16:05'),
(9, 1, 3, 'Typing Message as Super Admin and sending to User \"Kristina Angel\"', NULL, '2020-10-08 03:17:24', '2020-10-08 03:17:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(22, '2020_09_22_052724_create_messages_table', 4),
(21, '2020_09_18_104145_create_user_action_documents_table', 3),
(20, '2020_09_18_101533_create_user_actions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(2, 'App\\User', 4),
(3, 'App\\User', 3),
(3, 'App\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('superadmin@admin.com', 'L3V6SXRXOQ4g8URy4ltMUtoGT52hMwhj2Hsj1p9Mdvr5GqZIR9jkMYpWBERS', '2020-04-28 07:14:40'),
('superadmin@admin.com', 'LqLGtduEZK9kPyahqCXF2LcVw5Ogj6lb5tadlJacUnKd14m5hB7EW9IdqYBP', '2020-04-28 07:01:30');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2020-04-10 08:16:47', '2020-04-10 08:16:47'),
(2, 'role-create', 'web', '2020-04-10 08:16:48', '2020-04-10 08:16:48'),
(3, 'role-edit', 'web', '2020-04-10 08:16:48', '2020-04-10 08:16:48'),
(4, 'role-delete', 'web', '2020-04-10 08:16:48', '2020-04-10 08:16:48'),
(5, 'user-list', 'web', '2020-04-10 08:16:48', '2020-04-10 08:16:48'),
(6, 'user-create', 'web', '2020-04-10 08:16:48', '2020-04-10 08:16:48'),
(7, 'user-edit', 'web', '2020-04-10 08:16:48', '2020-04-10 08:16:48'),
(8, 'user-delete', 'web', '2020-04-10 08:16:48', '2020-04-10 08:16:48'),
(9, 'setting-list', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', NULL, NULL),
(2, 'Admin', 'web', NULL, NULL),
(3, 'User', 'web', '2020-09-21 06:34:22', '2020-09-21 06:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(7, 1),
(8, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setting_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_name`, `setting_slug`, `setting_value`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Under Maintenance Mode', 'under_maintenance_mode', '0', NULL, NULL, '2020-09-15 07:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '2:Pending , 1: Active , 0: Inactive',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `county` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `email_verified_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `image`, `is_admin`, `status`, `address`, `address2`, `town`, `county`, `country`, `postcode`, `phone_number`, `email_verified_at`, `email_verified_token`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'Admin', 'superadmin', 'superadmin@admin.com', '$2y$10$JMrNQqwOXyTfaP4326T9..C7dJeH8GJGRiY3ALD7reTZcqQMz81hi', '20200922075155_admin3.png', 1, 1, '126 Palmera', NULL, 'East Sussex', 'Hove', NULL, 'BN33GB', '877878778', NULL, NULL, '', NULL, NULL, '2020-10-07 05:29:49'),
(2, 'Sean', 'Paul', 'sean-paul', 'sean.paul@gmail.com', '$2y$10$6QLbqGruwUdLZ0flHEhYmO/wuBSwaVf3o8CvgBIgFXLHzJRsdVg3O', NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-21 07:06:14'),
(3, 'Kristina', 'Angel', 'kristina-angel', 'kristina@gmail.com', '$2y$10$7hKMGlntvcOrpQqLX/kPoOY.SJLHmuxJ/AwUi8H2bkv8w1MCmwbQi', '20200921123503_kristina.jpg', 0, 1, '12 Palmera Avenue', NULL, 'East Sussex', 'Hove', 'United Kingdom', 'BN33GB', '878787877', NULL, NULL, '', NULL, '2020-09-21 06:57:57', '2020-10-07 05:10:24'),
(4, 'Utsav', 'Patel', 'utsav-patel', 'utsav@gmail.com', '$2y$10$n.E.mFzMw9O11oOCzuErm.btorf9TWzIanzZc8LknDF5TN9e9r9iC', '', 1, 1, '14 Palmera Avenue', NULL, 'East Sussex', 'Hove', 'United Kingdom', 'BN33GB', '787878474', NULL, NULL, NULL, NULL, '2020-09-21 07:09:12', '2020-09-21 07:09:12'),
(5, 'Martina', 'Duke', 'martina-duke', 'martina@gmail.com', '$2y$10$TAXfqWAFT6ptkAc6xhXasehTFP4P/puIcBxlQt/3fU.RYCmOeq.Py', '', 0, 1, '12', 'Palmeria avenue', 'East sussex', 'Hove', 'United Kingdom', 'BN33GB', '878787877', NULL, NULL, NULL, NULL, '2020-10-07 02:42:05', '2020-10-07 02:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_actions`
--

CREATE TABLE `user_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_signed_date` datetime DEFAULT NULL,
  `action_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:on_going 0:completed',
  `status` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_actions`
--

INSERT INTO `user_actions` (`id`, `user_id`, `title`, `action_signed_date`, `action_status`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'First User Action', NULL, 1, 1, NULL, '2020-09-21 05:09:17', '2020-09-21 05:23:52'),
(2, 2, 'Second User Action', NULL, 1, 1, '2020-09-21 05:26:16', '2020-09-21 05:09:55', '2020-09-21 05:26:16'),
(3, 2, 'Third User Action', NULL, 1, 1, '2020-09-21 05:26:58', '2020-09-21 05:10:38', '2020-09-21 05:26:58'),
(4, 2, 'Fourth User Actions', NULL, 1, 1, NULL, '2020-09-21 05:11:07', '2020-09-21 05:23:52'),
(7, 2, 'Fifth User Action', NULL, 1, 1, '2020-09-21 05:26:58', '2020-09-21 05:25:10', '2020-09-21 05:26:58'),
(8, 2, 'User action testing', NULL, 1, 1, NULL, '2020-09-21 05:35:34', '2020-09-21 05:35:34'),
(9, 3, 'Assignment to verify documents 1', NULL, 1, 1, NULL, '2020-09-21 07:50:37', '2020-09-21 07:59:43'),
(10, 3, 'Assignment to verify documents', NULL, 1, 1, NULL, '2020-09-21 07:50:49', '2020-09-21 07:50:49'),
(19, 5, 'Child Benefit', NULL, 1, 1, NULL, '2020-10-07 06:58:01', '2020-10-07 06:58:01'),
(20, 3, 'Assignment to Verify Documents Slot 3', NULL, 1, 1, NULL, '2020-10-07 07:10:14', '2020-10-07 07:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_action_documents`
--

CREATE TABLE `user_action_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_action_id` int(11) NOT NULL,
  `document_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_signed` tinyint(1) NOT NULL,
  `document_signed_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_action_documents`
--

INSERT INTO `user_action_documents` (`id`, `user_action_id`, `document_title`, `document_name`, `is_signed`, `document_signed_date`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Document 1', '20200921103917_stamp-duty-in-london-wp81.pdf', 0, NULL, 1, NULL, '2020-09-21 05:09:17', '2020-09-21 05:09:17'),
(2, 1, 'Stamp Duty', '20200921103917_Stamp_Duty.pdf', 0, NULL, 1, NULL, '2020-09-21 05:09:17', '2020-09-21 05:09:17'),
(15, 4, 'Dummy Document', '20200921110328_dummy.pdf', 0, NULL, 1, NULL, '2020-09-21 05:33:28', '2020-09-21 05:33:28'),
(16, 8, 'Professional Tax', '20200921110534_enquiry1.pdf', 0, NULL, 1, NULL, '2020-09-21 05:35:34', '2020-09-21 05:35:34'),
(17, 8, 'Document of Child benefit', '20200921110534_enquiry2.pdf', 0, NULL, 1, NULL, '2020-09-21 05:35:34', '2020-09-21 05:35:34'),
(18, 9, 'SDLT Document', '20200921132037_dummy.pdf', 0, NULL, 1, NULL, '2020-09-21 07:50:37', '2020-09-21 07:50:37'),
(19, 10, 'Document of Corporation Tax', '20200921132049_dummy.pdf', 0, NULL, 1, NULL, '2020-09-21 07:50:49', '2020-09-21 07:50:49'),
(21, 19, 'Specification Document', '20201007122801_4_types_of_Project_Scope.pdf', 0, NULL, 1, NULL, '2020-10-07 06:58:01', '2020-10-07 06:58:01'),
(22, 19, 'Specification Document', '20201007122801_Avanis_Spec.docx', 0, NULL, 1, NULL, '2020-10-07 06:58:01', '2020-10-07 06:58:01'),
(23, 19, 'Ionic Specification', '20201007123738_4_types_of_Project_Scope.pdf', 0, NULL, 1, NULL, '2020-10-07 07:07:38', '2020-10-07 07:07:38'),
(24, 19, 'Ionic Specification Part 2', '20201007123738_Ionic_Developer.docx', 0, NULL, 1, NULL, '2020-10-07 07:07:38', '2020-10-07 07:07:38'),
(25, 20, 'Specification Part 1', '20201007124014_Ionic_Developer.docx', 0, NULL, 1, NULL, '2020-10-07 07:10:14', '2020-10-07 07:10:14'),
(26, 20, 'Specification Part 2', '20201007124014_4_types_of_Project_Scope.pdf', 0, NULL, 1, NULL, '2020-10-07 07:10:14', '2020-10-07 07:10:14'),
(27, 20, 'Specification Part 3', '20201007124014_Laravel_Practical_Test-1.pdf', 0, NULL, 1, NULL, '2020-10-07 07:10:14', '2020-10-07 07:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `slug`, `date`, `created_at`, `updated_at`) VALUES
(1, 3, 'login', '2020-10-06 12:00:50', '2020-10-06 06:30:50', '2020-10-06 06:30:50'),
(2, 3, 'login', '2020-10-06 12:05:44', '2020-10-06 06:35:44', '2020-10-06 06:35:44'),
(3, 3, 'login', '2020-10-06 12:11:04', '2020-10-06 06:41:04', '2020-10-06 06:41:04'),
(4, 3, 'login', '2020-10-06 12:14:14', '2020-10-06 06:44:14', '2020-10-06 06:44:14'),
(5, 3, 'login', '2020-10-06 12:29:31', '2020-10-06 06:59:31', '2020-10-06 06:59:31'),
(6, 3, 'login', '2020-10-06 12:32:21', '2020-10-06 07:02:21', '2020-10-06 07:02:21'),
(7, 3, 'login', '2020-10-06 12:38:01', '2020-10-06 07:08:01', '2020-10-06 07:08:01'),
(8, 3, 'login', '2020-10-07 05:33:42', '2020-10-07 00:03:42', '2020-10-07 00:03:42'),
(9, 3, 'login', '2020-10-07 07:16:55', '2020-10-07 01:46:55', '2020-10-07 01:46:55'),
(10, 3, 'login', '2020-10-07 07:17:13', '2020-10-07 01:47:13', '2020-10-07 01:47:13'),
(11, 3, 'login', '2020-10-07 07:19:02', '2020-10-07 01:49:02', '2020-10-07 01:49:02'),
(12, 3, 'login', '2020-10-07 07:31:31', '2020-10-07 02:01:31', '2020-10-07 02:01:31'),
(13, 3, 'login', '2020-10-07 10:39:17', '2020-10-07 05:09:17', '2020-10-07 05:09:17'),
(14, 3, 'login', '2020-10-07 11:13:24', '2020-10-07 05:43:24', '2020-10-07 05:43:24'),
(15, 3, 'login', '2020-10-07 12:43:49', '2020-10-07 07:13:49', '2020-10-07 07:13:49'),
(16, 3, 'login', '2020-10-08 06:54:55', '2020-10-08 01:24:55', '2020-10-08 01:24:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(250));

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`,`deleted_at`) USING BTREE;

--
-- Indexes for table `user_actions`
--
ALTER TABLE `user_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_action_documents`
--
ALTER TABLE `user_action_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_actions`
--
ALTER TABLE `user_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_action_documents`
--
ALTER TABLE `user_action_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
