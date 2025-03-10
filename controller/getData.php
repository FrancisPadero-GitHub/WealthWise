<?php
// Authentication Simple and userID assigning for global use
if (!isset($_SESSION['auth']) || !isset($_SESSION['authUser']['userid'])) {
  $_SESSION['message'] = "Please login first";
  $_SESSION['code'] = "error";
  header('Location: ../view/login.php');
  exit();
}

$userid = intval($_SESSION['authUser']['userid']);



/*** SELECT STATEMENTS ***/

/** Transaction Records **/
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$sql = "SELECT *
        FROM transactions 
        WHERE userid = ?";
if ($filter == 'today') {
  $sql .= " AND DATE(date) = CURDATE()";
} elseif ($filter == 'month') {
  $sql .= " AND MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
} elseif ($filter == 'year') {
  $sql .= " AND YEAR(date) = YEAR(CURDATE())";
}

$sql .= " ORDER BY transaction_id DESC";

$stmt = $conn->prepare($sql);
if ($stmt) {
  $stmt->bind_param("i", $userid);
  if ($stmt->execute()) {
    $result = $stmt->get_result();

    // $_SESSION['message'] = "Transactions filtered successfully!";
    // $_SESSION['code'] = "success";
  } else {
    $_SESSION['message'] = "Failed to filter transactions!";
    $_SESSION['code'] = "error";
  }
  $stmt->close();
} else {
  $_SESSION['message'] = "Error preparing statement for transactions!";
  $_SESSION['code'] = "error";
}
/** END OF Transaction Records **/



/** Account Balance **/
$sql2 = "SELECT balance FROM accounts WHERE userid = ?";
$stmt2 = $conn->prepare($sql2);
if ($stmt2) {
  $stmt2->bind_param("i", $userid);
  if ($stmt2->execute()) {
    $balanceResult = $stmt2->get_result();
    if ($balanceResult->num_rows > 0.00) {
      $balance = $balanceResult->fetch_assoc()['balance'];

      // $_SESSION['message'] = "Balance fetched successfully! ₱" . number_format($balance, 2);
      // $_SESSION['code'] = "success";
    } else {
      $balance = 0.00;
      $_SESSION['message'] = "No balance record found. Defaulting to ₱0.00.";
      $_SESSION['code'] = "info";
    }
  } else {
    $_SESSION['message'] = "Failed to fetch balance!";
    $_SESSION['code'] = "error";
  }
  $stmt2->close();
} else {
  $_SESSION['message'] = "Error preparing statement for balance!";
  $_SESSION['code'] = "error";
}
/** END OF Account Balance **/



/** Expenses **/

/** All-Time Expenses **/
$sqlAllTimeExpense = "SELECT SUM(amount) AS total 
                      FROM transactions 
                      WHERE userid = ? 
                      AND transaction = 'expense'";
$stmtAllTimeExpense = $conn->prepare($sqlAllTimeExpense);
if ($stmtAllTimeExpense) {
  $stmtAllTimeExpense->bind_param("i", $userid);
  if ($stmtAllTimeExpense->execute()) {
    $allTimeExpenseResult = $stmtAllTimeExpense->get_result();
    $allTimeExpense = $allTimeExpenseResult->fetch_assoc()['total'] ?? 0;
  }
  $stmtAllTimeExpense->close();
}


/** Current Month Expenses **/
$sql3 = "SELECT SUM(amount) AS total FROM transactions WHERE userid = ? AND transaction = 'expense' AND MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE()) ";
$stmt3 = $conn->prepare($sql3);
if ($stmt3) {
  $stmt3->bind_param("i", $userid);
  if ($stmt3->execute()) {
    $expenseResult = $stmt3->get_result();
    $totalExpense = $expenseResult->fetch_assoc()['total'] ?? 0;
  }
  $stmt3->close();
}

/** Previous Period's Expenses (e.g., Last Month) **/
$sqlPrev = "SELECT SUM(amount) AS total FROM transactions WHERE userid = ? AND transaction = 'expense' AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
$stmtPrev = $conn->prepare($sqlPrev);
if ($stmtPrev) {
  $stmtPrev->bind_param("i", $userid);
  if ($stmtPrev->execute()) {
    $prevExpenseResult = $stmtPrev->get_result();
    $prevExpense = $prevExpenseResult->fetch_assoc()['total'] ?? 0;
  }
  $stmtPrev->close();
}

/** Calculate Percentage Increase **/
$percentageIncrease = 0;
if ($prevExpense > 0) {
  $percentageIncrease = (($totalExpense - $prevExpense) / $prevExpense) * 100;
}

/** END OF Expenses **/



/** Income **/
/** Current Income **/
$sql4 = "SELECT SUM(amount) AS total FROM transactions WHERE userid = ? AND transaction = 'income' AND MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
$stmt4 = $conn->prepare($sql4);
if ($stmt4) {
  $stmt4->bind_param("i", $userid);
  if ($stmt4->execute()) {
    $incomeResult = $stmt4->get_result();
    $totalIncome = $incomeResult->fetch_assoc()['total'] ?? 0;
  }
  $stmt4->close();
}

/** Previous Period's Income (e.g., Last Month) **/
$sqlPrevIncome = "SELECT SUM(amount) AS total FROM transactions WHERE userid = ? AND transaction = 'income' AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
$stmtPrevIncome = $conn->prepare($sqlPrevIncome);
if ($stmtPrevIncome) {
  $stmtPrevIncome->bind_param("i", $userid);
  if ($stmtPrevIncome->execute()) {
    $prevIncomeResult = $stmtPrevIncome->get_result();
    $prevIncome = $prevIncomeResult->fetch_assoc()['total'] ?? 0;
  }
  $stmtPrevIncome->close();
}

/** Calculate Percentage Increase for Income **/
$incomePercentageIncrease = 0;
if ($prevIncome > 0) {
  $incomePercentageIncrease = (($totalIncome - $prevIncome) / $prevIncome) * 100;
}

/** END OF Income **/



/** Profile **/
$sql5 = "SELECT * 
         FROM `accounts` 
         WHERE `userid` = ?";

$stmt5 = $conn->prepare($sql5);
if ($stmt5) {
  $stmt5->bind_param("i", $userid);

  if ($stmt5->execute()) {
    $result5 = $stmt5->get_result();

    if ($result5->num_rows > 0) {
      $data = $result5->fetch_assoc();

      // Extract data
      $firstName = $data['first_name'];
      $lastName = $data['last_name'];
      $balance = $data['balance'];
      $email = $data['email'];

      // Success notification
      // $_SESSION['message'] = "User data fetched successfully!";
      // $_SESSION['code'] = "success";
    } else {
      $_SESSION['message'] = "No user found with the given ID!";
      $_SESSION['code'] = "info";
    }
  } else {
    $_SESSION['message'] = "Failed to execute statement!";
    $_SESSION['code'] = "error";
  }

  $stmt5->close();
} else {
  $_SESSION['message'] = "Error preparing statement!";
  $_SESSION['code'] = "error";
}
/** END OF Profile **/

$conn->close();
