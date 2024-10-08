-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 08, 2024 lúc 09:44 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `maga_translated`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chapter`
--

CREATE TABLE `chapter` (
  `chapter_id` int(11) NOT NULL,
  `chapter_name` varchar(50) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chapter`
--

INSERT INTO `chapter` (`chapter_id`, `chapter_name`, `manga_id`, `update_at`) VALUES
(1, 'Chương 1: Test', 1, '2024-10-05 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `manga`
--

INSERT INTO `manga` (`manga_id`, `manga_name`, `view_number`, `description`, `manga_content`, `type_id`, `marked`, `update_at`, `imgurl`, `author`, `nomination_number`, `trending_id`) VALUES
(1, 'testtttttttttttttttttttttttttttttttttttttttttttttttttttt', 10, 'test', 'test', 1, 0, '2024-10-05 00:00:00', 'assets/image/avatar.jpg', 'admin', 1, NULL),
(2, 'test1annnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', 200, 'test1', 'test1', 1, 0, '2024-10-05 00:00:00', 'assets/image/logo.png', 'admin', 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manga_comment`
--

CREATE TABLE `manga_comment` (
  `comment_id` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manga_completed`
--

CREATE TABLE `manga_completed` (
  `complete_id` int(11) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manga_nomination`
--

CREATE TABLE `manga_nomination` (
  `nomination_id` int(11) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manga_type`
--

CREATE TABLE `manga_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `manga_type`
--

INSERT INTO `manga_type` (`type_id`, `type_name`, `update_at`) VALUES
(1, 'test', '2024-10-05 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `rolename` varchar(20) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trending`
--

CREATE TABLE `trending` (
  `trending_id` int(11) UNSIGNED NOT NULL,
  `trending_name` varchar(50) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `trending`
--

INSERT INTO `trending` (`trending_id`, `trending_name`, `update_at`) VALUES
(1, 'test', '2024-10-06 00:00:00');

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
  ADD KEY `chapter_id` (`chapter_id`);

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
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `chapter`
--
ALTER TABLE `chapter`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `manga`
--
ALTER TABLE `manga`
  MODIFY `manga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `manga_comment`
--
ALTER TABLE `manga_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `manga_completed`
--
ALTER TABLE `manga_completed`
  MODIFY `complete_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `manga_nomination`
--
ALTER TABLE `manga_nomination`
  MODIFY `nomination_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `manga_rate`
--
ALTER TABLE `manga_rate`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `manga_type`
--
ALTER TABLE `manga_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `manga_comment_ibfk_2` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`chapter_id`);

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
