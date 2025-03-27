<?php
session_start();
require_once '../database/config.php';

$userid = intval($_SESSION['authUser']['userid']);

/** ✅ Helper Functions **/
function runQuery($conn, $sql, $params, $types)
{
  $stmt = $conn->prepare($sql);
  if ($stmt) {
    $stmt->bind_param($types, ...$params);
    if ($stmt->execute()) {
      return true;
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

function redirect($location)
{
  header("Location: $location");
  exit();
}

/** ✅ Handle Balance Update **/
if (isset($_POST['edit_balance'])) {
  $balance = floatval($_POST['balance'] ?? 0);

  if ($balance < 0) {
    setSessionMessage("Balance cannot be manually set to negative!", "error");
    redirect("../view/index.php");
  }

  // Update balance in the database
  $sql = "UPDATE accounts SET balance = ? WHERE userid = ?";
  if (runQuery($conn, $sql, [$balance, $userid], "di")) {
    setSessionMessage("Balance updated successfully!", "success");
  } else {
    setSessionMessage("Failed to update balance.", "error");
  }

  redirect("../view/index.php");
}

$conn->close();
