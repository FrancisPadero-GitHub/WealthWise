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
    (?, 'Food and Drinks', 'Freelance project payment', 1000.00, DATE_SUB(NOW(), INTERVAL 1 MONTH), 'cash', 'income'),
    (?, 'Monthly salary', 'Monthly salary', 2500.00, DATE_SUB(NOW(), INTERVAL 10 DAY), 'bank transfer', 'income'),
    (?, 'Bonus', 'Bonus', 300.00, DATE_SUB(NOW(), INTERVAL 15 DAY), 'cash', 'income'),
    (?, 'Dividends', 'Investment dividend', 150.00, DATE_SUB(NOW(), INTERVAL 1 MONTH), 'bank transfer', 'income'),
    (?, 'Gifts & Donations', 'Gift received', 200.00, DATE_SUB(NOW(), INTERVAL 20 DAY), 'cash', 'income'),
    (?, 'Utilities', 'Groceries', 150.00, DATE_SUB(NOW(), INTERVAL 5 DAY), 'credit', 'expense'),
    (?, 'Transportation', 'Utility bill', 100.00, DATE_SUB(NOW(), INTERVAL 1 MONTH), 'bank transfer', 'income'),
    (?, 'Health & Medical', 'Car repair', 250.00, DATE_SUB(NOW(), INTERVAL 12 DAY), 'cash', 'income'),
    (?, 'Dining Out', 'Restaurant dinner', 80.00, DATE_SUB(NOW(), INTERVAL 1 MONTH), 'credit', 'income'),
    (?, 'Online shopping', 'Online shopping', 200.00, DATE_SUB(NOW(), INTERVAL 25 DAY), 'bank transfer', 'income'),
    (?, 'Education', 'Tuition fee', 1500.00, DATE_SUB(NOW(), INTERVAL 8 DAY), 'bank transfer', 'income'),
    (?, 'Personal Care', 'Haircut', 50.00, DATE_SUB(NOW(), INTERVAL 14 DAY), 'cash', 'income'),
    (?, 'Entertainment', 'Movie night', 30.00, DATE_SUB(NOW(), INTERVAL 7 DAY), 'credit', 'income'),
    (?, 'Travel', 'Weekend trip', 500.00, DATE_SUB(NOW(), INTERVAL 18 DAY), 'credit', 'income'),
    (?, 'Clothing & Accessories', 'New shoes', 120.00, DATE_SUB(NOW(), INTERVAL 22 DAY), 'cash', 'income'),
    (?, 'Childcare', 'Babysitter', 100.00, DATE_SUB(NOW(), INTERVAL 27 DAY), 'cash', 'expense'),
    (?, 'Pet Care', 'Vet checkup', 80.00, DATE_SUB(NOW(), INTERVAL 10 DAY), 'credit', 'expense'),
    (?, 'Subscriptions & Memberships', 'Gym membership', 60.00, DATE_SUB(NOW(), INTERVAL 5 DAY), 'credit', 'expense'),
    (?, 'Vehicle', 'Car maintenance', 300.00, DATE_SUB(NOW(), INTERVAL 15 DAY), 'cash', 'expense'),
    (?, 'Life and Entertainment', 'Concert tickets', 150.00, DATE_SUB(NOW(), INTERVAL 20 DAY), 'credit', 'expense'),
    (?, 'Communication & PC', 'Phone bill', 75.00, DATE_SUB(NOW(), INTERVAL 18 DAY), 'bank transfer', 'expense'),
    (?, 'Home', 'Rent payment', 800.00, DATE_SUB(NOW(), INTERVAL 1 MONTH), 'bank transfer', 'expense'),
    (?, 'Furniture & Appliances', 'New sofa', 700.00, DATE_SUB(NOW(), INTERVAL 3 MONTH), 'credit', 'expense'),
    (?, 'Electronics', 'New laptop', 1200.00, DATE_SUB(NOW(), INTERVAL 40 DAY), 'bank transfer', 'expense'),
    (?, 'Jewelry & Luxury Items', 'Gold ring', 400.00, DATE_SUB(NOW(), INTERVAL 2 MONTH), 'cash', 'expense'),
    (?, 'Art & Collectibles', 'Painting', 500.00, DATE_SUB(NOW(), INTERVAL 1 MONTH), 'cash', 'expense'),
    (?, 'Financial Expenses', 'Bank fees', 25.00, DATE_SUB(NOW(), INTERVAL 5 DAY), 'bank transfer', 'expense'),
    (?, 'Investments', 'Stock purchase', 1000.00, DATE_SUB(NOW(), INTERVAL 1 MONTH), 'bank transfer', 'expense'),
    (?, 'Savings', 'Savings deposit', 500.00, DATE_SUB(NOW(), INTERVAL 7 DAY), 'bank transfer', 'income'),
    (?, 'Business Expenses', 'Office rent', 1200.00, DATE_SUB(NOW(), INTERVAL 1 MONTH), 'bank transfer', 'expense');
";

    $stmt = $conn->prepare($sql);

    // Bind parameters (repeat $userid 30 times)
    $stmt->bind_param(
      'iiiiiiiiiiiiiiiiiiiiiiiiiiiiii',
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid,
      $userid
    );


    if (!$stmt->execute()) {
      throw new Exception($stmt->error);
    }

    // Insert Tasks
    $sql2 = "
      INSERT INTO `tasks` (`userid`, `title`, `description`, `created_at`, `is_completed`) 
      VALUES 
      (?, 'Complete Project Proposal', 'Draft and submit the project proposal by the end of the week.', '2025-03-20', 'no'),
      (?, 'Team Meeting', 'Attend the weekly team meeting to discuss project updates.', '2025-03-21', 'no'),
      (?, 'Fix Login Bug', 'Investigate and resolve the login issue reported by users.', '2025-03-22', 'yes'),
      (?, 'Design Homepage', 'Create a new design for the homepage and get approval.', '2025-03-23', 'no'),
      (?, 'Database Backup', 'Perform a full backup of the production database.', '2025-03-24', 'yes'),
      (?, 'Update API Docs', 'Update the API documentation to reflect new endpoints.', '2025-03-25', 'no'),
      (?, 'Prepare Financial Report', 'Compile the financial report for the last quarter.', '2025-03-26', 'yes'),
      (?, 'Code Review', 'Review the latest code changes and provide feedback.', '2025-03-27', 'no'),
      (?, 'User Feedback Session', 'Organize a session to gather user feedback.', '2025-03-28', 'yes'),
      (?, 'Security Audit', 'Conduct a security audit on the main application.', '2025-03-29', 'no');
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
