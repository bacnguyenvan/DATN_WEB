-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2020 at 11:21 AM
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
-- Table structure for table `loai_rau`
--

CREATE TABLE `loai_rau` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `nhiet_do` int(11) DEFAULT NULL,
  `do_am` int(11) DEFAULT NULL,
  `deleted_at` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loai_rau`
--

INSERT INTO `loai_rau` (`id`, `name`, `nhiet_do`, `do_am`, `deleted_at`, `created_at`) VALUES
(1, 'Rau thơm', NULL, NULL, 0, '2020-03-29 06:19:55'),
(2, 'Rau ăn quả', NULL, NULL, 0, '2020-03-29 06:21:24'),
(3, 'Rau ăn thân', NULL, NULL, 0, '2020-03-29 06:21:58'),
(4, 'Rau ăn hoa', NULL, NULL, 0, '2020-03-29 06:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `rau`
--

CREATE TABLE `rau` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `loai_rau_id` int(11) NOT NULL,
  `nha_cung_cap` varchar(200) DEFAULT NULL,
  `image_giong` varchar(200) DEFAULT NULL,
  `qrcode` varchar(200) DEFAULT NULL,
  `ngay_chon_giong` datetime DEFAULT NULL,
  `deleted_at` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rau`
--

INSERT INTO `rau` (`id`, `name`, `loai_rau_id`, `nha_cung_cap`, `image_giong`, `qrcode`, `ngay_chon_giong`, `deleted_at`, `created_at`, `price`, `number`) VALUES
(1, 'Rau thủy canh', 1, '', NULL, NULL, '2020-03-04 00:00:00', 0, '2020-03-29 08:50:27', NULL, NULL),
(2, 'Rau dền', 2, '', NULL, NULL, '2020-03-29 10:19:00', 0, '2020-03-29 08:51:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `thu_hoach`
--

CREATE TABLE `thu_hoach` (
  `id` int(11) NOT NULL,
  `rau_id` int(11) NOT NULL,
  `ngay_thu_hoach` datetime DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `deleted_at` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loai_rau`
--
ALTER TABLE `loai_rau`
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
-- AUTO_INCREMENT for table `loai_rau`
--
ALTER TABLE `loai_rau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rau`
--
ALTER TABLE `rau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `thu_hoach`
--
ALTER TABLE `thu_hoach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
