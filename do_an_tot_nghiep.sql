-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 24, 2020 lúc 06:41 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `do_an_tot_nghiep`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dieu_kien_canh_tac`
--

CREATE TABLE `dieu_kien_canh_tac` (
  `id` int(11) NOT NULL,
  `rau_id` int(11) NOT NULL,
  `ten_dieu_kien` text DEFAULT NULL,
  `dieu_kien` text DEFAULT NULL,
  `deleted_at` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `dieu_kien_canh_tac`
--

INSERT INTO `dieu_kien_canh_tac` (`id`, `rau_id`, `ten_dieu_kien`, `dieu_kien`, `deleted_at`, `created_at`) VALUES
(3, 12, 'Thời gian thu hoạch', '>10 ngày', 0, '2020-04-04 13:52:20'),
(4, 12, 'ngày canh tác', '20 ngày', 0, '2020-04-11 04:39:22'),
(14, 13, 'Thời gian thu hoạch', 'tối đa 20 days', 0, '2020-04-19 04:02:57'),
(15, 13, 'độ ẩm ', '100ph', 0, '2020-04-19 04:02:57'),
(16, 9, 'độ ẩm ', '12ph', 0, '2020-04-19 05:12:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rau`
--

CREATE TABLE `rau` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `nha_cung_cap` varchar(200) DEFAULT NULL,
  `image_giong` varchar(200) DEFAULT NULL,
  `ngay_trong` date DEFAULT NULL,
  `deleted_at` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `provide_location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `rau`
--

INSERT INTO `rau` (`id`, `name`, `nha_cung_cap`, `image_giong`, `ngay_trong`, `deleted_at`, `created_at`, `price`, `number`, `provide_location`) VALUES
(1, 'Rau muống', 'Văn phòng phẩm ABC , 123 võ văn Ngân', 'rau_muong.jpg', '2020-03-29', 0, '2020-03-29 09:24:09', 4000, 2, NULL),
(2, 'Rau mướp', 'Phong lan 23 Lê lợi', 'muop.png', '2020-03-30', 0, '2020-03-29 09:44:05', 10000, 1, NULL),
(3, 'Rau hoa chuối', 'Nhà a 46 Phạm Văn Đồng', 'hoa_chuoi.jpg', '2020-03-30', 0, '2020-03-29 09:47:10', 12000, 2, NULL),
(4, 'aaaa', '122 ', 'adven.jpg', '2020-03-30', 0, '2020-03-29 09:49:31', 3500000, 1, NULL),
(5, 'âq23', '122 aaa', 'zi_dat.png', '2020-03-30', 1, '2020-03-29 09:50:05', 3000000, 1, NULL),
(6, '12A', 'Văn phòng phẩm ABC , 123 võ văn Ngân', '9_ro.jpg', '2020-02-02', 0, '2020-03-29 09:50:43', 3500000, 1, NULL),
(7, 'rau dền', '123 nguyễn trãi', '3_chuon.jpg', '2020-03-30', 0, '2020-03-29 10:17:48', 100, 2, NULL),
(8, 'rau bông súng', '123 Phong phong', 'icon1.png', '2020-04-02', 0, '2020-04-02 01:31:03', 12000, 1, NULL),
(9, 'Rau giá vàng', 'Lê lai 22', 'background_img.jpg', '2020-04-05', 0, '2020-04-04 03:16:40', 1001, 12, NULL),
(10, 'Rau hoa sen', 'Văn Bá', 'icon2.png', '2020-04-04', 0, '2020-04-04 12:03:21', 900000, 1, NULL),
(11, 'Rau xxx', 'Nguyễn Văn Bắc', 'icon3.png', '2020-04-04', 0, '2020-04-04 13:51:42', 1000, 3, NULL),
(12, 'Rau sen', 'Đồng tháp', 'vietnam.png', '2020-04-11', 0, '2020-04-11 04:38:27', 25000, 10, NULL),
(13, 'Rau bông lan 12', 'Tú bà hàng xanh', 'adven.jpg', '2020-04-20', 0, '2020-04-18 03:55:41', 13000, 127, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_so_moi_truong`
--

