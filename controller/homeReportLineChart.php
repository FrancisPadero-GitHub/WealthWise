<?php
session_start();
require_once '../database/config.php';

$userid = intval($_SESSION['authUser']['userid']);

// ✅ Fetch Expenses and Income
$expenses = getTransactionSummary($userid, 'expense');
$income = getTransactionSummary($userid, 'income');

// ✅ Return JSON response
header('Content-Type: application/json');
echo json_encode([
  'expenses' => $expenses,
  'income'   => $income
]);
exit();

/** ✅ Function to get transaction summary */
function getTransactionSummary($userid, $type)
{
  $query = "SELECT DATE(date) as date, SUM(amount) AS total
              FROM transactions
              WHERE userid = ? AND transaction = ?
              GROUP BY DATE(date)
              ORDER BY date ASC";

  $results = fetchAllResults($query, 'is', $userid, $type);

  if ($results) {
    return array_map(function ($row) use ($type) {
      return [
        'date'  => $row['date'],
        'total' => ($type === 'expense') ? abs(floatval($row['total'])) : floatval($row['total'])
      ];
    }, $results);
  }

  return [];
}

/** ✅ Helper to execute query and fetch all results */
function fetchAllResults($query, $types, ...$params)
{
  global $conn;
  $stmt = $conn->prepare($query);

  if (!$stmt) {
    error_log("Error preparing statement: " . $conn->error);
    setSessionMessage("Error preparing statement!", "error");
    return null;
  }

  $stmt->bind_param($types, ...$params);

  if (!$stmt->execute()) {
    error_log("Query execution failed: " . $stmt->error);
    setSessionMessage("Failed to execute query!", "error");
    return null;
  }

  $result = $stmt->get_result();
  $data = $result->fetch_all(MYSQLI_ASSOC);

  $stmt->close();
  return $data;
}

/** ✅ Helper to set session message */
function setSessionMessage($message, $code)
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
}

$conn->close();
