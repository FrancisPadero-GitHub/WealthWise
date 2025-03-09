<?php
include("../database/config.php");

// gets the userid from the login process to determine who is logged in and sql query for the user
$userid = $_SESSION['authUser']['userid']; // can be accessed anywhere in the project

/** THIS IS FOR THE FILTER DATE FOR THE TRANSACTIONS TABLE */
// Get filter value from URL
// Handle filter and search inputs
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Base SQL query
$sql = "SELECT transaction_id, category, description, amount, date FROM transactions WHERE userid = $userid";

// Apply date filters
if ($filter == 'today') {
  $sql .= " AND DATE(date) = CURDATE()";
} elseif ($filter == 'month') {
  $sql .= " AND MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
} elseif ($filter == 'year') {
  $sql .= " AND YEAR(date) = YEAR(CURDATE())";
} elseif ($filter == 'all_time') {
  // No date filter applied for "all time" — leave the query unchanged
}

$result = $conn->query($sql);



// fetch the latest balance
$sql2 = "SELECT balance 
         FROM accounts 
         WHERE userid = $userid ";
$balanceResult = $conn->query($sql2);

if ($balanceResult->num_rows > 0) {
  $balanceRow = $balanceResult->fetch_assoc();
  $balance = $balanceRow['balance'];
} else {
  $balance = 0; // Default balance if no record found
}

// fetch expenses and income
$sql3 = "SELECT SUM(amount) AS total FROM transactions WHERE userid = $userid AND transaction = 'expense'";
$expense = $conn->query($sql3);

if ($expense->num_rows > 0) {
  $totalExpense = $expense->fetch_assoc()['total'] ?? 0;
} else {
  $totalExpense = 0; // Default to 0 if no result
}
// income
$sql4 = "SELECT SUM(amount) AS total FROM transactions WHERE userid = $userid AND transaction = 'income'";
$income = $conn->query($sql4);

if ($income->num_rows > 0) {
  $totalIncome = $income->fetch_assoc()['total'] ?? 0;
} else {
  $totalIncome = 0; // Default to 0 if no result
}

/** CRUDS */

// add new record
// if (isset($_POST['add_record'])) {
//   $
// }




$conn->close();
