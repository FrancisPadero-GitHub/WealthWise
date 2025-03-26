-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 10:15 AM
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
(1, 'Francis', 'Padero', -2.00, 'francispadero2001@gmail.com', '$2y$10$p3iXH/RI5DX01xKJQV3Og.sMVM.XI9.4NmjZMvPzQCjSEal.NctXS'),
(2, 'Cindy Claire', 'Booc', 320.00, 'cindyclairebooc@gmail.com', '$2y$10$nfKWUS05aBXh.9Ev/mHM1.U4RTCNyYHh.ne1.K7UKRHo2Eym0vYSm'),
(4, 'Annriza', 'Lam', 0.00, 'annriza30lam@gmail.com', '$2y$10$kDcXEvHa4xu7fSROuQGJ7.KximTzaHjuzukL2QCMSlrbcWeJyR9FK');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `taskid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`taskid`, `title`, `content`, `date`) VALUES
(1, 'Test Task', 'This is a test.', '2025-03-19 20:04:00'),
(7, 'task to edit', 'weferfw', '2025-03-13 17:02:00'),
(8, 'task to delete', 'use this tp test delete', '2025-03-12 17:14:00');

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
(2, 1, 'Transport', 'Uber ride', -20.00, '2025-03-11 14:23:52', 'credit', 'expense'),
(3, 1, 'Salary', 'Monthly salary credited', 2500.00, '2025-03-12 14:23:52', 'cash', 'income'),
(4, 1, 'Entertainment', 'Netflix subscription', -15.00, '2025-03-13 14:23:52', 'credit', 'expense'),
(5, 1, 'Utilities', 'Electric bill payment', -100.00, '2025-03-14 14:23:52', 'credit', 'expense'),
(6, 1, 'Food', 'Dinner at a restaurant', -60.00, '2025-03-15 14:23:52', 'cash', 'expense'),
(7, 1, 'Shopping', 'New shoes', -120.00, '2025-03-16 14:23:52', 'credit', 'expense'),
(8, 1, 'Investment', 'Stocks purchase', -500.00, '2025-03-17 14:23:52', 'credit', 'expense'),
(9, 1, 'Health', 'Doctor consultation', -80.00, '2025-03-18 14:23:52', 'credit', 'expense'),
(10, 1, 'Rent', 'Monthly house rent', -1000.00, '2025-03-19 14:23:52', 'cash', 'expense'),
(11, 1, 'Groceries', 'Grocery shopping', -75.00, '2026-03-10 14:23:52', 'credit', 'expense'),
(12, 1, 'Entertainment', 'Movie tickets', -30.00, '2027-03-10 14:23:52', 'credit', 'expense'),
(13, 1, 'Utilities', 'Internet bill', -45.00, '2028-03-10 14:23:52', 'credit', 'expense'),
(14, 1, 'Food', 'Lunch with friends', -40.00, '2029-03-10 14:23:52', 'cash', 'expense'),
(15, 1, 'Investment', 'Crypto purchase', -300.00, '2030-03-10 14:23:52', 'credit', 'expense'),
(16, 1, 'Health', 'Gym membership', -60.00, '2031-03-10 14:23:52', 'credit', 'expense'),
(17, 1, 'Salary', 'Freelance work', 1500.00, '2032-03-10 14:23:52', 'cash', 'income'),
(18, 1, 'Shopping', 'Clothing purchase', -80.00, '2033-03-10 14:23:52', 'credit', 'expense'),
(19, 1, 'Transport', 'Gas refill', -50.00, '2034-03-10 14:23:52', 'cash', 'expense'),
(20, 1, 'Education', 'Online course payment', -200.00, '2035-03-10 14:23:52', 'credit', 'expense'),
(21, 2, 'Food and Drinks', 'Cake', -50.00, '2025-03-10 07:37:18', 'cash', 'expense'),
(22, 2, 'Transportation', 'Plete', -80.00, '2025-03-11 00:00:00', 'cash', 'expense'),
(23, 2, 'Income', 'Balon', 100.00, '2025-03-11 00:00:00', 'cash', 'income'),
(24, 2, 'Income', 'Commission', 250.00, '2025-03-12 00:00:00', 'cash', 'income'),
(25, 2, 'Investments', 'ROI', 600.00, '2025-03-13 00:00:00', 'cash', 'income'),
(26, 2, 'Shopping', 'Wattsons', -500.00, '2025-03-14 00:00:00', 'cash', 'expense'),
(27, 1, 'Food and Drinks', '', 1.00, '2025-03-11 00:00:00', 'cash', 'income'),
(28, 1, 'Food and Drinks', '', 1.00, '2025-03-14 00:00:00', 'cash', 'expense'),
(29, 1, 'Food and Drinks', '', 0.00, '2025-03-11 07:47:26', 'cash', 'expense'),
(30, 1, 'Food and Drinks', '', 0.00, '2025-03-11 07:47:48', 'cash', 'expense'),
(31, 1, 'Food and Drinks', '', 1.00, '2025-03-07 00:00:00', 'cash', 'expense');

--
-- Triggers `transactions`
--
DELIMITER $$
CREATE TRIGGER `update_account_balance` AFTER INSERT ON `transactions` FOR EACH ROW BEGIN
    -- If the transaction is income, add the amount
    IF NEW.transaction = 'income' THEN
        UPDATE accounts
        SET balance = balance + NEW.amount
        WHERE userid = NEW.userid;
    END IF;  -- This was missing 

    -- If the transaction is expense, subtract the amount
    IF NEW.transaction = 'expense' THEN
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
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`taskid`);

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
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `taskid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
