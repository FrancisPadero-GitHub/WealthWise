<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
  $userid = $_SESSION['authUser']['userid'];

  // Now you can use $userid throughout this file
  echo "User ID: " . $userid;

  // ... your code ...
} else {
  // Redirect to login if not logged in
  header("Location: ../view/login.php");
  exit();
}
$conn->close();
