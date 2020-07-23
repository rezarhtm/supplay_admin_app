-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2020 at 09:00 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sup_test_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(2) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_name`, `created_at`, `update_at`) VALUES
(0, 'BNI', '2020-05-27 13:02:41', '2020-05-27 20:02:41'),
(27, 'BCA', '2020-05-27 13:32:13', '2020-05-27 20:31:35'),
(28, 'Bank Mandiri Syariah', '2020-05-27 18:23:25', '2020-05-27 20:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(3) NOT NULL,
  `category_desc` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_desc`, `created_at`, `updated_at`) VALUES
(101, 'Sayuran', NULL, '2020-05-27 17:37:59'),
(102, 'Buah-buahan', NULL, '2020-05-27 17:38:11'),
(103, 'Air kemasan', NULL, '2020-05-27 17:38:39'),
(104, 'Minuman bersoda', NULL, '2020-05-27 17:39:00'),
(105, 'Kue kering', NULL, '2020-05-27 17:39:30'),
(106, 'Makanan ringan', NULL, '2020-05-27 17:39:44'),
(107, 'Bumbu masakan', NULL, '2020-05-27 17:40:18'),
(108, 'Pecah belah', NULL, '2020-05-27 17:46:22'),
(109, 'Obat obatan', NULL, '2020-05-27 17:46:37'),
(110, 'Vitamin', NULL, '2020-05-27 17:46:50'),
(111, 'Elektronik', '2020-04-14 15:19:08', '2020-05-27 17:47:00'),
(112, 'Alat makan', '2020-04-16 07:46:02', '2020-05-27 17:47:10'),
(113, 'Obat serangga', '2020-04-16 07:46:56', '2020-05-27 17:47:49'),
(114, 'Mainan anak', '2020-04-16 07:48:27', '2020-05-27 17:48:09'),
(115, 'Perabotan', '2020-04-16 07:49:57', '2020-05-27 17:48:18'),
(116, 'elektro', NULL, '2020-04-16 12:49:38'),
(117, 'Alat tulis kantor', '2020-05-27 17:48:44', '2020-05-27 17:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `horeka`
--

CREATE TABLE `horeka` (
  `horeka_id` int(10) NOT NULL,
  `h_name` varchar(255) NOT NULL,
  `h_npwp` varchar(100) NOT NULL,
  `h_username` varchar(20) NOT NULL,
  `h_password` varchar(20) NOT NULL,
  `h_pic_name` varchar(255) NOT NULL,
  `h_address` varchar(255) NOT NULL,
  `h_biz_address` varchar(255) NOT NULL,
  `h_city` varchar(255) NOT NULL,
  `h_province` varchar(255) NOT NULL,
  `h_phone` varchar(255) NOT NULL,
  `h_fax` varchar(255) NOT NULL,
  `h_email` varchar(255) NOT NULL,
  `bank_id` int(2) NOT NULL,
  `h_bank_acc` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_id` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `horeka`
--

INSERT INTO `horeka` (`horeka_id`, `h_name`, `h_npwp`, `h_username`, `h_password`, `h_pic_name`, `h_address`, `h_biz_address`, `h_city`, `h_province`, `h_phone`, `h_fax`, `h_email`, `bank_id`, `h_bank_acc`, `remarks`, `status_id`, `created_at`, `updated_at`) VALUES
(62006283, 'Warung Ayam', '123890', 'ayamku', 'ayamku', 'Joko', 'Jalanan', 'Jalanan', '', '', '123123132', '123123123', 'asd@asd.asd', 1213, '12313', '12313', 1, '2020-06-12 01:13:37', '2020-06-12 01:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `vendor_id` int(10) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `qty` int(3) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price_perunit` int(7) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `vendor_id`, `product_desc`, `category_id`, `qty`, `unit`, `price_perunit`, `created_at`, `updated_at`, `status_id`) VALUES
(0, 'Kue Nastar Ashoy', 3, 'Kue Nastar Ashoy halal tidak mengandung yang diharamkan agama', 4, 9, 'Toples', 100000, '2020-05-31 16:02:22', '2020-05-31 09:02:22', 1),
(312407, 'Keju aja', 1, 'Keju slice merk Kraft isi 12          ', 3, 12, 'Pak', 7500, '2020-05-20 19:58:06', '2020-05-31 09:34:08', 1),
(531765, 'Biskuit Kong Guan', 1, 'Biskuit Kong Guan', 1, 10, 'Kaleng', 5000, '2020-05-31 19:56:01', '2020-05-31 12:57:01', 1),
(757808, 'Kangkung', 2, 'Kangkung segar', 2, 10, 'Ikat', 5000, '2020-05-30 19:57:20', '2020-05-31 12:58:04', 1),
(102040907, 'Kurma Asli', 123, 'Kurma Asli', 0, 90, 'Box', 30000, '2020-06-21 11:00:19', '2020-06-21 04:00:19', 1),
(102043824, 'Smartphone ziomi', 1231, 'Smartphone xiomi 4', 0, 1, 'Box', 4000000, '2020-06-21 05:45:29', '2020-06-20 22:45:29', 1),
(102061550, 'Logitech Mouse', 123, 'Logitech Mouse', 111, 1, 'Unit / Unit', 50000, '2020-07-06 17:11:31', '2020-07-06 10:11:31', 1),
(102093906, 'Asem Jawa', 12, 'Asem Jawa asli jawa', 12, 12, 'Batang', 10000, '2020-06-12 01:40:18', '2020-06-11 18:40:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(1) NOT NULL,
  `status_desc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_desc`) VALUES
(0, 'not_active'),
(1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` varchar(10) NOT NULL,
  `v_name` varchar(255) NOT NULL,
  `v_npwp` varchar(255) NOT NULL,
  `v_username` varchar(20) NOT NULL,
  `v_password` varchar(20) NOT NULL,
  `v_pic_name` varchar(255) NOT NULL,
  `v_address` varchar(255) NOT NULL,
  `v_biz_address` varchar(255) NOT NULL,
  `v_city` varchar(255) NOT NULL,
  `v_province` varchar(255) NOT NULL,
  `v_phone` varchar(255) NOT NULL,
  `v_fax` varchar(255) NOT NULL,
  `v_email` varchar(255) NOT NULL,
  `bank_id` int(2) NOT NULL,
  `v_bank_acc` varchar(255) NOT NULL,
  `v_remarks` varchar(255) NOT NULL,
  `status_id` int(2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `v_name`, `v_npwp`, `v_username`, `v_password`, `v_pic_name`, `v_address`, `v_biz_address`, `v_city`, `v_province`, `v_phone`, `v_fax`, `v_email`, `bank_id`, `v_bank_acc`, `v_remarks`, `status_id`, `created_at`, `updated_at`) VALUES
('', 'Toko Black', '1234', 'black', 'black', 'Bleki', 'Jalanan', 'Jalanan', '', '', '12341234', '12341234', 'asd.asd@asd.asd', 0, '12341234', 'asd', 1, '2020-06-09 14:56:43', '2020-06-09 14:56:43'),
('', 'Toko Ayong', '123412341234', 'ayong', 'ayong', 'Joko', 'Cengkareng', 'Cengkareng', 'Jakarta', 'Jakarta', '123123123', '123123123', 'asd.asd@asd.asd', 28, '123123123', 'telat bayar', 1, NULL, NULL),
('', 'Agen Buah Segar Saja', '123412341234', 'buahsegar', '', 'Barney', 'Jalan kaki          ', 'Jalan kaki          ', 'Jakarta', 'Jakarta', '123123123', '123123123', 'asd.asd@asd.asd', 27, '123123123', 'kredit lancar', 0, NULL, '2020-05-31 11:32:57'),
('V200617982', 'Toko Panto', '123123123', 'pantos', '', 'Joko', 'Jalanan          ', 'Jalanan          ', '', '', '123123123', '123123123', 'asd.asd@asd.asd', 0, '12312123', 'as', 0, '2020-06-09 15:18:54', '2020-06-09 15:45:16'),
('V200639746', 'White Shades', '710276', 'white', 'white', 'Shiro', 'Matsuri', 'Matsuri', '', '', '1231231231', '12351333', 'asd.asd@asd.asd', 0, '12314', 'qwe', 1, '2020-06-09 15:46:25', '2020-06-09 15:46:25'),
('V200694859', 'Dello', '7878900', 'dello', 'dello', 'Bu Dello', 'Jakabaring', 'Jakabaring', '', '', '8383838', '8484848', 'asd.asd@asd.asd', 0, '107265657', 'q', 1, '2020-06-09 15:52:58', '2020-06-09 15:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(10) NOT NULL,
  `v_name` varchar(255) DEFAULT NULL,
  `v_npwp` varchar(255) DEFAULT NULL,
  `v_username` varchar(255) DEFAULT NULL,
  `v_password` varchar(255) DEFAULT NULL,
  `v_pic_name` varchar(255) DEFAULT NULL,
  `v_address` varchar(255) DEFAULT NULL,
  `v_biz_address` varchar(255) DEFAULT NULL,
  `v_phone` varchar(255) DEFAULT NULL,
  `v_fax` varchar(255) DEFAULT NULL,
  `v_email` varchar(255) DEFAULT NULL,
  `v_bank_acc` varchar(255) DEFAULT NULL,
  `bank_id` varchar(255) DEFAULT NULL,
  `v_remarks` varchar(255) DEFAULT NULL,
  `status_id` int(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `v_name`, `v_npwp`, `v_username`, `v_password`, `v_pic_name`, `v_address`, `v_biz_address`, `v_phone`, `v_fax`, `v_email`, `v_bank_acc`, `bank_id`, `v_remarks`, `status_id`, `created_at`, `updated_at`) VALUES
(42006152, 'qwer', '123', 'qwerty', 'qwerty', 'asd', 'asd', 'asd', '1234', '1234', 'asd.asd@asd.asd', '1234', NULL, '123', 1, '2020-06-11 09:15:17', '2020-06-11 09:15:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `horeka`
--
ALTER TABLE `horeka`
  ADD PRIMARY KEY (`horeka_id`),
  ADD UNIQUE KEY `horeka_id` (`horeka_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`),
  ADD UNIQUE KEY `vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
