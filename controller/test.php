<?php
session_start();
include("../database/config.php");
$userid = intval($_SESSION['authUser']['userid']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dummy_data'])) {
  $sql = "
  INSERT INTO `transactions` 
  (`userid`, `category`, `description`, `amount`, `date`, `payment_type`, `transaction`) 
  VALUES 
  ($userid, 'Food and Drinks', 'Walmart shopping', '150.50', NOW(), 'credit', 'expense'),
  ($userid, 'Transportation', 'Uber ride', '20.00', DATE_ADD(NOW(), INTERVAL 1 DAY), 'credit', 'expense'),
  ($userid, 'Income', 'Monthly salary credited', '2500.00', DATE_ADD(NOW(), INTERVAL 2 DAY), 'cash', 'income'),
  ($userid, 'Life and Entertainment', 'Netflix subscription', '15.00', DATE_ADD(NOW(), INTERVAL 3 DAY), 'credit', 'expense'),
  ($userid, 'Communication & PC', 'Electric bill payment', '100.00', DATE_ADD(NOW(), INTERVAL 4 DAY), 'credit', 'expense'),
  ($userid, 'Food and Drinks', 'Dinner at a restaurant', '60.00', DATE_ADD(NOW(), INTERVAL 5 DAY), 'cash', 'expense'),
  ($userid, 'Shopping', 'New shoes', '120.00', DATE_ADD(NOW(), INTERVAL 6 DAY), 'credit', 'expense'),
  ($userid, 'Investments', 'Stocks purchase', '500.00', DATE_ADD(NOW(), INTERVAL 7 DAY), 'credit', 'expense'),
  ($userid, 'Health', 'Doctor consultation', '80.00', DATE_ADD(NOW(), INTERVAL 8 DAY), 'credit', 'expense'),
  ($userid, 'House Rent', 'Monthly house rent', '1000.00', DATE_ADD(NOW(), INTERVAL 9 DAY), 'cash', 'expense'),
  ($userid, 'Food and Drinks', 'Walmart shopping', '100.00', DATE_SUB(NOW(), INTERVAL 1 MONTH), 'credit', 'expense'),
  ($userid, 'Transportation', 'Taxi ride', '30.00', DATE_SUB(NOW(), INTERVAL 1 MONTH), 'cash', 'expense'),
  ($userid, 'Income', 'Monthly salary', '2200.00', DATE_SUB(NOW(), INTERVAL 1 MONTH), 'cash', 'income'),
  ($userid, 'Life and Entertainment', 'Spotify subscription', '12.00', DATE_SUB(NOW(), INTERVAL 1 MONTH), 'credit', 'expense'),
  ($userid, 'Health', 'Medical checkup', '90.00', DATE_SUB(NOW(), INTERVAL 1 MONTH), 'credit', 'expense'),
  ($userid, 'Food and Drinks', 'Grocery shopping', '75.00', DATE_SUB(NOW(), INTERVAL 1 YEAR), 'credit', 'expense'),
  ($userid, 'Life and Entertainment', 'Movie tickets', '30.00', DATE_SUB(NOW(), INTERVAL 1 YEAR), 'credit', 'expense'),
  ($userid, 'Communication & PC', 'Internet bill', '45.00', DATE_SUB(NOW(), INTERVAL 1 YEAR), 'credit', 'expense'),
  ($userid, 'Income', 'Freelance work', '1500.00', DATE_SUB(NOW(), INTERVAL 1 YEAR), 'cash', 'income'),
  ($userid, 'Investments', 'Crypto purchase', '300.00', DATE_SUB(NOW(), INTERVAL 1 YEAR), 'credit', 'expense'),
  ($userid, 'Health', 'Gym membership', '60.00', DATE_ADD(NOW(), INTERVAL 1 YEAR), 'credit', 'expense'),
  ($userid, 'Shopping', 'Clothing purchase', '80.00', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'credit', 'expense'),
  ($userid, 'Transportation', 'Gas refill', '50.00', DATE_ADD(NOW(), INTERVAL 3 YEAR), 'cash', 'expense'),
  ($userid, 'Others', 'Online course payment', '200.00', DATE_ADD(NOW(), INTERVAL 4 YEAR), 'credit', 'expense');
  ";

  if ($conn->query($sql)) {
    header("Location: ../view/index.php");
    setSessionMessage("Dummy data generated!", "success");
  } else {
    setSessionMessage("Database error: " . $conn->error, "error");
  }
  $conn->close();
}

function setSessionMessage($message, $code)
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
  exit(); // Exit here ensures nothing else runs after setting message
}
