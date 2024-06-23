-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql
-- 生成日時: 2024 年 6 月 23 日 21:21
-- サーバのバージョン： 8.0.32
-- PHP のバージョン: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `household_app`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `failed_jobs`
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
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(29, '2024_03_20_072622_create_projects-table', 1),
(63, '2014_10_12_000000_create_users_table', 2),
(64, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(65, '2019_08_19_000000_create_failed_jobs_table', 2),
(66, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(67, '2024_01_31_165706_create_articles_table', 2),
(68, '2024_02_26_073827_create_projects_table', 2),
(69, '2024_02_26_183937_create_tasks_table', 2),
(70, '2024_03_20_073052_create_spendings_table', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `personal_access_tokens`
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

-- --------------------------------------------------------

--
-- テーブルの構造 `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `project_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `project_name`, `created_at`, `updated_at`) VALUES
(73, 1, '１月', '2024-06-14 07:43:38', '2024-06-14 07:43:38'),
(74, 2, '１月', '2024-06-15 07:46:07', '2024-06-15 07:46:07'),
(75, 2, '２月', '2024-06-15 08:21:37', '2024-06-15 08:21:37'),
(76, 2, '３月', '2024-06-15 10:05:39', '2024-06-15 10:05:39'),
(77, 2, '４月', '2024-06-16 08:37:52', '2024-06-16 08:37:52'),
(78, 2, '５月', '2024-06-17 17:09:05', '2024-06-17 17:09:05');

-- --------------------------------------------------------

--
-- テーブルの構造 `spendings`
--

CREATE TABLE `spendings` (
  `id` bigint UNSIGNED NOT NULL,
  `task_id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `spending_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` date NOT NULL,
  `spending_amount` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `spending_category` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `spendings`
--

INSERT INTO `spendings` (`id`, `task_id`, `project_id`, `spending_name`, `due_date`, `spending_amount`, `created_at`, `updated_at`, `spending_category`) VALUES
(78, 105, 74, 'パン', '2024-06-21', 5500, '2024-06-20 07:39:16', '2024-06-21 17:37:51', '食費'),
(80, 106, 74, 'ガス', '2024-06-22', 6000, '2024-06-20 07:39:56', '2024-06-20 07:39:56', '光熱費');

-- --------------------------------------------------------

--
-- テーブルの構造 `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `spending_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` date NOT NULL,
  `spending_amount` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `spending_name`, `due_date`, `spending_amount`, `created_at`, `updated_at`) VALUES
(104, 73, '食費', '2024-06-21', 0, '2024-06-14 07:43:51', '2024-06-14 07:43:51'),
(105, 74, '食費', '2024-06-16', 0, '2024-06-15 07:46:16', '2024-06-15 07:46:16'),
(106, 74, '光熱費', '2024-06-19', 0, '2024-06-15 08:11:40', '2024-06-15 08:11:40'),
(107, 75, '食費', '2024-06-21', 0, '2024-06-15 09:11:09', '2024-06-15 09:11:09'),
(108, 75, '光熱費', '2024-06-20', 0, '2024-06-15 09:13:45', '2024-06-15 09:13:45'),
(109, 76, '食費', '2024-06-22', 0, '2024-06-15 10:05:45', '2024-06-15 10:05:45'),
(110, 77, '食費', '2024-06-18', 0, '2024-06-16 08:37:58', '2024-06-16 08:37:58'),
(111, 77, '交際費', '2024-06-17', 0, '2024-06-16 10:00:15', '2024-06-16 10:00:15'),
(112, 77, '光熱費', '2024-06-19', 0, '2024-06-16 10:01:49', '2024-06-16 10:01:49'),
(113, 78, '食費', '2024-06-18', 0, '2024-06-17 17:09:18', '2024-06-17 17:09:18'),
(114, 78, '光熱費', '2024-06-18', 0, '2024-06-17 17:55:04', '2024-06-17 17:55:04'),
(115, 74, '食費', '2024-06-20', 0, '2024-06-17 18:05:59', '2024-06-17 18:05:59'),
(116, 74, '雑費', '2024-06-18', 0, '2024-06-17 18:07:52', '2024-06-17 18:07:52'),
(117, 77, '雑費', '2024-06-19', 0, '2024-06-18 07:38:41', '2024-06-18 07:38:41'),
(118, 77, '通信費', '2024-06-19', 0, '2024-06-18 18:53:52', '2024-06-18 18:53:52');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
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
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@test.test', NULL, '$2y$12$NqbFNSMPOOvuV0F6I00h.uR4aoQCPHQCW0PfJVuwy/Hndq4bTjR0q', NULL, '2024-03-22 17:42:45', '2024-03-22 17:42:45'),
(2, 'こたろう', 'ke1_hat1_an@yahoo.co.jp', NULL, '$2y$12$nkKfgLWI.yU0YiJNsujBo.ylc4PlIXDUQulG4dExF44mEY61O6.ni', NULL, '2024-05-21 07:17:14', '2024-05-21 07:17:14');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- テーブルのインデックス `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- テーブルのインデックス `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_user_id_foreign` (`user_id`);

--
-- テーブルのインデックス `spendings`
--
ALTER TABLE `spendings`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `spending_category` (`id`) USING BTREE;

--
-- テーブルのインデックス `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- テーブルの AUTO_INCREMENT `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- テーブルの AUTO_INCREMENT `spendings`
--
ALTER TABLE `spendings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- テーブルの AUTO_INCREMENT `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
