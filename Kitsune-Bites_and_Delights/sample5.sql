-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 08:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample5`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `items_id` int(11) NOT NULL,
  `item_name` varchar(55) NOT NULL,
  `item_desc` text NOT NULL,
  `item_category` varchar(100) NOT NULL,
  `item_price` decimal(7,2) NOT NULL,
  `item_image` blob NOT NULL,
  `item_status` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`items_id`, `item_name`, `item_desc`, `item_category`, `item_price`, `item_image`, `item_status`) VALUES
(48, 'Mochi', 'Japanese Dessert', 'Desserts', 110.00, 0x53756e6f6f2e6a7067, 'A'),
(49, 'apple', 'hehehe', 'Sushi and Sashimi', 20.00, 0x706c616e742e706e67, 'A'),
(50, 'Gyoza (Pan-Fried Dumplings)', 'Delicate dumplings filled with a mix of ground meat and vegetables, pan-fried until golden brown. Served with a savory dipping sauce.', 'Ramen and Noodles', 200.00, 0x70726f626c656d2e706e67, 'A'),
(51, 'tako', 'icon', 'Donburi Bowls', 20.00, 0x37383032613037612d343237352d346431382d393739302d3032326136643766306666622e6a7067, 'A'),
(52, 'hahahahah', 'Fresh tuna sashimi slices arranged over a bowl of seasoned rice.', 'Japanese Curry', 250.00, 0x33376336313661362d626563392d343863662d616238322d6634323263656434623037312e6a7067, 'A'),
(53, 'hahahaooow', 'hjhrdjkwvfvj', 'Appetizers', 20.00, 0x372e706e67, 'A'),
(54, 'ayata', 'Japanese Dessert', 'Appetizers', 10.00, 0x666c6f7765722d706f742e706e67, 'I'),
(55, 'maki', 'sod', 'Appetizers', 110.00, 0x53637265656e73686f7420323032342d30352d3133203232313632362e706e67, 'I'),
(56, 'ice cream', 'malamig', 'Desserts', 110.00, 0x53637265656e73686f7420323032342d30352d3133203233303135352e706e67, 'I'),
(57, 'lkhkjdgqbjd', 'kjbqkjdvjhq', 'Beverages', 20.00, 0x53637265656e73686f7420323032342d30352d3133203232313335372e706e67, 'I'),
(58, 'jsjsjsjsjs', 'hshshhhshs', 'Hot Pot (Nabe)', 10.00, 0x53637265656e73686f7420323032342d30352d3133203233303231332e706e67, 'I'),
(59, 'faarrtyu', 'jkabhj', 'Yakitori and Kushiyaki', 150.00, 0x53637265656e73686f7420323032342d30352d3133203233303230342e706e67, 'I'),
(60, 'takoyaki', 'sanaol', 'Appetizers', 150.00, 0x77616c6c686176656e2d676a776736715f3235363078313038302e706e67, 'I'),
(61, 'apple', 'Japanese Dessert', 'Japanese Curry', 20.00, 0x392e706e67, 'I');

-- --------------------------------------------------------

--
-- Table structure for table `item_statuses`
--

CREATE TABLE `item_statuses` (
  `item_status_id` int(11) NOT NULL,
  `item_status_cd` char(1) NOT NULL,
  `item_status_desc` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_statuses`
--

