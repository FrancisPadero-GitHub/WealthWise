<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/wealthwise.png" rel="icon">
  <link href="../assets/img/wealthwise.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="w-container">
  <main>
    <div class="container py-5">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10 col-sm-12">
              <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-5">

                  <div class="text-center mb-4">
                    <h2 class="logo-title text-primary">WealthWise</h2>
                    <p class="text-muted">Create an Account</p>
                  </div>


                  <form class="needs-validation" action="../controller/authRegister.php" method="POST" novalidate>
                    <div class="row">
                      <!-- Column 1 -->
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="firstName" class="form-label fw-medium">First Name</label>
                          <input type="text" name="firstname" class="form-control rounded-3" id="firstName" required>
                          <div class="invalid-feedback">Please enter your first name!</div>
                        </div>
                        <div class="mb-3">
                          <label for="lastName" class="form-label fw-medium">Last Name</label>
                          <input type="text" name="lastname" class="form-control rounded-3" id="lastName" required>
                          <div class="invalid-feedback">Please enter your last name!</div>
                        </div>
                        <div class="mb-3">
                          <label for="yourEmail" class="form-label fw-medium">Email Address</label>
                          <input type="email" name="email" class="form-control rounded-3" id="yourEmail" required>
                          <div class="invalid-feedback">Please enter a valid email address!</div>
                        </div>
                      </div>

                      <!-- Column 2 -->
                      <div class="col-md-6">

                        <div class="mb-3">
                          <label for="yourPassword" class="form-label fw-medium">Password</label>
                          <input type="password" name="password" class="form-control rounded-3" id="yourPassword" required>
                          <div class="invalid-feedback">Please enter your password!</div>
                        </div>

                        <div class="mb-3">
                          <label for="confirmPassword" class="form-label fw-medium">Confirm Password</label>
                          <input type="password" name="cpassword" class="form-control rounded-3" id="confirmPassword" required>
                          <div class="invalid-feedback">Please confirm your password!</div>
                        </div>

                        <div class="form-check mb-3">
                          <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                          <label class="form-check-label" for="acceptTerms" style="font-size: 14px;">
                            I agree and accept the <a href="#" class="text-decoration-underline">terms and conditions</a>
                          </label>
                          <div class="invalid-feedback">You must agree before submitting.</div>
                        </div>

                        <button class="btn btn-primary w-100 mb-3 rounded-3 fw-medium" type="submit" name="register">
                          <i class="bi bi-person-plus me-2"></i> Create Account
                        </button>

                        <p class="small text-center mb-0" style="font-size: 14px;">
                          Already have an account? <a href="login.php" class="text-decoration-underline">Log in</a>
                        </p>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
        timer: 1500,
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