<?php
include(__DIR__ . '/../database/config.php');

if (!isset($_SESSION['auth'])) {
    $_SESSION['message'] = "Please login first";
    $_SESSION['code'] = "error";
    header('Location: ../view/login.php');
    exit();
}
