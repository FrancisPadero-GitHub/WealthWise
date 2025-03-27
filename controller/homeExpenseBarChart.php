<?php
session_start();
require_once '../database/config.php';

$userid = intval($_SESSION['authUser']['userid']);

// ✅ Fetch Expense Summary Data
$data = getExpenseSummary($userid);

// ✅ Return JSON response
header('Content-Type: application/json');
echo json_encode($data);
exit();

/** ✅ Function to get expense summary data */
function getExpenseSummary($userid)
{
  $query = "SELECT category, SUM(amount) AS total 
              FROM transactions 
              WHERE userid = ? AND transaction = 'expense' 
              GROUP BY category";

  $results = fetchAllResults($query, 'i', $userid);

  if ($results) {
    return array_map(function ($row) {
      return [
        'category' => $row['category'],
        'total'    => abs(floatval($row['total'])) // Ensure positive value for display
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
