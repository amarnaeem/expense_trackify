-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2024 at 06:50 PM
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
-- Database: `ema`
--

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `budget_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `budget_amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `budget_month` char(4) NOT NULL,
  `budget_year` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`budget_id`, `category_id`, `budget_amount`, `user_id`, `budget_month`, `budget_year`) VALUES
(20, 11, 3100, 33, '0', '0000'),
(22, 11, 5000, 33, '12', '24'),
(23, 11, 2000, 33, '12', '24');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_purpose` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_purpose`, `user_id`) VALUES
(11, 'Food', 'expense', NULL),
(12, 'Salary', 'income', NULL),
(14, 'aaa', 'expense', 33),
(15, 'transport', 'expense', 34);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL,
  `expense_amount` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `expense_details` varchar(255) NOT NULL,
  `expense_receipt` varchar(255) NOT NULL,
  `expense_date` varchar(255) NOT NULL,
  `expense_month` int(11) NOT NULL,
  `expense_year` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `expense_amount`, `category_id`, `expense_details`, `expense_receipt`, `expense_date`, `expense_month`, `expense_year`, `user_id`) VALUES
(58, 4000, 14, '', '', '2024-10-09', 10, 24, 33),
(59, 3004, 11, '', '', '2023-08-17', 8, 23, 33),
(60, 200, 14, '', '', '2024-11-14', 11, 24, 33),
(62, 2000, 15, '', '', '2024-11-07', 11, 24, 34),
(65, 3000, 11, '', '', '2024-11-11', 11, 24, 33);

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `income_id` int(11) NOT NULL,
  `income_amount` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `income_details` varchar(255) NOT NULL,
  `income_receipt` varchar(255) NOT NULL,
  `income_date` varchar(255) NOT NULL,
  `income_month` varchar(255) NOT NULL,
  `income_year` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `income_amount`, `category_id`, `income_details`, `income_receipt`, `income_date`, `income_month`, `income_year`, `user_id`) VALUES
(31, 3000, 12, '', '', '2024-11-08', '11', '24', 33),
(32, 4000, 12, '', '', '2024-10-11', '10', '24', 33),
(33, 9000, 12, '', '', '2023-12-07', '12', '23', 33),
(34, 4555, 12, 'rrrrrr', '', '2024-06-06', '06', '24', 33),
(36, 5000, 12, 'qqqqq', '', '2024-11-14', '11', '24', 34);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_image`, `role`, `reset_token`, `token_expiration`) VALUES
(19, 'admin', 'admin@gmail.com', '$2y$10$6nwdwwXbV7/cESH9wEX8Ku7lZ0dUa6dGZGFvQhJPhbHwfJRmmC9Ti', 'img1.png', 'Admin', NULL, 0),
(33, 'Ammar', 'ammarpucit111@gmail.com', '$2y$10$cVU9R9dzKxYrH92DBymyDelrHAhqnMXjcdFvj33DqvP5VcIIM21fy', '673fc3e336079.png', 'User', NULL, 0),
(34, 'abhii', 'abhiramramanaboina2002@gmail.com', '$2y$10$vgh8OuyNpNNjvk4go24g7ugijmTj953rX8Dz6CwCkB.x8gmTa6fnS', '673fbb63c9af6.png', 'User', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`budget_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`income_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `budget_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