INSERT INTO `item_statuses` (`item_status_id`, `item_status_cd`, `item_status_desc`) VALUES
(1, 'A', 'Active'),
(2, 'I', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `order_ref_number` varchar(9) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `gcash_ref_num` varchar(55) DEFAULT NULL,
  `gcash_account_name` varchar(55) DEFAULT NULL,
  `gcash_account_number` varchar(22) DEFAULT NULL,
  `gcash_amount_sent` double DEFAULT NULL,
  `shipper_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `alternate_receiver` varchar(100) DEFAULT NULL,
  `alternate_address` varchar(100) DEFAULT NULL,
  `items_id` int(11) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `item_qty` int(11) NOT NULL,
  `order_phase` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 - Cart\r\n2 - Checkout\r\n3 - Pending\r\n4 - Confirmed\r\n5 - Delivered\r\n0 - Cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `order_ref_number`, `payment_method`, `gcash_ref_num`, `gcash_account_name`, `gcash_account_number`, `gcash_amount_sent`, `shipper_id`, `user_id`, `alternate_receiver`, `alternate_address`, `items_id`, `date_added`, `item_qty`, `order_phase`) VALUES
(230, '17A6C8R1', 2, NULL, NULL, NULL, NULL, 1, 14, '', '', 48, '2024-06-03 04:04:23', 2, '5'),
(231, '44W3B0E4', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 49, '2024-06-03 04:10:09', 1, '5'),
(232, '44W3B0E4', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 51, '2024-06-03 04:10:14', 1, '5'),
(233, '44W3B0E4', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 52, '2024-06-03 04:10:18', 1, '5'),
(234, '60C0Z6N6', 2, NULL, NULL, NULL, NULL, 1, 14, '', '', 49, '2024-06-03 04:12:08', 1, '5'),
(235, '26Q3X4L2', 2, NULL, NULL, NULL, NULL, 1, 14, '', '', 50, '2024-06-03 04:12:54', 2, '5'),
(236, '35B3B0B7', 2, NULL, NULL, NULL, NULL, 1, 14, '', '', 52, '2024-06-03 04:14:18', 2, '5'),
(237, '61L1J9H6', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 52, '2024-06-03 04:15:57', 2, '5'),
(238, '08L9X3K0', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 48, '2024-06-03 04:56:03', 2, '5'),
(239, '90F0R2F4', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 48, '2024-06-03 05:11:16', 7, '5'),
(240, '49K5W1I0', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 48, '2024-06-03 05:14:27', 1, '5'),
(241, '03L1D6J0', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 50, '2024-06-03 05:21:55', 1, '5'),
(242, '23K4B6V0', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 54, '2024-06-03 05:22:49', 1, '5'),
(243, '10Q3N5A9', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 53, '2024-06-03 05:34:15', 2, '5'),
(244, '05T3W1T8', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 53, '2024-06-03 05:34:58', 3, '5'),
(245, '58C5O8K0', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 50, '2024-06-03 05:47:24', 2, '5'),
(246, '14B1S2U0', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 50, '2024-06-03 05:48:17', 4, '5'),
(247, '85S3L7G0', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 50, '2024-06-03 05:55:02', 3, '5'),
(248, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, 48, '2024-06-03 06:09:31', 1, '1'),
(250, '02K8Q1K5', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 48, '2024-06-03 06:21:22', 2, '5'),
(251, '08E8P0T7', 2, NULL, NULL, NULL, NULL, 1, 15, '', '', 48, '2024-06-03 06:24:42', 3, '5');

-- --------------------------------------------------------

--
-- Table structure for table `order_phase`
--

CREATE TABLE `order_phase` (
  `order_phase_id` int(11) NOT NULL,
  `order_phase_desc` varchar(55) NOT NULL,
  `order_phase_admin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_phase`
--

INSERT INTO `order_phase` (`order_phase_id`, `order_phase_desc`, `order_phase_admin`) VALUES
(1, 'Cart', ''),
(2, 'Checkout', 'New'),
(3, 'Pending', ''),
(4, 'Confirmed', ''),
(5, 'Delivered', ''),
(0, 'Cancelled', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `payment_method_desc` varchar(55) NOT NULL,
  `payment_method_status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`payment_method_id`, `payment_method_desc`, `payment_method_status`) VALUES
