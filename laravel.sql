-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 25, 2022 lúc 05:53 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_profiles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2022_02_23_152923_create_sessions_table', 1),
(8, '2022_02_24_112036_change_username_login', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ducanh24072000@gmail.com', '$2y$10$pGt7MRC1iR9lMCR.yac9p.ejGfz9SKXOTkjLD9pOjfflgML1KPzF6', '2022-02-25 09:34:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `date_of_birth`, `nickname`, `username`, `email`, `description`, `avatar`, `address`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 'Em. Lư Yên Nhàn', '1970-01-01', 'pariatur', 'consequuntur', 'mla@bang.com', 'Consequuntur at pariatur ut autem natus maiores.', 'qui', 'consequatur', '(0165) 983 7122', '2022-02-23 15:41:06', '2022-02-23 15:41:06'),
(8, 'Huỳnh Sơn Chương', '1970-01-01', 'repudiandae', 'veritatis', 'lngan@hotmail.com', 'Non sit voluptatem ea porro libero ullam.', 'natus', 'quam', '(0651)166-7172', '2022-02-23 15:41:06', '2022-02-23 15:41:06'),
(11, 'Nhữ Nhung', '1970-01-01', 'vel', 'tenetur', 'hung.thao@gmail.com', 'Unde repellat a in quo labore dolore qui.', 'ad', 'itaque', '+84-231-927-2700', '2022-02-25 13:57:21', '2022-02-25 13:57:21'),
(12, 'Bác. Khổng Thoại', '1970-01-01', 'impedit', 'nihil', 'pdinh@to.com', 'Facere distinctio et quis consequatur et inventore repudiandae.', 'odit', 'est', '(0230)784-6215', '2022-02-25 13:57:21', '2022-02-25 13:57:21'),
(13, 'Hứa Thục', '1970-01-01', 'et', 'impedit', 'hao91@hotmail.com', 'Quis quo inventore optio omnis consectetur et excepturi.', 'eos', 'vitae', '0500-039-3491', '2022-02-25 13:57:21', '2022-02-25 13:57:21'),
(14, 'Vi Phương', '1970-01-01', 'numquam', 'alias', 'cat.ly@hotmail.com', 'Corrupti ea qui veniam consequatur.', 'corporis', 'et', '+84-90-866-4612', '2022-02-25 13:57:21', '2022-02-25 13:57:21'),
(16, 'Bá Phụng Ngọc', '1970-01-01', 'nulla', 'qui', 'trang26@tao.org.vn', 'Consequatur omnis ea soluta.', 'autem', 'eligendi', '(0241) 722 2156', '2022-02-25 13:57:21', '2022-02-25 13:57:21'),
(17, 'Thịnh Hà Tráng', '1970-01-01', 'sapiente', 'iure', 'vtra@yahoo.com', 'Molestiae quisquam animi nulla ullam aliquid aperiam commodi.', 'iure', 'esse', '0510 294 4506', '2022-02-25 13:57:21', '2022-02-25 13:57:21'),
(18, 'Đinh Trực', '1970-01-01', 'consequatur', 'beatae', 'an.hanh@hotmail.com', 'Doloremque id perferendis dolorem dolores.', NULL, 'optio', '0219-295-7179', '2022-02-25 13:57:21', '2022-02-25 15:03:07'),
(19, 'Lô Sao Hoàn', '1970-01-01', 'veritatis', 'et', 'chau12@yahoo.com', 'Nulla et nam sunt sed sit est.', 'asperiores', 'quia', '(099) 406 1275', '2022-02-25 13:57:21', '2022-02-25 13:57:21'),
(20, 'Đỗ Niệm Đức', '1970-01-01', 'impedit', 'necessitatibus', 'chien.khau@hotmail.com', 'Commodi soluta architecto et aut quo accusamus accusantium.', 'quia', 'ipsum', '(077) 075 0044', '2022-02-25 13:57:21', '2022-02-25 13:57:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6FSoMZTQR2bnjoHY2HhWVnxTKwgKe0uG6XZWhxH1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0M3NUZhT0ZGMkZQR1JmRFExSDdXa2tHSGREM3ZjQ2RaRXlEZEFjayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1645806828),
('AmJ4uyXYkV1Bk8bsx7G0yBgXeeWJHYekWTURbm9A', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoieW5DbG9uSG5PajNCcDlTQk1qc2tZUWFLQ0c3WGpZaDMzcGZyQ1k2bSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNjQ1ODAyNzYwO31zOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJGFiNVVVUzV1VUJaeTV3MzFueVRmME92LnprL2ZGMDNNVXhtbmZFSnBncHFJZ2VhNlVUd0R1Ijt9', 1645806835),
('gBZg0LUsayBTJ7oUaQnByi1dpNetUX4G97mHL729', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicENZeGhWVjR4cUdqeUVTWk13NUwwekxNYWd0NTdiOGVScmxXREpzRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1645799330),
('JuceNklw4OT48vKRidX9C9Gqhj39ax9Pj9CI7ffB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib1Z4aU1SemRVZHVKYWlWNkdodlhidlZiZklGeEh6a1BiOHlDSEd1diI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1645807900);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username_login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username_login`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Đức Anh', 'ducanh24072000@gmail.com', NULL, '$2y$10$xEwYp69wOGLlp9Nu4X.cOu3BPj3CVkIBVhZOJd.UjRbjDDm/AbC.6', NULL, NULL, '21vXSkdx39AR03zI3J1mFNPRALd4FH8FKEGPsdH6BVk6vl7FLmiE1Xx3fyIg', NULL, NULL, '2022-02-23 08:56:33', '2022-02-23 21:55:51'),
(2, 'anhkatori', 'anhdoraemon2k@gmail.com', NULL, '$2y$10$ab5UUS5uUBZy5w31nyTf0Ov.zk/fF03MUxmnfEJpgpqIgea6UTwDu', NULL, NULL, NULL, NULL, NULL, '2022-02-24 08:45:33', '2022-02-24 08:45:33'),
(3, 'gfsdgsdg', '100033836532239@gmail.com', NULL, '$2y$10$HRW5lGE5iRDp1tmAiH/TSurteQZyPxUO3jwq0NwbZUEEalBPMMZLu', NULL, NULL, NULL, NULL, NULL, '2022-02-25 09:51:08', '2022-02-25 09:51:08');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profiles_email_unique` (`email`),
  ADD UNIQUE KEY `profiles_phone_number_unique` (`phone_number`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
