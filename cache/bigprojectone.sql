-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2021 at 05:21 AM
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
(5, 'Hà', 0, '2018-01-10', '1112223365', 'ha@gmail.com', '123', 'Đà Nẵng'),
(7, 'Ngọc', 0, '2016-12-07', '1112223367', 'ngoc@gmail.com', '123', 'Cần Thơ'),
(8, 'Huệ', 0, '2020-12-28', '1239874424', 'hue@gmail.com', '456', 'Ninh Bình');

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
(27, 'Chess Club', 'f25cc4e39700dc633113ea005d7e56bf.png', 100000, 'Kẻ đi nước đầu tiên chưa chắc là kẻ chiến thắng', 1, 6),
(28, 'Born to Shine', 'f3b391fdce28c6768f4919d69d221a6e.png', 130000, 'Quá sáng thì cũng không ai nhận ra', 1, 8),
(29, 'Risk blue', 'eab2dd953f537b3434ec1f6b6d14cac1.png', 120000, 'Không cần bất cứ mô tả nào vì áo quá đỉnh', 1, 2),
(30, 'Cool Donut', 'f2c4e6a6d92fd7cb1f9845909c17c283.jpeg', 153000, 'Donut cool ngầu', 5, 6),
(31, 'Unique Eagle', 'e8ecd36dfaafea069b903bcf7ecfa918.png', 162000, 'Sự khác biệt làm nổi bật con người của chính bạn', 4, 6),
(32, 'Triple Power', 'd7b65f4e24d3f14c9591765e420410a0.png', 158000, 'Triple power - Triple kill', 4, 2),
(33, 'Dolphin Family', 'f79d08962917668bd8ed5f9e120201eb.png', 210000, 'Gia đình của bé cá', 2, 1),
(34, 'The Black Wizard', 'e48427cc533da56efdebbe19e6af3e09.png', 280000, 'Give me your soul', 2, 1),
(35, 'Shin The Pencil', '44c6b8b2d94caf6a09a566a4af3984e3.png', 169000, 'Shin so small and his pencil is small too', 1, 4),
(36, 'Study change my life', 'c8e55bd75f9e1a44a0bd6129af2292db.png', 97000, 'Kẻ mang tri thức là kẻ mạnh', 1, 2),
(37, 'A5', 'a9d41159a35e0240e6422466d2f472b8.png', 182000, 'Ngộ nghĩnh phá phách - phong cách trẻ trâu', 1, 2);

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
(7, 'yellow'),
(8, 'orange'),
(9, 'pink'),
(10, 'brown'),
(11, 'gray');

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
(27, 1, 50),
(27, 2, 12),
(27, 4, 68),
(27, 5, 30),
(28, 1, 15),
(28, 3, 200),
(28, 4, 57),
(29, 1, 843),
(29, 2, 356),
(29, 4, 345),
(29, 6, 52),
(30, 1, 23),
(30, 2, 62),
(30, 3, 23),
(30, 4, 674),
(30, 5, 33),
(30, 6, 314),
(31, 1, 53),
(31, 2, 83),
(31, 3, 452),
(31, 4, 35),
(32, 1, 453),
(32, 2, 22),
(32, 3, 6),
(32, 4, 43),
(32, 6, 23),
(33, 1, 243),
(33, 2, 21),
(33, 4, 342),
(33, 6, 432),
(34, 1, 233),
(34, 2, 51),
(34, 3, 4),
(34, 4, 234),
(34, 6, 31),
(35, 1, 231),
(35, 2, 12),
(35, 3, 12),
(35, 4, 223),
(35, 5, 34),
(35, 6, 123),
(36, 1, 31),
(36, 2, 342),
(36, 3, 3),
(36, 4, 352),
(36, 5, 12),
(37, 1, 12),
(37, 2, 12),
(37, 3, 412),
(37, 4, 51),
(37, 5, 12),
(37, 6, 34);

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
  ADD KEY `id_size` (`id_size`),
  ADD KEY `id_item` (`id_item`,`id_size`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `item_colors`
--
ALTER TABLE `item_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `bill_details_ibfk_2` FOREIGN KEY (`id_item`,`id_size`) REFERENCES `item_details` (`id_item`, `id_size`);

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
