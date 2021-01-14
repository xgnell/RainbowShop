-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 14, 2021 at 02:59 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bigprojectone`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birth` date DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `id_rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `gender`, `birth`, `phone`, `email`, `passwd`, `id_rank`) VALUES
(6, 'admin1', 1, '2020-12-17', '1239874440', 'admin1@gmail.com', '123', 2),
(8, 'admin2', 0, '2020-12-16', '1112223337', 'admin2@gmail.com', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_ranks`
--

CREATE TABLE `admin_ranks` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_ranks`
--

INSERT INTO `admin_ranks` (`id`, `name`, `level`) VALUES
(1, 'Super admin', 1),
(2, 'Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `id_state` int(11) NOT NULL,
  `purchase_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `id_customer`, `receiver`, `address`, `phone`, `id_state`, `purchase_time`) VALUES
(7, 8, 'Huệ', 'Hà Nội', '1234569879', 2, '2021-01-11 05:35:08'),
(8, 7, 'Ngoc', 'Ninh Bình', '231535234', 3, '2021-01-11 05:50:46'),
(9, 8, 'Huệ', 'Huế', '1112223367', 2, '2021-01-11 05:51:51'),
(10, 7, 'Lan', 'Quảng Ninh', '231535234', 2, '2021-01-13 03:56:47'),
(11, 7, 'Ngoc Luui', 'Ngoc Lam', '1239876540', 1, '2021-01-13 08:26:21'),
(12, 7, 'Ngoc', 'Ha Noi', '1112223335', 1, '2021-01-13 09:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `bill_details`
--

CREATE TABLE `bill_details` (
  `id_bill` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_size` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_details`
--

INSERT INTO `bill_details` (`id_bill`, `id_item`, `id_size`, `amount`, `price`) VALUES
(7, 25, 1, 27, 342),
(7, 25, 2, 46, 342),
(7, 25, 4, 21, 342),
(7, 26, 1, 18, 4335),
(7, 26, 2, 26, 4335),
(7, 26, 4, 17, 4335),
(8, 24, 1, 10, 3332),
(8, 24, 2, 33, 3332),
(8, 24, 4, 16, 3332),
(8, 25, 1, 34, 342),
(8, 25, 2, 26, 342),
(8, 25, 4, 43, 342),
(9, 1, 1, 49, 5000),
(9, 1, 2, 33, 5000),
(9, 1, 4, 46, 5000),
(9, 25, 1, 16, 342),
(9, 25, 2, 15, 342),
(9, 25, 4, 28, 342),
(10, 25, 4, 14, 342),
(11, 24, 2, 35, 3332),
(11, 24, 4, 25, 3332),
(12, 1, 1, 34, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `bill_states`
--

CREATE TABLE `bill_states` (
  `id` int(11) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_states`
--

INSERT INTO `bill_states` (`id`, `state`) VALUES
(1, 'Đang chờ duyệt'),
(2, 'Đã duyệt'),
(3, 'Đã hủy');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birth` date DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `gender`, `birth`, `phone`, `email`, `passwd`, `address`) VALUES
(4, 'Trịnh Ngọc Hải', 1, '2020-11-18', '4555555551', 'hai08@gmail.com', '123', 'Quảng Nam'),
(5, 'Hà', 0, '2018-01-10', '1112223365', 'ha@gmail.com', '123', 'Đà Nẵng'),
(7, 'Ngọc', 0, '2016-12-07', '1112223367', 'ngoc@gmail.com', '123', 'Cần Thơ'),
(8, 'Huệ', 0, '2020-12-28', '1239874424', 'hue@gmail.com', '456', 'Ninh Bình'),
(9, 'Nguyễn Thành Đạt', 1, '2021-01-04', '0976228132', 'dat06@gmail.com', '456', 'Ngọc Lâm, Long Biên, Hà Nội'),
(10, 'Tuấn Trần', 1, '2021-01-19', '0825311312', 'tuan@gmail.com', '123', 'Skypie'),
(12, 'Ngà', 0, '2021-01-05', '0932116328', 'nga@gmail.com', '123', 'Laughing Tale'),
(14, 'dfasdfdfadfdfff', 0, '2021-01-06', '125658234', 'dfae@gdfa.v', '123', 'dfae'),
(16, 'dfadf', 0, '2021-01-12', '025369147', 'dfa3@fdadf', '123', 'dfa');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `id_type` int(11) NOT NULL,
  `id_color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `picture`, `price`, `description`, `id_type`, `id_color`) VALUES
(1, 'Áo phông', 'shirt.jpg', 5000, 'Áo phông đơn giản nhưng đại diện cho sự cá tính và nét hiện đại. Addon', 1, 1),
(22, 'test4', 'f79d08962917668bd8ed5f9e120201eb.png', 46345, 'test dfa 4 dfadf dafeaf', 4, 5),
(24, 'test new', 'daddc749b8c8161a704d3afbe8c207df.png', 3332, 'new item', 3, 7),
(25, 'Sp moi', 'f3b391fdce28c6768f4919d69d221a6e.png', 342, 'Orange', 1, 7),
(26, 'Other', 'e476c3c7f8539966de14b8c871a69328.png', 4335, 'Pink panther', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_colors`
--

CREATE TABLE `item_colors` (
  `id` int(11) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_colors`
--

INSERT INTO `item_colors` (`id`, `color`) VALUES
(1, 'black'),
(2, 'blue'),
(3, 'green'),
(4, 'purple'),
(5, 'red'),
(6, 'white'),
(7, 'yellow');

-- --------------------------------------------------------

--
-- Table structure for table `item_details`
--

CREATE TABLE `item_details` (
  `id_item` int(11) NOT NULL,
  `id_size` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_details`
--

INSERT INTO `item_details` (`id_item`, `id_size`, `amount`) VALUES
(1, 1, 8),
(1, 2, 12),
(1, 3, 5),
(22, 1, 12),
(22, 2, 7),
(22, 3, 9),
(24, 2, 20),
(24, 3, 34),
(24, 4, 21),
(24, 5, 5),
(25, 2, 12),
(25, 4, 4),
(26, 3, 12),
(26, 4, 5),
(26, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `item_sizes`
--

CREATE TABLE `item_sizes` (
  `id` int(11) NOT NULL,
  `size` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_sizes`
--

INSERT INTO `item_sizes` (`id`, `size`) VALUES
(1, 'L'),
(2, 'M'),
(3, 'S'),
(4, 'XL'),
(5, 'XS'),
(6, 'XXL');

-- --------------------------------------------------------

--
-- Table structure for table `item_types`
--

CREATE TABLE `item_types` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_types`
--

INSERT INTO `item_types` (`id`, `type`) VALUES
(2, 'Hoodie'),
(5, 'Oversize'),
(4, 'Polo'),
(3, 'Raglan'),
(1, 'T-shirt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rank` (`id_rank`);

--
-- Indexes for table `admin_ranks`
--
ALTER TABLE `admin_ranks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_state` (`id_state`);

--
-- Indexes for table `bill_details`
--
ALTER TABLE `bill_details`
  ADD PRIMARY KEY (`id_bill`,`id_item`,`id_size`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_size` (`id_size`);

--
-- Indexes for table `bill_states`
--
ALTER TABLE `bill_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_color` (`id_color`);

--
-- Indexes for table `item_colors`
--
ALTER TABLE `item_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_details`
--
ALTER TABLE `item_details`
  ADD PRIMARY KEY (`id_item`,`id_size`),
  ADD KEY `id_size` (`id_size`);

--
-- Indexes for table `item_sizes`
--
ALTER TABLE `item_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_types`
--
ALTER TABLE `item_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `admin_ranks`
--
ALTER TABLE `admin_ranks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bill_states`
--
ALTER TABLE `bill_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `item_colors`
--
ALTER TABLE `item_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item_sizes`
--
ALTER TABLE `item_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_types`
--
ALTER TABLE `item_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`id_rank`) REFERENCES `admin_ranks` (`id`);

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`id_state`) REFERENCES `bill_states` (`id`);

--
-- Constraints for table `bill_details`
--
ALTER TABLE `bill_details`
  ADD CONSTRAINT `bill_details_ibfk_1` FOREIGN KEY (`id_bill`) REFERENCES `bills` (`id`),
  ADD CONSTRAINT `bill_details_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `bill_details_ibfk_3` FOREIGN KEY (`id_size`) REFERENCES `item_sizes` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `item_types` (`id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`id_color`) REFERENCES `item_colors` (`id`);

--
-- Constraints for table `item_details`
--
ALTER TABLE `item_details`
  ADD CONSTRAINT `item_details_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `item_details_ibfk_2` FOREIGN KEY (`id_size`) REFERENCES `item_sizes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
