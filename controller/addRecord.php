<?php
session_start();
include("../database/config.php");

header('Content-Type: application/json'); // Ensure JSON output

// ✅ Check if user is logged in
if (!isset($_SESSION['authUser']['userid'])) {
  $_SESSION['message'] = "User not authenticated!";
  $_SESSION['code'] = "error";
  header("Location: ../view/pages/login.php");
  exit();
}

$userid = intval($_SESSION['authUser']['userid']);

// ✅ Handle adding new record (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_record'])) {
  $amount = floatval($_POST['amount'] ?? 0);
  $category = trim($_POST['category'] ?? '');
  $transaction = strtolower(trim($_POST['transaction'] ?? ''));
  $date = trim($_POST['date'] ?? '');
  $time = trim($_POST['time'] ?? '');
  $account = trim($_POST['account'] ?? '');
  $description = trim($_POST['description'] ?? '');

  // ✅ Validate required fields
  if (empty($category) || empty($transaction) || empty($account)) {
    setSessionMessage("All fields are required!", "error");
  }

  // ✅ Automatically sets the amount to positive
  $amount = abs($amount);

  // ✅ Combine date and time into a single DATETIME value
  if (!empty($date) && !empty($time)) {
    $datetime = date('Y-m-d H:i:s', strtotime("$date $time"));
  } elseif (!empty($date)) {
    $datetime = date('Y-m-d H:i:s', strtotime("$date 00:00:00"));
  } else {
    $datetime = date('Y-m-d H:i:s');
  }

  // ✅ Insert into database using prepared statement
  $sql = "INSERT INTO `transactions` 
                (`userid`, `amount`, `category`, `transaction`, `date`, `payment_type`, `description`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);

  if ($stmt) {
    // ✅ Bind parameters to prevent SQL injection
    $stmt->bind_param("idsssss", $userid, $amount, $category, $transaction, $datetime, $account, $description);

    if ($stmt->execute()) {
      header("Location: ../view/index.php");
      setSessionMessage("Record added successfully!", "success",);
    } else {
      setSessionMessage("Database error: " . $stmt->error, "error",);
    }
  } else {
    setSessionMessage("Error preparing statement!", "error",);
  }
}

$conn->close();

// ✅ Helper function for setting session messages and redirecting
function setSessionMessage($message, $code)
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
  exit();
}
