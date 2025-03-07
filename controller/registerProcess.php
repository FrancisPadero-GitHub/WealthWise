<?php
include("../database/config.php");
session_start();

if(isset($_POST['register'])){
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$phoneNumber = $_POST['phonenumber'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];

//pass and cpass match?
if($password != $cpassword){
    $_SESSION['status'] = "Password does not match!";
    $_SESSION['status_code'] = "error";
    header("Location: ../registration.php");
    exit(0);
} 

//email exists?
$checkQuery = "SELECT * FROM `users` WHERE `email` = '$email'";
$result = mysqli_query($con, $checkQuery);

if(mysqli_num_rows($result) > 0){
    $_SESSION['status'] = "Email address is already taken.";
    $_SESSION['status_code'] = "error";
}

//insert to db
$query = "INSERT INTO `users`(`firstName`, `lastName`, `email`, `password`, `birthday`, `phoneNumber`, `gender`) VALUES ('$firstname','$lastname','$email','$password','$phoneNumber','$gender','$birthday')";

if(mysqli_query($con, $query)){
    {
        $_SESSION['status'] = "Registration Success";
        $_SESSION['status_code'] = "success";
        header('Location: ../login.php');
        exit(0);
    }
}
else{
    echo "Error:".mysqli_error($con);
}
}
?>
