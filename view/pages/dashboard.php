<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Home</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <!-- Left side columns -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 col-xxl-7">
      <div class="row">
        <!-- Balance Modal Card -->
        <div class="modal fade" id="editBalanceModal" tabindex="-1" aria-labelledby="editBalanceModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

              <form id="editBalanceForm" action="../controller/edit_balance.php" method="POST">
                <div class="modal-header">
                  <h5 class="modal-title" id="editBalanceModalLabel">Edit Balance</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="balanceAmount" class="form-label">New Balance Amount</label>
                    <input type="number" class="form-control" id="balanceAmount" name="balance" step="0.01" value="<?php echo isset($balance) ? htmlspecialchars($balance) : '0.00'; ?>" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" name="edit_balance" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End of Modal Card -->

        <!-- Balance Card -->
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-4">
          <div class="card info-card balance-card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li>
                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editBalanceModal">
                    Edit
                  </a>
                </li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Balance <span>| Cash</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-wallet2"></i>
                </div>
                <div class="ps-3">
                  <h6 id="currentBalance">₱ <?php echo number_format($balance, 2); ?></h6>
                  <span id="balanceStatus" class="text-success small pt-1 fw-bold">Debt Free</span>
                </div>

                <script>

                </script>

              </div>
            </div>
          </div>
        </div>
        <!-- End Balance Card -->

        <!-- Total Expenses Card -->
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-4">
          <div class="card info-card expense-card">

            <!-- <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div> -->

            <div class="card-body">
              <h5 class="card-title">Total Expenses <span>| This Month</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cash-coin"></i>
                </div>
                <div class="ps-3">
                  <h6 class="text-danger">₱ <?php echo number_format($totalExpense, 2); ?></h6>
                  <span class="text-danger small pt-1 fw-bold">
                    <?php echo ($percentageIncrease >= 0 ? '+' : '') . number_format($percentageIncrease, 2) . '%'; ?>
                  </span>
                  <span class="text-muted small pt-2 ps-1">
                    <?php echo ($percentageIncrease >= 0) ? 'increase' : 'decrease'; ?>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Expenses Card -->

        <!-- Total Income Card -->
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-4">
          <div class="card info-card income-card">
            <!-- <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div> -->
            <div class="card-body">
              <h5 class="card-title">Total Income <span>|This Month</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cash-coin"></i>
                </div>
                <div class="ps-3">
                  <h6 class="text-success">₱ <?php echo number_format($totalIncome, 2); ?></h6>
                  <span class="text-success small pt-1 fw-bold">
                    <?php echo ($incomePercentageIncrease >= 0 ? '+' : '') . number_format($incomePercentageIncrease, 2) . '%'; ?>
                  </span>
                  <span class="text-muted small pt-2 ps-1">
                    <?php echo ($incomePercentageIncrease >= 0) ? 'increase' : 'decrease'; ?>
                  </span>
                </div>

              </div>
            </div>
          </div>
        </div><!-- End Income Card -->
      </div><!-- End cards -->


      <!--Add Transaction -->
      <div class="d-flex justify-content-between">
        <form action="../controller/test.php" method="POST">
          <button type="submit" name="dummy_data" class="btn btn-secondary" title="Generate dummy data for testing">
            <i class="bi bi-box-seam"></i> Generate
          </button>
        </form>

        <!-- <button type="submit" name="reset_data" class="btn btn-danger" title="Reset all data">
          <i class="bi bi-arrow-counterclockwise"></i> Reset Data
        </button> -->

        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addRecordModal">
          <i class="bi bi-plus-lg"></i>
        </a>
      </div>


      <!-- Add new record modal -->
      <div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="addRecordModalLabel">New Record</h6>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="../controller/addRecord.php" method="POST" novalidate>
                <div class="row mb-3">
                  <!-- Amount -->
                  <div class="col-md-4">
                    <label for="inputNumber" class="form-label">Amount</label>
                    <input type="number" class="form-control" name="amount" id="inputNumber" min="0" required>
                  </div>

                  <!-- Category -->
                  <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <div style="border: 1px solid #ced4da; border-radius: 0.375rem;">
                      <select class="form-select" name="category" id="editCategory" aria-label="Default select example"
                        style="width: 100%; border: none; max-height: 200px; overflow-y: auto;">
                        <!-- Daily Expenses -->
                        <optgroup label="Daily Expenses">
                          <option value="Food and Drinks">Food and Drinks</option>
                          <option value="Shopping">Shopping</option>
                          <option value="House Rent">House Rent</option>
                          <option value="Transportation">Transportation</option>
                          <option value="Health & Medical">Health & Medical</option>
                          <option value="Education">Education</option>
                          <option value="Utilities">Utilities</option>
                          <option value="Personal Care">Personal Care</option>
                          <option value="Entertainment">Entertainment</option>
                          <option value="Dining Out">Dining Out</option>
                          <option value="Travel">Travel</option>
                          <option value="Clothing & Accessories">Clothing & Accessories</option>
                          <option value="Childcare">Childcare</option>
                          <option value="Pet Care">Pet Care</option>
                          <option value="Subscriptions & Memberships">Subscriptions & Memberships</option>
                        </optgroup>
                        <!-- Assets -->
                        <optgroup label="Assets">
                          <option value="Vehicle">Vehicle</option>
                          <option value="Life and Entertainment">Life and Entertainment</option>
                          <option value="Communication & PC">Communication & PC</option>
                          <option value="Home">Home</option>
                          <option value="Furniture & Appliances">Furniture & Appliances</option>
                          <option value="Electronics">Electronics</option>
                          <option value="Jewelry & Luxury Items">Jewelry & Luxury Items</option>
                          <option value="Art & Collectibles">Art & Collectibles</option>
                          <option value="Real Estate">Real Estate</option>
                          <option value="Vehicles & Boats">Vehicles & Boats</option>
                        </optgroup>
                        <!-- Financial -->
                        <optgroup label="Financial">
                          <option value="Financial Expenses">Financial Expenses</option>
                          <option value="Investments">Investments</option>
                          <option value="Income">Income</option>
                          <option value="Savings">Savings</option>
                          <option value="Debt Payments">Debt Payments</option>
                          <option value="Taxes">Taxes</option>
                          <option value="Insurance">Insurance</option>
                          <option value="Gifts & Donations">Gifts & Donations</option>
                          <option value="Loan Payments">Loan Payments</option>
                          <option value="Bank Fees">Bank Fees</option>
                          <option value="Retirement Contributions">Retirement Contributions</option>
                          <option value="Dividends">Dividends</option>
                          <option value="Royalties">Royalties</option>
                          <option value="Other Income">Other Income</option>
                          <option value="Other Expenses">Other Expenses</option>
                        </optgroup>
                        <!-- Business & Professional -->
                        <optgroup label="Business & Professional">
                          <option value="Business Expenses">Business Expenses</option>
                          <option value="Business Income">Business Income</option>
                          <option value="Professional Services">Professional Services</option>
                          <option value="Office Supplies">Office Supplies</option>
                          <option value="Marketing & Advertising">Marketing & Advertising</option>
                          <option value="Software & Subscriptions">Software & Subscriptions</option>
                          <option value="Legal Fees">Legal Fees</option>
                          <option value="Consulting Fees">Consulting Fees</option>
                        </optgroup>
                        <!-- Leisure & Lifestyle -->
                        <optgroup label="Leisure & Lifestyle">
                          <option value="Hobbies & Crafts">Hobbies & Crafts</option>
                          <option value="Sports & Recreation">Sports & Recreation</option>
                          <option value="Books & Magazines">Books & Magazines</option>
                          <option value="Music & Instruments">Music & Instruments</option>
                          <option value="Movies & Streaming">Movies & Streaming</option>
                          <option value="Concerts & Events">Concerts & Events</option>
                          <option value="Video Games">Video Games</option>
                          <option value="Outdoor Activities">Outdoor Activities</option>
                          <option value="Others">Others</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>

                  <!-- Transaction -->
                  <div class="col-md-4">
                    <label class="form-label">Transaction</label>
                    <select class="form-select" name="transaction" aria-label="Default select example">
                      <option value="Expense">Expense</option>
                      <option value="Income">Income</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <!-- Date -->
                  <div class="col-md-6">
                    <label for="inputDate" class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" id="inputDate">
                  </div>

                  <!-- Account -->
                  <div class="col-md-6">
                    <label class="form-label">Account</label>
                    <select class="form-select" name="account" aria-label="Default select example">
                      <option value="Cash">Cash</option>
                      <option value="Credit">Credit</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" style="height: 100px" maxlength="150"></textarea>
                  </div>
                </div>

                <div class="text-end">
                  <button type="submit" name="add_record" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Add
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- end of add new record modal -->

      <!-- Edit Record Modal -->
      <div class="modal fade" id="editRecordModal" tabindex="-1" aria-labelledby="editRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="editRecordModalLabel">Edit Record</h6>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="editRecordForm" action="../controller/updateRecord.php" method="POST" novalidate>
                <!-- Hidden ID field -->
                <input type="hidden" name="transaction_id" id="editTransactionId">

                <div class="row mb-3">
                  <!-- Amount -->
                  <div class="col-md-4">
                    <label for="editInputNumber" class="form-label">Amount</label>
                    <input type="number" class="form-control" name="amount" id="editInputNumber" min="0" required>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <div style="border: 1px solid #ced4da; border-radius: 0.375rem;">
                      <select class="form-select" name="category" id="editCategory" aria-label="Default select example"
                        style="width: 100%; border: none; max-height: 200px; overflow-y: auto;">
                        <!-- Daily Expenses -->
                        <optgroup label="Daily Expenses">
                          <option value="Food and Drinks">Food and Drinks</option>
                          <option value="Shopping">Shopping</option>
                          <option value="House Rent">House Rent</option>
                          <option value="Transportation">Transportation</option>
                          <option value="Health & Medical">Health & Medical</option>
                          <option value="Education">Education</option>
                          <option value="Utilities">Utilities</option>
                          <option value="Personal Care">Personal Care</option>
                          <option value="Entertainment">Entertainment</option>
                          <option value="Dining Out">Dining Out</option>
                          <option value="Travel">Travel</option>
                          <option value="Clothing & Accessories">Clothing & Accessories</option>
                          <option value="Childcare">Childcare</option>
                          <option value="Pet Care">Pet Care</option>
                          <option value="Subscriptions & Memberships">Subscriptions & Memberships</option>
                        </optgroup>
                        <!-- Assets -->
                        <optgroup label="Assets">
                          <option value="Vehicle">Vehicle</option>
                          <option value="Life and Entertainment">Life and Entertainment</option>
                          <option value="Communication & PC">Communication & PC</option>
                          <option value="Home">Home</option>
                          <option value="Furniture & Appliances">Furniture & Appliances</option>
                          <option value="Electronics">Electronics</option>
                          <option value="Jewelry & Luxury Items">Jewelry & Luxury Items</option>
                          <option value="Art & Collectibles">Art & Collectibles</option>
                          <option value="Real Estate">Real Estate</option>
                          <option value="Vehicles & Boats">Vehicles & Boats</option>
                        </optgroup>
                        <!-- Financial -->
                        <optgroup label="Financial">
                          <option value="Financial Expenses">Financial Expenses</option>
                          <option value="Investments">Investments</option>
                          <option value="Income">Income</option>
                          <option value="Savings">Savings</option>
                          <option value="Debt Payments">Debt Payments</option>
                          <option value="Taxes">Taxes</option>
                          <option value="Insurance">Insurance</option>
                          <option value="Gifts & Donations">Gifts & Donations</option>
                          <option value="Loan Payments">Loan Payments</option>
                          <option value="Bank Fees">Bank Fees</option>
                          <option value="Retirement Contributions">Retirement Contributions</option>
                          <option value="Dividends">Dividends</option>
                          <option value="Royalties">Royalties</option>
                          <option value="Other Income">Other Income</option>
                          <option value="Other Expenses">Other Expenses</option>
                        </optgroup>
                        <!-- Business & Professional -->
                        <optgroup label="Business & Professional">
                          <option value="Business Expenses">Business Expenses</option>
                          <option value="Business Income">Business Income</option>
                          <option value="Professional Services">Professional Services</option>
                          <option value="Office Supplies">Office Supplies</option>
                          <option value="Marketing & Advertising">Marketing & Advertising</option>
                          <option value="Software & Subscriptions">Software & Subscriptions</option>
                          <option value="Legal Fees">Legal Fees</option>
                          <option value="Consulting Fees">Consulting Fees</option>
                        </optgroup>
                        <!-- Leisure & Lifestyle -->
                        <optgroup label="Leisure & Lifestyle">
                          <option value="Hobbies & Crafts">Hobbies & Crafts</option>
                          <option value="Sports & Recreation">Sports & Recreation</option>
                          <option value="Books & Magazines">Books & Magazines</option>
                          <option value="Music & Instruments">Music & Instruments</option>
                          <option value="Movies & Streaming">Movies & Streaming</option>
                          <option value="Concerts & Events">Concerts & Events</option>
                          <option value="Video Games">Video Games</option>
                          <option value="Outdoor Activities">Outdoor Activities</option>
                          <option value="Others">Others</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>



                  <!-- Transaction -->
                  <div class="col-md-4">
                    <label class="form-label">Transaction</label>
                    <select class="form-select" name="transaction" id="editTransaction" aria-label="Default select example">
                      <option value="expense">Expense</option>
                      <option value="income">Income</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <!-- Date -->
                  <div class="col-md-6">
                    <label for="editInputDate" class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" id="editInputDate">
                  </div>

                  <!-- Account -->
                  <div class="col-md-6">
                    <label class="form-label">Account</label>
                    <select class="form-select" name="account" id="editAccount" aria-label="Default select example">
                      <option value="cash">Cash</option>
                      <option value="credit">Credit</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-12">
                    <label for="editDescription" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="editDescription" style="height: 100px" maxlength="150"></textarea>
                  </div>
                </div>

                <div class="text-end">
                  <!-- Delete Button -->
                  <button type="button" name="delete" class="btn btn-danger delete-btn" id="deleteTransactionBtn">
                    <i class="bi bi-trash"></i> Delete
                  </button>

                  <!-- Update Button -->
                  <button type="submit" name="submit" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Update
                  </button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End of Edit Record Modal -->


      <!-- Transaction Records -->
      <div class="col-12" style="margin-top: 10px;">
        <div class="card recent-sales overflow-auto">

          <!-- Filter Section -->
          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>
              <li><a class="dropdown-item" href="?filter=today">Today</a></li>
              <li><a class="dropdown-item" href="?filter=month">This Month</a></li>
              <li><a class="dropdown-item" href="?filter=year">This Year</a></li>
              <li><a class="dropdown-item" href="?filter=all_time">All Time</a></li>
            </ul>
          </div>
          <!-- End Filter Section -->

          <div class="card-body">
            <h5 class="card-title">
              Recent Transactions
              <?php
              if (isset($filter)) { // Add check to avoid undefined variable issue
                if ($filter == 'today') {
                  echo "<span>| Today</span>";
                } elseif ($filter == 'month') {
                  echo "<span>| This Month</span>";
                } elseif ($filter == 'year') {
                  echo "<span>| This Year</span>";
                } elseif ($filter == 'all_time') {
                  echo "<span>| All Time</span>";
                }
              }
              ?>
            </h5>
            <p>Quick Overview of your recent transactions. Click the 3 dots on the upper right side to filter dates</p>

            <!-- Make table scrollable -->
            <div style="max-height: 400px; overflow-y: auto;">
              <table class="table table-borderless table-hover">
                <thead>
                  <tr>
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                    <th scope="col">Type</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                      <tr class="transaction-row" data-id="<?php echo $row['transaction_id']; ?>" style="cursor: pointer;">
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td>
                          <span class="<?php echo $row['transaction'] === 'expense' ? 'text-danger' : 'text-success'; ?> fw-bold">
                            <?php echo number_format($row['amount'], 2); ?>
                          </span>
                        </td>
                        <td><?php echo date('F d, Y', strtotime($row['date'])); ?></td>
                        <td class="text-center">
                          <span class="badge bg-<?php echo $row['transaction'] === 'expense' ? 'danger' : ($row['transaction'] === 'income' ? 'success' : 'secondary'); ?>">
                            <?php echo htmlspecialchars($row['transaction']); ?>
                          </span>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="5" class="text-center">No transactions found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

            <!-- End scrollable table -->

          </div>
        </div>
      </div>
      <!-- End Transaction Records -->


      <!-- Reports -->
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Reports <span>/Today</span></h5>

            <!-- Line Chart -->
            <div id="reportsChart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                let reportChart;

                async function loadReportData() {
                  try {
                    const response = await fetch(`../controller/reportChart.php`);
                    const data = await response.json();

                    const expenses = data.expenses.map(item => ({
                      x: item.date,
                      y: item.total
                    }));

                    const income = data.income.map(item => ({
                      x: item.date,
                      y: item.total
                    }));

                    // Destroy old chart if it exists
                    if (reportChart) {
                      reportChart.destroy();
                    }

                    reportChart = new ApexCharts(document.querySelector("#reportsChart"), {
                      series: [{
                          name: 'Expense',
                          data: expenses
                        },
                        {
                          name: 'Income',
                          data: income
                        }
                      ],
                      chart: {
                        height: 350,
                        type: 'area',
                        toolbar: {
                          show: false
                        },
                      },
                      markers: {
                        size: 4
                      },
                      colors: ['#ff771d', '#2eca6a'],
                      fill: {
                        type: "gradient",
                        gradient: {
                          shadeIntensity: 1,
                          opacityFrom: 0.3,
                          opacityTo: 0.4,
                          stops: [0, 90, 100]
                        }
                      },
                      dataLabels: {
                        enabled: false
                      },
                      stroke: {
                        curve: 'smooth',
                        width: 2
                      },
                      xaxis: {
                        type: 'category'
                      },
                      tooltip: {
                        x: {
                          format: 'yyyy-MM-dd'
                        },
                      }
                    });

                    reportChart.render();

                  } catch (error) {
                    console.error('Error loading chart data:', error);
                  }
                }

                // Load chart data on page load
                loadReportData();
              });
            </script>
            <!-- End Line Chart -->

          </div>

        </div>
      </div><!-- End Reports -->

    </div> <!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-xxl-5">

      <!-- Reminders -->
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
              <img src="../assets/img/icon.png" alt="Icon" width="24" height="24" class="me-2">
              <h5 class="card-title fw-bold mb-0">Reminders</h5>
            </div>
            <!-- Add Task Button -->
            <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addTaskModal">
              <i class="bi bi-plus-lg"></i>
            </a>
          </div>


          <!-- Task List -->
          <ul class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
            <!-- Active Tasks -->
            <?php if (!empty($tasksData['active'])): ?>
              <?php foreach ($tasksData['active'] as $row): ?>
                <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                  <div class="me-auto">
                    <div class="fw-bold fs-6 mb-1"><?php echo htmlspecialchars($row['title']); ?></div>
                    <div class="text-muted mb-2"><?php echo htmlspecialchars($row['description']); ?></div>
                    <small class="text-secondary">
                      <?php echo date('F d, Y ', strtotime($row['created_at'])); ?>
                    </small>
                  </div>

                  <div class="d-flex align-items-center">
                    <!-- Complete Button -->
                    <form action="../controller/updateTaskStatus.php" method="POST" style="display:inline;">
                      <input type="hidden" name="taskid" value="<?php echo $row['id']; ?>">
                      <input type="hidden" name="status" value="yes">
                      <button type="submit" class="btn btn-outline-success btn-sm me-2">
                        <i class="bi bi-check-circle"></i>
                      </button>
                    </form>

                    <!-- Edit Button -->
                    <button class="btn btn-outline-primary btn-sm me-2"
                      data-bs-toggle="modal"
                      data-bs-target="#editTaskModal"
                      data-id="<?php echo $row['id']; ?>"
                      data-title="<?php echo htmlspecialchars($row['title']); ?>"
                      data-description="<?php echo htmlspecialchars($row['description']); ?>"
                      data-date="<?php echo date('Y-m-d', strtotime($row['created_at'])); ?>">
                      <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- Delete Button -->
                    <form action="../controller/deleteTask.php" method="POST" style="display:inline;">
                      <input type="hidden" name="taskid" value="<?php echo $row['id']; ?>">
                      <button type="submit" class="btn btn-outline-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this task?');">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </div>
                </li>
              <?php endforeach; ?>
            <?php else: ?>
              <li class="list-group-item text-center text-muted py-3">
                Click + to add a note
              </li>
            <?php endif; ?>

            <!-- Separator -->
            <?php if (!empty($tasksData['completed'])): ?>
              <li class="list-group-item text-center text-muted py-2">✔️ Completed Tasks</li>
            <?php endif; ?>

            <!-- Completed Tasks -->
            <?php foreach ($tasksData['completed'] as $row): ?>
              <li class="list-group-item d-flex justify-content-between align-items-start py-3" style="text-decoration: line-through; color: #999;">
                <div class="me-auto">
                  <div class="fw-bold fs-6 mb-1"><?php echo htmlspecialchars($row['title']); ?></div>
                  <div class="text-muted mb-2"><?php echo htmlspecialchars($row['description']); ?></div>
                  <small class="text-secondary">
                    <?php echo date('F d, Y', strtotime($row['created_at'])); ?>
                  </small>
                </div>

                <div class="d-flex align-items-center">
                  <!-- Mark as Incomplete Button -->
                  <form action="../controller/updateTaskStatus.php" method="POST" style="display:inline;">
                    <input type="hidden" name="taskid" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="status" value="no">
                    <button type="submit" class="btn btn-outline-secondary btn-sm me-2">
                      <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                  </form>

                  <!-- Delete Button -->
                  <form action="../controller/deleteTask.php" method="POST" style="display:inline;">
                    <input type="hidden" name="taskid" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-outline-danger btn-sm"
                      onclick="return confirm('Are you sure you want to delete this task?');">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>


        </div>
      </div>

      <!-- Add Task Modal -->
      <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addtaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <div class="d-flex align-items-center">
                <img src="../assets/img/icon.png" alt="Icon" width="24" height="24" class="me-2">
                <h6 class="modal-title fw-bold" id="addtaskModalLabel">New Reminder</h6>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <form action="../controller/addtask.php" method="POST" novalidate>
                <div class="row mb-3">
                  <!-- Title -->
                  <div class="col-7">
                    <label for="inputtitle" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="inputtitle" required>
                  </div>
                  <!-- Date -->
                  <div class="col-5">
                    <label for="inputDate" class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" id="inputDate">
                  </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" name="description" id="description"
                    style="height: 100px" maxlength="150"></textarea>
                </div>

                <div class="text-end">
                  <button type="submit" name="addtask" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Add
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End of Add Task Modal -->

      <!-- Edit Task Modal -->
      <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <div class="d-flex align-items-center">
                <img src="../assets/img/icon.png" alt="Icon" width="24" height="24" class="me-2">
                <h6 class="modal-title fw-bold" id="editTaskModalLabel">Edit Reminder</h6>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <form action="../controller/updateTask.php" method="POST" novalidate>
                <input type="hidden" name="taskid" id="editTaskId">

                <div class="row mb-3">
                  <!-- Title -->
                  <div class="col-7">
                    <label for="editTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="editTitle" required>
                  </div>
                  <!-- Date -->
                  <div class="col-5">
                    <label for="editDate" class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" id="editDate">
                  </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                  <label for="editTaskDescription" class="form-label">Description</label>
                  <textarea class="form-control" name="editTaskDescription" id="editTaskDescription"
                    style="height: 100px" maxlength="150"></textarea>
                </div>

                <div class="text-end">
                  <button type="submit" name="editTask" class="btn btn-success">
                    <i class="bi bi-save"></i> Save Changes
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>





      <!-- End of Reminders -->


      <!-- Money Traffic -->
      <div class="card">
        <div class="card-body pb-0" id="expense">
          <h5 class="card-title">Expense Structure <span>| All Time</span> </h5>
          <div id="trafficChart" class="echart"></div>
          <script>
            // Fetch data from PHP
            async function loadChartData() {
              try {
                const response = await fetch('../controller/expenseChart.php');
                const data = await response.json();

                // Initialize ECharts
                const chart = echarts.init(document.querySelector("#trafficChart"));

                chart.setOption({
                  tooltip: {
                    trigger: 'item'
                  },
                  legend: {
                    top: '1%',
                    left: 'center'
                  },
                  series: [{
                    name: "Access from",
                    type: 'pie',
                    radius: ['33%', '65%'],
                    center: ['50%', '60%'],
                    avoidLabelOverlap: false,
                    label: {
                      show: false,
                      position: 'center'
                    },
                    emphasis: {
                      label: {
                        show: true,
                        fontSize: '12',
                        fontWeight: 'bold'
                      }
                    },
                    labelLine: {
                      show: true
                    },
                    data: data
                  }]
                });

              } catch (error) {
                console.error('Error loading chart data:', error);
              }
            }

            // Load data when DOM is ready
            document.addEventListener("DOMContentLoaded", loadChartData);
          </script>
          <div class="text-center mb-3">
            <h6 class="total-expenses">
              Total Expenses: ₱ <?php echo number_format($allTimeExpense, 2); ?>
            </h6>
          </div>

        </div>
      </div>


      <!-- Budget Report -->
      <div class="card">
        <!-- Bar Chart -->
        <div id="barChart"></div>

        <script>
          document.addEventListener("DOMContentLoaded", () => {
            fetch('../controller/expenseChart2.php')
              .then(response => response.json())
              .then(data => {
                const categories = data.map(item => item.category);
                const totals = data.map(item => item.total);

                new ApexCharts(document.querySelector("#barChart"), {
                  series: [{
                    data: totals
                  }],
                  chart: {
                    type: 'bar',
                    height: 350
                  },
                  plotOptions: {
                    bar: {
                      borderRadius: 4,
                      horizontal: true,
                    }
                  },
                  dataLabels: {
                    enabled: false
                  },
                  xaxis: {
                    categories: categories
                  },
                  colors: ['#ff6384'],
                  tooltip: {
                    y: {
                      formatter: (value) => `₱ ${value.toLocaleString()}`
                    }
                  }
                }).render();
              })
              .catch(error => console.error('Error loading data:', error));
          });
        </script>
        <!-- End Bar Chart -->
      </div><!-- End Budget Report -->

    </div><!-- End Right side columns -->
  </div>
</section>