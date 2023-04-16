-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2023 at 07:46 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(0, 'satabdi rath', 'satabdirath2000@gmail.com', '2298'),
(1, 'admin', 'admin@gmail.com', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `created_at`) VALUES
(17, 0, '10400.00', '2023-04-14 08:04:00'),
(18, 0, '3081.00', '2023-04-14 15:04:04'),
(19, 0, '24000.00', '2023-04-15 12:15:59'),
(20, 0, '20.00', '2023-04-15 12:42:34'),
(21, 0, '100.00', '2023-04-15 12:44:38'),
(22, 0, '40.00', '2023-04-15 12:46:37'),
(23, 0, '24000.00', '2023-04-15 12:50:15'),
(24, 0, '10000.00', '2023-04-16 05:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`) VALUES
(17, 17, 3, 1, '400.00', '2023-04-14 08:04:00'),
(18, 17, 4, 1, '10000.00', '2023-04-14 08:04:00'),
(19, 18, 2, 1, '3000.00', '2023-04-14 15:04:04'),
(20, 18, 9, 1, '81.00', '2023-04-14 15:04:04'),
(21, 19, 5, 1, '24000.00', '2023-04-15 12:15:59'),
(22, 20, 7, 1, '20.00', '2023-04-15 12:42:34'),
(23, 21, 8, 1, '100.00', '2023-04-15 12:44:38'),
(24, 22, 6, 1, '40.00', '2023-04-15 12:46:37'),
(25, 23, 5, 1, '24000.00', '2023-04-15 12:50:15'),
(26, 24, 4, 1, '10000.00', '2023-04-16 05:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'mobile', 'poco m33 5g', '5000.00', '1.jpeg'),
(2, 'mobile', 'realme c33', '3000.00', '2.jpg'),
(4, 'laptop', ' DELL XPS 15 ', '10000.00', '15.jpg'),
(5, ' laptop', 'HP 15s-fq2673', '24000.00', '4.jpg'),
(6, ' Gift items', 'combo teddy', '40.00', '5.jpg'),
(7, ' Gift items', 'single teddy', '20.00', '6.jpg'),
(8, ' Gift items', 'dancing couple', '100.00', '7.jpg'),
(9, ' Gift items', 'Antique lord ganesh', '81.00', '8.jpg'),
(10, ' watches', 'mens wrist watch', '320.00', '10.jpg'),
(11, 'watches', 'Daniel Klein womens watch', '350.00', '11.jpg'),
(12, 'watches', 'tommy hilfiger womens watch', '450.00', '12.jpg'),
(13, 'watches', 'noise smart watch ', '415.00', '13.jpg'),
(14, ' laptop', 'dell inspiron 15 3000', '7000.00', '14.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `reset_token`) VALUES
(1, '', '', '', NULL),
(2, '', '', '', NULL),
(3, '', '', '', NULL),
(4, '', '', '', NULL),
(5, 'satabdi', 'satabdi@gmail.com', 'sss', '242c92819af915e549616d998f3a8027'),
(6, 'minati rath', 'minatirath@gmail.com', 'mmm', NULL),
(7, 'satabdi', 'fff@example.com', 'rrrr', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_idx` (`user_id`),
  ADD KEY `product_id_idx` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id_idx` (`order_id`),
  ADD KEY `product_id_idx` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
