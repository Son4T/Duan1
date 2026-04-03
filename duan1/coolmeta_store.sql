-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 01, 2026 at 07:05 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coolmeta_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `cate_name` varchar(255) NOT NULL,
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cate_name`, `type`) VALUES
(1, 'Áo sơ mi', 'Áo'),
(2, 'Áo jacket', 'Áo'),
(3, 'Áo blazer', 'Áo'),
(4, 'Quần tây', 'Quần'),
(5, 'Quần short', 'Quần'),
(6, 'Quần khaki', 'Quần'),
(7, 'Quần Jeans', 'Quần'),
(8, 'Tất', 'Phụ Kiện'),
(9, 'Dây lưng', 'Phụ Kiện'),
(10, 'Ví da', 'Phụ Kiện'),
(11, 'Cà vạt', 'Phụ Kiện'),
(12, 'Giày', 'Phụ Kiện');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'sản phẩm rất đẹp!!', '2024-12-04 18:42:09', '2024-12-04 18:42:09'),
(4, 3, 11, 'Tốt', '2025-12-19 06:12:11', '2025-12-19 06:12:11');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `status` enum('pending','in transit','completed','canceled') DEFAULT 'pending',
  `payment_method` enum('cash','card','online') DEFAULT 'cash',
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `payment_method`, `total_price`, `created_at`) VALUES
(6, 1, 'canceled', 'cash', 690000.00, '2024-12-04 15:56:27'),
(7, 1, 'pending', 'cash', 427000.00, '2024-12-05 02:16:27'),
(8, 11, 'pending', 'cash', 20000.00, '2025-12-19 06:00:10'),
(9, 11, 'in transit', 'cash', 1208000.00, '2025-12-19 06:10:47'),
(10, 11, 'pending', 'cash', 550000.00, '2025-12-19 07:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`) VALUES
(9, 6, 2, 'Áo sơ mi - AS240043D', 690000.00, 1),
(10, 7, 1, 'Áo sơ mi - AS230655D', 427000.00, 1),
(12, 9, 3, 'Áo sơ mi - AS220145D', 588000.00, 1),
(13, 9, 4, 'Áo sơ mi - AS220136D', 620000.00, 1),
(14, 10, 9, 'Dây lưng - BELT232627', 550000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(25,2) DEFAULT NULL,
  `description` text,
  `content` text,
  `type` varchar(10) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `category_id` int NOT NULL,
  `view` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `description`, `content`, `type`, `status`, `category_id`, `view`, `created_at`) VALUES