(1, 'GCASH', 'A'),
(2, 'COD', 'A'),
(3, 'Debit', 'A'),
(4, 'Credit Card', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `shippers`
--

CREATE TABLE `shippers` (
  `shipper_id` int(11) NOT NULL,
  `shipping_company` varchar(55) NOT NULL,
  `shipping_address` text DEFAULT NULL,
  `shipping_company_cd` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shippers`
--

INSERT INTO `shippers` (`shipper_id`, `shipping_company`, `shipping_address`, `shipping_company_cd`) VALUES
(1, 'J&T Express', NULL, 'JTX'),
(2, 'Flash Express', NULL, 'FX'),
(3, 'SPX', 'Shoppee Express', '');

-- --------------------------------------------------------

--
-- Table structure for table `total_per_date`
--

CREATE TABLE `total_per_date` (
  `total_per_date_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total_item_qty` int(11) NOT NULL,
  `total_sales` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_per_date`
--

INSERT INTO `total_per_date` (`total_per_date_id`, `date`, `total_item_qty`, `total_sales`) VALUES
(677, '2024-06-03', 43, 5690.00);

-- --------------------------------------------------------

--
-- Table structure for table `total_per_item`
--

CREATE TABLE `total_per_item` (
  `total_per_item_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total_item_qty` int(11) NOT NULL,
  `total_sales` decimal(10,2) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_per_item`
--

INSERT INTO `total_per_item` (`total_per_item_id`, `date`, `total_item_qty`, `total_sales`, `item_name`) VALUES
(48, '2024-06-03', 17, 1870.00, 'Mochi'),
(49, '2024-06-03', 2, 40.00, 'apple'),
(50, '2024-06-03', 12, 2400.00, 'Gyoza (Pan-Fried Dumplings)'),
(51, '2024-06-03', 1, 20.00, 'tako'),
(52, '2024-06-03', 5, 1250.00, 'hahahahah'),
(53, '2024-06-03', 5, 100.00, 'hahahaooow'),
(54, '2024-06-03', 1, 10.00, 'ayata');

-- --------------------------------------------------------

--
-- Table structure for table `total_per_order`
--

CREATE TABLE `total_per_order` (
  `total_per_order_id` int(11) NOT NULL,
  `order_ref_number` varchar(9) DEFAULT NULL,
  `total_item_qty` int(11) NOT NULL,
  `total_sales` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_per_order`
--

INSERT INTO `total_per_order` (`total_per_order_id`, `order_ref_number`, `total_item_qty`, `total_sales`) VALUES
(867, '17A6C8R1', 2, 220.00),
(868, '26Q3X4L2', 2, 400.00),
(869, '35B3B0B7', 2, 500.00),
(870, '44W3B0E4', 3, 290.00),
(871, '60C0Z6N6', 1, 20.00),
(872, '61L1J9H6', 2, 500.00),
(879, '08L9X3K0', 2, 220.00),
(882, '90F0R2F4', 7, 770.00),
(887, '49K5W1I0', 1, 110.00),
(893, '03L1D6J0', 1, 200.00),
(896, '23K4B6V0', 1, 10.00),
(903, '10Q3N5A9', 2, 40.00),
(906, '05T3W1T8', 3, 60.00),
(918, '14B1S2U0', 4, 800.00),
(919, '58C5O8K0', 2, 400.00),
(926, '85S3L7G0', 3, 600.00),
(937, '02K8Q1K5', 2, 220.00),
(944, '08E8P0T7', 3, 330.00);

-- --------------------------------------------------------

--
-- Table structure for table `total_per_user`
--

CREATE TABLE `total_per_user` (
  `total_per_user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(55) NOT NULL,
  `total_item_qty` int(11) NOT NULL,
  `total_sales` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_per_user`
--

INSERT INTO `total_per_user` (`total_per_user_id`, `fullname`, `username`, `total_item_qty`, `total_sales`) VALUES
(2, 'Yang Jungwon', 'wonie', 36, 4550.00),
(55, 'mika suchi', 'mika', 7, 1140.00);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_info_id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(22) NOT NULL,
  `gender` char(1) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_status` char(1) NOT NULL DEFAULT 'A',
  `user_type` char(1) NOT NULL DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_info_id`, `username`, `password`, `fullname`, `address`, `contact_no`, `gender`, `date_added`, `user_status`, `user_type`) VALUES
(12, 'niki', 'niki', 'mima souichiro', 'chiba', 'weeb', 'M', '2024-05-26 10:15:29', 'A', 'A'),
(13, 'sunki', 'sunki', 'nicole', 'chiba', '11222', 'M', '2024-05-26 10:48:22', 'A', 'C'),
(14, 'mika', 'mika', 'mika suchi', 'hahahha', '1562161246', 'M', '2024-05-26 11:35:44', 'A', 'C'),
(15, 'wonie', 'wonie', 'Yang Jungwon', 'chiba', '090909', 'M', '2024-06-02 15:14:37', 'A', 'C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`items_id`),
  ADD KEY `item_status_items` (`item_status`);

--
-- Indexes for table `item_statuses`
--
ALTER TABLE `item_statuses`
  ADD PRIMARY KEY (`item_status_id`),
  ADD KEY `item_status_cd` (`item_status_cd`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`),
  ADD KEY `user_id_orders` (`user_id`),
  ADD KEY `item_id_orders` (`items_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `shippers`
--
ALTER TABLE `shippers`
  ADD PRIMARY KEY (`shipper_id`);

--
-- Indexes for table `total_per_date`
--
ALTER TABLE `total_per_date`
  ADD PRIMARY KEY (`total_per_date_id`),
  ADD UNIQUE KEY `idx_date` (`date`);

--
-- Indexes for table `total_per_item`
--
ALTER TABLE `total_per_item`
  ADD PRIMARY KEY (`total_per_item_id`);

--
-- Indexes for table `total_per_order`
--
ALTER TABLE `total_per_order`
  ADD PRIMARY KEY (`total_per_order_id`),
  ADD UNIQUE KEY `idx_order_ref_number` (`order_ref_number`);

--
-- Indexes for table `total_per_user`
--
ALTER TABLE `total_per_user`
  ADD PRIMARY KEY (`total_per_user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_info_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `item_statuses`
--
ALTER TABLE `item_statuses`
  MODIFY `item_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shippers`
--
ALTER TABLE `shippers`
  MODIFY `shipper_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `total_per_date`
--
ALTER TABLE `total_per_date`
  MODIFY `total_per_date_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=761;

--
-- AUTO_INCREMENT for table `total_per_item`
--
ALTER TABLE `total_per_item`
  MODIFY `total_per_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `total_per_order`
--
ALTER TABLE `total_per_order`
  MODIFY `total_per_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=947;

--
-- AUTO_INCREMENT for table `total_per_user`
--
ALTER TABLE `total_per_user`
  MODIFY `total_per_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `item_status_items` FOREIGN KEY (`item_status`) REFERENCES `item_statuses` (`item_status_cd`) ON DELETE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`items_id`) REFERENCES `items` (`items_id`),
  ADD CONSTRAINT `user_id_orders` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_info_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
