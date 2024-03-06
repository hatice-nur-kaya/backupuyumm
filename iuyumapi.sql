-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2023 at 01:44 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iuyumapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_umber` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_office` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_module`
--

CREATE TABLE `company_module` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `module_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_module_settings`
--

CREATE TABLE `company_module_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `module_id` bigint UNSIGNED NOT NULL,
  `settings` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_03_103430_create_companies_table', 1),
(6, '2023_11_03_105743_create_user_company_table', 1),
(7, '2023_11_03_122556_create_modules_table', 1),
(8, '2023_11_03_122649_create_web_services_table', 1),
(9, '2023_11_03_124537_create_programs_table', 1),
(10, '2023_11_03_125404_create_company_module_table', 1),
(11, '2023_11_03_132958_create_company_module_settings_table', 1),
(12, '2023_11_04_101732_create_roles_table', 1),
(13, '2023_11_04_101848_create_permissions_table', 1),
(14, '2023_11_04_101943_create_role_permission_table', 1),
(15, '2023_11_04_102035_create_user_role_table', 1),
(16, '2023_11_04_111939_add_parent_id_to_permissions', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'E-Fatura', '2023-11-03 09:32:33', NULL),
(2, 'E-Defter', '2023-11-03 09:32:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `parent_id`, `name`, `permission`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Kullanıcı Yetkileri', 'users', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(2, 1, 'Kullanıcıları Görüntüleme', 'users.getAll', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(3, 1, 'Kullanıcı Bilgisi Görme', 'users.getById', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(4, 1, 'Kullanıcı Silme', 'users.delete', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(5, 1, 'Kullanıcı Güncelleme', 'users.update', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(6, 1, 'Kullanıcıya Şirket Ekleme', 'users.addCompany', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(7, 1, 'Kullanıcıdan Şirket Silme', 'users.removeCompany', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(8, 1, 'Kullanıcıya Ait Şirketleri Görüntüleme', 'users.getCompaniesByUserId', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(9, 1, 'Kullanıcıya Ait Şirketleri Görüntüleme', 'users.getCompaniesByUser', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(10, 1, 'Kullanıcıya Ait Rolleri Görüntüleme', 'users.role.getRoles', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(11, 1, 'Kullanıcıya Rol Atama', 'users.role.setRole', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(12, 1, 'Kullanıcıdan Rol Silme', 'users.role.deleteRole', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(13, 1, 'Kullanıcıya Ait Rol ve Yetkileri Görüntüleme', 'users.role.getRoleAndPermissions', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(14, NULL, 'Şirket Yetkileri', 'company', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(15, 14, 'Şirketleri Görüntüleme', 'company.getAll', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(16, 14, 'Şirket Bilgisi Görme', 'company.getById', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(17, 14, 'Şirket Silme', 'company.delete', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(18, 14, 'Şirket Güncelleme', 'company.update', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(19, 14, 'Şirket Oluşturma', 'company.create', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(20, 14, 'Şirkete Kullanıcı Ekleme', 'company.addUser', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(21, 14, 'Şirketten Kullanıcı Silme', 'company.removeUser', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(22, 14, 'Kullanıcıya Ait Şirketleri Görüntüleme', 'company.getByUserCompanies', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(23, 14, 'Şirkete Modül Ekleme', 'company.module.addModule', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(24, 14, 'Şirketten Modül Silme', 'company.module.removeModule', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(25, 14, 'Şirkete Ait Modülleri Görüntüleme', 'company.module.getByCompanyModules', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(26, 14, 'Şirkete Ait Modül Ayarlarını Güncelleme', 'company.module.setModuleSetting', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(27, 14, 'Şirkete Ait Modül Ayarlarını Görüntüleme', 'company.module.getModuleSetting', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(28, NULL, 'Modül Yetkileri', 'module', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(29, 28, 'Modülleri Görüntüleme', 'module.getAll', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(30, 28, 'Programları Görüntüleme', 'module.getPrograms', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(31, 28, 'Web Servisleri Görüntüleme', 'module.getWebServices', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(32, 28, 'Modül Bilgisi Görme', 'module.getById', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(33, NULL, 'Rol Yetkileri', 'roles', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(34, 33, 'Rolleri Görüntüleme', 'roles.getAll', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(35, 33, 'Rol Bilgisi Görme', 'roles.getById', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(36, 33, 'Rol Silme', 'roles.delete', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(37, 33, 'Rol Güncelleme', 'roles.update', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(38, 33, 'Rol Oluşturma', 'roles.create', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(39, 33, 'Role Yetki Ekleme', 'roles.setPermissions', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(40, 33, 'Role Ait Yetkileri Görüntüleme', 'roles.getPermissions', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(41, 33, 'Tüm Yetkileri Görüntüleme', 'roles.getAllPermissions', '2023-11-04 09:45:53', '2023-11-04 09:45:53'),
(42, NULL, 'Geliştirici (DİKKAT!!!)', 'developer', '2023-11-04 13:10:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'userApiToken', '49c5101bb4ed193d77e90276fb0451ed09c4d458c34f197167d6fbf6f8412dc0', '[\"*\"]', '2023-11-04 09:48:33', NULL, '2023-11-04 09:47:28', '2023-11-04 09:48:33');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `title`, `requirements`, `module_id`, `created_at`, `updated_at`) VALUES
(1, 'Luca E-Defter', 'username,password,customerNumber', 2, '2023-11-03 09:48:45', NULL),
(2, 'Datasoft E-Defter', 'taxNumber,eDefterSubeKodu,eDefterSubeAdi', 2, '2023-11-03 09:48:45', NULL),
(3, 'Paraşüt E-Fatura', 'clientId,clientSecret,username,password', 1, '2023-11-03 09:49:47', NULL),
(4, 'Rapid360', 'client_id,client_secret,DealerID,EInvoiceCode', 1, '2023-11-03 09:50:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Yönetici', '2023-11-04 09:45:53', '2023-11-04 09:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 1, 7, NULL, NULL),
(8, 1, 8, NULL, NULL),
(9, 1, 9, NULL, NULL),
(10, 1, 10, NULL, NULL),
(11, 1, 11, NULL, NULL),
(12, 1, 12, NULL, NULL),
(13, 1, 13, NULL, NULL),
(14, 1, 14, NULL, NULL),
(15, 1, 15, NULL, NULL),
(16, 1, 16, NULL, NULL),
(17, 1, 17, NULL, NULL),
(18, 1, 18, NULL, NULL),
(19, 1, 19, NULL, NULL),
(20, 1, 20, NULL, NULL),
(21, 1, 21, NULL, NULL),
(22, 1, 22, NULL, NULL),
(23, 1, 23, NULL, NULL),
(24, 1, 24, NULL, NULL),
(25, 1, 25, NULL, NULL),
(26, 1, 26, NULL, NULL),
(27, 1, 27, NULL, NULL),
(28, 1, 28, NULL, NULL),
(29, 1, 29, NULL, NULL),
(30, 1, 30, NULL, NULL),
(31, 1, 31, NULL, NULL),
(32, 1, 32, NULL, NULL),
(33, 1, 33, NULL, NULL),
(34, 1, 34, NULL, NULL),
(35, 1, 35, NULL, NULL),
(36, 1, 36, NULL, NULL),
(37, 1, 37, NULL, NULL),
(38, 1, 38, NULL, NULL),
(39, 1, 39, NULL, NULL),
(40, 1, 40, NULL, NULL),
(41, 1, 41, NULL, NULL),
(42, 1, 42, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'onur.evren@ayssoft.com', NULL, '$2y$12$IHojEGgwinYtC.h.9bgffOYm.6S2khMyL5bqzTl9J245Zuowsat.a', NULL, '2023-11-04 09:45:53', '2023-11-04 09:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_company`
--

CREATE TABLE `user_company` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `web_services`
--

CREATE TABLE `web_services` (
  `id` bigint UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_services`
--

INSERT INTO `web_services` (`id`, `title`, `url`, `requirements`, `module_id`, `created_at`, `updated_at`) VALUES
(1, 'Bien Teknoloji E-Defter (Demo)', 'https://connect-test.bienteknoloji.com.tr/Services/LedgerIntegration?wsdl', 'username,password', 2, '2023-11-03 09:32:55', NULL),
(2, 'CRSSOFT E-Defter (Demo)', 'https://connect-test.crssoft.com/Services/LedgerIntegration?wsdl', 'username,password', 2, '2023-11-03 09:32:55', NULL),
(3, 'Uyumsoft E-Defter (Demo)', 'https://efatura-test.uyumsoft.com.tr/Services/LedgerIntegration?wsdl', 'username,password', 2, '2023-11-03 09:33:44', NULL),
(4, 'Bien Teknoloji E-Defter', 'https://connect-test.bienteknoloji.com.tr/Services/LedgerIntegration?wsdl', 'username,password', 2, '2023-11-03 09:34:07', NULL),
(5, 'Uyumsoft E-Defter', 'https://efatura.uyumsoft.com.tr/Services/LedgerIntegration?wsdl', 'username,password', 2, '2023-11-03 09:34:41', NULL),
(6, 'CRSSOFT E-Defter', 'https://connect-test.crssoft.com/Services/LedgerIntegration?wsdl', 'username,password', 2, '2023-11-03 09:34:41', NULL),
(7, 'Uyumsoft E-Fatura (Demo)', 'https://efatura-test.uyumsoft.com.tr/Services/Integration?wsdl', 'username,password', 1, '2023-11-03 09:35:25', NULL),
(8, 'Bien Teknoloji E-Fatura (Demo)', 'https://connect-test.bienteknoloji.com.tr/Services/Integration?wsdl', 'username,password', 1, '2023-11-03 09:35:25', NULL),
(9, 'CRSSOFT E-Fatura (Demo)', 'https://connect-test.crssoft.com/Services/Integration?wsdl', 'username,password', 1, '2023-11-03 09:36:13', NULL),
(10, 'Uyumsoft E-Fatura', 'https://efatura.uyumsoft.com.tr/Services/Integration?wsdl', 'username,password', 1, '2023-11-03 09:36:27', NULL),
(11, 'Bien Teknoloji E-Fatura', 'https://connect.bienteknoloji.com.tr/Services/Integration?wsdl', 'username,password', 1, '2023-11-03 09:36:51', NULL),
(12, 'CRSSOFT E-Fatura', 'https://connect.crssoft.com/Services/Integration?wsdl', 'username,password', 1, '2023-11-03 09:37:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_module`
--
ALTER TABLE `company_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_module_company_id_foreign` (`company_id`),
  ADD KEY `company_module_module_id_foreign` (`module_id`);

--
-- Indexes for table `company_module_settings`
--
ALTER TABLE `company_module_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_module_settings_company_id_foreign` (`company_id`),
  ADD KEY `company_module_settings_module_id_foreign` (`module_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_module_id_foreign` (`module_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permission_role_id_foreign` (`role_id`),
  ADD KEY `role_permission_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_company`
--
ALTER TABLE `user_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_company_user_id_foreign` (`user_id`),
  ADD KEY `user_company_company_id_foreign` (`company_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_user_id_foreign` (`user_id`),
  ADD KEY `user_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `web_services`
--
ALTER TABLE `web_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `web_services_module_id_foreign` (`module_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_module`
--
ALTER TABLE `company_module`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_module_settings`
--
ALTER TABLE `company_module_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_company`
--
ALTER TABLE `user_company`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `web_services`
--
ALTER TABLE `web_services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `company_module`
--
ALTER TABLE `company_module`
  ADD CONSTRAINT `company_module_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_module_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_module_settings`
--
ALTER TABLE `company_module_settings`
  ADD CONSTRAINT `company_module_settings_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_module_settings_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_company`
--
ALTER TABLE `user_company`
  ADD CONSTRAINT `user_company_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_company_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `web_services`
--
ALTER TABLE `web_services`
  ADD CONSTRAINT `web_services_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
