<?php
session_start();
require_once '../database/config.php';

$userid = intval($_SESSION['authUser']['userid']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dummy_data'])) {
  $conn->begin_transaction(); // Start transaction for atomicity

  try {
    // Insert Transactions
    $sql = "
            INSERT INTO `transactions` 
            (`userid`, `category`, `description`, `amount`, `date`, `payment_type`, `transaction`) 
            VALUES 
            (?, 'Income', 'Freelance project payment', 1000.00, DATE_SUB(NOW(), INTERVAL 1 MONTH), 'cash', 'income'),
            (?, 'Income', 'Monthly salary', 2500.00, DATE_SUB(NOW(), INTERVAL 10 DAY), 'bank transfer', 'income'),
            (?, 'Income', 'Bonus', 300.00, DATE_SUB(NOW(), INTERVAL 15 DAY), 'cash', 'income'),
            (?, 'Income', 'Investment dividend', 150.00, DATE_SUB(NOW(), INTERVAL 1 MONTH), 'bank transfer', 'income'),
            (?, 'Income', 'Gift received', 200.00, DATE_SUB(NOW(), INTERVAL 20 DAY), 'cash', 'income'),
            (?, 'Expense', 'Groceries', 150.00, DATE_SUB(NOW(), INTERVAL 5 DAY), 'credit', 'expense'),
            (?, 'Expense', 'Utility bill', 100.00, DATE_SUB(NOW(), INTERVAL 1 MONTH), 'bank transfer', 'expense'),
            (?, 'Expense', 'Car repair', 250.00, DATE_SUB(NOW(), INTERVAL 12 DAY), 'cash', 'expense'),
            (?, 'Expense', 'Restaurant dinner', 80.00, DATE_SUB(NOW(), INTERVAL 1 MONTH), 'credit', 'expense'),
            (?, 'Expense', 'Online shopping', 200.00, DATE_SUB(NOW(), INTERVAL 25 DAY), 'bank transfer', 'expense');
        ";

    $stmt = $conn->prepare($sql);

    // Bind parameters (repeat $userid 10 times)
    $stmt->bind_param('iiiiiiiiii', $userid, $userid, $userid, $userid, $userid, $userid, $userid, $userid, $userid, $userid);

    if (!$stmt->execute()) {
      throw new Exception($stmt->error);
    }

    // Insert Tasks
    $sql2 = "
            INSERT INTO `tasks` (`userid`, `title`, `description`, `created_at`, `is_completed`) 
            VALUES 
            (?, 'Complete Project Proposal', 'Draft and submit the project proposal by the end of the week.', '2025-03-20 09:30:00', 'no'),
            (?, 'Team Meeting', 'Attend the weekly team meeting to discuss project updates.', '2025-03-21 14:00:00', 'no'),
            (?, 'Fix Login Bug', 'Investigate and resolve the login issue reported by users.', '2025-03-22 10:00:00', 'yes'),
            (?, 'Design Homepage', 'Create a new design for the homepage and get approval.', '2025-03-23 11:30:00', 'no'),
            (?, 'Database Backup', 'Perform a full backup of the production database.', '2025-03-24 08:00:00', 'yes'),
            (?, 'Update API Docs', 'Update the API documentation to reflect new endpoints.', '2025-03-25 16:00:00', 'no'),
            (?, 'Prepare Financial Report', 'Compile the financial report for the last quarter.', '2025-03-26 09:00:00', 'yes'),
            (?, 'Code Review', 'Review the latest code changes and provide feedback.', '2025-03-27 13:00:00', 'no'),
            (?, 'User Feedback Session', 'Organize a session to gather user feedback.', '2025-03-28 15:00:00', 'yes'),
            (?, 'Security Audit', 'Conduct a security audit on the main application.', '2025-03-29 10:30:00', 'no');
        ";

    $stmt2 = $conn->prepare($sql2);

    // Bind parameters (repeat $userid 10 times)
    $stmt2->bind_param('iiiiiiiiii', $userid, $userid, $userid, $userid, $userid, $userid, $userid, $userid, $userid, $userid);

    if (!$stmt2->execute()) {
      throw new Exception($stmt2->error);
    }

    $conn->commit(); // Commit transaction

    setSessionMessage("Dummy data generated!", "success");
    header("Location: ../view/index.php");
    exit(); // Exit after redirect
  } catch (Exception $e) {
    $conn->rollback(); // Rollback on failure
    setSessionMessage("Database error: " . $e->getMessage(), "error");
    header("Location: ../view/index.php");
    exit(); // Exit after error
  }
}

function setSessionMessage($message, $code)
{
  $_SESSION['message'] = $message;
  $_SESSION['code'] = $code;
}
