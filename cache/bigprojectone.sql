-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2021 at 01:16 AM
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
  `id_rank` int(11) NOT NULL,
  `id_state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `gender`, `birth`, `phone`, `email`, `passwd`, `id_rank`, `id_state`) VALUES
(8, 'Nam', 2, '2020-12-16', '0983221316', 'hoangnam@gmail.com', 'abcd1234', 1, 1),
(17, 'Hương', 1, '1997-04-01', '0912556327', 'huong123@gmail.com', 'abcd1234', 2, 1),
(18, 'Tuấn', 2, '1993-05-31', '0976311269', 'tuan@gmail.com', 'abcd1234', 2, 1),
(19, 'Đạt', 2, '2000-10-01', '0892176312', 'dat09@gmail.com', 'abcd1234', 2, 1),
(20, 'Trần Thùy Linh', 1, '2016-05-10', '0313236168', 'linh@bkacad.edu.vn', 'abcd1234', 2, 1);

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
-- Table structure for table `admin_states`
--

CREATE TABLE `admin_states` (
  `id` int(11) NOT NULL,
  `state` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_states`
--

INSERT INTO `admin_states` (`id`, `state`, `color`) VALUES
(1, 'Bình thường', 'green'),
(2, 'Bị khóa', 'red');

-- --------------------------------------------------------

--
-- Table structure for table `backgrounds`
--

CREATE TABLE `backgrounds` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `backgrounds`
--

INSERT INTO `backgrounds` (`id`, `name`, `picture`) VALUES
(1, 'Background 1', 'bg1.png'),
(5, 'Background3', 'bg2.png'),
(6, 'Background4', 'bg3.png'),
(7, 'Background5', 'bg4.png');

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
  `purchase_time` datetime NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `id_customer`, `receiver`, `address`, `phone`, `id_state`, `purchase_time`, `id_admin`, `updated_at`) VALUES
(13, 7, 'Ngọc', 'Hà Nội', '0915327117', 2, '2021-01-16 04:03:55', 8, '2021-01-25 09:54:43'),
(14, 7, 'Ngọc', 'Hà Nội', '0915327117', 2, '2021-01-16 08:23:46', 8, '2021-01-27 10:17:22'),
(15, 7, 'Ngọc', 'Hà Nội', '0915327117', 3, '2021-01-17 17:50:17', 17, '2021-01-28 10:17:11'),
(16, 7, 'Ngọc', 'Hà Nội', '0915327117', 2, '2021-01-19 05:45:22', 18, '2021-01-28 10:16:01'),
(17, 8, 'Huệ', 'Đà Nẵng', '0976311269', 3, '2021-01-19 09:06:24', 17, '2021-01-25 10:00:44'),
(18, 8, 'Huệ', 'Đà Nẵng', '0976311269', 2, '2021-01-19 10:27:59', 19, '2021-01-27 17:22:44'),
(19, 7, 'Ngọc', 'Hà Nội', '0982316226', 1, '2021-01-29 11:15:47', NULL, NULL),
(20, 5, 'Hà', 'Ninh Bình', '0986336218', 1, '2021-01-29 17:14:03', NULL, NULL),
(22, 7, 'Ngọc', 'Hà Nội', '0915327117', 1, '2021-01-30 11:04:28', NULL, NULL),
(23, 7, 'Ngọc', 'Hà Nội', '0982311216', 1, '2021-01-31 00:56:38', NULL, NULL);

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
(13, 27, 2, 3, 100000),
(13, 28, 1, 8, 130000),
(13, 37, 2, 3, 182000),
(14, 28, 4, 2, 130000),
(15, 28, 1, 3, 130000),
(16, 29, 2, 1, 120000),
(17, 34, 1, 3, 280000),
(18, 30, 3, 3, 153000),
(19, 32, 3, 6, 158000),
(19, 34, 4, 3, 280000),
(19, 37, 4, 10, 182000),
(20, 31, 3, 4, 162000),
(20, 32, 3, 1, 158000),
(20, 37, 4, 4, 182000),
(22, 34, 3, 4, 280000),
(22, 35, 4, 3, 169000),
(23, 34, 6, 2, 280000);

-- --------------------------------------------------------

--
-- Table structure for table `bill_states`
--

CREATE TABLE `bill_states` (
  `id` int(11) NOT NULL,
  `state` varchar(50) NOT NULL,
  `color` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_states`
--

INSERT INTO `bill_states` (`id`, `state`, `color`) VALUES
(1, 'Đang chờ duyệt', 'blue'),
(2, 'Đã duyệt', 'green'),
(3, 'Đã hủy', 'red');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `type`, `value`) VALUES
(1, 'Điện thoại', '0243692216'),
(2, 'Địa chỉ', 'Tầng 12, Tòa nhà trung tâm Lotte Hà Nội, 54 Liễu Giai, phường Cống Vị, Quận Ba Đình, Hà Nội.');

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
  `address` varchar(100) DEFAULT NULL,
  `id_state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `gender`, `birth`, `phone`, `email`, `passwd`, `address`, `id_state`) VALUES
