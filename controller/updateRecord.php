<?php
session_start();
include("../database/config.php");

header('Content-Type: application/json'); // Ensure JSON output

// ✅ Get transaction details (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  if ($id > 0) {
    $query = "SELECT * FROM transactions WHERE transaction_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
      echo json_encode($result);
    } else {
      echo json_encode(['success' => false, 'error' => 'Record not found.']);
    }
  } else {
    echo json_encode(['success' => false, 'error' => 'Invalid transaction ID.']);
  }
  exit();
}

// ✅ Handle POST requests (Update/Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_POST['transaction_id'] ?? 0);

  if ($id <= 0) {
    echo json_encode(['success' => false, 'error' => 'Invalid transaction ID.']);
    exit();
  }

  if (isset($_POST['delete'])) {
    // ✅ Delete the record
    deleteTransaction($conn, $id);
  } else {
    // ✅ Update the record
    updateTransaction($conn, $id);
  }
}

// ✅ Function to delete a transaction
function deleteTransaction($conn, $id)
{
  $query = "DELETE FROM transactions WHERE transaction_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('i', $id);

  if ($stmt->execute()) {
    $_SESSION['message'] = "Record deleted successfully!";
    $_SESSION['code'] = "success";
    echo json_encode(['success' => true, 'message' => 'Record deleted successfully!']);
  } else {
    $_SESSION['message'] = "Database error: " . $stmt->error;
    $_SESSION['code'] = "error";
    echo json_encode(['success' => false, 'error' => $stmt->error]);
  }
  exit();
}

// ✅ Function to update a transaction
function updateTransaction($conn, $id)
{
  $amount = floatval($_POST['amount'] ?? 0);
  $category = trim($_POST['category'] ?? '');
  $transaction = strtolower(trim($_POST['transaction'] ?? ''));
  $date = trim($_POST['date'] ?? '');
  $time = trim($_POST['time'] ?? '');
  $payment_type = trim($_POST['account'] ?? '');
  $description = trim($_POST['description'] ?? '');

  // ✅ Adjust amount based on transaction type
  $amount = ($transaction === 'expense') ? -abs($amount) : abs($amount);

  // ✅ Combine date and time into a single DATETIME value
  $datetime = (!empty($date) && !empty($time))
    ? date('Y-m-d H:i:s', strtotime("$date $time"))
    : date('Y-m-d H:i:s');

  $query = "UPDATE transactions 
              SET amount = ?, category = ?, transaction = ?, date = ?, payment_type = ?, description = ?
              WHERE transaction_id = ?";

  $stmt = $conn->prepare($query);
  $stmt->bind_param('ssssssi', $amount, $category, $transaction, $datetime, $payment_type, $description, $id);

  if ($stmt->execute()) {
    $_SESSION['message'] = "Record updated successfully!";
    $_SESSION['code'] = "success";
    echo json_encode(['success' => true]);
  } else {
    $_SESSION['message'] = "Database error: " . $stmt->error;
    $_SESSION['code'] = "error";
    echo json_encode(['success' => false, 'error' => $stmt->error]);
  }
  exit();
}

$conn->close();
