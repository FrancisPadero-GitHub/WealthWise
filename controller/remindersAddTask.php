<?php
session_start();
require_once '../database/config.php';

$userid = intval($_SESSION['authUser']['userid']);

// ✅ Add new task (POST)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["addtask"])) {
    $title = trim($_POST["title"] ?? "");
    $date = !empty($_POST['date']) ? date('Y-m-d', strtotime($_POST['date'])) : date('Y-m-d');
    $description = trim($_POST["description"] ?? "");

    if (empty($title) || empty($description)) {
        setSessionMessage("Title and description are required!", "error");
    }

    $query = "INSERT INTO tasks (userid, title, description, created_at) VALUES (?, ?, ?, ?)";
    $params = [$userid, $title, $description, $date];
    $types = 'isss';

    if (executeQuery($query, $types, ...$params)) {
        setSessionMessage("Record added successfully!", "success");
    } else {
        setSessionMessage("Failed to add record!", "error");
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