CREATE TABLE `thong_so_moi_truong` (
  `id` int(11) NOT NULL,
  `nhiet_do` float DEFAULT NULL,
  `do_am` int(11) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `rau_id` int(11) NOT NULL,
  `day` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `thong_so_moi_truong`
--

INSERT INTO `thong_so_moi_truong` (`id`, `nhiet_do`, `do_am`, `time`, `rau_id`, `day`, `created_at`) VALUES
(1, 31.9, 85, NULL, 0, '2020-05-20', '2020-05-20 14:34:47'),
(2, 31.9, 85, NULL, 0, '2020-05-20', '2020-05-20 14:38:57'),
(3, 31.9, 85, NULL, 0, '2020-05-20', '2020-05-20 14:39:32'),
(4, 31.9, 85, NULL, 0, '2020-05-21', '2020-05-20 14:40:38'),
(5, 32, 33, NULL, 0, '2020-05-21', '2020-05-20 14:41:17'),
(6, 32.1, 84, NULL, 0, '2020-05-22', '2020-05-20 14:56:26'),
(7, 32.1, 84, NULL, 0, '2020-05-22', '2020-05-20 14:59:28'),
(8, 31.9, 85, NULL, 0, '2020-05-20', '2020-05-20 15:03:29'),
(9, 31.9, 85, NULL, 0, '2020-05-23', '2020-05-20 15:06:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thu_hoach`
--

CREATE TABLE `thu_hoach` (
  `id` int(11) NOT NULL,
  `rau_id` int(11) NOT NULL,
  `nha_san_xuat` varchar(200) DEFAULT NULL,
  `ngay_thu_hoach` date DEFAULT NULL,
  `san_luong` int(11) DEFAULT NULL,
  `gia_ban` varchar(200) DEFAULT NULL,
  `image_thu_hoach` varchar(200) DEFAULT NULL,
  `qrcode` varchar(200) DEFAULT NULL,
  `deleted_at` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `plant_location` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `thu_hoach`
--

INSERT INTO `thu_hoach` (`id`, `rau_id`, `nha_san_xuat`, `ngay_thu_hoach`, `san_luong`, `gia_ban`, `image_thu_hoach`, `qrcode`, `deleted_at`, `created_at`, `plant_location`) VALUES
(3, 12, NULL, NULL, NULL, NULL, '', 'generate.php_text_qrcode=12.png', 0, '2020-04-11 04:48:59', NULL),
(4, 13, 'Trần văn A', '2020-04-20', 12, '1000/1 kí', 'hinh-nen-dep-cho-may-tinh-nature-wallpapers-nature-wallpaper-latest-beautiful-wallpapers.jpg', 'bt_adapter.png', 0, '2020-04-18 03:58:59', NULL),
(5, 9, 'lê thị bé', '2020-04-21', 12, '1000/1 kí', 'hinh-nen-dep-cho-may-tinh-nature-wallpapers-nature-wallpaper-latest-beautiful-wallpapers.jpg', 'city1.jpg', 0, '2020-04-19 05:12:29', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dieu_kien_canh_tac`
--
ALTER TABLE `dieu_kien_canh_tac`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rau`
--
ALTER TABLE `rau`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thong_so_moi_truong`
--
ALTER TABLE `thong_so_moi_truong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thu_hoach`
--
ALTER TABLE `thu_hoach`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `dieu_kien_canh_tac`
--
ALTER TABLE `dieu_kien_canh_tac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `rau`
--
ALTER TABLE `rau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `thong_so_moi_truong`
--
ALTER TABLE `thong_so_moi_truong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `thu_hoach`
--
ALTER TABLE `thu_hoach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
