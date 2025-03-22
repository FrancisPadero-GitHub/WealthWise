-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2025 at 05:06 PM
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
(4, 'Francis', 'Padero', 3092.50, 'francispadero2001@gmail.com', '$2y$10$vTNVjPZ5l6/iZ3/VeLSaM.eu1UCDtSBkbafLQyJwZB.WJph7vDUOC');

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
(1, 4, 'Food and Drinks', 'Test', 60.00, '2025-03-22 00:00:00', 'cash', 'income'),
(2, 4, 'Food and Drinks', 'Walmart shopping', 150.50, '2025-03-22 23:07:30', 'credit', 'expense'),
(3, 4, 'Transportation', 'Uber ride', 20.00, '2025-03-23 23:07:30', 'credit', 'expense'),
(4, 4, 'Income', 'Monthly salary credited', 2500.00, '2025-03-24 23:07:30', 'cash', 'income'),
(5, 4, 'Life and Entertainment', 'Netflix subscription', 15.00, '2025-03-25 23:07:30', 'credit', 'expense'),
(6, 4, 'Communication & PC', 'Electric bill payment', 100.00, '2025-03-26 23:07:30', 'credit', 'expense'),
(7, 4, 'Food and Drinks', 'Dinner at a restaurant', 60.00, '2025-03-27 23:07:30', 'cash', 'expense'),
(8, 4, 'Shopping', 'New shoes', 120.00, '2025-03-28 23:07:30', 'credit', 'expense'),
(9, 4, 'Investments', 'Stocks purchase', 500.00, '2025-03-29 23:07:30', 'credit', 'expense'),
(10, 4, 'Health', 'Doctor consultation', 80.00, '2025-03-30 23:07:30', 'credit', 'expense'),
(11, 4, 'House Rent', 'Monthly house rent', 1000.00, '2025-03-31 23:07:30', 'cash', 'expense'),
(12, 4, 'Food and Drinks', 'Walmart shopping', 100.00, '2025-02-22 23:07:30', 'credit', 'expense'),
(13, 4, 'Transportation', 'Taxi ride', 30.00, '2025-02-22 23:07:30', 'cash', 'expense'),
(14, 4, 'Income', 'Monthly salary', 2200.00, '2025-02-22 23:07:30', 'cash', 'income'),
(15, 4, 'Life and Entertainment', 'Spotify subscription', 12.00, '2025-02-22 23:07:30', 'credit', 'expense'),
(16, 4, 'Health', 'Medical checkup', 90.00, '2025-02-22 23:07:30', 'credit', 'expense'),
(17, 4, 'Food and Drinks', 'Grocery shopping', 75.00, '2024-03-22 23:07:30', 'credit', 'expense'),
(18, 4, 'Life and Entertainment', 'Movie tickets', 30.00, '2024-03-22 23:07:30', 'credit', 'expense'),
(19, 4, 'Communication & PC', 'Internet bill', 45.00, '2024-03-22 23:07:30', 'credit', 'expense'),
(20, 4, 'Income', 'Freelance work', 1500.00, '2024-03-22 23:07:30', 'cash', 'income'),
(21, 4, 'Investments', 'Crypto purchase', 300.00, '2024-03-22 23:07:30', 'credit', 'expense'),
(22, 4, 'Health', 'Gym membership', 60.00, '2026-03-22 23:07:30', 'credit', 'expense'),
(23, 4, 'Shopping', 'Clothing purchase', 80.00, '2027-03-22 23:07:30', 'credit', 'expense'),
(24, 4, 'Transportation', 'Gas refill', 50.00, '2028-03-22 23:07:30', 'cash', 'expense'),
(25, 4, 'Others', 'Online course payment', 200.00, '2029-03-22 23:07:30', 'credit', 'expense');

--
-- Triggers `transactions`
--
DELIMITER $$
CREATE TRIGGER `update_balance_after_transaction` AFTER INSERT ON `transactions` FOR EACH ROW BEGIN
    IF NEW.transaction = 'income' THEN
        -- Add amount for income
        UPDATE accounts
        SET balance = balance + NEW.amount
        WHERE userid = NEW.userid;
    ELSEIF NEW.transaction = 'expense' THEN
        -- Subtract amount for expense
        UPDATE accounts
        SET balance = balance - NEW.amount
        WHERE userid = NEW.userid;
    END IF;
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
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
