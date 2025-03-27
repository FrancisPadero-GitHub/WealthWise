<?php
session_start();
require_once '../database/config.php';

if (isset($_POST['register'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Validate required fields
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($cpassword)) {
        setSessionMessage("All fields are required!", "error", "../view/registration.php");
    }

    // Check if passwords match
    if ($password !== $cpassword) {
        setSessionMessage("Passwords do not match!", "error", "../view/registration.php");
    }

    // Check if email already exists
    $checkQuery = "SELECT * FROM `accounts` WHERE `email` = ?";
    $stmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        setSessionMessage("Email already taken!", "error", "../view/registration.php");
    }

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert new user into the database
    $query = "INSERT INTO `accounts`(`first_name`, `last_name`, `email`, `password`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $hashedPassword);
        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            setSessionMessage("Registration Successful!", "success", "../view/login.php");
        } else {
            setSessionMessage("Database error: " . mysqli_error($conn), "error", "../view/registration.php");
        }
    } else {
        setSessionMessage("Error preparing statement!", "error", "../view/registration.php");
    }
}

$conn->close();

// ✅ Helper function for setting session messages and redirecting
function setSessionMessage($message, $code, $redirect)
{
    $_SESSION['message'] = $message;
    $_SESSION['code'] = $code;
    header("Location: $redirect");
    exit();
}
