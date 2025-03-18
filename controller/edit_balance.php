<?php
session_start();
include("../database/config.php");

$userid = intval($_SESSION['authUser']['userid']);

if (isset($_POST['edit_balance'])) {
  $balance = floatval($_POST['balance'] ?? 0);

  if ($balance < 0) {
    $_SESSION['message'] = "Balance cannot be manually set to negative!";
    $_SESSION['code'] = "error";
    header("Location: ../view/index.php");
    exit();
  }

  // Update balance in the database
  $sql = "UPDATE accounts SET balance = ? WHERE userid = ?";
  $stmt = $conn->prepare($sql);

  if ($stmt) {
    $stmt->bind_param("di", $balance, $userid);
    if ($stmt->execute()) {
      $_SESSION['message'] = "Balance updated successfully!";
      $_SESSION['code'] = "success";

      // Redirect back to index page or dashboard
      header("Location: ../view/index.php");
      exit();
    } else {
      $_SESSION['message'] = "Failed to update balance.";
      $_SESSION['code'] = "error";
    }
    $stmt->close();
  } else {
    $_SESSION['message'] = "Error preparing statement!";
    $_SESSION['code'] = "error";
  }
}

$conn->close();
