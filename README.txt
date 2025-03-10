Things to add
- transaction update & delete [ok na]
- profile update & delete

Features
- charts integration [ok na]
- todo list 




TO RESET THE INCREMENTS OF THE DATABASE

ALTER TABLE transactions AUTO_INCREMENT = 1;
ALTER TABLE accounts AUTO_INCREMENT = 1;

DUMMY DATA TO USE for the Charts

INSERT INTO `transactions` 
(`userid`, `category`, `description`, `amount`, `date`, `payment_type`, `transaction`) 
VALUES 
-- Start from today
(1, 'Food and Drinks', 'Walmart shopping', '150.50', NOW(), 'credit', 'expense'),
(1, 'Transportation', 'Uber ride', '20.00', DATE_ADD(NOW(), INTERVAL 1 DAY), 'credit', 'expense'),
(1, 'Income', 'Monthly salary credited', '2500.00', DATE_ADD(NOW(), INTERVAL 2 DAY), 'cash', 'income'),
(1, 'Life and Entertainment', 'Netflix subscription', '15.00', DATE_ADD(NOW(), INTERVAL 3 DAY), 'credit', 'expense'),
(1, 'Communication & PC', 'Electric bill payment', '100.00', DATE_ADD(NOW(), INTERVAL 4 DAY), 'credit', 'expense'),
(1, 'Food and Drinks', 'Dinner at a restaurant', '60.00', DATE_ADD(NOW(), INTERVAL 5 DAY), 'cash', 'expense'),
(1, 'Shopping', 'New shoes', '120.00', DATE_ADD(NOW(), INTERVAL 6 DAY), 'credit', 'expense'),
(1, 'Investments', 'Stocks purchase', '500.00', DATE_ADD(NOW(), INTERVAL 7 DAY), 'credit', 'expense'),
(1, 'Health', 'Doctor consultation', '80.00', DATE_ADD(NOW(), INTERVAL 8 DAY), 'credit', 'expense'),
(1, 'House Rent', 'Monthly house rent', '1000.00', DATE_ADD(NOW(), INTERVAL 9 DAY), 'cash', 'expense'),

-- Increment by Year for Next 10 Transactions
(1, 'Food and Drinks', 'Grocery shopping', '75.00', DATE_ADD(NOW(), INTERVAL 1 YEAR), 'credit', 'expense'),
(1, 'Life and Entertainment', 'Movie tickets', '30.00', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'credit', 'expense'),
(1, 'Communication & PC', 'Internet bill', '45.00', DATE_ADD(NOW(), INTERVAL 3 YEAR), 'credit', 'expense'),
(1, 'Food and Drinks', 'Lunch with friends', '40.00', DATE_ADD(NOW(), INTERVAL 4 YEAR), 'cash', 'expense'),
(1, 'Investments', 'Crypto purchase', '300.00', DATE_ADD(NOW(), INTERVAL 5 YEAR), 'credit', 'expense'),
(1, 'Health', 'Gym membership', '60.00', DATE_ADD(NOW(), INTERVAL 6 YEAR), 'credit', 'expense'),
(1, 'Income', 'Freelance work', '1500.00', DATE_ADD(NOW(), INTERVAL 7 YEAR), 'cash', 'income'),
(1, 'Shopping', 'Clothing purchase', '80.00', DATE_ADD(NOW(), INTERVAL 8 YEAR), 'credit', 'expense'),
(1, 'Transportation', 'Gas refill', '50.00', DATE_ADD(NOW(), INTERVAL 9 YEAR), 'cash', 'expense'),
(1, 'Others', 'Online course payment', '200.00', DATE_ADD(NOW(), INTERVAL 10 YEAR), 'credit', 'expense');


DUMMY DATA TO USE FOR THE PERCENTAGE


