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
    setSessionMessage("All fields are required!", "error", "../view/pages/add.php");
  }

  // ✅ Automatically format amount based on transaction type
  $amount = ($transaction === 'expense') ? -abs($amount) : abs($amount);

  // ✅ Combine date and time into a single DATETIME value
  $datetime = (!empty($date) && !empty($time))
    ? date('Y-m-d H:i:s', strtotime("$date $time"))
    : date('Y-m-d H:i:s');

  // ✅ Insert into database using prepared statement
  $sql = "INSERT INTO `transactions` 
                (`userid`, `amount`, `category`, `transaction`, `date`, `payment_type`, `description`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);

  if ($stmt) {
    // ✅ Bind parameters to prevent SQL injection
    $stmt->bind_param("idsssss", $userid, $amount, $category, $transaction, $datetime, $account, $description);

    if ($stmt->execute()) {
      setSessionMessage("Record added successfully!", "success", "../view/index.php");
    } else {
      setSessionMessage("Database error: " . $stmt->error, "error", "../view/pages/add.php");
    }
  } else {
    setSessionMessage("Error preparing statement!", "error", "../view/pages/add.php");
  }
}

$conn->close();

// ✅ Helper function for setting session messages and redirecting
function setSessionMessage($message, $code, $redirect)
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
  header("Location: $redirect");
  exit();
}
