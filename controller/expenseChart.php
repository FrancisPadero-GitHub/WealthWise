<?php
session_start();
require_once '../database/config.php';
$userid = intval($_SESSION['authUser']['userid']);

// ** Fetch Money Traffic Data **

$sql6 = "SELECT `category`, SUM(`amount`) AS total 
         FROM `transactions` 
         WHERE `userid` = ? AND `transaction` = 'expense'
         GROUP BY `category`";


$stmt6 = $conn->prepare($sql6);
$data = [];

if ($stmt6) {
  $stmt6->bind_param("i", $userid);

  if ($stmt6->execute()) {
    $result6 = $stmt6->get_result();

    while ($row = $result6->fetch_assoc()) {
      $data[] = [
        'name'  => $row['category'],
        'value' => abs($row['total'])
      ];
    }

    // Handle empty data case
    if (empty($data)) {
      $data = [['name' => 'No Data', 'value' => 0]];
    }

    // Success message (Optional)
    // $_SESSION['message'] = "Money traffic data fetched successfully!";
    // $_SESSION['code'] = "success";
  } else {
    // Log the MySQL error for debugging
    error_log("Money traffic query failed: " . $stmt6->error);

    $_SESSION['message'] = "Failed to fetch money traffic data!";
    $_SESSION['code'] = "error";
  }

  $stmt6->close();
} else {
  error_log("Error preparing statement for money traffic: " . $conn->error);

  $_SESSION['message'] = "Error preparing statement for money traffic data!";
  $_SESSION['code'] = "error";
}

// Close the connection
$conn->close();

// Return JSON data with proper header
header('Content-Type: application/json');
echo json_encode($data);
