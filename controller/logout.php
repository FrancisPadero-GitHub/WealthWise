<?php
session_start();
include("../database/config.php");

// Unset all authentication-related session variables
unset($_SESSION['auth']);
unset($_SESSION['authUser']);

$_SESSION['message'] = "Logged out successfully";
$_SESSION['code'] = "success";

// Redirect to login page
header('Location: ../view/login.php');
exit();
