-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2024 at 08:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_10_undangan_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `uuid` char(36) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `event_type_uuid` char(36) DEFAULT NULL,
  `client_uuid` char(36) NOT NULL,
  `song_uuid` char(36) DEFAULT NULL,
  `village_uuid_1` char(36) DEFAULT NULL,
  `village_uuid_2` char(36) DEFAULT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

CREATE TABLE `event_types` (
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `framables`
--

CREATE TABLE `framables` (
  `uuid` char(36) NOT NULL,
  `framable_uuid` char(36) NOT NULL,
  `framable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `client_uuid` char(36) NOT NULL,
  `feedback` text DEFAULT NULL,
  `pray` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iconables`
--

CREATE TABLE `iconables` (
  `uuid` char(36) NOT NULL,
  `iconable_uuid` char(36) NOT NULL,
  `iconable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `event_uuid` char(36) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `uuid` char(36) NOT NULL,
  `guest_uuid` char(36) NOT NULL,
  `event_uuid` char(36) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `invitation_type_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invitation_types`
--

CREATE TABLE `invitation_types` (
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invitors`
--

CREATE TABLE `invitors` (
  `uuid` char(36) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `mid_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `client_uuid` char(36) NOT NULL,
  `parent_1_name` varchar(255) DEFAULT NULL,
  `parent_2_name` varchar(255) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `join_in_inviting`
--

CREATE TABLE `join_in_inviting` (
  `uuid` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `family_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_clients_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_29_142808_create_districts_table', 1),
(6, '2024_01_29_142845_create_subdistricts_table', 1),
(7, '2024_01_29_142907_create_villages_table', 1),
(8, '2024_01_29_150306_create_event_types_table', 1),
(9, '2024_02_01_090615_create_songs_table', 1),
(10, '2024_02_01_090616_create_events_table', 1),
(11, '2024_02_01_091110_create_invitation_types_table', 1),
(12, '2024_02_01_091150_create_guests_table', 1),
(13, '2024_02_01_091435_create_invitations_table', 1),
(14, '2024_02_01_091701_create_images_table', 1),
(15, '2024_02_01_092214_create_framables_table', 1),
(16, '2024_02_01_100225_create_texturables_table', 1),
(17, '2024_02_01_100249_create_iconables_table', 1),
(18, '2024_02_01_102506_create_invitors_table', 1),
(19, '2024_02_01_171649_create_join_in_inviting_table', 1);

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
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subdistricts`
--

CREATE TABLE `subdistricts` (
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `districts_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `texturables`
--

CREATE TABLE `texturables` (
  `uuid` char(36) NOT NULL,
  `texturable_uuid` char(36) NOT NULL,
  `texturable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `district_uuid` char(36) DEFAULT NULL,
  `subdistricts_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `events_client_uuid_foreign` (`client_uuid`),
  ADD KEY `events_event_type_uuid_foreign` (`event_type_uuid`),
  ADD KEY `events_song_uuid_foreign` (`song_uuid`),
  ADD KEY `events_village_uuid_1_foreign` (`village_uuid_1`),
  ADD KEY `events_village_uuid_2_foreign` (`village_uuid_2`);

--
-- Indexes for table `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `framables`
--
ALTER TABLE `framables`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `guests_client_uuid_foreign` (`client_uuid`);

--
-- Indexes for table `iconables`
--
ALTER TABLE `iconables`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `images_event_uuid_foreign` (`event_uuid`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `invitations_event_uuid_foreign` (`event_uuid`),
  ADD KEY `invitations_guest_uuid_foreign` (`guest_uuid`),
  ADD KEY `invitations_invitation_type_uuid_foreign` (`invitation_type_uuid`);

--
-- Indexes for table `invitation_types`
--
ALTER TABLE `invitation_types`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `invitors`
--
ALTER TABLE `invitors`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `invitors_client_uuid_foreign` (`client_uuid`);

--
-- Indexes for table `join_in_inviting`
--
ALTER TABLE `join_in_inviting`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `join_in_inviting_event_id_foreign` (`event_id`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `subdistricts`
--
ALTER TABLE `subdistricts`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `subdistricts_districts_uuid_foreign` (`districts_uuid`);

--
-- Indexes for table `texturables`
--
ALTER TABLE `texturables`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `villages_district_uuid_foreign` (`district_uuid`),
  ADD KEY `villages_subdistricts_uuid_foreign` (`subdistricts_uuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_client_uuid_foreign` FOREIGN KEY (`client_uuid`) REFERENCES `clients` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `events_event_type_uuid_foreign` FOREIGN KEY (`event_type_uuid`) REFERENCES `event_types` (`uuid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `events_song_uuid_foreign` FOREIGN KEY (`song_uuid`) REFERENCES `songs` (`uuid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `events_village_uuid_1_foreign` FOREIGN KEY (`village_uuid_1`) REFERENCES `villages` (`uuid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `events_village_uuid_2_foreign` FOREIGN KEY (`village_uuid_2`) REFERENCES `villages` (`uuid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `guests_client_uuid_foreign` FOREIGN KEY (`client_uuid`) REFERENCES `clients` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_event_uuid_foreign` FOREIGN KEY (`event_uuid`) REFERENCES `events` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `invitations_event_uuid_foreign` FOREIGN KEY (`event_uuid`) REFERENCES `events` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invitations_guest_uuid_foreign` FOREIGN KEY (`guest_uuid`) REFERENCES `guests` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invitations_invitation_type_uuid_foreign` FOREIGN KEY (`invitation_type_uuid`) REFERENCES `invitation_types` (`uuid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `invitors`
--
ALTER TABLE `invitors`
  ADD CONSTRAINT `invitors_client_uuid_foreign` FOREIGN KEY (`client_uuid`) REFERENCES `clients` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `join_in_inviting`
--
ALTER TABLE `join_in_inviting`
  ADD CONSTRAINT `join_in_inviting_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subdistricts`
--
ALTER TABLE `subdistricts`
  ADD CONSTRAINT `subdistricts_districts_uuid_foreign` FOREIGN KEY (`districts_uuid`) REFERENCES `districts` (`uuid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `villages`
--
ALTER TABLE `villages`
  ADD CONSTRAINT `villages_district_uuid_foreign` FOREIGN KEY (`district_uuid`) REFERENCES `districts` (`uuid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `villages_subdistricts_uuid_foreign` FOREIGN KEY (`subdistricts_uuid`) REFERENCES `subdistricts` (`uuid`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
