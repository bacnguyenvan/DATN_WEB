-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2020 at 10:28 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `do_an_tot_nghiep`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dieu_kien_canh_tac`
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
-- Dumping data for table `dieu_kien_canh_tac`
--

INSERT INTO `dieu_kien_canh_tac` (`id`, `rau_id`, `ten_dieu_kien`, `dieu_kien`, `deleted_at`, `created_at`) VALUES
(1, 9, 'nhiet do', '>50', 0, '2020-04-04 03:17:20'),
(2, 9, 'Nhiệt độ', '50-60', 0, '2020-04-04 12:04:24'),
(3, 11, 'Thời gian thu hoạch', '>10 ngày', 0, '2020-04-04 13:52:20'),
(4, 12, 'ngày canh tác', '20 ngày', 0, '2020-04-11 04:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `rau`
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
  `number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rau`
--

INSERT INTO `rau` (`id`, `name`, `nha_cung_cap`, `image_giong`, `ngay_trong`, `deleted_at`, `created_at`, `price`, `number`) VALUES
(1, 'Rau muống', 'Văn phòng phẩm ABC , 123 võ văn Ngân', 'rau_muong.jpg', '2020-03-29', 0, '2020-03-29 09:24:09', 4000, 2),
(2, 'Rau mướp', 'Phong lan 23 Lê lợi', 'muop.png', '2020-03-30', 0, '2020-03-29 09:44:05', 10000, 1),
(3, 'Rau hoa chuối', 'Nhà a 46 Phạm Văn Đồng', 'hoa_chuoi.jpg', '2020-03-30', 0, '2020-03-29 09:47:10', 12000, 2),
(4, 'aaaa', '122 ', 'adven.jpg', '2020-03-30', 0, '2020-03-29 09:49:31', 3500000, 1),
(5, 'âq23', '122 aaa', 'zi_dat.png', '2020-03-30', 1, '2020-03-29 09:50:05', 3000000, 1),
(6, '12A', 'Văn phòng phẩm ABC , 123 võ văn Ngân', '9_ro.jpg', '2020-02-02', 0, '2020-03-29 09:50:43', 3500000, 1),
(7, 'rau dền', '123 nguyễn trãi', '3_chuon.jpg', '2020-03-30', 0, '2020-03-29 10:17:48', 100, 2),
(8, 'rau bông súng', '123 Phong phong', 'icon1.png', '2020-04-02', 0, '2020-04-02 01:31:03', 12000, 1),
(9, 'Rau giá', 'Lê lai', 'hinh-nen-dep-cho-may-tinh-nature-wallpapers-nature-wallpaper-latest-beautiful-wallpapers.jpg', '2020-04-04', 0, '2020-04-04 03:16:40', 10000, 1),
(10, 'Rau hoa sen', 'Văn Bá', 'icon2.png', '2020-04-04', 0, '2020-04-04 12:03:21', 900000, 1),
(11, 'Rau xxx', 'Nguyễn Văn Bắc', 'icon3.png', '2020-04-04', 0, '2020-04-04 13:51:42', 1000, 3),
(12, 'Rau sen', 'Đồng tháp', 'vietnam.png', '2020-04-11', 0, '2020-04-11 04:38:27', 25000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `thu_hoach`
--

CREATE TABLE `thu_hoach` (
  `id` int(11) NOT NULL,
  `rau_id` int(11) NOT NULL,
  `nha_san_xuat` varchar(200) DEFAULT NULL,
  `ngay_thu_hoach` datetime DEFAULT NULL,
  `san_luong` int(11) DEFAULT NULL,
  `gia_ban` varchar(200) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `qrcode` varchar(200) DEFAULT NULL,
  `deleted_at` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thu_hoach`
--

INSERT INTO `thu_hoach` (`id`, `rau_id`, `nha_san_xuat`, `ngay_thu_hoach`, `san_luong`, `gia_ban`, `image`, `qrcode`, `deleted_at`, `created_at`) VALUES
(3, 12, NULL, NULL, NULL, NULL, '', 'generate.php_text_qrcode=12.png', 0, '2020-04-11 04:48:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dieu_kien_canh_tac`
--
ALTER TABLE `dieu_kien_canh_tac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rau`
--
ALTER TABLE `rau`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thu_hoach`
--
ALTER TABLE `thu_hoach`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dieu_kien_canh_tac`
--
ALTER TABLE `dieu_kien_canh_tac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rau`
--
ALTER TABLE `rau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `thu_hoach`
--
ALTER TABLE `thu_hoach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