(1, 'Áo sơ mi - AS230655D', 'Assets/Admin/Uploads/674f6fcd2f64e6.92026083.png', 427000.00, 'Áo sơ mi dài tay, kiểu dáng Slim Fit dễ mặc, hợp form dáng.\r\nMàu sắc và kiểu dáng trẻ trung, kiểu dáng hiện đại, dễ phối đồ.\r\nChất liệu: 50% Bamboo, 50% Polyester', 'Áo sơ mi đẹp giá tốt', 'Áo', 'active', 1, 112, '2024-12-03 20:53:33'),
(2, 'Áo sơ mi - AS240043D', 'Assets/Admin/Uploads/674f703b773a16.91679962.png', 690000.00, 'Áo sơ mi đẹp giá tốt', 'Áo sơ mi đẹp giá tốt', 'Áo', 'active', 1, 14, '2024-12-03 20:55:23'),
(3, 'Áo sơ mi - AS220145D', 'Assets/Admin/Uploads/674f707eef7d10.84008632.png', 588000.00, 'Áo sơ mi dài tay, kiểu dáng Slim Fit dễ mặc, hợp form dáng.\r\nMàu sắc trẻ trung, kiểu dáng hiện đại, dễ phối đồ.\r\nChất liệu Bamboo mịn mát từ vải sợi tre thân thiện môi trường.', 'Áo sơ mi đẹp giá tốt', 'Áo', 'active', 1, 19, '2024-12-03 20:56:30'),
(4, 'Áo sơ mi - AS220136D', 'Assets/Admin/Uploads/674f74b6da88c7.50521595.png', 620000.00, 'Áo sơ mi dài tay, kiểu dáng Slim Fit dễ mặc, hợp form dáng.\r\nMàu sắc và kiểu dáng trẻ trung, kiểu dáng hiện đại, dễ phối đồ.\r\nChất liệu Bamboo mịn mát từ vải sợi tre thân thiện môi trường.', 'Áo sơ mi dài tay, kiểu dáng Slim Fit dễ mặc, hợp form dáng.', 'Áo', 'active', 1, 2, '2024-12-03 21:14:30'),
(5, 'Quần tây - QST242826', 'Assets/Admin/Uploads/674f7c5373deb0.41551657.png', 730000.00, 'Quần tây chất liệu: 100% Polyester Nano\r\nForm slim fit có tăng đơ tôn dáng người mặc. \r\nMàu sắc trung tính dễ phối đồ.', 'Quần tây chất liệu: 100% Polyester Nano', 'Quần', 'active', 4, 0, '2024-12-03 21:46:59'),
(6, 'Quần tây - QST242408', 'Assets/Admin/Uploads/674f7ca78456b3.79251092.png', 650000.00, 'Quần tây chất liệu: 70% Polyester, 27% Rayon, 3% Spandex\r\nForm slimfit có tăng đơ tôn dáng người mặc. \r\nMàu sắc trung tính dễ phối đồ.', 'Quần tây chất liệu: 70% Polyester, 27% Rayon, 3% Spandex', 'Quần', 'active', 4, 0, '2024-12-03 21:48:23'),
(7, 'Quần tây - QST231255', 'Assets/Admin/Uploads/674f7ce8570726.17232082.png', 700000.00, 'Quần tây chất liệu: 27% Rayon, 70% Polyester, 3% Spandex\r\nForm slim fit có tăng đơ tôn dáng người mặc. \r\nMàu sắc trung tính dễ phối đồ.', 'Quần tây chất liệu: 27% Rayon, 70% Polyester, 3% Spandex', 'Quần', 'active', 4, 0, '2024-12-03 21:49:28'),
(8, 'Quần tây - QST231240', 'Assets/Admin/Uploads/674f7d2b526868.86794050.png', 490000.00, 'Quần tây chất liệu: Nano\r\nForm slim fit có tăng đơ ôm dáng người mặc. \r\nMàu sắc trung tính dễ phối đồ.', 'Quần tây chất liệu: Nano', 'Quần', 'active', 4, 0, '2024-12-03 21:50:35'),
(9, 'Dây lưng - BELT232627', 'Assets/Admin/Uploads/674f7d95086ce9.35094827.png', 550000.00, 'Chất liệu: PU Leather', 'Chất liệu: PU Leather', 'Phụ Kiện', 'active', 9, 2, '2024-12-03 21:52:21'),
(10, 'Thắt lưng - BELT220593', 'Assets/Admin/Uploads/674f7dd5667e30.21169641.png', 495000.00, 'Chất liệu 100% da thật, tone màu nâu lịch lãm, sang trọng, dễ dàng phối tạo nên phong cách thanh lịch.', 'Chất liệu 100% da thật, tone màu nâu lịch lãm, sang trọng, dễ dàng phối tạo nên phong cách thanh lịch.', 'Phụ Kiện', 'active', 9, 0, '2024-12-03 21:53:25'),
(13, 'Áo Sơ Mi- AS220121A', 'Assets/Admin/Uploads/6944edd3ccc130.56929107.jpg', 2000000.00, 'Chất liệu: \r\n75% Cotton thoáng khí, thấm mồ hôi vượt trội và thân thiện với làn da\r\n25% Tencel giúp vải mềm mát, thoáng khí, ít co rút khi sử dụng\r\nPhối với:\r\nÁo sơ mi này dễ dàng phối với quần âu, quần jeans, hoặc áo khoác casual.\r\nPhù hợp với nhiều dịp khác nhau như đi làm, tham dự sự kiện, hoặc đi chơi.', 'Thiết kế:\r\nÁo sơ mi dài tay phom dáng Brezza suông rộng mang đến một làn gió mới cho phong cách thời trang của quý ông.\r\nÁo thiết kế cổ tàu, không có túi ngực đơn giản', 'Áo', 'active', 1, 0, '2025-12-19 06:13:50'),
(14, 'Quần kaki-QST242824', 'Assets/Admin/Uploads/6944ede376f5c0.30092334.jpg', 600000.00, 'Đặc điểm nổi bật:\r\n\r\nChất liệu: kaki 4 chiều cao cấp, bề mặt mịn, thoáng khí\r\n\r\nThiết kế: Form đứng tôn dáng, đường may chắc chắn, hiện đại.\r\n\r\nCạp quần vừa vặn, dễ phối với thắt lưng.\r\n\r\nMàu sắc: Xám tiêu trăng, Đen, Xám tiêu đen phù hợp mọi tone da.\r\n\r\nCo giãn mạnh di chuyển linh hoạn, không gò bó.\r\n\r\nPhong cách: Công sở, dạo phố, hẹn hò, đi chơi', 'Quần Tây Nam Kaki Co Giãn Nhẹ Form Đứng coolmeta Lịch Lãm. Mang phong cách basic lịch sự, chiếc quần tây nam coolmeta là lựa chọn hoàn hảo cho các chàng trai theo đuổi sự gọn gàng, tinh tế, thoải mái. Thiết kế thiết kế ống đứng, vải kaki mềm độ co giãn cực cao, dễ dàng phối cùng áo sơ mi hoặc áo thun.', 'Quần', 'active', 7, 0, '2025-12-19 06:15:30'),
(15, 'Quần Khaki Ống Suông Co Giãn', 'Assets/Admin/Uploads/6944ee6a7590b7.01997399.jpg', 600000.00, 'Với thiết kế basic không kém phần hiện đại . Một item mà bạn có thể mặc phối với các kiểu áo của bạn từ áo thun, đến những mẫu áo sơ mi mà bạn yêu thích\r\n\r\nChất vải kaki co giãn 4 chiều với mật độ sợi cotton lên tới 98.4% mang lại cảm giác mát mẻ , thâm hút mồ hôi cực tốt.\r\n\r\nMột item mà không thể thiếu được trong tủ đồ của bạn phù hợp cả đi làm và đi chơi.\r\n\r\nĐường may tỉ mỉ , siêu nét.', 'Quần Ống Suông coolmeta:\r\n\r\nChất Liệu : Kaki Fabric composition 98.4% cotton 1.6% sp\r\nĐộ co giãn : 4 chiều.\r\nMàu : xám muối tiêu.\r\nForm : Slim , ống đứng.\r\nĐặc Điểm:', 'Quần', 'active', 6, 0, '2025-12-19 06:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `address` text,
  `status` enum('active','banned') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `phone`, `role`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Vũ Tiến Thành', 'tienthanh1025@gmail.com', '$2y$10$OesPT1y.eoJNhrC6hDr12emQibJZH/S.RiQ3onRmGLwYmPUh3u4Ru', '0395386692', 'admin', '', 'active', '2024-12-03 13:47:04', '2025-12-10 19:34:16'),
(10, 'thanh32', 'admin@1231gmail.com', '$2y$10$zwhHdxUMWTfy8jxi4qh74O0rszLQhUVH5orBvK0m9ObSP.aaTmfSG', '0333332211', 'user', 'hanoi', 'active', '2025-12-10 13:21:06', '2025-12-10 13:21:06'),
(11, 'TienThanh', 'tienthanh10@gmail.com', '$2y$10$TTkUtBafI50mFKa3Sq4G0OP6rE2/ey673f7X/5rNQWenhcPJAaaua', '0395386692', 'user', 'HaiPhong', 'active', '2025-12-18 22:49:20', '2025-12-18 22:49:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
