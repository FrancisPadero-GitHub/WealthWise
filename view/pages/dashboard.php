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
    <div class="col-lg-7">
      <div class="row" style="margin-bottom: 0;">

        <!-- Balance Card -->
        <div class="col-xxl-4 col-md-6">
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

        <!-- Total Expenses Card -->
        <div class="col-xxl-4 col-md-6">
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
              <h5 class="card-title">Total Expenses <span>| All Time</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cash-coin"></i>
                </div>
                <div class="ps-3">
                  <h6 class="text-danger">₱ <?php echo number_format($totalExpense, 2); ?></h6>
                  <span class="text-danger small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Expenses Card -->

        <!-- Total Income Card -->
        <div class="col-xxl-4 col-xl-12">
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
              <h5 class="card-title">Total Income <span>| All Time</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cash-coin"></i>
                </div>
                <div class="ps-3">
                  <h6 class="text-success">₱ <?php echo number_format($totalIncome, 2); ?></h6>
                  <span class="text-success small pt-1 fw-bold">16%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                </div>
              </div>
            </div>
          </div>
        </div><!-- End Income Card -->
      </div><!-- End cards -->

      <!--Add Transaction -->
      <div class="text-end">
        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addRecordModal">
          <i class="bi bi-plus-lg"></i> <!-- Bootstrap Plus Icon -->
        </a>
      </div>

      <!-- Add new record modal -->
      <div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addRecordModalLabel">New Record</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="../controller/addRecord.php" method="POST" novalidate>
                <div class="row mb-3">
                  <!-- Amount -->
                  <div class="col-md-4">
                    <label for="inputNumber" class="form-label">Amount</label>
                    <input type="number" class="form-control" name="amount" id="inputNumber" required>
                  </div>

                  <!-- Category -->
                  <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <select class="form-select" name="category" aria-label="Default select example">
                      <optgroup label="Daily Expenses">
                        <option value="Food and Drinks">Food and Drinks</option>
                        <option value="Shopping">Shopping</option>
                        <option value="House Rent">House Rent</option>
                        <option value="Transportation">Transportation</option>
                      </optgroup>
                      <optgroup label="Assets">
                        <option value="Vehicle">Vehicle</option>
                        <option value="Life and Entertainment">Life and Entertainment</option>
                        <option value="Communication & PC">Communication & PC</option>
                      </optgroup>
                      <optgroup label="Financial">
                        <option value="Financial Expenses">Financial Expenses</option>
                        <option value="Investments">Investments</option>
                        <option value="Income">Income</option>
                        <option value="Others">Others</option>
                      </optgroup>
                    </select>
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
                    <textarea class="form-control" name="description" id="description" style="height: 100px" maxlength="255"></textarea>
                  </div>
                </div>

                <div class="text-end">
                  <button type="submit" name="add_record" class="btn btn-success">
                    <i class="bi bi-check-lg"></i> OK
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- end of add new record modal -->



      <!-- Update Edit Transaction Modal -->
      <!-- Modal -->
      <!-- Edit Record Modal -->
      <div class="modal fade" id="editRecordModal" tabindex="-1" aria-labelledby="editRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editRecordModalLabel">Edit Record</h5>
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

                  <!-- Category -->
                  <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <select class="form-select" name="category" id="editCategory" aria-label="Default select example">
                      <optgroup label="Daily Expenses">
                        <option value="Food and Drinks">Food and Drinks</option>
                        <option value="Shopping">Shopping</option>
                        <option value="House Rent">House Rent</option>
                        <option value="Transportation">Transportation</option>
                      </optgroup>
                      <optgroup label="Assets">
                        <option value="Vehicle">Vehicle</option>
                        <option value="Life and Entertainment">Life and Entertainment</option>
                        <option value="Communication & PC">Communication & PC</option>
                      </optgroup>
                      <optgroup label="Financial">
                        <option value="Financial Expenses">Financial Expenses</option>
                        <option value="Investments">Investments</option>
                        <option value="Income">Income</option>
                        <option value="Others">Others</option>
                      </optgroup>
                    </select>
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
                    <textarea class="form-control" name="description" id="editDescription" style="height: 100px" maxlength="255"></textarea>
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
                    <th scope="col">#</th> <!-- Row number -->
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                    <th scope="col">Type</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($result->num_rows > 0): ?>
                    <?php
                    $rowNumber = $result->num_rows; // Start from the highest number
                    while ($row = $result->fetch_assoc()):
                    ?>
                      <tr class="transaction-row" data-id="<?php echo $row['transaction_id']; ?>" style="cursor: pointer;">
                        <th scope="row">
                          <!-- Show row number in DESC order -->
                          <a href="#"><?php echo $rowNumber; ?></a>
                        </th>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td>
                          <span class="<?php echo $row['transaction'] === 'expense' ? 'text-danger' : 'text-success'; ?> fw-bold">
                            <?php echo number_format($row['amount'], 2); ?>
                          </span>
                        </td>
                        <td><?php echo date('F, d, Y', strtotime($row['date'])); ?></td>
                        <td>
                          <span class="badge bg-<?php echo $row['transaction'] === 'expense' ? 'danger' : ($row['transaction'] === 'income' ? 'success' : 'secondary'); ?>">
                            <?php echo htmlspecialchars($row['transaction']); ?>
                          </span>
                        </td>
                      </tr>
                      <?php $rowNumber--; // Decrement row number to reflect DESC order 
                      ?>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="6" class="text-center">No transactions found.</td>
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

          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>

              <li><a class="dropdown-item" href="#">Today</a></li>
              <li><a class="dropdown-item" href="#">This Month</a></li>
              <li><a class="dropdown-item" href="#">This Year</a></li>
            </ul>
          </div>

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
    <div class="col-lg-5">

      <!-- Money Traffic -->
      <div class="card">
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

        <div class="card-body pb-0">
          <h5 class="card-title">Expense Structure </h5>
          <div id="trafficChart" style="height: 50vh; width: 100%;" class="echart"></div>
          <script>
            // Fetch data from PHP
            async function loadChartData() {
              try {
                const response = await fetch('../controller/expenseChart.php');
                const data = await response.json();
                console.log(data)
                // Initialize ECharts
                const chart = echarts.init(document.querySelector("#trafficChart"));
                chart.setOption({
                  tooltip: {
                    trigger: 'item'
                  },
                  legend: {
                    top: '5%',
                    left: 'center'
                  },
                  series: [{
                    name: 'Access From',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                      show: false,
                      position: 'center'
                    },
                    emphasis: {
                      label: {
                        show: true,
                        fontSize: '18',
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
              Total Expenses: ₱ <?php echo number_format($totalExpense, 2); ?>
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