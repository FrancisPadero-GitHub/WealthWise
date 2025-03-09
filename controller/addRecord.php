<?php
session_start();
include("../database/config.php");

// Check if user is logged in
if (isset($_SESSION['authUser']['userid'])) {
  $userid = intval($_SESSION['authUser']['userid']);
} else {
  $_SESSION['message'] = "UserID didn't initialize!";
  $_SESSION['code'] = "error";

}

// Add new record
if (isset($_POST['add_record'])) {
  // Get form data and apply fallback values
  $amount = floatval($_POST['amount'] ?? 0);
  $category = trim($_POST['category'] ?? '');
  $transaction = trim($_POST['transaction'] ?? '');
  $date = trim($_POST['date'] ?? '');
  $time = trim($_POST['time'] ?? '');
  $account = trim($_POST['account'] ?? '');
  $description = trim($_POST['description'] ?? '');

  // ✅ Automatically format amount based on transaction type
  if (strtolower($transaction) === 'expense') {
    $amount = -abs($amount); // Make it negative
  } elseif (strtolower($transaction) === 'income') {
    $amount = abs($amount); // Make it positive
  }

  // ✅ Combine date and time into a single DATETIME value
  if (!empty($date) && !empty($time)) {
    $datetime = date('Y-m-d H:i:s', strtotime("$date $time"));
  } else {
    $datetime = date('Y-m-d H:i:s'); // Use current date and time if missing
  }


  // Prepare SQL statement
  $sql = "INSERT INTO `transactions` 
                (`userid`, `amount`, `category`, `transaction`, `date`, `payment_type`, `description`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);
  if ($stmt) {
    // Bind parameters to prevent SQL injection
    $stmt->bind_param("idsssss", $userid, $amount, $category, $transaction, $datetime, $account, $description);
    $execute = $stmt->execute();

    if ($execute) {
      $_SESSION['message'] = "Added new Record!";
      $_SESSION['code'] = "success";
      header("Location: ../view/index.php");
      exit();
    } else {
      $_SESSION['message'] = "Database error: " . $conn->error;
      $_SESSION['code'] = "error";
      header("Location: ../view/pages/add.php");
      exit();
    }
  } else {
    $_SESSION['message'] = "Error preparing statement!";
    $_SESSION['code'] = "error";
    header("Location: ../view/pages/add.php");
    exit();
  }
}

$conn->close();
