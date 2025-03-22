<?php

session_start();
require_once '../database/config.php';
$userid = intval($_SESSION['authUser']['userid']);

// Fetch expenses
$sqlExpenses = "SELECT DATE(date) as date, SUM(amount) AS total
                FROM transactions
                WHERE userid = ? AND transaction = 'expense'
                GROUP BY DATE(date)
                ORDER BY date ASC";

$stmt = $conn->prepare($sqlExpenses);
$expenses = [];

if ($stmt) {
  $stmt->bind_param("i", $userid);
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      $expenses[] = [
        'date'  => $row['date'],
        'total' => abs($row['total'])
      ];
    }
  }
  $stmt->close();
}

// Fetch income
$sqlIncome = "SELECT DATE(date) as date, SUM(amount) AS total
              FROM transactions
              WHERE userid = ? AND transaction = 'income'
              GROUP BY DATE(date)
              ORDER BY date ASC";

$stmt = $conn->prepare($sqlIncome);
$income = [];

if ($stmt) {
  $stmt->bind_param("i", $userid);
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      $income[] = [
        'date'  => $row['date'],
        'total' => floatval($row['total'])
      ];
    }
  }
  $stmt->close();
}

$conn->close();

header('Content-Type: application/json');
echo json_encode([
  'expenses' => $expenses,
  'income'   => $income
]);
