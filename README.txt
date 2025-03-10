Things to add
- transaction update & delete
- profile update & delete

Features
- charts integration
- todo list



TO RESET THE INCREMENTS OF THE DATABASE

ALTER TABLE transactions AUTO_INCREMENT = 1;
ALTER TABLE accounts AUTO_INCREMENT = 1;

DUMMY DATA TO USE

INSERT INTO `transactions` 
(`userid`, `category`, `description`, `amount`, `date`, `payment_type`, `transaction`) 
VALUES 
-- Start from today
(1, 'Groceries', 'Walmart shopping', '-150.50', NOW(), 'credit', 'expense'),
(1, 'Transport', 'Uber ride', '-20.00', DATE_ADD(NOW(), INTERVAL 1 DAY), 'credit', 'expense'),
(1, 'Salary', 'Monthly salary credited', '2500.00', DATE_ADD(NOW(), INTERVAL 2 DAY), 'cash', 'income'),
(1, 'Entertainment', 'Netflix subscription', '-15.00', DATE_ADD(NOW(), INTERVAL 3 DAY), 'credit', 'expense'),
(1, 'Utilities', 'Electric bill payment', '-100.00', DATE_ADD(NOW(), INTERVAL 4 DAY), 'credit', 'expense'),
(1, 'Food', 'Dinner at a restaurant', '-60.00', DATE_ADD(NOW(), INTERVAL 5 DAY), 'cash', 'expense'),
(1, 'Shopping', 'New shoes', '-120.00', DATE_ADD(NOW(), INTERVAL 6 DAY), 'credit', 'expense'),
(1, 'Investment', 'Stocks purchase', '-500.00', DATE_ADD(NOW(), INTERVAL 7 DAY), 'credit', 'expense'),
(1, 'Health', 'Doctor consultation', '-80.00', DATE_ADD(NOW(), INTERVAL 8 DAY), 'credit', 'expense'),
(1, 'Rent', 'Monthly house rent', '-1000.00', DATE_ADD(NOW(), INTERVAL 9 DAY), 'cash', 'expense'),

-- Increment by Year for Next 10 Transactions
(1, 'Groceries', 'Grocery shopping', '-75.00', DATE_ADD(NOW(), INTERVAL 1 YEAR), 'credit', 'expense'),
(1, 'Entertainment', 'Movie tickets', '-30.00', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'credit', 'expense'),
(1, 'Utilities', 'Internet bill', '-45.00', DATE_ADD(NOW(), INTERVAL 3 YEAR), 'credit', 'expense'),
(1, 'Food', 'Lunch with friends', '-40.00', DATE_ADD(NOW(), INTERVAL 4 YEAR), 'cash', 'expense'),
(1, 'Investment', 'Crypto purchase', '-300.00', DATE_ADD(NOW(), INTERVAL 5 YEAR), 'credit', 'expense'),
(1, 'Health', 'Gym membership', '-60.00', DATE_ADD(NOW(), INTERVAL 6 YEAR), 'credit', 'expense'),
(1, 'Salary', 'Freelance work', '1500.00', DATE_ADD(NOW(), INTERVAL 7 YEAR), 'cash', 'income'),
(1, 'Shopping', 'Clothing purchase', '-80.00', DATE_ADD(NOW(), INTERVAL 8 YEAR), 'credit', 'expense'),
(1, 'Transport', 'Gas refill', '-50.00', DATE_ADD(NOW(), INTERVAL 9 YEAR), 'cash', 'expense'),
(1, 'Education', 'Online course payment', '-200.00', DATE_ADD(NOW(), INTERVAL 10 YEAR), 'credit', 'expense');