<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "wealthwise";

$con = new mysqli($servername, $username, $password, $database);

if ($con->connect_error) {
}
