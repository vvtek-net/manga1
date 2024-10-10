-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 10, 2024 lúc 12:51 PM
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
(4, 'nta', '123', 'Tuấn Anh', 2, '2024-10-09 16:59:01'),
(5, 'hdh', '$2y$10$gSPuGrDwOf./VKgeaeAgTuRhQ76lLUegApMOolPJVUy', 'Hà Đình Hoàng', 2, '2024-10-10 15:19:03');

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
(3, 'test20', 10000, 'sdfgsdfg', 'hehe', 2, 0, '2024-10-08 00:00:00', 'assets/image/avatar.jpg', 'admin', 0, 1),
(5, 'Vũ Hi', 0, 'Tôi và dì nhỏ tổ chức lễ tang cho Ban Ban, chôn nó bên cạnh mộ của bố mẹ.\n\nKhông biết tại sao, Cố Minh Huyền lại xuất hiện.\n\nMiệng anh ta nói:\n\n\"Tôi là bác sĩ tâm lý của dì, có nghĩa vụ theo dõi tình trạng của bệnh nhân.\"\n\nĐã từng có thời, Cố Minh Huyền là một \"món ngon\" trong thị trường hẹn hò.\n\nTốt nghiệp trường danh tiếng, ngoại hình không tệ, sau khi tốt nghiệp đã mở được phòng khám tâm lý riêng.\n\nCoi như là một người xuất sắc trong đám đông.\n\nNhưng giờ đây anh ta trông tiều tụy, râu ria lởm chởm, chẳng còn gì liên quan đến hình ảnh người trí thức trung lưu trước kia.\n\nGiọng điệu hạ thấp đến đáng thương.\n\nTôi không chút động lòng:\n\n\"Bác sĩ Cố, không cần anh bận tâm, dì nhỏ đã đi Tây Bắc, nơi có đất trời rộng mở, dân du mục thành kính, gia súc rong ruổi khắp nơi.\"\n\n\"Bà ấy qua việc chiêm ngưỡng đất trời, gặp gỡ chúng sinh, đã buông bỏ quá khứ.\"\n\nĐiều này không phải là lời nói dối.\n\nTrong chuyến du lịch Tây Bắc, dì nhỏ tình cờ gặp đồng hương của người đàn ông đó.\n\n\"Ôi! Năm xưa anh ta rời bỏ cô không hoàn toàn vì cô phải chăm sóc con gái của chị mình đâu.\"\n\n\"Anh ta đã sớm cặp kè với con gái của lãnh đạo địa phương, chỉ là đang tìm lý do để bỏ cô thôi!\"\n\nNgày đó, thông tin không như bây giờ, hai người một ở Nam, một ở Bắc.\n\nMột người quay lưng bỏ đi như viên đá rơi vào biển, mất hút không tăm tích.\n\nNgười đồng hương là một người thích nói chuyện, kể với dì nhỏ:\n\n\"Vài năm trước, anh ta chết vì bệnh. Hình như là bệnh lây qua đường tình dục, dính dáng với nhiều người không trong sạch.\"\n\n\"May mà cô không lấy anh ta, không thì cũng khổ như vợ anh ta bây giờ.\"\n\nDì nhỏ nghe mà ngơ ngác.\n\nNgày xưa, bà đã thần thánh hóa người ấy quá nhiều, bỏ qua vô số dấu hiệu.\n\nNếu một người thực sự yêu bạn, làm sao lại nhẫn tâm bỏ rơi bạn một cách dễ dàng như vậy?\n\nKhi trở về từ chuyến đi, gương mặt dì nhỏ thanh thản:\n\n\"Thật là dại dột, đã lãng phí cả đời cho một kẻ tồi tệ.\"\n\nTôi nắm lấy tay bà:\n\n\"Cháu có bạn quen biết một giáo sư đại học đã nghỉ hưu, dì muốn gặp không?\"\n\nDì nhỏ chọc vào mũi tôi:\n\n\"Được thôi! Coi chừng cháu sẽ làm dì phải \'e thẹn\' đấy.\"\n\nNhìn bà cười đến rơi nước mắt.\n\nKhoảnh khắc đó, tôi biết nút thắt trong lòng dì nhỏ đã hoàn toàn được tháo gỡ.\n', '', 1, 0, '2024-10-10 17:46:49', 'hinh-nen-cun-con-puppy-de-thuong-02.jpg', 'Admin', 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manga_affiliate`
--

CREATE TABLE `manga_affiliate` (
  `aff_id` int(11) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `aff_link` varchar(255) NOT NULL,
  `update_at` date NOT NULL,
  `product_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manga_affiliate`
--

INSERT INTO `manga_affiliate` (`aff_id`, `manga_id`, `aff_link`, `update_at`, `product_name`) VALUES
(5, 2, 'https://s.shopee.vn/1qJu9f2pYa', '2024-10-10', 'Nước tẩy trang');

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
(15, 'Tôi thấy chương này còn hay hơn các chương khác', 3, 2, 2, '2024-10-10 00:32:33'),
(16, 'Hay lắm shop ơi, tuyệt !!', 3, 4, 2, '2024-10-10 11:45:25'),
(17, 'haha', 3, NULL, 2, '2024-10-10 11:47:01'),
(18, 'Tôi mê em đấy lắm', 3, 2, 2, '2024-10-10 11:47:30'),
(19, 'Em ấy tuyệt quá !!', 3, 2, 2, '2024-10-10 11:48:09'),
(20, 'abc', 3, 2, 2, '2024-10-10 12:10:38'),
(21, 'cba', 3, 2, 2, '2024-10-10 12:10:46'),
(22, 'ádf', 3, 2, 2, '2024-10-10 12:10:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manga_completed`
--

CREATE TABLE `manga_completed` (
  `complete_id` int(11) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manga_completed`
--

INSERT INTO `manga_completed` (`complete_id`, `manga_id`, `update_at`) VALUES
(3, 3, '2024-10-10 16:54:22'),
(4, 2, '2024-10-10 16:54:39'),
(8, 1, '2024-10-10 17:38:27');

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
(2, 2, 2, 2, 2, 3, '2024-10-08'),
(3, 2, 3, 2, 3, 3, '2024-10-10'),
(4, 1, 2, 2, 2, 3, '2024-10-10'),
(5, 2, 2, 2, 2, 3, '2024-10-10');

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
(1, 'test2', '2024-10-06 00:00:00');

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
-- Chỉ mục cho bảng `manga_affiliate`
--
ALTER TABLE `manga_affiliate`
  ADD PRIMARY KEY (`aff_id`),
  ADD KEY `manga_id` (`manga_id`);

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
  ADD UNIQUE KEY `uc_manga_id` (`manga_id`),
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
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `chapter`
--
ALTER TABLE `chapter`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `manga`
--
ALTER TABLE `manga`
  MODIFY `manga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `manga_affiliate`
--
ALTER TABLE `manga_affiliate`
  MODIFY `aff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `manga_comment`
--
ALTER TABLE `manga_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `manga_completed`
--
ALTER TABLE `manga_completed`
  MODIFY `complete_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `manga_nomination`
--
ALTER TABLE `manga_nomination`
  MODIFY `nomination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `manga_rate`
--
ALTER TABLE `manga_rate`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Các ràng buộc cho bảng `manga_affiliate`
--
ALTER TABLE `manga_affiliate`
  ADD CONSTRAINT `manga_affiliate_ibfk_1` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`manga_id`);

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
