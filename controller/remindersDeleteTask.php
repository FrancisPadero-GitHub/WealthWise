<?php
session_start();
require_once("../database/config.php");

if (!isset($conn) || !$conn) {
    die("Database connection failed.");
}

if (isset($_POST['taskid'])) { // Make sure you switch to POST
    $taskid = intval($_POST['taskid']);

    $query = "DELETE FROM tasks WHERE id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $taskid);
        if ($stmt->execute()) {
            setSessionMessage("Task deleted successfully!", "success");
        } else {
            setSessionMessage("Error deleting task: " . $stmt->error, "error");
        }
        $stmt->close();
    } else {
        setSessionMessage("Database error: " . $conn->error, "error");
    }
} else {
    setSessionMessage("No task ID provided!", "error");
}

function setSessionMessage($message, $code)
{
    $_SESSION['message'] = $message;
    $_SESSION['code'] = $code;
    header("Location: ../view/index.php");
    exit();
}
