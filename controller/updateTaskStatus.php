<?php
session_start();
require_once("../database/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $taskId = intval($_POST["taskid"]);
  $status = trim($_POST["status"]); // Should be "yes" or "no"

  $sql = "UPDATE tasks SET is_completed = ? WHERE id = ?";

  if ($stmt = $conn->prepare($sql)) {
    // Use "s" since status is now a string ("yes" or "no")
    $stmt->bind_param("si", $status, $taskId);

    if ($stmt->execute()) {
      setSessionMessage("Task status updated successfully!", "success");
    } else {
      setSessionMessage("Failed to update task status: " . $stmt->error, "error");
    }

    $stmt->close();
  } else {
    setSessionMessage("Error preparing statement!", "error");
  }
}

function setSessionMessage($message, $code)
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
  header("Location: ../view/index.php");
  exit();
}
