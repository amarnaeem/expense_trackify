-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 09:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`budget_id`, `category_id`, `budget_amount`, `user_id`) VALUES
(1, 7, 4000, 0),
(3, 4, 4000, 0),
(4, 1, 20000, 0),
(5, 6, 7000, 0),
(6, 1, 15000, 13),
(7, 7, 5000, 13),
(8, 1, 15000, 5),
(9, 4, 4000, 13),
(10, 4, 10000, 12),
(11, 7, 4000, 12),
(12, 7, 4000, 16);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_purpose` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_purpose`) VALUES
(1, 'study', 'expense'),
(2, 'bussiness', 'income'),
(3, 'commission', 'income'),
(4, 'grocery', 'expense'),
(5, 'medical', 'income'),
(6, 'clothing', 'expense'),
(7, 'fit gym', 'expense'),
(8, 'investment', 'expense');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `expense_amount`, `category_id`, `expense_details`, `expense_receipt`, `expense_date`, `expense_month`, `expense_year`, `user_id`) VALUES
(15, 12000, 1, 'papper fee', '', '2022-07-05', 7, 22, 5),
(16, 1000, 4, 'qqqq', '1639640254371.jpg', '2022-07-04', 7, 22, 5),
(17, 500, 7, 'aaa', '', '2022-07-12', 7, 22, 13),
(18, 5000, 1, 'eee', '', '2022-07-12', 7, 22, 13),
(19, 5000, 4, 'home lcd', '', '2022-07-08', 7, 22, 13),
(20, 2000, 8, 'bitcoin', '', '2022-06-17', 7, 22, 13),
(21, 500, 6, '123', '', '2022-06-01', 7, 22, 13),
(22, 500, 8, 'yyyyy', '', '2022-06-08', 7, 22, 13),
(23, 500, 7, 'uuuuuu', '', '2022-06-07', 7, 22, 13),
(24, 500, 1, '111', '', '2022-06-08', 7, 22, 13),
(25, 500, 4, 'aaaaaaaaaaaaa', '', '2022-06-08', 7, 22, 13),
(26, 5000, 4, 'maggie', '1639640254371.jpg', ' 2022-06-09', 7, 22, 12),
(27, 1500, 7, 'jym fee', '', '2022-07-12', 7, 22, 12),
(28, 3000, 7, 'qqqq', '', '2022-07-22', 7, 22, 16);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `income_amount`, `category_id`, `income_details`, `income_receipt`, `income_date`, `income_month`, `income_year`, `user_id`) VALUES
(13, 1500, 2, 'profit in investement', '', '2022-07-05', '07', '22', 5),
(14, 15000, 2, 'weekly income', '', '2022-07-07', '07', '22', 5),
(15, 2000, 5, 'aaa', '', '2022-07-05', '07', '22', 13),
(16, 3000, 2, 'week earning', '', '2022-07-22', '07', '22', 13),
(17, 1000, 2, 'qqqq', '', '2022-07-23', '07', '22', 13),
(18, 5000, 2, 'yessssss', '', '2022-07-18', '07', '22', 13),
(19, 5000, 3, 'sudden profit', '', '2022-06-07', '07', '22', 13),
(20, 10000, 2, 'tution fee', '', ' 2022-06-11', '07', '22', 12),
(21, 5000, 2, 'kkk', '', '2022-07-14', '07', '22', 16);

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
  `salt` varchar(255) NOT NULL DEFAULT '$2y$10$quickbrownfoxjumpsover',
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_image`, `salt`, `role`) VALUES
(5, 'Zain', 'zain@gmail.com', '12345', '2.jpg', '$2y$10$quickbrownfoxjumpsover', ''),
(11, 'Rohail', 'rohail@gmail.com', '123456', '1.jfif', '$2y$10$quickbrownfoxjumpsover', ''),
(12, 'Abdullah', 'abdullah@gmail.com', '12345', '3.jfif', '$2y$10$quickbrownfoxjumpsover', ''),
(13, 'Muneeb', 'muneeb@gmail.com', 'abcde', '4.jpg', '$2y$10$quickbrownfoxjumpsover', ''),
(15, 'hunain', 'hunain@gmail.com', '12345', '1.jfif', '$2y$10$quickbrownfoxjumpsover', ''),
(16, 'admin', 'admin@gmail.com', 'admin', '1639640254355.jpg', '$2y$10$quickbrownfoxjumpsover', 'Admin');

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
  MODIFY `budget_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
