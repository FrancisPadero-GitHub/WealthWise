<?php
session_start();
require_once '../database/config.php';

$userid = intval($_SESSION['authUser']['userid']);

// ✅ Fetch Money Traffic Data
$data = getMoneyTrafficData($userid);

// ✅ Return JSON response
header('Content-Type: application/json');
echo json_encode($data);
exit();

/** ✅ Function to get money traffic data */
function getMoneyTrafficData($userid)
{
  $query = "SELECT `category`, SUM(`amount`) AS total 
              FROM `transactions` 
              WHERE `userid` = ? AND `transaction` = 'expense'
              GROUP BY `category`";

  $results = fetchAllResults($query, 'i', $userid);

  if ($results) {
    $data = array_map(function ($row) {
      return [
        'name'  => $row['category'],
        'value' => abs(floatval($row['total']))
      ];
    }, $results);
  } else {
    $data = [['name' => 'No Data', 'value' => 0]];
  }

  return $data;
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
