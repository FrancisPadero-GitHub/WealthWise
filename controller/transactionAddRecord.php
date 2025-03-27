<?php
session_start();
require_once '../database/config.php';

$userid = intval($_SESSION['authUser']['userid']);

// ✅ Handle POST requests add data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_record'])) {
  $amount = floatval($_POST['amount'] ?? 0);
  $category = trim($_POST['category'] ?? '');
  $transaction = strtolower(trim($_POST['transaction'] ?? ''));
  $date = !empty($_POST['date']) ? date('Y-m-d', strtotime($_POST['date'])) : date('Y-m-d');
  $account = trim($_POST['account'] ?? '');
  $description = trim($_POST['description'] ?? '');

  if ($amount <= 0 || empty($category) || empty($transaction)) {
    setSessionMessage("Invalid input data. Please check the fields!", "error");
  }

  $query = "INSERT INTO `transactions` 
              (`userid`, `amount`, `category`, `transaction`, `date`, `payment_type`, `description`) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

  if (executeQuery($query, "idsssss", $userid, abs($amount), $category, $transaction, $date, $account, $description)) {
    setSessionMessage("Record added successfully!", "success");
  } else {
    setSessionMessage("Failed to add record!", "error");
  }
}

$conn->close();

/** ✅ Helper function to execute prepared statement */
function executeQuery($query, $types, ...$params)
{
  global $conn;
  $stmt = $conn->prepare($query);
  if ($stmt) {
    $stmt->bind_param($types, ...$params);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }
  return false;
}

/** ✅ Helper function for setting session messages and redirecting */
function setSessionMessage($message, $code)
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
  header("Location: ../view/index.php");
  exit();
}
