<?php
session_start();
require_once '../database/config.php';
$userid = intval($_SESSION['authUser']['userid']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_pass'])) {
  // Sanitize inputs
  $currentPassword = trim($_POST['password']);
  $newPassword = trim($_POST['newpassword']);
  $renewPassword = trim($_POST['renewpassword']);

  // Check if all fields are filled
  if (empty($currentPassword) || empty($newPassword) || empty($renewPassword)) {
    header("Location: ../view/index.php?page=profile");
    setSessionMessage("All fields are required!", "error",);
  }

  // Check if new passwords match
  if ($newPassword !== $renewPassword) {
    header("Location: ../view/index.php?page=profile");
    setSessionMessage("New passwords do not match", "error",);
  }

  // Fetch the current password from the database
  $stmt = $conn->prepare("SELECT password FROM accounts WHERE userid = ?");
  $stmt->bind_param("i", $userid);
  $stmt->execute();
  $stmt->bind_result($hashedPassword);
  $stmt->fetch();
  $stmt->close();

  // Verify current password
  if (!password_verify($currentPassword, $hashedPassword)) {
    header("Location: ../view/index.php?page=profile");
    setSessionMessage("Current Password is incorrect!", "error",);
  }

  // Hash the new password
  $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

  // Update password in the database
  $stmt = $conn->prepare("UPDATE accounts SET password = ? WHERE userid = ?");
  $stmt->bind_param("si", $newHashedPassword, $userid);

  if ($stmt->execute()) {
    // after changing password proceed to login again to test the new password
    header("Location: ../view/login.php");
    logout();
  } else {
    header("Location: ../view/index.php?page=profile");
    setSessionMessage("Something went wrong!", "error",);
  }

  $stmt->close();
}

$conn->close();

function setSessionMessage($message, $code)
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
  exit();
}

function logout()
{
  session_unset(); // Clear all session data
  session_destroy(); // Destroy the session
  // Set the message for next login
  session_start(); // Start a new session to store the message
  setSessionMessage("Password changed successfully! Please log in again.", "success");
}
