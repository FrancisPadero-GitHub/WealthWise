<?php
session_start();
require_once("../database/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["editTask"])) {
  $id = intval($_POST["taskid"]);
  $title = trim($_POST["title"]);
  $description = trim($_POST["editTaskDescription"]);
  $date = trim($_POST["date"]);

  // ✅ Use only the date component (remove time)
  $datetime = !empty($date) ? date('Y-m-d', strtotime($date)) : date('Y-m-d');


  $sql = "UPDATE tasks SET title=?, description=?, created_at=? WHERE id=?";

  if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sssi", $title, $description, $datetime, $id);

    if ($stmt->execute()) {
      setSessionMessage("Record updated successfully!", "success");
    } else {
      setSessionMessage("Database error: " . $stmt->error, "error");
    }

    $stmt->close();
  } else {
    setSessionMessage("Error preparing statement!", "error");
  }
}

// ✅ Helper function for setting session messages and redirecting
function setSessionMessage($message, $code)
{
  header("Location: ../view/index.php");
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
  exit();
}
