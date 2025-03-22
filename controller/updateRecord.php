<?php
session_start();
require_once '../database/config.php';
header('Content-Type: application/json'); // Ensure JSON output

$userid = intval($_SESSION['authUser']['userid']);

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


  if (!empty($date) && !empty($time)) {
    $datetime = date('Y-m-d H:i:s', strtotime("$date $time"));
  } elseif (!empty($date)) {
    $datetime = date('Y-m-d H:i:s', strtotime("$date 00:00:00"));
  } else {
    $datetime = date('Y-m-d H:i:s');
  }


  $query = "SELECT amount, transaction, userid FROM transactions WHERE transaction_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    $_SESSION['message'] = "Transaction not found!";
    $_SESSION['code'] = "error";
    echo json_encode(['success' => false, 'error' => "Transaction not found"]);
    exit();
  }

  $row = $result->fetch_assoc();
  $oldAmount = floatval($row['amount']);
  $oldTransaction = $row['transaction'];
  $userid = intval($row['userid']);
  $stmt->close();


  $query = "SELECT balance FROM accounts WHERE userid = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('i', $userid);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    $_SESSION['message'] = "Account not found!";
    $_SESSION['code'] = "error";
    echo json_encode(['success' => false, 'error' => "Account not found"]);
    exit();
  }

  $balance = floatval($result->fetch_assoc()['balance']);
  $stmt->close();


  if ($oldTransaction === 'expense') {
    $balance += $oldAmount; // Remove the effect of old expense
  } else {
    $balance -= $oldAmount; // Remove the effect of old income
  }

  if ($transaction === 'expense') {
    $balance -= $amount; // Subtract new expense
  } else {
    $balance += $amount; // Add new income
  }

  $query = "UPDATE transactions 
              SET amount = ?, category = ?, transaction = ?, date = ?, payment_type = ?, description = ?
              WHERE transaction_id = ?";

  $stmt = $conn->prepare($query);
  $stmt->bind_param('dsssssi', $amount, $category, $transaction, $datetime, $payment_type, $description, $id);

  if ($stmt->execute()) {
    // ✅ Step 7: Update the balance in the accounts table
    $query = "UPDATE accounts SET balance = ? WHERE userid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('di', $balance, $userid);
    $stmt->execute();

    $_SESSION['message'] = "Record and balance updated successfully!";
    $_SESSION['code'] = "success";
    echo json_encode(['success' => true]);
  } else {
    $_SESSION['message'] = "Database error: " . $stmt->error;
    $_SESSION['code'] = "error";
    echo json_encode(['success' => false, 'error' => $stmt->error]);
  }

  $stmt->close();
  $conn->close();
  exit();
}

$conn->close();
