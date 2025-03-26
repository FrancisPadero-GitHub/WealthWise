<?php
session_start();
include_once("../database/config.php");

// Check if user is logged in
if (!isset($_SESSION['authUser']['userid'])) { // FIXED: Correct 'authUser' key
    $_SESSION['message'] = "User not authenticated!";
    $_SESSION['code'] = "error";
    header("Location: ../view/login.php");
    exit();
}

$userid = intval($_SESSION['authUser']['userid']); // FIXED: Correct session key

// adding new task
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addtask"])) {
    $title = trim($_POST["title"] ?? "");
    $date = trim($_POST["date"] ?? "");
    $time = trim($_POST["time"] ?? "");
    $content = trim($_POST["description"] ?? "");


    // ✅ Combine date and time into a single DATETIME value
    if (!empty($date) && !empty($time)) {
        $datetime = date('Y-m-d H:i:s', strtotime("$date $time"));
    } elseif (!empty($date)) {
        $datetime = date('Y-m-d H:i:s', strtotime("$date 00:00:00"));
    } else {
        $datetime = date('Y-m-d H:i:s');
    }


    // Insert into database using prepared statement
    $sql = "INSERT INTO tasks ( `userid`, `title`, `description`, `created_at`) VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to prevent SQL injection
        $stmt->bind_param("isss", $userid, $title, $content, $datetime);

        if ($stmt->execute()) {
            setSessionMessage("Record added successfully!", "success",);
        } else {
            setSessionMessage("Database error: " . $stmt->error, "error",);
        }
        $stmt->close();
    } else {
        setSessionMessage("Error preparing statement!", "error",);
    }
}

// Helper function for setting session messages and redirecting
function setSessionMessage($message, $code)
{
    header("Location: ../view/index.php");
    $_SESSION['message'] = $message;
    $_SESSION['code'] = $code;
    exit();
}
