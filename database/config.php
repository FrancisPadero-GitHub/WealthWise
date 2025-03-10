<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "wealthwise";
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("MYSQL Connection failed: " . $conn->connect_error);
}
