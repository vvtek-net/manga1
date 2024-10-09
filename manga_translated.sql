-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 09, 2024 lúc 07:34 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `manga_translated`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `acc_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`acc_id`, `username`, `password`, `fullname`, `role_id`, `update_at`) VALUES
(2, 'admin', 'admin', 'full-admin', 1, '2024-10-09 00:00:00'),
(4, 'nta', '123', 'Tuấn Anh', 2, '2024-10-09 16:59:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chapter`
--

CREATE TABLE `chapter` (
  `chapter_id` int(11) NOT NULL,
  `chapter_name` varchar(50) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp(),
  `chapter_content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chapter`
--

INSERT INTO `chapter` (`chapter_id`, `chapter_name`, `manga_id`, `update_at`, `chapter_content`) VALUES
(1, 'Chương 1: Test', 3, '2024-10-05 00:00:00', 'Đây là nội dung bài viết của chapter id 1 và manga id 3'),
(2, 'Chương 2: chapter 2', 3, '2024-10-09 00:00:00', 'Đây là nội dung của chapter 2 và manga 3'),
(3, 'Chương 1: Chapter 1', 1, '2024-10-09 00:00:00', NULL),
(4, 'Chapter 3', 3, '2024-10-09 00:00:00', NULL),
(5, 'Chapter 4', 3, '2024-10-09 00:00:00', '[value-5]');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manga`
--

CREATE TABLE `manga` (
  `manga_id` int(11) NOT NULL,
  `manga_name` varchar(200) NOT NULL,
  `view_number` int(11) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `manga_content` text NOT NULL,
  `type_id` int(11) NOT NULL,
  `marked` tinyint(1) NOT NULL DEFAULT 0,
  `update_at` datetime NOT NULL DEFAULT current_timestamp(),
  `imgurl` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL DEFAULT 'admin',
  `nomination_number` int(11) NOT NULL DEFAULT 0,
  `trending_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manga`
--

INSERT INTO `manga` (`manga_id`, `manga_name`, `view_number`, `description`, `manga_content`, `type_id`, `marked`, `update_at`, `imgurl`, `author`, `nomination_number`, `trending_id`) VALUES
(1, 'testtttttttttttttttttttttttttttttttttttttttttttttttttttt', 10, 'test', 'test', 1, 0, '2024-10-05 00:00:00', 'assets/image/avatar.jpg', 'admin', 1, NULL),
(2, 'test1annnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', 200, 'test1', 'test1', 2, 0, '2024-10-05 00:00:00', 'assets/image/logo.png', 'admin', 0, NULL),
(3, 'test20', 10000, 'sdfgsdfg', 'hehe', 2, 0, '2024-10-08 00:00:00', 'assets/image/avatar.jpg', 'admin', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manga_comment`
--

CREATE TABLE `manga_comment` (
  `comment_id` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `acc_id` int(11) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manga_comment`
--

INSERT INTO `manga_comment` (`comment_id`, `comment`, `manga_id`, `chapter_id`, `acc_id`, `update_at`) VALUES
(2, 'Good', 3, 1, 2, '2024-10-09 00:00:00'),
(3, 'Hayy', 3, 1, 2, '2024-10-09 00:00:00'),
(4, 'a', 3, NULL, 4, '2024-10-09 19:55:11'),
(5, 'Oke', 3, NULL, 4, '2024-10-09 19:56:59'),
(6, 'Hay lắm', 3, NULL, 4, '2024-10-09 19:58:23'),
(7, 'Hay lắm', 3, NULL, 4, '2024-10-09 19:58:32'),
(8, 'Hay lắm', 3, NULL, 4, '2024-10-09 19:58:42'),
(9, 'Tuyệt', 3, NULL, 4, '2024-10-09 19:59:22'),
(10, 'Tuyệt vời', 3, NULL, 4, '2024-10-09 19:59:58'),
(11, 'Tuyệt vời luôn', 3, NULL, 4, '2024-10-09 20:00:15'),
(12, 'ádfasdf', 3, NULL, 2, '2024-10-10 00:15:24'),
(13, 'Đỉnh của chóp', 3, NULL, 2, '2024-10-10 00:16:42'),
(14, 'Chương này đúng tuyệt vời', 3, 1, 2, '2024-10-10 00:20:48'),
(15, 'Tôi thấy chương này còn hay hơn các chương khác', 3, 2, 2, '2024-10-10 00:32:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manga_completed`
--

CREATE TABLE `manga_completed` (
  `complete_id` int(11) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manga_nomination`
--

CREATE TABLE `manga_nomination` (
  `nomination_id` int(11) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manga_nomination`
--

INSERT INTO `manga_nomination` (`nomination_id`, `manga_id`, `update_at`) VALUES
(1, 2, '2024-10-08 16:52:25'),
(2, 2, '2024-10-08 16:52:52'),
(3, 1, '2024-10-08 17:20:01'),
(4, 3, '2024-10-09 18:42:28'),
(5, 3, '2024-10-09 18:45:58'),
(6, 3, '2024-10-09 18:46:19'),
(7, 3, '2024-10-09 18:46:21'),
(8, 3, '2024-10-09 18:46:24'),
(9, 3, '2024-10-09 18:51:29'),
(10, 2, '2024-10-09 18:51:41'),
(11, 2, '2024-10-09 18:51:44'),
(12, 2, '2024-10-09 18:51:47'),
(13, 2, '2024-10-09 18:51:50'),
(14, 2, '2024-10-09 18:51:52'),
(15, 2, '2024-10-09 18:51:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manga_rate`
--

CREATE TABLE `manga_rate` (
  `rate_id` int(11) NOT NULL,
  `rate_character_personality` int(11) DEFAULT NULL,
  `rate_plot_content` int(11) DEFAULT NULL,
  `rate_world_layout` int(11) DEFAULT NULL,
  `rate_translation_quality` int(11) DEFAULT NULL,
  `manga_id` int(11) DEFAULT NULL,
  `update_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manga_rate`
--

INSERT INTO `manga_rate` (`rate_id`, `rate_character_personality`, `rate_plot_content`, `rate_world_layout`, `rate_translation_quality`, `manga_id`, `update_at`) VALUES
(1, 1, 1, 1, 1, 3, '2024-10-08'),
(2, 2, 2, 2, 2, 3, '2024-10-08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manga_type`
--

CREATE TABLE `manga_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manga_type`
--

INSERT INTO `manga_type` (`type_id`, `type_name`, `update_at`) VALUES
(1, 'test15', '2024-10-05 00:00:00'),
(2, 'test1', '2024-10-08 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `rolename` varchar(20) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`role_id`, `rolename`, `update_at`) VALUES
(1, 'admin', '2024-10-09 00:00:00'),
(2, 'user', '2024-10-09 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trending`
--

CREATE TABLE `trending` (
  `trending_id` int(11) UNSIGNED NOT NULL,
  `trending_name` varchar(50) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `trending`
--

INSERT INTO `trending` (`trending_id`, `trending_name`, `update_at`) VALUES
(1, 'test10', '2024-10-06 00:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Chỉ mục cho bảng `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`chapter_id`),
  ADD KEY `manga_id` (`manga_id`);

--
-- Chỉ mục cho bảng `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`manga_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `fk_trending` (`trending_id`);

--
-- Chỉ mục cho bảng `manga_comment`
--
ALTER TABLE `manga_comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `manga_id` (`manga_id`),
  ADD KEY `chapter_id` (`chapter_id`),
  ADD KEY `manga_comment_ibfk_3` (`acc_id`);

--
-- Chỉ mục cho bảng `manga_completed`
--
ALTER TABLE `manga_completed`
  ADD PRIMARY KEY (`complete_id`),
  ADD KEY `manga_id` (`manga_id`);

--
-- Chỉ mục cho bảng `manga_nomination`
--
ALTER TABLE `manga_nomination`
  ADD PRIMARY KEY (`nomination_id`),
  ADD KEY `manga_id` (`manga_id`);

--
-- Chỉ mục cho bảng `manga_rate`
--
ALTER TABLE `manga_rate`
  ADD PRIMARY KEY (`rate_id`),
  ADD KEY `manga_id` (`manga_id`);

--
-- Chỉ mục cho bảng `manga_type`
--
ALTER TABLE `manga_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Chỉ mục cho bảng `trending`
--
ALTER TABLE `trending`
  ADD PRIMARY KEY (`trending_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `chapter`
--
ALTER TABLE `chapter`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `manga`
--
ALTER TABLE `manga`
  MODIFY `manga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `manga_comment`
--
ALTER TABLE `manga_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `manga_completed`
--
ALTER TABLE `manga_completed`
  MODIFY `complete_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `manga_nomination`
--
ALTER TABLE `manga_nomination`
  MODIFY `nomination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `manga_rate`
--
ALTER TABLE `manga_rate`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `manga_type`
--
ALTER TABLE `manga_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Các ràng buộc cho bảng `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `chapter_ibfk_1` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`manga_id`);

--
-- Các ràng buộc cho bảng `manga`
--
ALTER TABLE `manga`
  ADD CONSTRAINT `fk_trending` FOREIGN KEY (`trending_id`) REFERENCES `trending` (`trending_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `manga_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `manga_type` (`type_id`);

--
-- Các ràng buộc cho bảng `manga_comment`
--
ALTER TABLE `manga_comment`
  ADD CONSTRAINT `manga_comment_ibfk_1` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`manga_id`),
  ADD CONSTRAINT `manga_comment_ibfk_2` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`chapter_id`),
  ADD CONSTRAINT `manga_comment_ibfk_3` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`);

--
-- Các ràng buộc cho bảng `manga_completed`
--
ALTER TABLE `manga_completed`
  ADD CONSTRAINT `manga_completed_ibfk_1` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`manga_id`);

--
-- Các ràng buộc cho bảng `manga_nomination`
--
ALTER TABLE `manga_nomination`
  ADD CONSTRAINT `manga_nomination_ibfk_1` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`manga_id`);

--
-- Các ràng buộc cho bảng `manga_rate`
--
ALTER TABLE `manga_rate`
  ADD CONSTRAINT `manga_rate_ibfk_1` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`manga_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
