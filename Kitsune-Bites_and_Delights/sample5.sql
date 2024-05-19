-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2024 at 10:34 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

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
  `item_price` decimal(7,2) NOT NULL,
  `item_status` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`items_id`, `item_name`, `item_desc`, `item_price`, `item_status`) VALUES
(1, 'Item Test', 'Test Only', '100.00', 'I'),
(2, 'Iphone 12', 'Apol pradaks', '40000.00', 'I'),
(3, 'Iphone 13', 'Mango', '30000.00', 'A'),
(4, 'Iphone 14', 'Apol', '60000.00', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `item_statuses`
--

CREATE TABLE `item_statuses` (
  `item_status_id` int(11) NOT NULL,
  `item_status_cd` char(1) NOT NULL,
  `item_status_desc` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `order_ref_number` varchar(8) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `item_qty` int(11) NOT NULL,
  `order_phase` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 - Cart\r\n2 - Checkout\r\n3 - Pending\r\n4 - Confirmed\r\n5 - Delivered\r\n0 - Cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `order_ref_number`, `user_id`, `item_id`, `date_added`, `item_qty`, `order_phase`) VALUES
(7, '', 4, 3, '2024-04-24 08:08:18', 30, '1'),
(12, '', 4, 4, '2024-04-24 08:26:53', 10, '1'),
(13, '', 4, 3, '2024-04-24 08:26:56', 10, '1');

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
  `contact_no` varchar(11) NOT NULL,
  `gender` char(1) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_status` char(1) NOT NULL DEFAULT 'A',
  `user_type` char(1) NOT NULL DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_info_id`, `username`, `password`, `fullname`, `address`, `contact_no`, `gender`, `date_added`, `user_status`, `user_type`) VALUES
(1, 'sample1', '12345', 'sample lang po', 'Sample Albay', '1234566788', 'X', '2024-02-22 06:26:40', 'A', 'A'),
(2, 'sample2', '1234', 'Sample Din Po', 'Sample Albay', '87000', 'X', '2024-02-22 06:27:20', 'A', 'C'),
(4, 'rllagas', '12345', 'Reymar', 'Polangui Albay', '09985518206', 'M', '2024-04-24 07:04:59', 'A', 'C'),
(5, 'rllagas01', '12345', 'Reymar Again', 'pol', '0999999', 'M', '2024-04-24 07:06:15', 'A', 'C'),
(6, 'rllagas02', '123', 'Reymar Again', 'aknskjsdksjd', '982398293', 'M', '2024-04-24 07:07:17', 'A', 'C');

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
  ADD KEY `item_id_orders` (`item_id`);

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
  MODIFY `items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_statuses`
--
ALTER TABLE `item_statuses`
  MODIFY `item_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `user_id_orders` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_info_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
