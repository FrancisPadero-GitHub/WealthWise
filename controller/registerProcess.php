<?php
include("../database/config.php");

session_start();

if (isset($_POST['register'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Validate required fields
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($cpassword)) {
        $_SESSION['status'] = "All fields are required!";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/registration.php");
        exit();
    }

    // Check if passwords match
    if ($password !== $cpassword) {
        $_SESSION['status'] = "Passwords do not match!";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/registration.php");
        exit();
    }

    // Check if email already exists
    $checkQuery = "SELECT * FROM `accounts` WHERE `email` = ?";
    $stmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['status'] = "email is already taken.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/registration.php");
        exit();
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
            $_SESSION['status'] = "Registration Successful!";
            $_SESSION['status_code'] = "success";
            header("Location: ../view/login.php");
            exit();
        } else {
            $_SESSION['status'] = "Database error: " . mysqli_error($conn);
            $_SESSION['status_code'] = "error";
            header("Location: ../view/registration.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Error preparing statement!";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/registration.php");
        exit();
    }
}
