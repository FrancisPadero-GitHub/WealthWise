<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "wealthwise";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
}


