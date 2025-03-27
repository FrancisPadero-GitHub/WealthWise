<?php
session_start();
require_once '../database/config.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT `userid`, `first_name`, `last_name`, `email`, `password` FROM `Accounts` WHERE email = ?";
    $stmt = mysqli_prepare($conn, $login_query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);

            // Verify the hashed password
            if (password_verify($password, $data['password'])) {
                $_SESSION['auth'] = true;
                $_SESSION['authUser'] = [
                    'userid' => $data['userid'],
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email']
                ];

                header("Location: ../view/index.php");
                exit();
            } else {
                setSessionMessage("Invalid email or Password", "error", "../view/login.php");
            }
        } else {
            setSessionMessage("Invalid email or Password", "error", "../view/login.php");
        }
    } else {
        setSessionMessage("Database error: " . mysqli_error($conn), "error", "../view/login.php");
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
