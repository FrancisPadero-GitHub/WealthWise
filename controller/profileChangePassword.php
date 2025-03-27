<?php
session_start();
require_once '../database/config.php';

$userid = intval($_SESSION['authUser']['userid']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_pass'])) {
  // ✅ Sanitize and validate inputs
  $currentPassword = trim($_POST['password'] ?? '');
  $newPassword     = trim($_POST['newpassword'] ?? '');
  $renewPassword   = trim($_POST['renewpassword'] ?? '');

  if (!$currentPassword || !$newPassword || !$renewPassword) {
    setSessionMessage("All fields are required!", "error", "../view/index.php?page=profile");
  }

  if ($newPassword !== $renewPassword) {
    setSessionMessage("New passwords do not match!", "error", "../view/index.php?page=profile");
  }

  // ✅ Fetch current password from database
  $query = "SELECT password FROM accounts WHERE userid = ?";
  $hashedPassword = executeQueryAndFetch($query, 'i', $userid)['password'] ?? null;

  if (!$hashedPassword || !password_verify($currentPassword, $hashedPassword)) {
    setSessionMessage("Current password is incorrect!", "error", "../view/index.php?page=profile");
  }

  // ✅ Hash the new password securely
  $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

  // ✅ Update password in database
  $updateQuery = "UPDATE accounts SET password = ? WHERE userid = ?";
  if (executeQuery($updateQuery, 'si', $newHashedPassword, $userid)) {
    logout(); // Log out and prompt user to log in again
  } else {
    setSessionMessage("Failed to update password!", "error", "../view/index.php?page=profile");
  }
}

/** ✅ Helper to execute query and return result */
function executeQueryAndFetch($query, $types, ...$params)
{
  global $conn;
  $stmt = $conn->prepare($query);

  if (!$stmt) {
    error_log("Error preparing statement: " . $conn->error);
    return null;
  }

  $stmt->bind_param($types, ...$params);
  $stmt->execute();

  $result = $stmt->get_result()->fetch_assoc();

  $stmt->close();
  return $result;
}

/** ✅ Helper to execute query without returning data */
function executeQuery($query, $types, ...$params)
{
  global $conn;
  $stmt = $conn->prepare($query);

  if (!$stmt) {
    error_log("Error preparing statement: " . $conn->error);
    return false;
  }

  $stmt->bind_param($types, ...$params);
  $success = $stmt->execute();

  if (!$success) {
    error_log("Query execution failed: " . $stmt->error);
  }

  $stmt->close();
  return $success;
}

/** ✅ Helper to set session message and redirect */
function setSessionMessage($message, $code, $redirect)
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
  header("Location: $redirect");
  exit();
}

/** ✅ Logout function */
function logout()
{
  session_unset(); // Clear all session data
  session_destroy(); // Destroy the session
  session_start(); // Start a new session to store the message
  setSessionMessage("Password changed successfully! Please log in again.", "success", "../view/login.php");
}

$conn->close();
