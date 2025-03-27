<?php
session_start();
require_once '../database/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $taskId = intval($_POST["taskid"] ?? 0);
  $status = trim($_POST["status"] ?? "");

  // ✅ Validate inputs
  if ($taskId <= 0 || !in_array($status, ['yes', 'no'])) {
    setSessionMessage("Invalid input data!", "error");
  }

  $query  = "UPDATE tasks SET is_completed = ? WHERE id = ?";
  $params = [$status, $taskId];
  $types  = 'si';

  if (executeQuery($query, $types, ...$params)) {
    setSessionMessage("Task status updated successfully!", "success");
  } else {
    setSessionMessage("Failed to update task status!", "error");
  }
}

/** ✅ Helper to execute query */
function executeQuery($query, $types, ...$params)
{
  global $conn;
  $stmt = $conn->prepare($query);

  if (!$stmt) {
    error_log("Error preparing statement: " . $conn->error);
    return false;
  }

  $stmt->bind_param($types, ...$params);

  if (!$stmt->execute()) {
    error_log("Query execution failed: " . $stmt->error);
    return false;
  }

  $stmt->close();
  return true;
}

/** ✅ Helper to set session message and redirect */
function setSessionMessage($message, $code, $redirect = "../view/index.php")
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
  header("Location: $redirect");
  exit();
}
