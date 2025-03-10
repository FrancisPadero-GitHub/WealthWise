<?php
session_start();
include("../database/config.php");

$userid = intval($_SESSION['authUser']['userid']);

$sql = "SELECT category, SUM(amount) AS total 
        FROM transactions 
        WHERE userid = ? AND transaction = 'expense' 
        GROUP BY category";

$stmt = $conn->prepare($sql);
$userid = 1; // Adjust to the logged-in user ID
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = [
    'category' => $row['category'],
    'total' => abs($row['total']) // Convert to positive value for display
  ];
}

$stmt->close();
$conn->close();

echo json_encode($data);
