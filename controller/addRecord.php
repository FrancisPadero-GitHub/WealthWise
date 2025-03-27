<?php
session_start();
include("../database/config.php");
$userid = intval($_SESSION['authUser']['userid']);

// ✅ Handle adding new record (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_record'])) {
  $amount = floatval($_POST['amount'] ?? 0);
  $category = trim($_POST['category'] ?? '');
  $transaction = strtolower(trim($_POST['transaction'] ?? ''));
  $date = trim($_POST['date'] ?? '');
  $account = trim($_POST['account'] ?? '');
  $description = trim($_POST['description'] ?? '');

  // ✅ Combine date and time into a single DATETIME value
  if (!empty($date)) {
    $datetime = date('Y-m-d', strtotime($date));
  } else {
    $datetime = date('Y-m-d'); // Default to today’s date if none provided
  }

  // ✅ Insert into database using prepared statement
  $sql = "INSERT INTO `transactions` 
                (`userid`, `amount`, `category`, `transaction`, `date`, `payment_type`, `description`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);

  if ($stmt) {
    // ✅ Bind parameters to prevent SQL injection
    $stmt->bind_param("idsssss", $userid, abs($amount), $category, $transaction, $datetime, $account, $description);

    if ($stmt->execute()) {
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
  header("Location: ../view/index.php");
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
  exit();
}
