<?php
require_once '../database/config.php';

// Check if the user is authenticated or not before displaying or redirecting to dashboard
if (!isset($_SESSION['authUser']['userid'])) {
  setSessionMessage("User not authenticated!", "error");
  header("Location: ../view/login.php");
  exit();
}

$userid = intval($_SESSION['authUser']['userid']);

/** ✅ Helper Functions **/
function runQuery($conn, $sql, $params, $types)
{
  $stmt = $conn->prepare($sql);
  if ($stmt) {
    $stmt->bind_param($types, ...$params);
    if ($stmt->execute()) {
      return $stmt->get_result();
    } else {
      setSessionMessage("Failed to execute query: " . $conn->error, "error");
      return false;
    }
  } else {
    setSessionMessage("Error preparing statement: " . $conn->error, "error");
    return false;
  }
}

function setSessionMessage($message, $code)
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
}

function fetchSingleValue($result, $column)
{
  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    return $row[$column] ?? 0;
  }
  return 0;
}

/** ✅ Transaction Records **/
$filter = $_GET['filter'] ?? '';
$sql = "SELECT * FROM transactions WHERE userid = ?";
if ($filter === 'today') {
  $sql .= " AND DATE(date) = CURDATE()";
} elseif ($filter === 'month') {
  $sql .= " AND MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
} elseif ($filter === 'year') {
  $sql .= " AND YEAR(date) = YEAR(CURDATE())";
}
$sql .= " ORDER BY transaction_id DESC";

$transactions = runQuery($conn, $sql, [$userid], "i");

/** ✅ Account Balance **/
$sql = "SELECT balance FROM accounts WHERE userid = ?";
$balance = fetchSingleValue(runQuery($conn, $sql, [$userid], "i"), 'balance');

/** ✅ All-Time Expenses **/
$sql = "SELECT SUM(amount) AS total FROM transactions WHERE userid = ? AND transaction = 'expense'";
$allTimeExpense = fetchSingleValue(runQuery($conn, $sql, [$userid], "i"), 'total');

/** ✅ Current Month Expenses **/
$sql = "SELECT SUM(amount) AS total FROM transactions WHERE userid = ? AND transaction = 'expense' 
        AND MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
$totalExpense = fetchSingleValue(runQuery($conn, $sql, [$userid], "i"), 'total');

/** ✅ Previous Month's Expenses **/
$sql = "SELECT SUM(amount) AS total FROM transactions WHERE userid = ? AND transaction = 'expense' 
        AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
$prevExpense = fetchSingleValue(runQuery($conn, $sql, [$userid], "i"), 'total');

/** ✅ Percentage Increase in Expenses **/
$percentageIncrease = $prevExpense > 0 ? (($totalExpense - $prevExpense) / $prevExpense) * 100 : 0;

/** ✅ Current Income **/
$sql = "SELECT SUM(amount) AS total FROM transactions WHERE userid = ? AND transaction = 'income' 
        AND MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
$totalIncome = fetchSingleValue(runQuery($conn, $sql, [$userid], "i"), 'total');

/** ✅ Previous Month's Income **/
$sql = "SELECT SUM(amount) AS total FROM transactions WHERE userid = ? AND transaction = 'income' 
        AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
$prevIncome = fetchSingleValue(runQuery($conn, $sql, [$userid], "i"), 'total');

/** ✅ Percentage Increase in Income **/
$incomePercentageIncrease = $prevIncome > 0 ? (($totalIncome - $prevIncome) / $prevIncome) * 100 : 0;

/** ✅ Profile **/
$sql = "SELECT * FROM accounts WHERE userid = ?";
$userData = runQuery($conn, $sql, [$userid], "i");
if ($userData && $userData->num_rows > 0) {
  $data = $userData->fetch_assoc();
  $firstName = $data['first_name'];
  $lastName = $data['last_name'];
  $balance = $data['balance'];
  $email = $data['email'];
}

/** ✅ Tasks **/
$sql = "SELECT * FROM tasks WHERE userid = ? ORDER BY id DESC";
$tasksResult = runQuery($conn, $sql, [$userid], "i");
$tasksData = ['active' => [], 'completed' => []];

if ($tasksResult) {
  while ($row = $tasksResult->fetch_assoc()) {
    if ($row['is_completed'] === 'yes') {
      $tasksData['completed'][] = $row;
    } else {
      $tasksData['active'][] = $row;
    }
  }
}