(5, 'Hà', 1, '2018-01-10', '0983226319', 'ha@gmail.com', 'ha123456', 'Đà Nẵng', 1),
(7, 'Ngọc', 1, '2016-12-07', '0521369442', 'ngoc@gmail.com', 'ngoc123456', 'Cần Thơ', 1),
(8, 'Huệ', 1, '2020-12-28', '0363912348', 'hue@gmail.com', 'hue123456', 'Ninh Bình', 1),
(17, 'Nam', 2, '1996-10-06', '0823116324', 'nam123@gmail.com', 'nam123456', 'Quảng Bình', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_states`
--

CREATE TABLE `customer_states` (
  `id` int(11) NOT NULL,
  `state` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_states`
--

INSERT INTO `customer_states` (`id`, `state`, `color`) VALUES
(1, 'Bình thường', 'green'),
(2, 'Bị khóa', 'red');

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
(37, 'A5', 'a9d41159a35e0240e6422466d2f472b8.png', 182000, 'Vượt qua gian nan - Đập tan thử thách - Ngộ nghĩnh phá phách - phong cách trẻ trâu', 1, 2),
(42, 'Pure White', 'f1d9d8cd25d4ef10999cad1861cef9f0.png', 160000, 'Đơn giản chỉ là trắng', 4, 6),
(43, 'Pink panther', 'e476c3c7f8539966de14b8c871a69328.png', 68000, 'Pink panther', 1, 9),
(44, 'Pure Blue', 'c36ac2190675cf6041a05aace4b74013.png', 120000, 'Đơn giản chỉ là xanh', 4, 2),
(45, 'Love16', '7b5c39d3479f582a78ae65b6a6267a80.png', 123000, 'Love sixteen', 4, 3),
(46, 'Home Sweet', '53464afdffe635f269f50cb4b08d6a16.jpeg', 236000, 'Đi về nhà', 5, 7),
(47, 'Pure Red', 'bf7d868f14890f092c7a677b380ab880.png', 235000, 'Đơn giản chỉ là đỏ', 4, 5),
(48, 'Dragon Cute', '183bab45ac5a37c2b9854821854bd6b8.jpeg', 213000, 'Bé rồng dễ thương', 5, 3),
(49, 'Nivel', '6a4e2b17480a83248ad18aa83b67e26d.png', 320000, 'Nivelra', 2, 3),
(50, 'BayMax', '5fc82f7d04e74e5a4a24aa582e84aa7f.png', 530000, 'Big Hero 6', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `item_colors`
--

CREATE TABLE `item_colors` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_colors`
--

INSERT INTO `item_colors` (`id`, `code`, `color`) VALUES
(1, 'black', 'đen'),
(2, 'blue', 'xanh lam'),
(3, 'green', 'xanh lục'),
(4, 'purple', 'tím'),
(5, 'red', 'đỏ'),
(6, 'white', 'trắng'),
(7, 'yellow', 'vàng'),
(8, 'orange', 'cam'),
(9, 'pink', 'hồng'),
(10, 'brown', 'nâu'),
(11, 'gray', 'xám');

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
(27, 1, 23),
(27, 2, 123),
(27, 3, 156),
(27, 4, 369),
(27, 5, 124),
(27, 6, 269),
(28, 1, 236),
(28, 2, 123),
(28, 3, 200),
(28, 4, 55),
(28, 5, 236),
(29, 1, 843),
(29, 2, 355),
(29, 4, 345),
(29, 6, 52),
(30, 1, 23),
(30, 2, 62),
(30, 3, 20),
(30, 4, 674),
(30, 5, 33),
(30, 6, 314),
(31, 1, 53),
(31, 2, 263),
(31, 3, 448),
(31, 4, 236),
(31, 5, 236),
(32, 1, 453),
(32, 2, 22),
(32, 3, 0),
(32, 4, 43),
(32, 6, 23),
(33, 1, 243),
(33, 2, 21),
(33, 4, 342),
(33, 6, 432),
(34, 1, 230),
(34, 2, 51),
(34, 3, 4),
(34, 4, 231),
(34, 6, 29),
(35, 1, 231),
(35, 2, 12),
(35, 3, 12),
(35, 4, 220),
(35, 5, 34),
(35, 6, 123),
(36, 1, 31),
(36, 2, 342),
(36, 3, 3),
(36, 4, 352),
(36, 5, 12),
(37, 1, 12),
(37, 2, 21),
(37, 3, 412),
(37, 4, 37),
(37, 5, 12),
(37, 6, 34),
(42, 2, 236),
(42, 3, 264),
(42, 4, 34),
(42, 5, 135),
(43, 1, 15),
(43, 2, 236),
(43, 3, 236),
(43, 4, 126),
(43, 5, 26),
(44, 2, 123),
(44, 3, 362),
(44, 4, 128),
(44, 5, 369),
(44, 6, 236),
(45, 2, 263),
(45, 3, 365),
(45, 4, 129),
(45, 5, 126),
(45, 6, 223),
(46, 1, 123),
(46, 2, 123),
(46, 3, 263),
(46, 4, 532),
(46, 5, 136),
(46, 6, 23),
(47, 1, 12),
(47, 2, 126),
(47, 3, 368),
(47, 4, 126),
(47, 5, 269),
(48, 2, 23),
(48, 3, 269),
(48, 4, 125),
(48, 5, 469),
(49, 2, 126),
(49, 3, 236),
(49, 4, 23),
(49, 5, 165),
(50, 1, 123),
(50, 2, 125),
(50, 3, 236),
(50, 4, 632),
(50, 5, 236),
(50, 6, 124);

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
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
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

-- --------------------------------------------------------

--
-- Table structure for table `qna`
--

CREATE TABLE `qna` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qna`
--

INSERT INTO `qna` (`id`, `question`, `answer`) VALUES
(1, 'Địa chỉ shop ở đâu ý nhỉ?', 'Shop ở trong tim bạn đó'),
(2, 'Tại sao shop lại nhiều đồ đẹp thế?', 'Bởi vì shop có 1 đội thiết kế rất oki đó'),
(3, 'Khi nào thì shop mở cửa đơn khách vậy?', 'Lúc nào shop cũng chờ đón bạn nhé'),
(5, 'Làm sao để biết size thế nào là vừa?', 'Hiện Rainbow Kitty đang cung cấp sẵn bảng size để khách hàng có căn cứ lựa chọn. 1 bảng có thông tin chiều cao, cân nặng và 1 bảng là thông số đo của áo. Vì chọn size theo chiều cao, cân nặng chỉ mang tính chất ước lượng, bạn nên tham khảo thêm bảng thông số chiều dài, chiều rộng của áo để có thể lựa chọn size cho phù hợp. Rất đơn giản, bạn hãy lấy một chiếc áo mà mình đang mặc vừa và thoải mái nhất đo 2 thông số: dài áo và rộng vai, sau đó đối chiếu với bảng size mà Sales cung cấp để biết được size vừa với mình nhất nhé!'),
(6, 'Vậy thì những chiếc áo tuyệt đẹp đó được bán với giá bao nhiêu?\r\n\r\n', 'Ồ thực sự thì không hề đắt đâu, bạn hãy cứ yên tâm mua sắm nhé');

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
  ADD KEY `id_rank` (`id_rank`),
  ADD KEY `id_state` (`id_state`);

--
-- Indexes for table `admin_ranks`
--
ALTER TABLE `admin_ranks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `admin_states`
--
ALTER TABLE `admin_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backgrounds`
--
ALTER TABLE `backgrounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_state` (`id_state`),
  ADD KEY `id_admin` (`id_admin`);

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
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_state` (`id_state`);

--
-- Indexes for table `customer_states`
--
ALTER TABLE `customer_states`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `qna`
--
ALTER TABLE `qna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `admin_ranks`
--
ALTER TABLE `admin_ranks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_states`
--
ALTER TABLE `admin_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `backgrounds`
--
ALTER TABLE `backgrounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `bill_states`
--
ALTER TABLE `bill_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customer_states`
--
ALTER TABLE `customer_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
-- AUTO_INCREMENT for table `qna`
--
ALTER TABLE `qna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`id_rank`) REFERENCES `admin_ranks` (`id`),
  ADD CONSTRAINT `admins_ibfk_2` FOREIGN KEY (`id_state`) REFERENCES `admin_states` (`id`);

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`id_state`) REFERENCES `bill_states` (`id`),
  ADD CONSTRAINT `bills_ibfk_3` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id`);

--
-- Constraints for table `bill_details`
--
ALTER TABLE `bill_details`
  ADD CONSTRAINT `bill_details_ibfk_1` FOREIGN KEY (`id_bill`) REFERENCES `bills` (`id`),
  ADD CONSTRAINT `bill_details_ibfk_2` FOREIGN KEY (`id_item`,`id_size`) REFERENCES `item_details` (`id_item`, `id_size`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`id_state`) REFERENCES `customer_states` (`id`);

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