INSERT INTO `transactions` 
(`userid`, `category`, `description`, `amount`, `date`, `payment_type`, `transaction`) 
VALUES 
-- ✅ Current Month Transactions (for testing current period)
(1, 'Food and Drinks', 'Walmart shopping', '150.50', NOW(), 'credit', 'expense'),
(1, 'Transportation', 'Uber ride', '20.00', DATE_ADD(NOW(), INTERVAL 1 DAY), 'credit', 'expense'),
(1, 'Income', 'Monthly salary credited', '2500.00', DATE_ADD(NOW(), INTERVAL 2 DAY), 'cash', 'income'),
(1, 'Life and Entertainment', 'Netflix subscription', '15.00', DATE_ADD(NOW(), INTERVAL 3 DAY), 'credit', 'expense'),
(1, 'Communication & PC', 'Electric bill payment', '100.00', DATE_ADD(NOW(), INTERVAL 4 DAY), 'credit', 'expense'),
(1, 'Food and Drinks', 'Dinner at a restaurant', '60.00', DATE_ADD(NOW(), INTERVAL 5 DAY), 'cash', 'expense'),
(1, 'Shopping', 'New shoes', '120.00', DATE_ADD(NOW(), INTERVAL 6 DAY), 'credit', 'expense'),
(1, 'Investments', 'Stocks purchase', '500.00', DATE_ADD(NOW(), INTERVAL 7 DAY), 'credit', 'expense'),
(1, 'Health', 'Doctor consultation', '80.00', DATE_ADD(NOW(), INTERVAL 8 DAY), 'credit', 'expense'),
(1, 'House Rent', 'Monthly house rent', '1000.00', DATE_ADD(NOW(), INTERVAL 9 DAY), 'cash', 'expense'),

-- ✅ Last Month Transactions (for percentage calculation)
(1, 'Food and Drinks', 'Walmart shopping', '100.00', DATE_SUB(NOW(), INTERVAL 1 MONTH), 'credit', 'expense'),
(1, 'Transportation', 'Taxi ride', '30.00', DATE_SUB(NOW(), INTERVAL 1 MONTH), 'cash', 'expense'),
(1, 'Income', 'Monthly salary', '2200.00', DATE_SUB(NOW(), INTERVAL 1 MONTH), 'cash', 'income'),
(1, 'Life and Entertainment', 'Spotify subscription', '12.00', DATE_SUB(NOW(), INTERVAL 1 MONTH), 'credit', 'expense'),
(1, 'Health', 'Medical checkup', '90.00', DATE_SUB(NOW(), INTERVAL 1 MONTH), 'credit', 'expense'),

-- ✅ Previous Year Data (for consistency over time)
(1, 'Food and Drinks', 'Grocery shopping', '75.00', DATE_SUB(NOW(), INTERVAL 1 YEAR), 'credit', 'expense'),
(1, 'Life and Entertainment', 'Movie tickets', '30.00', DATE_SUB(NOW(), INTERVAL 1 YEAR), 'credit', 'expense'),
(1, 'Communication & PC', 'Internet bill', '45.00', DATE_SUB(NOW(), INTERVAL 1 YEAR), 'credit', 'expense'),
(1, 'Income', 'Freelance work', '1500.00', DATE_SUB(NOW(), INTERVAL 1 YEAR), 'cash', 'income'),
(1, 'Investments', 'Crypto purchase', '300.00', DATE_SUB(NOW(), INTERVAL 1 YEAR), 'credit', 'expense'),

-- ✅ Future Year Data (for testing long-term consistency)
(1, 'Health', 'Gym membership', '60.00', DATE_ADD(NOW(), INTERVAL 1 YEAR), 'credit', 'expense'),
(1, 'Shopping', 'Clothing purchase', '80.00', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'credit', 'expense'),
(1, 'Transportation', 'Gas refill', '50.00', DATE_ADD(NOW(), INTERVAL 3 YEAR), 'cash', 'expense'),
(1, 'Others', 'Online course payment', '200.00', DATE_ADD(NOW(), INTERVAL 4 YEAR), 'credit', 'expense');
