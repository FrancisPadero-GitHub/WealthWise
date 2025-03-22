<?php
header('Location: ../view/login.php');
logout();
exit();

function logout()
{
  session_unset(); // Clear all session data
  session_destroy(); // Destroy the session
  // Set the message for next login
  session_start(); // Start a new session to store the message
  setSessionMessage("Logged out!", "success");
}

function setSessionMessage($message, $code)
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
  exit();
}
