-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 23, 2024 lúc 03:37 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bookstore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int(3) NOT NULL,
  `adminname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mypassword` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `adminname`, `email`, `mypassword`, `created_at`) VALUES
(1, 'owner', 'owner@bookstore.com', '$2y$10$PGf/nJTnLop4SnW7OA529OaMaNZw99ilvb0ylYlXqa9VwkOiq2gGC', '2024-09-21 14:41:11'),
(2, 'admin', 'admin@bookstore.com', '$2y$10$PGf/nJTnLop4SnW7OA529OaMaNZw99ilvb0ylYlXqa9VwkOiq2gGC', '2024-09-22 15:00:29'),
(4, 'support', 'support@bookstore.com', '$2y$10$0jhCIhAxg7yKs65xg.Xdqu1.YNUy6ITwWysuwU.abGu5Cgz94Kv.C', '2024-09-23 09:53:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(3) NOT NULL,
  `pro_id` int(3) NOT NULL,
  `pro_name` varchar(200) NOT NULL,
  `pro_image` varchar(200) NOT NULL,
  `pro_price` int(3) NOT NULL,
  `pro_amount` int(3) NOT NULL,
  `pro_discount` int(3) NOT NULL,
  `pro_file` varchar(200) NOT NULL,
  `user_id` int(3) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(3) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `created_at`) VALUES
(20, 'C#', 'C# từ cơ bản đến nâng cao', 'csharp.jpg', '2024-09-23 12:16:12'),
(21, 'Mạng máy tính', 'Mạng máy tính từ cơ bản đến nâng cao', 'mangmaytinh.jpg', '2024-09-23 12:16:32'),
(22, 'Thị giác máy tính và Xử lý ảnh', 'OpenCV - 1 thư viện mã nguồn mở dành cho thị giác máy tính và xử lý ảnh', 'opencv.jpeg', '2024-09-23 12:18:25'),
(23, 'PHP', 'Lập trình web bằng PHP cho người mới bắt đầu', 'php.jpg', '2024-09-23 12:19:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(3) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `price` varchar(20) NOT NULL,
  `user_id` int(3) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `email`, `username`, `fname`, `lname`, `token`, `price`, `user_id`, `create_at`) VALUES
(72, 'sakazuki168@gmail.com', 'dat2k', 'Nguyen Huu', 'Thanh Dat', 'tok_1Q2Bey04BuTMBXtcdZw3qRBX', '45', 13, '2024-09-23 12:46:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(3) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` int(3) NOT NULL,
  `discount` int(3) NOT NULL,
  `file` text NOT NULL,
  `description` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `category_id` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `discount`, `file`, `description`, `status`, `category_id`, `created_at`) VALUES
(1, 'C#', 'csharp.jpg', 50, 10, 'Csharp.pdf', 'Học lập trình C# căn bản', 1, 20, '2024-09-23 12:24:03'),
(2, 'An Toàn và Bảo Mật Thông Tin', 'mangmaytinh.jpg', 50, 15, 'An Toàn Và Bảo Mật Thông Tin - Đại Học Hàng Hải.pdf', 'Giáo trình AT&BMTT của Đại học Hàng Hải', 1, 21, '2024-09-23 12:26:37'),
(3, 'Giới Thiệu TCP-IP', 'mangmaytinh-1.jpg', 10, 0, 'ATHENA GioiThieu TCP-IP.pdf', 'Tài liệu của ATHENA Academy', 1, 21, '2024-09-23 12:27:53'),
(4, 'Learning OpenCV in C++', 'opencv.jpeg', 40, 15, 'Learning OpenCV - Computer Vision in C++ with the OpenCV Library.pdf', 'Learning OpenCV - Computer Vision in C++ with the OpenCV Library', 1, 22, '2024-09-23 12:30:17'),
(5, 'PHP Căn bản', 'php.jpg', 40, 10, '[Giáo Trình] Căn bản PHP.pdf', 'Lập trình PHP cho người mới bắt đầu', 1, 23, '2024-09-23 12:31:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mypassword` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `mypassword`, `created_at`) VALUES
(13, 'dat2k', 'sakazuki168@gmail.com', '$2y$10$Q5AcKDqY.T1f1yDm6ciOTuSLGCpfN9bCdqVzNNZFaStdEgI0uSa3S', '2024-09-23 12:45:55');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
