<?php
// ✅ Logout function
logout();

/** ✅ Logout function */
function logout()
{
  session_start(); // Ensure session is started before destroying
  session_unset(); // Clear all session data
  session_destroy(); // Destroy the session

  // ✅ Start a new session to store the logout message
  session_start();
  setSessionMessage("Logged out!", "success", "../view/login.php");
}

/** ✅ Helper to set session message and redirect */
function setSessionMessage($message, $code, $redirect)
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
  header("Location: $redirect");
  exit();
}
