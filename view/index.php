<?php
// Start session at the top
session_start();
include("../database/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>WealthWise</title>

  <!-- Favicons -->
  <link rel="icon" href="../assets/img/wealthwise.png">
  <link rel="apple-touch-icon" href="../assets/img/wealthwise.png">

  <!-- Google Fonts (Consolidated for better performance) -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Nunito:wght@300;400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/vendor/boxicons/css/boxicons.min.css">
  <link rel="stylesheet" href="../assets/vendor/quill/quill.snow.css">
  <link rel="stylesheet" href="../assets/vendor/quill/quill.bubble.css">
  <link rel="stylesheet" href="../assets/vendor/remixicon/remixicon.css">
  <link rel="stylesheet" href="../assets/vendor/simple-datatables/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

  <?php

  // Include essential files
  include("../database/config.php");
  include("../controller/getData.php"); // pra ni mka kuha ug select statements ang data sa tabales and everythings sa dashboard

  include("./includes/topbar.php");
  include("./includes/sidebar.php");
  ?>
  <main id="main" class="main">
    <?php
    // Load the page dynamically based on URL
    $page = $_GET['page'] ?? 'dashboard'; // Use null coalescing for cleaner syntax
    $path = "./pages/$page.php";

    if (file_exists($path)) {
      include($path);
    } else {
      include('./pages/404.php'); // Fallback to 404 page
    }
    ?>
  </main>

  <?php include("./includes/footer.php"); ?>

  <!-- Back to Top Button -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

  <!-- SweetAlert for Toast Notifications -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php
  if (isset($_SESSION['message']) && $_SESSION['code'] != '') {
  ?>
    <script>
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "<?php echo $_SESSION['code']; ?>",
        title: "<?php echo $_SESSION['message']; ?>"
      });
    </script>
  <?php
    unset($_SESSION['message']);
    unset($_SESSION['code']);
  }
  ?>

</body>

</html>