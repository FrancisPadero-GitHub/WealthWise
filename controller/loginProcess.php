<?php
session_start();
// since gawas mani sya sa index.php nga scope need ni sya atleast once same sa registerProcess
require_once '../database/config.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statements for security
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
                    'last_namename' => $data['last_name'],
                    'email' => $data['email']
                ];

                header("Location: ../view/index.php"); // Redirect to a user dashboard
                exit();
            } else {
                $_SESSION['message'] = "Invalid email or Password";
                $_SESSION['code'] = "error";
                header("Location: ../view/login.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Invalid email or Password";
            $_SESSION['code'] = "error";
            header("Location: ../view/login.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Database error: " . mysqli_error($conn);
        $_SESSION['code'] = "error";
        header("Location: ../view/login.php");
        exit();
    }
}

$conn->close();
