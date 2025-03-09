-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2025 at 12:24 PM
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
-- Database: `wealthwise`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `userid` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`userid`, `first_name`, `last_name`, `balance`, `email`, `password`) VALUES
(4, 'cindy claire', 'booc', 2074.50, 'cindyclairebooc@gmail.com', '$2y$10$.I0iGJNbLCyYf0ou4OJ.HuUfun0AiqcN9cAiU8KeNLwk9vDE8r5ES'),
(5, 'francis', 'padero', 0.00, 'francispadero2001@gmail.com', '$2y$10$s/jF73N1TrssO7bEu3SiFOEEzmDVP1dOug3n2Crrg24BOnu7owlqi');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `payment_type` enum('cash','credit') NOT NULL,
  `transaction` enum('expense','income') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `userid`, `category`, `description`, `amount`, `date`, `payment_type`, `transaction`) VALUES
(207, 4, 'Groceries', 'Walmart shopping', 150.50, '2025-03-09 14:24:45', 'credit', 'income'),
(208, 4, 'Income Test', 'Salary', 1000.00, '2025-03-09 14:25:34', 'cash', 'income'),
(209, 4, 'Groceries', 'Walmart shopping', -150.50, '2025-03-09 14:48:59', 'credit', 'expense'),
(210, 4, 'Utilities', 'Electric bill payment', -349.50, '2025-02-15 00:00:00', 'credit', 'expense'),
(211, 4, 'Groceries', 'Walmart shopping', -150.50, '2025-03-09 15:02:49', 'credit', 'expense'),
(212, 4, 'Transport', 'Uber ride', -20.00, '2025-03-09 15:02:49', 'credit', 'expense'),
(213, 4, 'Salary', 'Monthly salary credited', 2500.00, '2025-03-07 15:02:49', 'cash', 'income'),
(214, 4, 'Entertainment', 'Netflix subscription', -15.00, '2025-02-27 15:02:49', 'credit', 'expense'),
(215, 4, 'Utilities', 'Electric bill payment', -100.00, '2025-02-15 00:00:00', 'credit', 'expense'),
(216, 4, 'Food', 'Dinner at a restaurant', -60.00, '2025-01-20 00:00:00', 'cash', 'expense'),
(217, 4, 'Shopping', 'New shoes', -120.00, '2024-06-10 00:00:00', 'credit', 'expense'),
(218, 4, 'Investment', 'Stocks purchase', -500.00, '2024-08-25 00:00:00', 'credit', 'expense'),
(219, 4, 'Health', 'Doctor consultation', -80.00, '2023-04-12 00:00:00', 'credit', 'expense'),
(220, 4, 'Rent', 'Monthly house rent', -1000.00, '2022-11-05 00:00:00', 'cash', 'expense'),
(221, 4, 'Transport', 'Gas refill', -50.00, '2025-03-04 15:02:49', 'cash', 'expense'),
(222, 4, 'Education', 'Online course payment', -200.00, '2025-03-06 15:02:49', 'credit', 'expense'),
(223, 4, 'Groceries', 'Grocery shopping', -75.00, '2024-07-18 00:00:00', 'credit', 'expense'),
(224, 4, 'Entertainment', 'Movie tickets', -30.00, '2024-12-05 00:00:00', 'credit', 'expense'),
(225, 4, 'Utilities', 'Internet bill', -45.00, '2025-03-10 00:00:00', 'credit', 'expense'),
(226, 4, 'Food', 'Lunch with friends', -40.00, '2025-01-30 00:00:00', 'cash', 'expense'),
(227, 4, 'Investment', 'Crypto purchase', -300.00, '2023-09-14 00:00:00', 'credit', 'expense'),
(228, 4, 'Health', 'Gym membership', -60.00, '2023-07-05 00:00:00', 'credit', 'expense'),
(229, 4, 'Salary', 'Freelance work', 1500.00, '2025-03-09 15:02:49', 'cash', 'income'),
(230, 4, 'Shopping', 'Clothing purchase', -80.00, '2025-03-09 15:02:49', 'credit', 'expense');

--
-- Triggers `transactions`
--
DELIMITER $$
CREATE TRIGGER `update_balance_after_transaction` AFTER INSERT ON `transactions` FOR EACH ROW BEGIN
    -- Directly add the amount (positive for income, negative for expense)
    UPDATE accounts
    SET balance = balance + NEW.amount
    WHERE userid = NEW.userid;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`email`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `accounts` (`userid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
