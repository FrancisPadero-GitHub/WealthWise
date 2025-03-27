<?php
session_start();
require_once '../database/config.php';
header('Content-Type: application/json');

$userid = intval($_SESSION['authUser']['userid']);

// ✅ Get transaction details (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  if ($id > 0) {
    $query = "SELECT * FROM transactions WHERE transaction_id = ?";
    $result = fetchSingleResult($query, 'i', $id);
    if ($result) {
      echo json_encode($result);
    } else {
      jsonResponse(false, "Record not found.");
    }
  } else {
    jsonResponse(false, "Invalid transaction ID.");
  }
  exit();
}

// ✅ Handle POST requests (Update/Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_POST['transaction_id'] ?? 0);

  if ($id <= 0) {
    jsonResponse(false, "Invalid transaction ID.");
  }

  if (isset($_POST['delete'])) {
    deleteTransaction($id);
  } else {
    updateTransaction($id);
  }
}

// ✅ Delete a transaction
function deleteTransaction($id)
{
  $query = "DELETE FROM transactions WHERE transaction_id = ?";
  if (executeQuery($query, 'i', $id)) {
    setSessionMessage("Record deleted successfully!", "success");
    jsonResponse(true, "Record deleted successfully!");
  } else {
    jsonResponse(false, "Failed to delete record.");
  }
}

// ✅ Update a transaction
function updateTransaction($id)
{
  global $userid;

  $amount = floatval($_POST['amount'] ?? 0);
  $category = trim($_POST['category'] ?? '');
  $transaction = strtolower(trim($_POST['transaction'] ?? ''));
  $date = !empty($_POST['date']) ? date('Y-m-d', strtotime($_POST['date'])) : date('Y-m-d');
  $payment_type = trim($_POST['account'] ?? '');
  $description = trim($_POST['description'] ?? '');

  // ✅ Validate inputs
  if ($amount <= 0 || empty($category) || empty($transaction)) {
    jsonResponse(false, "Invalid input data. Please check the fields!");
  }

  // ✅ Get existing transaction
  $query = "SELECT amount, transaction, userid FROM transactions WHERE transaction_id = ?";
  $transactionData = fetchSingleResult($query, 'i', $id);

  if (!$transactionData) {
    jsonResponse(false, "Transaction not found!");
  }

  $oldAmount = floatval($transactionData['amount']);
  $oldTransaction = $transactionData['transaction'];
  $userid = intval($transactionData['userid']);

  // ✅ Get current balance
  $query = "SELECT balance FROM accounts WHERE userid = ?";
  $accountData = fetchSingleResult($query, 'i', $userid);

  if (!$accountData) {
    jsonResponse(false, "Account not found!");
  }

  $balance = floatval($accountData['balance']);

  // ✅ Reverse the effect of the old transaction
  $balance += ($oldTransaction === 'expense') ? $oldAmount : -$oldAmount;

  // ✅ Apply the effect of the new transaction
  $balance += ($transaction === 'expense') ? -$amount : $amount;

  // ✅ Update transaction
  $query = "UPDATE transactions 
              SET amount = ?, category = ?, transaction = ?, date = ?, payment_type = ?, description = ?
              WHERE transaction_id = ?";
  if (executeQuery($query, 'dsssssi', $amount, $category, $transaction, $date, $payment_type, $description, $id)) {

    // ✅ Update account balance
    $query = "UPDATE accounts SET balance = ? WHERE userid = ?";
    executeQuery($query, 'di', $balance, $userid);

    setSessionMessage("Record and balance updated successfully!", "success");
    jsonResponse(true, "Record and balance updated successfully!");
  } else {
    jsonResponse(false, "Failed to update record.");
  }
}

/** ✅ Helper to execute a query with prepared statement */
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

/** ✅ Helper to fetch a single result */
function fetchSingleResult($query, $types, ...$params)
{
  global $conn;
  $stmt = $conn->prepare($query);
  if ($stmt) {
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result;
  }
  return null;
}

/** ✅ Helper to set session message */
function setSessionMessage($message, $code)
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
}

/** ✅ Helper to send JSON response */
function jsonResponse($success, $message)
{
  echo json_encode(['success' => $success, 'message' => $message]);
  exit();
}

$conn->close();
