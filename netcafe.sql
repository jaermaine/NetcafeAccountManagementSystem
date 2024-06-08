-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 08:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `netcafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `first_name`, `last_name`, `username`, `password`, `time`, `role_id`, `status_id`, `active`) VALUES
(1, 'Jaermaine', 'Domingcil', 'zero', '$2y$10$sw.AIUGjZX8sQGcgRaZSh.8wWwtNSkukTFekZHqwvC1kJOzZpBg5i', 0, 1, 3, 1),
(2, 'staff', 'staff', 'staff', '$2y$10$B8/y1Az6FfmKmrRuprK3BeYGzPSAqNGkGVatrgXn826kKJ9pJlLwi', 0, 2, 3, 0),
(8, 'romuel', 'borja', 'romuel', '$2y$10$qt0bcMEIwTBT3gD/TDJQ8OpZgd4Gldq78eMdHLVIvadNXSiKXBQDm', 3600, 3, 1, 0),
(9, 'admin', 'admin', 'admin', '$2y$10$tbwbb00ZA0aEndFGr30YT.EkJpiart12./1tsUoXi6rSGTtV4U7uy', 0, 1, 3, 0),
(14, 'lorenzo', 'canales', 'onoda', '$2y$10$piMtCxM1NmXgm2VTAxNiP.K3wZ37vJ1y6dthma0ffbqGwXS6wE936', 7177, 3, 1, 0),
(16, 'test', 'test', 'test', '$2y$10$KxmjfIz3Qj0lLqwgqAPCxuWrAB2jN1zLfJhzGiqOPZBvP60oXSI4u', 3596, 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `food_id` int(11) NOT NULL,
  `food_transac_id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_transactions`
--

CREATE TABLE `food_transactions` (
  `food_transac_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Staff'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `services_id` int(11) NOT NULL,
  `service_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'Regular'),
(2, 'VIP'),
(3, 'Non-Customer');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `food_transactions`
--
ALTER TABLE `food_transactions`
  ADD PRIMARY KEY (`food_transac_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`services_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `services` (`services_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_transactions`
--
ALTER TABLE `food_transactions`
  MODIFY `food_transac_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `account_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `food_transactions`
--
ALTER TABLE `food_transactions`
  ADD CONSTRAINT `food_transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`user_id`),
  ADD CONSTRAINT `food_transactions_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`food_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`user_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`services_id`) REFERENCES `services` (`services_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
