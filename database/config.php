<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "wealthwise";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
}



/** THIS IS FOR THE FILTER DATE FOR THE TRANSACTIONS TABLE */
// Get filter value from URL
global $filter;
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Build the base query
$sql = "SELECT category, description, amount, date FROM transactions";

// Apply filtering based on the selected filter
if ($filter == 'today') {
  $sql .= " WHERE DATE(date) = CURDATE()";
} elseif ($filter == 'month') {
  $sql .= " WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
} elseif ($filter == 'year') {
  $sql .= " WHERE YEAR(date) = YEAR(CURDATE())";
}

// Add sorting
$sql .= " ORDER BY date DESC";

// Execute the query
global $result;
$result = $conn->query($sql);
// END OF GET FILTER


/** SEARCH FILTER */
$search = isset($_GET['search']) ? $_GET['search'] : '';

// END OF SEARCH FILTER