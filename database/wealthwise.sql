-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 08:06 AM
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
(1, 'Francis', 'Padero', 1.00, 'francispadero2001@gmail.com', '$2y$10$p3iXH/RI5DX01xKJQV3Og.sMVM.XI9.4NmjZMvPzQCjSEal.NctXS'),
(2, 'Cindy Claire', 'Booc', 0.00, 'cindyclairebooc@gmail.com', '$2y$10$nfKWUS05aBXh.9Ev/mHM1.U4RTCNyYHh.ne1.K7UKRHo2Eym0vYSm'),
(3, 'Francis', 'Padero', 0.00, 'frankpadero2025@gmail.com', '$2y$10$FWSJRQQAeF8umsmdXwqFGeuMrrHeYMpB2mW6UsZwofWu5ZM4wUhrq');

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
(25, 1, 'Food and Drinks', 'Income Last Month', 100.00, '2025-02-10 00:00:00', 'cash', 'income'),
(26, 1, 'Food and Drinks', 'Income this month', 20.00, '2025-03-10 00:00:00', 'cash', 'income'),
(27, 1, 'Food and Drinks', '', 100.00, '2025-03-10 00:00:00', 'cash', 'income'),
(28, 1, 'Food and Drinks', '', 100.00, '2025-02-10 00:00:00', 'cash', 'expense'),
(29, 1, 'Food and Drinks', '', 20.00, '2025-03-10 00:00:00', 'cash', 'expense'),
(30, 1, 'Food and Drinks', '', 100.00, '2025-03-10 00:00:00', 'cash', 'expense');

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
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
