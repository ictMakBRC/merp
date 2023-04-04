-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 20, 2022 at 10:29 AM
-- Server version: 8.0.18
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merpdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=619 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `email`, `description`, `platform`, `browser`, `client_ip`, `created_at`, `updated_at`) VALUES
(510, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Chrome', '197.239.47.9', '2022-08-18 03:16:26', '2022-08-18 03:16:26'),
(511, NULL, 'kedkays@gmai.com', 'login attempt failed', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 15:28:25', '2022-08-18 15:28:25'),
(512, 41, 'kedkays@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 15:28:41', '2022-08-18 15:28:41'),
(513, 41, 'kedkays@gmail.com', 'logged Out', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 15:33:50', '2022-08-18 15:33:50'),
(514, 41, 'kedkays@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 15:47:43', '2022-08-18 15:47:43'),
(515, 41, 'kedkays@gmail.com', 'logged Out', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 15:47:54', '2022-08-18 15:47:54'),
(516, 41, 'kedkays@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 16:00:03', '2022-08-18 16:00:03'),
(517, 41, 'kedkays@gmail.com', 'logged Out', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 16:07:00', '2022-08-18 16:07:00'),
(518, 41, 'kedkays@gmail.com', 'logged in', 'Windows', 'Edge', '102.134.149.88', '2022-08-18 16:07:15', '2022-08-18 16:07:15'),
(519, 41, 'kedkays@gmail.com', 'logged Out', 'Windows', 'Edge', '102.134.149.88', '2022-08-18 16:08:23', '2022-08-18 16:08:23'),
(520, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 16:14:36', '2022-08-18 16:14:36'),
(521, 12, 'kedkayz@gmail.com', 'logged in', 'Windows', 'Edge', '102.134.149.88', '2022-08-18 16:21:21', '2022-08-18 16:21:21'),
(522, NULL, 'kedkays@gmai.com', 'login attempt failed', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 17:17:45', '2022-08-18 17:17:45'),
(523, NULL, 'kedkays@gmail.com', 'login attempt failed', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 17:18:06', '2022-08-18 17:18:06'),
(524, 12, 'kedkayz@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 17:18:33', '2022-08-18 17:18:33'),
(525, 12, 'kedkayz@gmail.com', 'logged Out', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 18:53:49', '2022-08-18 18:53:49'),
(526, 12, 'kedkayz@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 19:03:17', '2022-08-18 19:03:17'),
(527, 12, 'kedkayz@gmail.com', 'logged Out', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 19:04:26', '2022-08-18 19:04:26'),
(528, 12, 'kedkayz@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 19:06:27', '2022-08-18 19:06:27'),
(529, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 21:28:17', '2022-08-18 21:28:17'),
(530, 12, 'kedkayz@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-18 21:39:17', '2022-08-18 21:39:17'),
(531, 23, 'lordrickategeka@gmail.com', 'logged in', 'Windows', 'Opera', '102.134.149.88', '2022-08-18 21:44:21', '2022-08-18 21:44:21'),
(532, 23, 'lordrickategeka@gmail.com', 'logged in', 'Windows', 'Opera', '154.224.80.73', '2022-08-19 02:44:11', '2022-08-19 02:44:11'),
(533, 11, 'muytimothy@gmail.com', 'logged in', 'Windows', 'Chrome', '154.224.80.73', '2022-08-19 02:47:54', '2022-08-19 02:47:54'),
(534, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Edge', '154.224.80.73', '2022-08-19 03:22:04', '2022-08-19 03:22:04'),
(535, 11, 'muytimothy@gmail.com', 'logged Out', 'Windows', 'Edge', '154.224.80.73', '2022-08-19 04:26:54', '2022-08-19 04:26:54'),
(536, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Edge', '154.224.80.73', '2022-08-19 04:26:59', '2022-08-19 04:26:59'),
(537, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-19 15:17:02', '2022-08-19 15:17:02'),
(538, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-19 17:30:39', '2022-08-19 17:30:39'),
(539, 23, 'lordrickategeka@gmail.com', 'logged in', 'Windows', 'Opera', '102.134.149.88', '2022-08-19 17:42:05', '2022-08-19 17:42:05'),
(540, 27, 'nalwaddageraldine@gmail.com', 'logged Out', 'Windows', 'Chrome', '102.134.149.88', '2022-08-19 17:46:14', '2022-08-19 17:46:14'),
(541, 25, 'lwanganewton@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-19 17:46:22', '2022-08-19 17:46:22'),
(542, 25, 'lwanganewton@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-19 19:59:47', '2022-08-19 19:59:47'),
(543, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Edge', '102.134.149.88', '2022-08-19 20:26:49', '2022-08-19 20:26:49'),
(544, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Chrome', '102.86.41.113', '2022-08-20 03:20:55', '2022-08-20 03:20:55'),
(545, 23, 'lordrickategeka@gmail.com', 'logged in', 'Windows', 'Opera', '102.86.41.113', '2022-08-20 03:26:10', '2022-08-20 03:26:10'),
(546, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Edge', '102.86.41.113', '2022-08-20 03:27:13', '2022-08-20 03:27:13'),
(547, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Edge', '102.86.41.113', '2022-08-20 03:28:51', '2022-08-20 03:28:51'),
(548, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-22 16:48:22', '2022-08-22 16:48:22'),
(549, 23, 'lordrickategeka@gmail.com', 'logged in', 'Windows', 'Opera', '102.134.149.88', '2022-08-22 17:01:29', '2022-08-22 17:01:29'),
(550, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Edge', '102.134.149.88', '2022-08-22 17:40:27', '2022-08-22 17:40:27'),
(551, 27, 'nalwaddageraldine@gmail.com', 'logged Out', 'Windows', 'Chrome', '102.134.149.88', '2022-08-22 17:51:47', '2022-08-22 17:51:47'),
(552, 25, 'lwanganewton@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-22 17:51:56', '2022-08-22 17:51:56'),
(553, 40, 'timothystatesman@gmail.com', 'logged in', 'Windows', 'Chrome', '102.222.235.165', '2022-08-22 19:02:22', '2022-08-22 19:02:22'),
(554, 40, 'timothystatesman@gmail.com', 'logged Out', 'Windows', 'Chrome', '102.222.235.165', '2022-08-22 19:03:50', '2022-08-22 19:03:50'),
(555, 11, 'muytimothy@gmail.com', 'logged in', 'Windows', 'Chrome', '102.222.235.165', '2022-08-22 19:04:02', '2022-08-22 19:04:02'),
(556, 27, 'nalwaddageraldine@gmail.com', 'logged Out', 'Windows', 'Edge', '102.222.235.165', '2022-08-22 19:33:04', '2022-08-22 19:33:04'),
(557, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'Windows', 'Edge', '102.222.235.165', '2022-08-22 19:39:45', '2022-08-22 19:39:45'),
(558, 27, 'nalwaddageraldine@gmail.com', 'logged in', 'OS X', 'Chrome', '102.222.235.165', '2022-08-22 19:58:50', '2022-08-22 19:58:50'),
(559, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Chrome', '197.239.4.121', '2022-08-22 23:45:32', '2022-08-22 23:45:32'),
(560, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Chrome', '102.222.235.43', '2022-08-23 15:35:22', '2022-08-23 15:35:22'),
(561, NULL, 'kedkayz@gmail.com', 'login attempt failed', 'Windows', 'Edge', '102.222.235.43', '2022-08-23 15:37:00', '2022-08-23 15:37:00'),
(562, NULL, 'kedkayz@gmail.com', 'login attempt failed', 'Windows', 'Edge', '102.222.235.43', '2022-08-23 15:37:09', '2022-08-23 15:37:09'),
(563, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '102.222.235.43', '2022-08-23 15:38:04', '2022-08-23 15:38:04'),
(565, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Chrome', '102.222.235.43', '2022-08-23 16:40:20', '2022-08-23 16:40:20'),
(566, 11, 'ict.makbrc@gmail.com', 'logged Out', 'Windows', 'Chrome', '102.222.235.43', '2022-08-23 16:52:09', '2022-08-23 16:52:09'),
(567, 44, 'birungijoanah@gmail.com', 'logged in', 'Windows', 'Chrome', '102.222.235.43', '2022-08-23 16:52:46', '2022-08-23 16:52:46'),
(568, NULL, 'birungijoanah@gmail.com', 'login attempt failed', 'Windows', 'Chrome', '102.222.235.43', '2022-08-23 16:55:08', '2022-08-23 16:55:08'),
(569, 44, 'birungijoanah@gmail.com', 'logged in', 'Windows', 'Chrome', '102.222.235.43', '2022-08-23 16:55:27', '2022-08-23 16:55:27'),
(570, 44, 'birungijoanah@gmail.com', 'logged Out', 'Windows', 'Chrome', '102.222.235.43', '2022-08-23 17:14:03', '2022-08-23 17:14:03'),
(571, 44, 'birungijoanah@gmail.com', 'logged in', 'Windows', 'Chrome', '102.222.235.43', '2022-08-23 17:15:01', '2022-08-23 17:15:01'),
(572, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Chrome', '102.134.149.88', '2022-08-24 15:28:35', '2022-08-24 15:28:35'),
(573, NULL, 'irammunazza5@gmail.com', 'login attempt failed', 'Windows', 'Chrome', '106.195.8.222', '2022-09-22 10:33:35', '2022-09-22 10:33:35'),
(574, NULL, 'irammunazza5@gmail.com', 'login attempt failed', 'Windows', 'Chrome', '106.195.8.222', '2022-09-22 10:33:43', '2022-09-22 10:33:43'),
(575, NULL, 'irammunazza5@gmail.com', 'login attempt failed', 'Windows', 'Chrome', '106.195.8.222', '2022-09-22 10:34:25', '2022-09-22 10:34:25'),
(576, NULL, 'irammunazza5@gmail.com', 'login attempt failed', 'Windows', 'Chrome', '106.195.8.222', '2022-09-22 10:34:26', '2022-09-22 10:34:26'),
(577, NULL, 'irammunazza5@gmail.com', 'login attempt failed', 'Windows', 'Chrome', '106.195.8.222', '2022-09-22 10:34:50', '2022-09-22 10:34:50'),
(578, NULL, 'irammunazza5@gmail.com', 'login attempt failed', 'Windows', 'Chrome', '106.195.8.222', '2022-09-22 10:35:18', '2022-09-22 10:35:18'),
(579, NULL, 'irammunazza5@gmail.com', 'login attempt failed', 'Windows', 'Chrome', '106.195.8.222', '2022-09-22 10:35:22', '2022-09-22 10:35:22'),
(580, NULL, 'suraj.kumar1@indiamart.com', 'login attempt failed', 'Windows', 'Edge', '122.176.108.154', '2022-09-23 11:44:16', '2022-09-23 11:44:16'),
(581, NULL, 'Nyan-lol.Maker@mambourin.org', 'login attempt failed', 'Windows', 'Edge', '61.69.101.202', '2022-10-19 06:09:41', '2022-10-19 06:09:41'),
(582, NULL, 'Nyan-lol.Maker@mambourin.org', 'login attempt failed', 'Windows', 'Chrome', '36.95.107.35', '2022-10-21 08:13:42', '2022-10-21 08:13:42'),
(583, NULL, 'Nyan-lol.Maker@mambourin.org', 'login attempt failed', 'Windows', 'Chrome', '36.95.107.35', '2022-10-21 08:14:19', '2022-10-21 08:14:19'),
(584, NULL, 'ict.makbrc@gmail.com', 'login attempt failed', 'Windows', 'Edge', '::1', '2022-11-08 09:30:21', '2022-11-08 09:30:21'),
(585, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-11-08 09:32:56', '2022-11-08 09:32:56'),
(586, NULL, 'kedkayz@gmail.com', 'login attempt failed', 'Windows', 'Edge', '::1', '2022-11-23 09:41:17', '2022-11-23 09:41:17'),
(587, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-11-23 09:41:23', '2022-11-23 09:41:23'),
(588, NULL, 'kedkayz@gmail.com', 'login attempt failed', 'Windows', 'Edge', '::1', '2022-11-24 12:09:44', '2022-11-24 12:09:44'),
(589, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-11-24 12:09:50', '2022-11-24 12:09:50'),
(590, NULL, 'kedkayz@gmail.com', 'login attempt failed', 'Windows', 'Edge', '::1', '2022-11-28 14:31:06', '2022-11-28 14:31:06'),
(591, NULL, 'ict.makbrc@gmail.com', 'login attempt failed', 'Windows', 'Edge', '::1', '2022-11-28 14:31:18', '2022-11-28 14:31:18'),
(592, NULL, 'ict.makbrc@gmail.com', 'login attempt failed', 'Windows', 'Edge', '::1', '2022-11-28 14:33:26', '2022-11-28 14:33:26'),
(593, NULL, 'ict.makbrc@gmail.com', 'login attempt failed', 'Windows', 'Edge', '::1', '2022-11-28 14:33:39', '2022-11-28 14:33:39'),
(594, NULL, 'ict.makbrc@gmail.com', 'login attempt failed', 'Windows', 'Edge', '::1', '2022-11-28 14:34:10', '2022-11-28 14:34:10'),
(595, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-11-28 14:34:23', '2022-11-28 14:34:23'),
(596, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-11-28 20:18:54', '2022-11-28 20:18:54'),
(597, 11, 'ict.makbrc@gmail.com', 'logged Out', 'Windows', 'Edge', '::1', '2022-11-28 20:19:17', '2022-11-28 20:19:17'),
(598, 45, 'kedkayz@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-11-28 20:22:06', '2022-11-28 20:22:06'),
(599, 45, 'kedkayz@gmail.com', 'logged Out', 'Windows', 'Edge', '::1', '2022-11-28 20:22:30', '2022-11-28 20:22:30'),
(600, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-11-28 20:22:36', '2022-11-28 20:22:36'),
(601, 11, 'ict.makbrc@gmail.com', 'logged Out', 'Windows', 'Edge', '::1', '2022-11-28 20:33:15', '2022-11-28 20:33:15'),
(602, 45, 'kedkayz@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-11-28 20:33:20', '2022-11-28 20:33:20'),
(603, 45, 'kedkayz@gmail.com', 'logged Out', 'Windows', 'Edge', '::1', '2022-11-28 20:42:21', '2022-11-28 20:42:21'),
(604, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-11-28 20:42:28', '2022-11-28 20:42:28'),
(605, 11, 'ict.makbrc@gmail.com', 'logged Out', 'Windows', 'Edge', '::1', '2022-11-28 20:43:10', '2022-11-28 20:43:10'),
(606, 45, 'kedkayz@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-11-28 20:43:14', '2022-11-28 20:43:14'),
(607, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-11-29 08:48:13', '2022-11-29 08:48:13'),
(608, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-11-29 13:09:18', '2022-11-29 13:09:18'),
(609, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-11-30 07:23:41', '2022-11-30 07:23:41'),
(610, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-12-02 13:41:56', '2022-12-02 13:41:56'),
(611, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-12-03 15:33:30', '2022-12-03 15:33:30'),
(612, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-12-05 11:17:24', '2022-12-05 11:17:24'),
(613, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-12-12 13:07:15', '2022-12-12 13:07:15'),
(614, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-12-12 16:00:03', '2022-12-12 16:00:03'),
(615, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-12-14 09:49:58', '2022-12-14 09:49:58'),
(616, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-12-14 22:45:24', '2022-12-14 22:45:24'),
(617, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-12-15 12:48:05', '2022-12-15 12:48:05'),
(618, 11, 'ict.makbrc@gmail.com', 'logged in', 'Windows', 'Edge', '::1', '2022-12-15 22:14:56', '2022-12-15 22:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
CREATE TABLE IF NOT EXISTS `assets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_category_id` bigint(20) UNSIGNED NOT NULL,
  `asset_subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `engraved_label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `station_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `condition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_price` double(12,2) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_order_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty_end` date DEFAULT NULL,
  `depreciation_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depreciation_rate` double(3,2) DEFAULT NULL,
  `expected_useful_years` int(11) DEFAULT NULL,
  `insurance_company` bigint(20) UNSIGNED DEFAULT NULL,
  `insurance_type` bigint(20) UNSIGNED DEFAULT NULL,
  `insurance_end` date DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `assets_barcode_unique` (`barcode`),
  KEY `assets_asset_category_id_foreign` (`asset_category_id`),
  KEY `assets_asset_subcategory_id_foreign` (`asset_subcategory_id`),
  KEY `assets_user_id_foreign` (`user_id`),
  KEY `assets_station_id_foreign` (`station_id`),
  KEY `assets_department_id_foreign` (`department_id`),
  KEY `assets_vendor_id_foreign` (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_categories`
--

DROP TABLE IF EXISTS `asset_categories`;
CREATE TABLE IF NOT EXISTS `asset_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asset_categories`
--

INSERT INTO `asset_categories` (`id`, `category_name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Hardware', 1, '2021-10-30 09:38:25', '2021-11-24 20:55:42'),
(2, 'Furniture', 1, '2021-10-30 09:38:34', '2021-10-30 09:38:34'),
(3, 'Structure', 1, '2021-10-30 09:55:41', '2021-10-30 09:55:41'),
(4, 'Buildings', 1, '2021-10-31 13:03:37', '2021-10-31 13:03:37'),
(5, 'Software', 11, '2021-11-24 20:47:30', '2021-11-24 20:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `asset_issues`
--

DROP TABLE IF EXISTS `asset_issues`;
CREATE TABLE IF NOT EXISTS `asset_issues` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `priority` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `station_id` bigint(20) UNSIGNED DEFAULT NULL,
  `source_dept` bigint(20) UNSIGNED DEFAULT NULL,
  `destination_dept` bigint(20) UNSIGNED DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `issue_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `reason` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `asset_issues_reference_unique` (`reference`),
  KEY `asset_issues_asset_id_foreign` (`asset_id`),
  KEY `asset_issues_station_id_foreign` (`station_id`),
  KEY `asset_issues_source_dept_foreign` (`source_dept`),
  KEY `asset_issues_destination_dept_foreign` (`destination_dept`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_maintenance_info`
--

DROP TABLE IF EXISTS `asset_maintenance_info`;
CREATE TABLE IF NOT EXISTS `asset_maintenance_info` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authorised_by` bigint(20) UNSIGNED DEFAULT NULL,
  `issue_ref` bigint(20) UNSIGNED NOT NULL,
  `vendor` bigint(20) UNSIGNED DEFAULT NULL,
  `internal_vendor` bigint(20) UNSIGNED DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `recommendation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `maintenance_date` date DEFAULT NULL,
  `next_maintenance` date DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asset_maintenance_info_authorised_by_foreign` (`authorised_by`),
  KEY `asset_maintenance_info_issue_ref_foreign` (`issue_ref`),
  KEY `asset_maintenance_info_vendor_foreign` (`vendor`),
  KEY `asset_maintenance_info_internal_vendor_foreign` (`internal_vendor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_subcategories`
--

DROP TABLE IF EXISTS `asset_subcategories`;
CREATE TABLE IF NOT EXISTS `asset_subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subcategory_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asset_subcategories_asset_category_id_foreign` (`asset_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_history`
--

DROP TABLE IF EXISTS `assignment_history`;
CREATE TABLE IF NOT EXISTS `assignment_history` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `from` bigint(20) UNSIGNED DEFAULT NULL,
  `to` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assignment_history_asset_id_foreign` (`asset_id`),
  KEY `assignment_history_from_foreign` (`from`),
  KEY `assignment_history_to_foreign` (`to`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banking_information`
--

DROP TABLE IF EXISTS `banking_information`;
CREATE TABLE IF NOT EXISTS `banking_information` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banking_information_employee_id_foreign` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banking_information`
--

INSERT INTO `banking_information` (`id`, `employee_id`, `bank_name`, `branch`, `account_name`, `currency`, `account_number`, `created_at`, `updated_at`) VALUES
(10, 19, 'Housing Finance Bank', 'Wandegeya', 'Basemera Joanitah', 'UGX', '2100016699', '2022-08-23 16:58:53', '2022-08-23 16:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

DROP TABLE IF EXISTS `children`;
CREATE TABLE IF NOT EXISTS `children` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `child_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `children_employee_id_foreign` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `employee_id`, `child_name`, `birth_date`, `created_at`, `updated_at`) VALUES
(8, 19, 'Kiweewa Ishan Kasagga', '2011-04-05', '2022-08-23 17:03:53', '2022-08-23 17:03:53'),
(9, 19, 'Naluwagga Shaimah Ali', '2018-04-04', '2022-08-23 17:04:25', '2022-08-23 17:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_department` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autonumber` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `parent_department`, `type`, `description`, `prefix`, `autonumber`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'MAKBRC', NULL, 'Department', 'Top most department for the Director Only', 'BRC', 103, 'Active', 12, '2022-01-15 16:02:58', '2022-08-23 15:58:40'),
(5, 'Internal Audit', 2, 'Department', 'Internal Audit reports to MD', 'IA', 102, 'Active', 12, '2022-01-15 17:18:07', '2022-01-16 12:13:57'),
(6, 'Operations', 2, 'Department', 'Operations Department', 'OP', 101, 'Active', 12, '2022-01-15 17:22:01', '2022-01-16 11:56:55'),
(7, 'Finance and Stragetic Management', 6, 'Department', 'Encapsulated Accounts, Grants and Procurement', 'FSM', 105, 'Active', 12, '2022-01-15 17:23:39', '2022-02-15 12:19:09'),
(8, 'Research, Clinical and Laboratory Services', 6, 'Department', 'For all Labs and clinical trials', 'RCLS', 101, 'Active', 12, '2022-01-15 17:25:21', '2022-01-15 22:43:16'),
(9, 'Administration and Human Resource', 6, 'Department', 'Administration and human resource department', 'AHR', 102, 'Active', 12, '2022-01-15 17:26:16', '2022-01-16 12:18:01'),
(10, 'Procurement', 7, 'Unit', 'For procurement processes', 'PRC', 102, 'Active', 12, '2022-01-15 17:27:06', '2022-01-16 12:21:09'),
(11, 'Grants', 7, 'Unit', 'Grants Management', 'GRTS', 101, 'Active', 12, '2022-01-15 17:28:00', '2022-01-15 22:42:31'),
(12, 'Accounts', 7, 'Unit', 'Accounting processes', 'ACC', 102, 'Active', 12, '2022-01-15 17:28:44', '2022-01-15 22:42:44'),
(13, 'Human Resource', 9, 'Unit', 'Human Resource Management', 'HRM', 102, 'Active', 12, '2022-01-15 17:29:54', '2022-01-16 12:26:38'),
(14, 'Legal and Cost Recovery', 9, 'Unit', 'Legal Department', 'LCR', 104, 'Active', 12, '2022-01-15 17:30:42', '2022-01-17 14:22:45'),
(15, 'Public Relations', 9, 'Unit', 'Public Relations management', 'PRM', 102, 'Active', 12, '2022-01-15 17:31:30', '2022-01-17 14:22:48'),
(16, 'Information Technology', 9, 'Unit', 'Information Technology department or IT team.', 'IT', 109, 'Active', 12, '2022-01-15 17:32:28', '2022-02-20 15:11:24'),
(17, 'Software Development', 16, 'Sub-Unit', 'Software development sub-unit of IT', 'SD', 100, 'Active', 11, '2022-01-15 18:52:56', '2022-01-15 18:52:56'),
(18, 'Data Management', 16, 'Sub-Unit', 'Data management unit', 'DM', 100, 'Active', 11, '2022-01-15 18:54:36', '2022-01-15 18:54:36'),
(19, 'Technical Support', 16, 'Sub-Unit', 'Technical Support unit of IT', 'TSUP', 100, 'Active', 11, '2022-01-15 18:55:37', '2022-01-15 18:55:37'),
(20, 'Laboratory Services', 8, 'Unit', 'Laboratory services', 'LS', 100, 'Active', 12, '2022-01-15 18:59:13', '2022-01-15 18:59:13'),
(21, 'Research and Innovation', 8, 'Unit', 'Research and innovation', 'RI', 100, 'Active', 12, '2022-01-15 19:00:12', '2022-01-15 19:00:12'),
(22, 'Clinical Trials', 8, 'Unit', 'Clinical Trials Unit', 'CT', 100, 'Active', 12, '2022-01-15 19:01:17', '2022-01-15 19:01:17'),
(23, 'Clinical Services', 8, 'Unit', 'Clinical services Unit', 'CS', 100, 'Active', 12, '2022-01-15 19:02:03', '2022-01-15 19:02:03'),
(24, 'Quality Assurance/Control', 8, 'Unit', 'Quality Assurance and control Unit', 'QA', 102, 'Active', 12, '2022-01-15 19:03:17', '2022-02-20 14:54:37'),
(25, 'Myco Bacterial Laboratory', 20, 'Laboratory', 'Myco Bacterial Lab', 'MYCO', 102, 'Active', 12, '2022-01-15 19:05:56', '2022-02-20 14:54:25'),
(26, 'Immunology Laboratory', 20, 'Laboratory', 'Immunology laboratory unit', 'IMML', 102, 'Active', 12, '2022-01-15 19:06:44', '2022-01-15 22:17:10'),
(27, 'Molecular Biology Laboratory', 20, 'Laboratory', 'Molecular Biology Lab', 'MBL', 105, 'Active', 12, '2022-01-15 19:08:14', '2022-02-20 14:53:39'),
(28, 'COV-BANK', NULL, 'Project', 'Establishment of a Quality Assured Specimen Biobank to Support Immediate and Future Research in Basic, Clinical and Translational Sciences of COVID-19 in Uganda.', 'COV-BANK', 100, 'Active', 11, '2022-01-15 19:42:20', '2022-01-15 19:42:20'),
(29, 'PCR Kits', NULL, 'Project', 'PCR & Antibody Diagnostic Kits.', 'PCR Kits', 100, 'Active', 11, '2022-01-15 19:43:21', '2022-01-15 19:43:21'),
(30, 'IVCOM', NULL, 'Project', 'Identification, Validation and Optimization of available drug molecules for clinical treatment of COVID-19.', 'IVCOM', 100, 'Active', 11, '2022-01-15 19:44:39', '2022-01-15 19:44:39'),
(31, 'STDS-AgX COVID19 RDT®', NULL, 'Project', 'Development, Testing and Deployment of An Affordable, Easy to Use, and Rapid Point of Care Diagnostic Test Platform for Covid-19 Suiting Remote Settings of Sub-Saharan Africa.', 'STDS-AgX COVID19 RDT®', 100, 'Active', 11, '2022-01-15 19:45:20', '2022-01-15 19:45:20'),
(32, 'SSARA-COV2', NULL, 'Project', 'Development and Validation of an Antigen Agglutination Test for Rapid Screening of COVID-19 in Low Laboratory Capacity and Field Settings.', 'SSARA-COV2', 100, 'Active', 11, '2022-01-15 19:46:11', '2022-01-15 19:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `department_units`
--

DROP TABLE IF EXISTS `department_units`;
CREATE TABLE IF NOT EXISTS `department_units` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `belongs_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_units_department_id_foreign` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department_user`
--

DROP TABLE IF EXISTS `department_user`;
CREATE TABLE IF NOT EXISTS `department_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  KEY `department_user_user_id_foreign` (`user_id`),
  KEY `department_user_department_id_foreign` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

DROP TABLE IF EXISTS `designations`;
CREATE TABLE IF NOT EXISTS `designations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `designations_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `description`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Head Information Technology', 'Head of the IT department', 'Active', 11, '2021-11-25 22:40:05', '2022-01-15 19:18:03'),
(2, 'Software Developer/Engineer', 'Planning, designing and developing software  on the IT team', 'Active', 11, '2021-11-25 22:42:13', '2022-01-15 19:19:20'),
(4, 'Principle Investigator', 'Head of a Project or study or research', 'Active', 11, '2021-11-30 14:28:22', '2021-11-30 14:28:22'),
(5, 'Co-Investigator', 'Deputy Principle investigator of  a study or project', 'Active', 11, '2021-11-30 14:29:38', '2021-11-30 14:29:38'),
(7, 'Laboratory Manager', 'Manages the Laboratory', 'Active', 11, '2021-11-30 14:30:33', '2022-01-15 19:17:38'),
(8, 'Laboratory Supervisor', 'Supervises Lab activities', 'Active', 11, '2021-11-30 14:31:09', '2022-01-15 19:23:12'),
(9, 'Head Procurement', 'Handles all procurement activities', 'Active', 11, '2021-11-30 14:32:23', '2022-01-15 19:15:11'),
(10, 'Head of Human Resource and Administration', 'Over all administration and human resource', 'Active', 11, '2021-11-30 14:33:24', '2021-11-30 14:33:24'),
(11, 'Assistant IT manager', 'Deputizes the chief IT manager', 'Active', 11, '2021-11-30 14:34:46', '2021-11-30 14:34:46'),
(12, 'Lead Software Developer/Engineer', 'Planning, Analysing, designing, development, testing, deploying and maintenance of software', 'Active', 11, '2021-11-30 14:36:08', '2022-01-15 19:16:39'),
(13, 'Asst Human Resource officer', 'Deputizes Head of HR', 'Active', 11, '2021-11-30 14:36:48', '2022-01-15 19:15:47'),
(14, 'Head of Finance and Strategic Management', 'Head of Finance and Strategic Management for MakBRC and its Labs', 'Active', 11, '2021-11-30 14:37:48', '2022-01-15 19:14:37'),
(15, 'Head Accounts', 'Chief accountant of MakBRC', 'Active', 11, '2021-11-30 14:38:18', '2021-11-30 14:38:18'),
(16, 'Data Manager', 'Manages Data collection, transmission, analysis, storage, and sharing.', 'Active', 11, '2021-11-30 14:39:13', '2021-11-30 14:39:13'),
(17, 'Grants Manager', 'Grants management', 'Active', 11, '2021-12-09 20:25:06', '2022-01-15 19:26:38'),
(18, 'Store Manager', 'Manages all inventory in the store', 'Active', 11, '2022-01-15 19:21:04', '2022-01-15 19:21:04'),
(19, 'Laboratory Technologist', 'Testing samples recieved', 'Active', 11, '2022-01-15 19:26:15', '2022-01-15 19:26:15'),
(20, 'Project Manager', 'Project Manager', 'Active', 11, '2022-01-15 19:29:59', '2022-01-15 19:29:59'),
(21, 'Grants Officer', 'Grants Officer', 'Active', 11, '2022-01-15 19:30:41', '2022-01-15 19:30:41'),
(22, 'Project Administrator', 'Project Administrator', 'Active', 11, '2022-01-15 19:31:08', '2022-01-15 19:31:08'),
(23, 'Procurement Officer', 'Procurement Officer', 'Active', 11, '2022-01-15 19:32:33', '2022-01-15 19:32:33'),
(24, 'Legal & Ethics Officer', 'Legal & Ethics Officer', 'Active', 11, '2022-01-15 19:33:10', '2022-01-15 19:33:10'),
(25, 'Project Officer', 'Project Officer', 'Active', 11, '2022-01-15 19:33:35', '2022-01-15 19:33:35'),
(26, 'Sample Runner', 'Sample Runner', 'Active', 11, '2022-01-15 19:34:02', '2022-01-15 19:34:02'),
(27, 'Technical Manager', 'Technical Manager', 'Active', 11, '2022-01-15 19:34:21', '2022-01-15 19:34:21'),
(28, 'Project Coordinator', 'Project Coordinator', 'Active', 11, '2022-01-15 19:34:39', '2022-01-15 19:34:39'),
(29, 'Biomedical Engineer', 'Biomedical Engineer', 'Active', 11, '2022-01-15 19:35:14', '2022-01-15 19:35:14'),
(30, 'Quality Officer', 'Quality Officer', 'Active', 11, '2022-01-15 19:35:33', '2022-01-15 19:35:33'),
(31, 'Sustainability Manager', 'Sustainability Manager', 'Active', 11, '2022-01-15 19:35:55', '2022-01-15 19:35:55'),
(32, 'Biostatistician', 'Biostatistician', 'Active', 11, '2022-01-15 19:36:48', '2022-01-15 19:36:48'),
(33, 'Study Clinician', 'Study Clinician', 'Active', 11, '2022-01-15 19:37:29', '2022-01-15 19:37:29'),
(34, 'Lab Scientist', 'Lab Scientist', 'Active', 11, '2022-01-15 19:37:49', '2022-01-15 19:37:49'),
(35, 'Research Assistant', 'Research Assistant', 'Active', 11, '2022-01-15 19:39:19', '2022-01-15 19:39:19'),
(36, 'Data Officer', 'Data Officer', 'Active', 11, '2022-01-15 19:39:45', '2022-01-15 19:39:45'),
(37, 'Operations Manager', 'Manage all MakBRC operations', 'Active', 11, '2022-01-16 11:53:59', '2022-01-16 14:26:39'),
(38, 'Internal Auditor', 'Internal Auditor', 'Active', 11, '2022-01-16 11:54:50', '2022-01-16 11:54:50'),
(39, 'Managing Director', 'Overall Head', 'Active', 11, '2022-01-16 11:55:19', '2022-01-16 11:55:19'),
(40, 'Personal Assistant', 'Personal Assistant to MD', 'Active', 11, '2022-01-16 11:56:32', '2022-01-16 11:56:32');

-- --------------------------------------------------------

--
-- Table structure for table `designation_histories`
--

DROP TABLE IF EXISTS `designation_histories`;
CREATE TABLE IF NOT EXISTS `designation_histories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `station_id` bigint(20) UNSIGNED DEFAULT NULL,
  `from` bigint(20) UNSIGNED DEFAULT NULL,
  `to` bigint(20) UNSIGNED DEFAULT NULL,
  `supervisor` bigint(20) UNSIGNED DEFAULT NULL,
  `official_contract_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `designation_histories_employee_id_foreign` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `education_backgrounds`
--

DROP TABLE IF EXISTS `education_backgrounds`;
CREATE TABLE IF NOT EXISTS `education_backgrounds` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `award` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `award_document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `education_backgrounds_employee_id_foreign` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

DROP TABLE IF EXISTS `emergency_contacts`;
CREATE TABLE IF NOT EXISTS `emergency_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_relationship` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emergency_contacts_employee_id_foreign` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emergency_contacts`
--

INSERT INTO `emergency_contacts` (`id`, `employee_id`, `contact_name`, `contact_relationship`, `contact_address`, `contact_phone`, `contact_email`, `created_at`, `updated_at`) VALUES
(7, 19, 'Birungi Margret', 'Mother', 'Kanyanya', '0704903332', NULL, '2022-08-23 17:06:10', '2022-08-23 17:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nin_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL,
  `birth_place` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religious_affiliation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civil_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `station_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reporting_to` bigint(20) UNSIGNED DEFAULT NULL,
  `work_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_date` date DEFAULT NULL,
  `tin_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nssf_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_emp_id_unique` (`emp_id`),
  UNIQUE KEY `employees_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_id`, `nin_number`, `prefix`, `surname`, `first_name`, `other_name`, `gender`, `nationality`, `birthday`, `age`, `birth_place`, `religious_affiliation`, `height`, `weight`, `blood_type`, `civil_status`, `address`, `email`, `alt_email`, `contact`, `alt_contact`, `designation_id`, `station_id`, `department_id`, `department_unit_id`, `reporting_to`, `work_type`, `join_date`, `tin_number`, `nssf_number`, `photo`, `signature`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'BRC10000P', 'CM900345678LVF', 'Mr.', 'MAKBRC', 'SUPPORT', NULL, 'Male', 'Ugandan', '2000-08-19', 21, 'RUBAGA', NULL, NULL, NULL, NULL, 'Single', 'MUTUNDWE', 'ict.makbrc@gmail.com', NULL, '0705678987', NULL, NULL, NULL, NULL, NULL, NULL, 'Contract', '2000-04-02', NULL, NULL, 'photos/20220117002637BRC/IT-102.jpg', 'signatures/20220117002637BRC/IT-102.jpg', 'Inactive', 12, '2022-01-15 23:22:34', '2022-08-23 00:24:57'),
(19, 'BRC10001W', NULL, 'Ms.', 'BASEMERA', 'JOANITAH', NULL, 'Female', 'Ugandan', '1984-05-23', 38, 'MULAGO', 'MUSLIM', '55', '70', 'O+', 'Married', NULL, 'birungijoanah@gmail.com', 'birungi.joanah@mak.ac.ug', '+256701925906', '0774572385', 22, 2, 2, NULL, NULL, 'Contract', '2008-09-23', NULL, NULL, NULL, NULL, 'Active', NULL, '2022-08-23 16:50:42', '2022-08-23 16:50:42'),
(20, 'BRC10002X', NULL, 'Mr.', 'KED', 'KAYS', NULL, 'Male', 'Ugandan', '2004-02-29', 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kedkayz@gmail.com', 'kedkayz@gmail.com', '+44705568888', NULL, 36, NULL, 16, NULL, NULL, 'Part Time', '2017-02-28', NULL, NULL, NULL, NULL, 'Active', NULL, '2022-11-28 14:41:39', '2022-11-28 14:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `employee_appraisals`
--

DROP TABLE IF EXISTS `employee_appraisals`;
CREATE TABLE IF NOT EXISTS `employee_appraisals` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `appraisal_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_appraisals_employee_id_foreign` (`employee_id`),
  KEY `employee_appraisals_department_id_foreign` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_warnings`
--

DROP TABLE IF EXISTS `employee_warnings`;
CREATE TABLE IF NOT EXISTS `employee_warnings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `letter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_warnings_employee_id_foreign` (`employee_id`),
  KEY `employee_warnings_department_id_foreign` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exit_interviews`
--

DROP TABLE IF EXISTS `exit_interviews`;
CREATE TABLE IF NOT EXISTS `exit_interviews` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `interview_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exit_interviews_employee_id_foreign` (`employee_id`),
  KEY `exit_interviews_department_id_foreign` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facility_information`
--

DROP TABLE IF EXISTS `facility_information`;
CREATE TABLE IF NOT EXISTS `facility_information` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `facility_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facility_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `physical_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facility_information`
--

INSERT INTO `facility_information` (`id`, `facility_name`, `slogan`, `about`, `facility_type`, `physical_address`, `address2`, `contact`, `contact2`, `email`, `email2`, `tin`, `website`, `fax`, `logo`, `logo2`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'MAKERERE UNIVERSITY BIOMEDICAL RESEARCH CENTRE', 'Excellence in BioMedical Research', 'Biomedical Research facility which is under Makerere University Uganda', 'GOVERMENT', 'Clock Tower Kampala, Uganda', 'P.O BOX 75018', '+256390554433', NULL, 'makbrc.mak@gmail.com', NULL, NULL, 'https://brc.mak.ac.ug', NULL, 'facilitylogo/logo.png', 'facilitylogo/logo2.png', 11, '2022-07-26 16:57:56', '2022-08-19 02:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `family_backgrounds`
--

DROP TABLE IF EXISTS `family_backgrounds`;
CREATE TABLE IF NOT EXISTS `family_backgrounds` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `member_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `family_backgrounds_employee_id_foreign` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `family_backgrounds`
--

INSERT INTO `family_backgrounds` (`id`, `employee_id`, `member_type`, `surname`, `first_name`, `middle_name`, `address`, `contact`, `occupation`, `employer`, `employer_address`, `employer_contact`, `created_at`, `updated_at`) VALUES
(9, 19, 'Mother', 'Birungi', 'Margret', NULL, 'Kanyanya Komaboga', '0704903332', 'support Staff', NULL, NULL, 'MAKBRC', '2022-08-23 17:00:28', '2022-08-23 17:00:28'),
(10, 19, 'Father', 'Birungi', 'Slyvester', 'Amooti', 'Kanyanya Komaboga', '0750415937', 'RETIRED', NULL, NULL, NULL, '2022-08-23 17:01:49', '2022-08-23 17:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `grievances`
--

DROP TABLE IF EXISTS `grievances`;
CREATE TABLE IF NOT EXISTS `grievances` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `grievance_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `addressee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `support_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grievances_employee_id_foreign` (`employee_id`),
  KEY `grievances_department_id_foreign` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
CREATE TABLE IF NOT EXISTS `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `holiday_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `details` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `title`, `holiday_type`, `start_date`, `end_date`, `details`, `created_at`, `updated_at`) VALUES
(1, 'Christmas Day', 'Public Holiday', '2021-08-19', '2021-12-31', 'Celebrating Christmas for Christians', '2021-11-26 10:02:48', '2021-11-26 10:10:27'),
(2, 'New Years Day', 'Public Holiday', '2022-08-10', '2022-08-10', 'New Years Day celebrations with family and Friends', '2021-11-26 10:07:01', '2021-11-26 10:07:01'),
(3, 'End of Year Party', 'Company Holiday', '2021-08-08', NULL, 'End of year wrap up party for MAKBRC', '2021-11-26 10:22:45', '2021-11-26 10:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_types`
--

DROP TABLE IF EXISTS `insurance_types`;
CREATE TABLE IF NOT EXISTS `insurance_types` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inv-_notifications`
--

DROP TABLE IF EXISTS `inv-_notifications`;
CREATE TABLE IF NOT EXISTS `inv-_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subjec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Open',
  `view` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Private',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inv__notifications_department_id_foreign` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inv_department__items`
--

DROP TABLE IF EXISTS `inv_department__items`;
CREATE TABLE IF NOT EXISTS `inv_department__items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `inv_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `qty_left` double(8,2) NOT NULL DEFAULT '0.00',
  `qty_held` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inv_department__items_department_id_foreign` (`department_id`),
  KEY `inv_department__items_inv_item_id_foreign` (`inv_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inv_department__items`
--

INSERT INTO `inv_department__items` (`id`, `department_id`, `inv_item_id`, `brand`, `is_active`, `qty_left`, `qty_held`, `created_at`, `updated_at`) VALUES
(5, 23, 2, 'QA', 1, 0.00, 0.00, '2022-12-15 23:13:43', '2022-12-15 23:13:43'),
(7, 22, 3, 'QA', 1, 0.00, 0.00, '2022-12-15 23:15:12', '2022-12-15 23:15:12'),
(8, 12, 2, 'QA', 1, 0.00, 0.00, '2022-12-15 23:16:52', '2022-12-15 23:16:52'),
(9, 18, 2, 'QA', 1, 0.00, 0.00, '2022-12-15 23:16:52', '2022-12-15 23:16:52'),
(10, 12, 3, 'bd', 1, 0.00, 0.00, '2022-12-15 23:19:15', '2022-12-15 23:20:51'),
(11, 25, 2, 'QB', 1, 0.00, 0.00, '2022-12-15 23:21:35', '2022-12-15 23:21:35'),
(12, 31, 2, 'QB', 1, 0.00, 0.00, '2022-12-15 23:21:35', '2022-12-15 23:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `inv_items`
--

DROP TABLE IF EXISTS `inv_items`;
CREATE TABLE IF NOT EXISTS `inv_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inv_subunit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cost_price` double(8,2) NOT NULL DEFAULT '0.00',
  `inv_uom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `max_qty` double(8,2) NOT NULL DEFAULT '0.00',
  `min_qty` double(8,2) NOT NULL DEFAULT '0.00',
  `inv_store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `expires` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `item_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inv_items_item_code_unique` (`item_code`),
  KEY `inv_items_inv_subunit_id_foreign` (`inv_subunit_id`),
  KEY `inv_items_inv_uom_id_foreign` (`inv_uom_id`),
  KEY `inv_items_supplier_id_foreign` (`supplier_id`),
  KEY `inv_items_inv_store_id_foreign` (`inv_store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `inv_items`
--

INSERT INTO `inv_items` (`id`, `item_name`, `inv_subunit_id`, `cost_price`, `inv_uom_id`, `supplier_id`, `max_qty`, `min_qty`, `inv_store_id`, `description`, `date_added`, `is_active`, `expires`, `item_code`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Alprazolam', 4, 6000.00, 4, 1, 400.00, 50.00, NULL, 'thi sis very goog', '2022-12-13', 1, 'Off', 'EME16491662725', 11, '2022-12-14 10:46:37', '2022-12-14 11:09:44'),
(3, 'Ampicillin', 1, 4900.00, 2, 1, 3000.00, 2000.00, NULL, 'Very  good', '2022-12-13', 1, '1', 'LAB1645979372444', 11, '2022-12-14 10:51:12', '2022-12-14 11:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `inv_requestitems`
--

DROP TABLE IF EXISTS `inv_requestitems`;
CREATE TABLE IF NOT EXISTS `inv_requestitems` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `inv_requests_id` bigint(20) UNSIGNED DEFAULT NULL,
  `inv_items_id` bigint(20) UNSIGNED DEFAULT NULL,
  `inv_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `request_qty` double(8,2) NOT NULL DEFAULT '0.00',
  `qty_given` double(8,2) NOT NULL DEFAULT '0.00',
  `request_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `item_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `users_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inv_requestitems_inv_requests_id_foreign` (`inv_requests_id`),
  KEY `inv_requestitems_inv_items_id_foreign` (`inv_items_id`),
  KEY `inv_requestitems_inv_item_id_foreign` (`inv_item_id`),
  KEY `inv_requestitems_users_id_foreign` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inv_requests`
--

DROP TABLE IF EXISTS `inv_requests`;
CREATE TABLE IF NOT EXISTS `inv_requests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `request_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Internal',
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `borrower_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `inventoryclerk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `request_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `borrow_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'na',
  `is_active` int(11) NOT NULL DEFAULT '0',
  `date_added` date DEFAULT NULL,
  `reqcomment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'na',
  `date_approved` date DEFAULT NULL,
  `request_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_week` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inv_requests_department_id_foreign` (`department_id`),
  KEY `inv_requests_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inv_stocklevels`
--

DROP TABLE IF EXISTS `inv_stocklevels`;
CREATE TABLE IF NOT EXISTS `inv_stocklevels` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `inv_items_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_qty` double(8,2) NOT NULL DEFAULT '0.00',
  `batch_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `stock_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_cost ,60,2` double DEFAULT NULL,
  `total_cost ,60,2` double DEFAULT NULL,
  `inv_supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `inv_store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `grn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lpo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `date_added` date DEFAULT NULL,
  `stock_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_week` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inv_stocklevels_inv_items_id_foreign` (`inv_items_id`),
  KEY `inv_stocklevels_department_id_foreign` (`department_id`),
  KEY `inv_stocklevels_inv_supplier_id_foreign` (`inv_supplier_id`),
  KEY `inv_stocklevels_inv_store_id_foreign` (`inv_store_id`),
  KEY `inv_stocklevels_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inv_stock_settlements`
--

DROP TABLE IF EXISTS `inv_stock_settlements`;
CREATE TABLE IF NOT EXISTS `inv_stock_settlements` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `request_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `borrower_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty_given` bigint(20) UNSIGNED DEFAULT NULL,
  `qty_remaining` bigint(20) UNSIGNED DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inv_stock_settlements_department_id_foreign` (`department_id`),
  KEY `inv_stock_settlements_borrower_id_foreign` (`borrower_id`),
  KEY `inv_stock_settlements_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inv_stores`
--

DROP TABLE IF EXISTS `inv_stores`;
CREATE TABLE IF NOT EXISTS `inv_stores` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_description` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inv_stores`
--

INSERT INTO `inv_stores` (`id`, `store_name`, `store_location`, `store_description`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 'Kampalayy', 'Kampala', 'kuvgh v', 11, 1, '2022-11-23 17:12:03', '2022-11-23 17:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `inv_subunits`
--

DROP TABLE IF EXISTS `inv_subunits`;
CREATE TABLE IF NOT EXISTS `inv_subunits` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subunit_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inv_subunits`
--

INSERT INTO `inv_subunits` (`id`, `subunit_name`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Office materials', 11, 1, '2022-11-29 10:12:34', '2022-11-29 10:12:34'),
(4, 'Laboratory Supplies', 11, 1, '2022-11-29 10:23:02', '2022-11-29 10:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `inv_suppliers`
--

DROP TABLE IF EXISTS `inv_suppliers`;
CREATE TABLE IF NOT EXISTS `inv_suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sup_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inv_uoms`
--

DROP TABLE IF EXISTS `inv_uoms`;
CREATE TABLE IF NOT EXISTS `inv_uoms` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uom_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inv_uoms`
--

INSERT INTO `inv_uoms` (`id`, `uom_name`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Pcs', 11, 1, '2022-11-29 10:43:38', '2022-11-29 10:43:38'),
(3, 'Roll', 11, 1, '2022-11-29 13:11:19', '2022-11-29 13:11:19'),
(4, 'Bottle', 11, 1, '2022-11-29 13:11:58', '2022-11-29 13:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `inv_userdeparments`
--

DROP TABLE IF EXISTS `inv_userdeparments`;
CREATE TABLE IF NOT EXISTS `inv_userdeparments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inv_userdeparments_user_id_foreign` (`user_id`),
  KEY `inv_userdeparments_department_id_foreign` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inv_userdeparments`
--

INSERT INTO `inv_userdeparments` (`id`, `user_id`, `department_id`, `role`, `created_at`, `updated_at`) VALUES
(1, 45, 9, 2, '2022-11-29 08:50:32', '2022-11-29 08:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=599 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(598, 'default', '{\"uuid\":\"59d9bdd5-9ebd-494e-a555-c0f405890ceb\",\"displayName\":\"App\\\\Notifications\\\\SendPasswordNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:45;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:42:\\\"App\\\\Notifications\\\\SendPasswordNotification\\\":2:{s:51:\\\"\\u0000App\\\\Notifications\\\\SendPasswordNotification\\u0000details\\\";a:4:{s:8:\\\"greeting\\\";s:14:\\\"Hello KED KAYS\\\";s:4:\\\"body\\\";s:30:\\\"Your password is 69H)V0s5&eCf*\\\";s:10:\\\"actiontext\\\";s:14:\\\"Click to Login\\\";s:9:\\\"actionurl\\\";s:23:\\\"https:\\/\\/merp.makbrc.org\\\";}s:2:\\\"id\\\";s:36:\\\"51842cff-475b-49a6-89af-6aa55884c6cb\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1669646576, 1669646576);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

DROP TABLE IF EXISTS `leaves`;
CREATE TABLE IF NOT EXISTS `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `carriable` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_payable` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `given_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notice_days` int(11) NOT NULL,
  `details` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `name`, `duration`, `carriable`, `is_payable`, `payment_type`, `given_to`, `notice_days`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Annual', 21, 'No', 'Yes', 'Full Pay', 'All', 14, NULL, 'Active', '2021-12-22 12:27:43', '2022-08-02 12:27:13'),
(2, 'Paternity', 4, 'No', 'Yes', 'Full Pay', 'Male', 0, NULL, 'Active', '2021-12-22 12:33:57', '2022-08-02 12:19:38'),
(3, 'Maternity', 60, 'No', 'Yes', 'Full Pay', 'Female', 60, NULL, 'Active', '2021-12-22 12:34:38', '2022-08-02 12:20:51'),
(4, 'Sick Leave', 12, 'No', 'Yes', 'Full Pay', 'All', 0, NULL, 'Active', '2021-12-22 18:23:24', '2022-08-02 12:17:37'),
(5, 'Study Leave', 1460, 'No', 'No', 'No Pay', 'All', 14, NULL, 'Active', '2021-12-22 18:25:19', '2021-12-22 18:26:35'),
(6, 'Compassionate', 5, 'No', 'Yes', 'Full Pay', 'All', 0, NULL, 'Active', '2022-08-02 12:24:18', '2022-08-02 12:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `leave_balances`
--

DROP TABLE IF EXISTS `leave_balances`;
CREATE TABLE IF NOT EXISTS `leave_balances` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leave_id` bigint(20) UNSIGNED DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `limit` int(11) DEFAULT NULL,
  `used` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_balances_employee_id_foreign` (`employee_id`),
  KEY `leave_balances_leave_id_foreign` (`leave_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

DROP TABLE IF EXISTS `leave_requests`;
CREATE TABLE IF NOT EXISTS `leave_requests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leave_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `length` int(11) DEFAULT NULL,
  `reason` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `duties_delegated` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `delegatee_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delegatee_comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delegated_to` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `accepted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_requests_employee_id_foreign` (`employee_id`),
  KEY `leave_requests_leave_id_foreign` (`leave_id`),
  KEY `leave_requests_department_id_foreign` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_10_08_130238_laratrust_setup_tables', 1),
(17, '2021_10_18_130238_create_asset_categories_table', 2),
(18, '2021_10_18_130239_create_asset_subcategories_table', 2),
(21, '2021_10_18_130241_create_insurance_types_table', 3),
(22, '2021_10_18_130242_create_vendors_table', 3),
(39, '2021_10_18_151248_create_activity_logs_table', 7),
(40, '2021_10_18_135514_create_assets_table', 8),
(41, '2021_10_18_135958_create_asset_issues_table', 9),
(42, '2021_10_18_145841_create_asset_maintenance_info_table', 9),
(43, '2013_11_20_182027_create_assignment_history_table', 10),
(45, '2021_10_18_130240_create_stations_table', 11),
(47, '2021_11_26_010008_create_designations_table', 12),
(48, '2021_11_26_124138_create_holidays_table', 13),
(58, '2021_12_01_192922_create_children_table', 18),
(59, '2021_12_01_193744_create_emergency_contacts_table', 19),
(60, '2021_12_01_195248_create_family_backgrounds_table', 20),
(63, '2021_12_02_230929_create_education_backgrounds_table', 23),
(66, '2021_12_03_164239_create_work_experiences_table', 26),
(67, '2021_12_03_171709_create_training_programs_table', 27),
(71, '2014_10_12_000000_create_users_table', 30),
(83, '2021_12_01_184713_create_banking_information_table', 39),
(84, '2021_11_26_140819_create_leaves_table', 40),
(95, '2021_12_03_001859_create_official_contracts_table', 46),
(96, '2021_12_03_001928_create_project_contracts_table', 47),
(98, '2021_12_30_175213_create_designation_histories_table', 48),
(99, '2021_11_26_183353_create_leave_requests_table', 49),
(100, '2022_01_03_181856_add_department_id_to_official_contracts_table', 50),
(101, '2021_12_27_222007_create_exit_interviews_table', 51),
(102, '2021_12_27_220734_create_employee_appraisals_table', 52),
(103, '2021_12_27_153453_create_employee_warnings_table', 53),
(104, '2021_12_10_010149_create_terminations_table', 54),
(106, '2021_12_09_233953_create_grievances_table', 56),
(107, '2021_12_10_002621_create_resignations_table', 57),
(108, '2014_10_11_000000_create_departments_table', 58),
(110, '2021_11_27_231324_create_employees_table', 59),
(112, '2022_07_01_153005_create_facility_information_table', 60),
(113, '2022_07_30_230616_create_jobs_table', 61),
(114, '2022_08_05_184715_create_notices_table', 62),
(115, '2022_08_05_184736_create_suggestions_table', 63),
(116, '2021_12_02_142526_create_department_units_table', 64),
(117, '2021_10_18_091633_create_inv_subunits_table', 65),
(118, '2021_10_18_104057_create_inv_uoms_table', 65),
(119, '2021_10_18_120334_create_inv_suppliers_table', 65),
(120, '2021_10_18_126360_create_inv_stores_table', 65),
(122, '2021_10_18_126362_create_inv_userdeparments_table', 65),
(123, '2021_10_18_126363_create_inv_department__items_table', 65),
(124, '2021_10_18_126364_create_inv_stocklevels_table', 65),
(125, '2021_10_18_126365_create_inv_requests_table', 65),
(126, '2021_10_18_126366_create_inv_requestitems_table', 65),
(127, '2021_10_18_126367_create_inv_stock_settlements_table', 65),
(128, '2021_10_18_126368_create_inv-_notifications_table', 65),
(129, '2021_12_13_001308_create_leave_balances_table', 65),
(130, '2021_04_29_151300_create_suppliers_table', 66),
(131, '2021_10_18_126361_create_inv_items_table', 67);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

DROP TABLE IF EXISTS `notices`;
CREATE TABLE IF NOT EXISTS `notices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `notice` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `audience` int(11) NOT NULL DEFAULT '0',
  `expires_on` date NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `official_contracts`
--

DROP TABLE IF EXISTS `official_contracts`;
CREATE TABLE IF NOT EXISTS `official_contracts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contract_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `gross_salary` double(12,2) NOT NULL,
  `contract_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Running',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `official_contracts_employee_id_foreign` (`employee_id`),
  KEY `official_contracts_department_id_foreign` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('muytimothy@gmail.com', '$2y$10$0osL8UE2gLGszmhPin456eS14ifyK7sSzctj3lIgMn/UyxulNPxSu', '2022-07-25 11:38:54'),
('kedkayz@gmail.com', '$2y$10$IDh1Pnk1SX8VYR8exWL3S.ovzMPMeNXjyONULsy3aHbx1k2b4UNxy', '2022-08-18 19:05:06'),
('kedkays@gmail.com', '$2y$10$5WZmOwyNbFkmSlC8ay8XbuZkIXWkFxYwJgIpHTepNaZWWXhfoQR7m', '2022-08-18 19:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'employee-manage', 'Manage Employee', 'Manage Employee Information', '2022-01-01 17:08:30', '2022-08-12 21:56:17'),
(2, 'employee-create', 'Create Employee', 'Create Employee information', '2022-01-01 17:08:30', '2022-08-13 14:07:02'),
(16, 'employee-accept', 'Accept Employee', 'Accept Employee', '2022-01-01 17:08:30', '2022-01-01 17:08:30'),
(17, 'employee-approve', 'Approve Employee', 'Approve Employee', '2022-01-01 17:08:30', '2022-01-01 17:08:30'),
(22, 'manageInventory', 'manage Inventory', 'manages Inventory', '2022-11-28 20:27:13', '2022-11-28 20:27:13'),
(23, 'requestInventory', 'request Inventory', 'requestInventory', '2022-11-28 20:27:57', '2022-11-28 20:27:57'),
(24, 'inventory-approve', 'Approve Inventory', 'Approve Inventory requests', '2022-11-28 20:28:46', '2022-11-28 20:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(2, 4),
(3, 4),
(4, 4),
(11, 5),
(12, 5),
(13, 5),
(14, 5),
(15, 5),
(12, 6),
(13, 6),
(14, 6),
(6, 7),
(7, 7),
(8, 7),
(9, 7),
(10, 7),
(18, 7),
(7, 8),
(8, 8),
(9, 8),
(10, 8),
(18, 8);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE IF NOT EXISTS `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`permission_id`, `user_id`, `user_type`) VALUES
(1, 27, 'App\\Models\\User'),
(1, 43, 'App\\Models\\User'),
(1, 44, 'App\\Models\\User'),
(2, 11, 'App\\Models\\User'),
(2, 27, 'App\\Models\\User'),
(2, 43, 'App\\Models\\User'),
(2, 44, 'App\\Models\\User'),
(23, 45, 'App\\Models\\User'),
(24, 45, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_contracts`
--

DROP TABLE IF EXISTS `project_contracts`;
CREATE TABLE IF NOT EXISTS `project_contracts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `contract_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `fte` double(12,2) DEFAULT NULL,
  `gross_salary` double(12,2) NOT NULL,
  `contract_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Running',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_contracts_employee_id_foreign` (`employee_id`),
  KEY `project_contracts_position_id_foreign` (`position_id`),
  KEY `project_contracts_project_id_foreign` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resignations`
--

DROP TABLE IF EXISTS `resignations`;
CREATE TABLE IF NOT EXISTS `resignations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hand_over_date` date DEFAULT NULL,
  `letter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resignations_employee_id_foreign` (`employee_id`),
  KEY `resignations_department_id_foreign` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'SuperAdmin', 'SuperAdmin', '2022-01-01 17:08:30', '2022-01-01 17:08:30'),
(2, 'HrAdmin', 'HrAdmin', 'HrAdmin', '2022-01-01 17:08:30', '2022-01-01 17:08:30'),
(3, 'HrSupervisor', 'HrSupervisor', 'HrSupervisor', '2022-01-01 17:08:30', '2022-01-01 17:08:30'),
(4, 'HrUser', 'HrUser', 'HrUser', '2022-01-01 17:08:30', '2022-01-01 17:08:30'),
(5, 'AssetsAdmin', 'AssetsAdmin', 'Over all Assets Manager', '2022-01-01 17:08:30', '2022-08-12 21:45:09'),
(6, 'AssetsUser', 'AssetsUser', 'AssetsUser', '2022-01-01 17:08:30', '2022-01-01 17:08:30'),
(7, 'InvAdmin', 'InvAdmin', 'InvAdmin', '2022-01-01 17:08:31', '2022-01-01 17:08:31'),
(8, 'InvSupervisor', 'InvSupervisor', 'InvSupervisor', '2022-01-01 17:08:31', '2022-01-01 17:08:31'),
(15, 'InvUser', 'Inventory User', NULL, '2022-11-28 20:26:15', '2022-11-28 20:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 11, 'App\\Models\\User'),
(2, 27, 'App\\Models\\User'),
(2, 29, 'App\\Models\\User'),
(2, 43, 'App\\Models\\User'),
(2, 44, 'App\\Models\\User'),
(3, 25, 'App\\Models\\User'),
(4, 12, 'App\\Models\\User'),
(4, 23, 'App\\Models\\User'),
(4, 24, 'App\\Models\\User'),
(4, 31, 'App\\Models\\User'),
(4, 32, 'App\\Models\\User'),
(4, 40, 'App\\Models\\User'),
(7, 11, 'App\\Models\\User'),
(8, 11, 'App\\Models\\User'),
(15, 45, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

DROP TABLE IF EXISTS `stations`;
CREATE TABLE IF NOT EXISTS `stations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `station_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`id`, `station_name`, `description`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Kasangati', 'Located along Kasangati Gayaza Road', 'Active', 11, '2021-11-25 20:06:38', '2021-11-25 20:06:38'),
(2, 'Mulago', 'Located along Mulaga Upper Hill road.', 'Active', 11, '2021-11-25 20:07:29', '2021-11-25 21:28:22'),
(3, 'Butabika', 'Its another station in Butabika Kampala', 'Inactive', 11, '2021-11-25 20:07:50', '2021-11-25 21:39:52'),
(4, 'Gulu', 'Located in Gulu city in northern Uganda', 'Active', 11, '2021-11-25 21:37:04', '2021-11-25 21:39:21');

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

DROP TABLE IF EXISTS `suggestions`;
CREATE TABLE IF NOT EXISTS `suggestions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `suggestion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_dept` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suggestions`
--

INSERT INTO `suggestions` (`id`, `suggestion`, `source_dept`, `created_by`, `created_at`, `updated_at`) VALUES
(18, 'jhjbhjhjhjhjhj', 2, 44, '2022-08-23 17:34:18', '2022-08-23 17:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `goods_supplied` text COLLATE utf8mb4_unicode_ci,
  `is_active` int(11) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `suppliers_created_by_foreign` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `tin_number`, `address`, `contact`, `email`, `contact_person`, `goods_supplied`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'ked kays', '104632322', 'KAMPALA', '0705568888', 'ked@ripontechug.co', 'KED KAYS', NULL, NULL, 11, '2022-11-30 07:30:28', '2022-11-30 07:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `terminations`
--

DROP TABLE IF EXISTS `terminations`;
CREATE TABLE IF NOT EXISTS `terminations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `termination_date` date DEFAULT NULL,
  `letter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `terminations_employee_id_foreign` (`employee_id`),
  KEY `terminations_department_id_foreign` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_programs`
--

DROP TABLE IF EXISTS `training_programs`;
CREATE TABLE IF NOT EXISTS `training_programs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `organised_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_length` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `certificate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `training_programs_employee_id_foreign` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_scheme` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `left_sidebar_theme` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `left_sidebar_compact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `declaration` int(2) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_employee_id_foreign` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `emp_id`, `name`, `email`, `email_verified_at`, `password`, `contact`, `title`, `avatar`, `color_scheme`, `left_sidebar_theme`, `left_sidebar_compact`, `created_by`, `is_active`, `declaration`, `remember_token`, `created_at`, `updated_at`) VALUES
(11, 1, 'BRC10000P', 'SUPPORT', 'ict.makbrc@gmail.com', NULL, '$2y$10$O/QUIxcvTYaRLrxuJ9FkMuDxUgh/9jmx2kHfjxYXLp61nS8x20qQe', '0705678987', 'Mr.', 'images/profile/20220724235508.jpg', 'false', NULL, NULL, NULL, '1', 1, 'pJ7tSRGvPKEgPt5DwQ4tOd6eorjdWJS6ik8Pi28OXVOgv5BT585OyvwjwJ1q', '2021-11-11 09:27:21', '2022-08-12 16:28:19'),
(44, 19, 'BRC10001W', 'BASEMERA JOANITAH', 'birungijoanah@gmail.com', NULL, '$2y$10$gVeIRI/FlbLriQfLiqfaZuCeqzyQcfrCuoaDC11qxdSzzMpaX7FRi', '+256701925906', 'Ms.', NULL, NULL, NULL, NULL, 11, '1', 1, '8gUexI7fdG64YlygcLS0Me5SNOl7M3FMEkmCGaKM0f0qvwgFOPwh5t7LAfCz', '2022-08-23 16:51:55', '2022-08-23 16:54:56'),
(45, 20, 'BRC10002x', 'KED KAYS', 'kedkayz@gmail.com', NULL, '$2y$10$q4dfesgVb5bCloyRiDOUi.VKogL/olmi1bTOEAS1tDDKHxM2f62Ti', '+44705568888', 'Mr.', NULL, NULL, NULL, NULL, 11, '1', 1, NULL, '2022-11-28 14:42:55', '2022-11-28 20:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `belongs_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vendors_contact_unique` (`contact`),
  UNIQUE KEY `vendors_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendor_name`, `contact`, `address`, `email`, `belongs_to`, `comment`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'AlgoFlare Technologies LTD', '987665433', 'kampala', 'muytimothy@gmail.com', 'assets', 'An information Technology company', 1, '2021-10-30 11:02:43', '2021-10-30 11:02:43'),
(2, 'Ripon Technologies LTD', '56789543', 'kampala', 'admin@example.com', 'assets', 'I.T company for all services', 1, '2021-10-30 11:03:32', '2021-10-30 11:03:32'),
(3, 'Landsat ICT', '8909876', 'Komambogga', 'admin@ict.com', 'assets', 'Company for both info tech and communication', 1, '2021-10-30 11:04:23', '2021-10-30 11:04:23'),
(4, 'Kumusoft', '89098763', 'Entebbe', 'admin@phpzag.com', 'assets', 'goood software vendor', 1, '2021-10-30 11:54:28', '2021-11-07 07:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `work_experiences`
--

DROP TABLE IF EXISTS `work_experiences`;
CREATE TABLE IF NOT EXISTS `work_experiences` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_held` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_length` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_experiences_employee_id_foreign` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_asset_category_id_foreign` FOREIGN KEY (`asset_category_id`) REFERENCES `asset_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assets_asset_subcategory_id_foreign` FOREIGN KEY (`asset_subcategory_id`) REFERENCES `asset_subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assets_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departmentss` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assets_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stationss` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assets_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `asset_issues`
--
ALTER TABLE `asset_issues`
  ADD CONSTRAINT `asset_issues_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asset_issues_destination_dept_foreign` FOREIGN KEY (`destination_dept`) REFERENCES `departmentss` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asset_issues_source_dept_foreign` FOREIGN KEY (`source_dept`) REFERENCES `departmentss` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asset_issues_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stationss` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `asset_maintenance_info`
--
ALTER TABLE `asset_maintenance_info`
  ADD CONSTRAINT `asset_maintenance_info_authorised_by_foreign` FOREIGN KEY (`authorised_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asset_maintenance_info_internal_vendor_foreign` FOREIGN KEY (`internal_vendor`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asset_maintenance_info_issue_ref_foreign` FOREIGN KEY (`issue_ref`) REFERENCES `asset_issues` (`reference`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asset_maintenance_info_vendor_foreign` FOREIGN KEY (`vendor`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `asset_subcategories`
--
ALTER TABLE `asset_subcategories`
  ADD CONSTRAINT `asset_subcategories_asset_category_id_foreign` FOREIGN KEY (`asset_category_id`) REFERENCES `asset_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assignment_history`
--
ALTER TABLE `assignment_history`
  ADD CONSTRAINT `assignment_history_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_history_from_foreign` FOREIGN KEY (`from`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_history_to_foreign` FOREIGN KEY (`to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banking_information`
--
ALTER TABLE `banking_information`
  ADD CONSTRAINT `banking_information_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department_units`
--
ALTER TABLE `department_units`
  ADD CONSTRAINT `department_units_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department_user`
--
ALTER TABLE `department_user`
  ADD CONSTRAINT `department_user_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departmentss` (`id`),
  ADD CONSTRAINT `department_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `designation_histories`
--
ALTER TABLE `designation_histories`
  ADD CONSTRAINT `designation_histories_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `education_backgrounds`
--
ALTER TABLE `education_backgrounds`
  ADD CONSTRAINT `education_backgrounds_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD CONSTRAINT `emergency_contacts_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_appraisals`
--
ALTER TABLE `employee_appraisals`
  ADD CONSTRAINT `employee_appraisals_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_appraisals_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_warnings`
--
ALTER TABLE `employee_warnings`
  ADD CONSTRAINT `employee_warnings_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_warnings_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exit_interviews`
--
ALTER TABLE `exit_interviews`
  ADD CONSTRAINT `exit_interviews_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exit_interviews_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `family_backgrounds`
--
ALTER TABLE `family_backgrounds`
  ADD CONSTRAINT `family_backgrounds_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grievances`
--
ALTER TABLE `grievances`
  ADD CONSTRAINT `grievances_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grievances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inv-_notifications`
--
ALTER TABLE `inv-_notifications`
  ADD CONSTRAINT `inv__notifications_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `inv_department__items`
--
ALTER TABLE `inv_department__items`
  ADD CONSTRAINT `inv_department__items_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inv_department__items_inv_item_id_foreign` FOREIGN KEY (`inv_item_id`) REFERENCES `inv_items` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `inv_items`
--
ALTER TABLE `inv_items`
  ADD CONSTRAINT `inv_items_inv_store_id_foreign` FOREIGN KEY (`inv_store_id`) REFERENCES `inv_stores` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `inv_items_inv_subunit_id_foreign` FOREIGN KEY (`inv_subunit_id`) REFERENCES `inv_subunits` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inv_items_inv_uom_id_foreign` FOREIGN KEY (`inv_uom_id`) REFERENCES `inv_uoms` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `inv_items_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `inv_requestitems`
--
ALTER TABLE `inv_requestitems`
  ADD CONSTRAINT `inv_requestitems_inv_item_id_foreign` FOREIGN KEY (`inv_item_id`) REFERENCES `inv_items` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inv_requestitems_inv_items_id_foreign` FOREIGN KEY (`inv_items_id`) REFERENCES `inv_department__items` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inv_requestitems_inv_requests_id_foreign` FOREIGN KEY (`inv_requests_id`) REFERENCES `inv_requests` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `inv_requestitems_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `inv_requests`
--
ALTER TABLE `inv_requests`
  ADD CONSTRAINT `inv_requests_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inv_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `inv_stocklevels`
--
ALTER TABLE `inv_stocklevels`
  ADD CONSTRAINT `inv_stocklevels_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inv_stocklevels_inv_items_id_foreign` FOREIGN KEY (`inv_items_id`) REFERENCES `inv_department__items` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inv_stocklevels_inv_store_id_foreign` FOREIGN KEY (`inv_store_id`) REFERENCES `inv_stores` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `inv_stocklevels_inv_supplier_id_foreign` FOREIGN KEY (`inv_supplier_id`) REFERENCES `inv_suppliers` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `inv_stocklevels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `inv_stock_settlements`
--
ALTER TABLE `inv_stock_settlements`
  ADD CONSTRAINT `inv_stock_settlements_borrower_id_foreign` FOREIGN KEY (`borrower_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inv_stock_settlements_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inv_stock_settlements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `inv_userdeparments`
--
ALTER TABLE `inv_userdeparments`
  ADD CONSTRAINT `inv_userdeparments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inv_userdeparments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `leave_balances`
--
ALTER TABLE `leave_balances`
  ADD CONSTRAINT `leave_balances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_balances_leave_id_foreign` FOREIGN KEY (`leave_id`) REFERENCES `leaves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_requests_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_requests_leave_id_foreign` FOREIGN KEY (`leave_id`) REFERENCES `leaves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `official_contracts`
--
ALTER TABLE `official_contracts`
  ADD CONSTRAINT `official_contracts_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `official_contracts_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_contracts`
--
ALTER TABLE `project_contracts`
  ADD CONSTRAINT `project_contracts_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_contracts_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_contracts_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resignations`
--
ALTER TABLE `resignations`
  ADD CONSTRAINT `resignations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resignations_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `terminations`
--
ALTER TABLE `terminations`
  ADD CONSTRAINT `terminations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `terminations_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `training_programs`
--
ALTER TABLE `training_programs`
  ADD CONSTRAINT `training_programs_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_experiences`
--
ALTER TABLE `work_experiences`
  ADD CONSTRAINT `work_experiences_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
