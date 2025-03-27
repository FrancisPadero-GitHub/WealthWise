<?php
session_start();
require_once '../database/config.php';

// ✅ Update task (POST)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["editTask"])) {
  $id          = intval($_POST["taskid"]);
  $title       = trim($_POST["title"] ?? "");
  $description = trim($_POST["editTaskDescription"] ?? "");
  $date = !empty($_POST['date']) ? date('Y-m-d', strtotime($_POST['date'])) : date('Y-m-d');

  // ✅ Validate required fields
  if (empty($id) || empty($title) || empty($description)) {
    setSessionMessage("Title and description are required!", "error");
  }



  $query = "UPDATE tasks SET title = ?, description = ?, created_at = ? WHERE id = ?";
  $params = [$title, $description, $date, $id];
  $types = 'sssi';

  if (executeQuery($query, $types, ...$params)) {
    setSessionMessage("Record updated successfully!", "success");
  } else {
    setSessionMessage("Failed to update record!", "error");
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
