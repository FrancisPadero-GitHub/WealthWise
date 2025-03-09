<div class="pagetitle">
  <h1>Add Expenses | Income</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
      <li class="breadcrumb-item">Add Transaction</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">New Record</h5>

        <!-- General Form Elements -->
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


          <div class="col-sm-12 text-end">
            <button type="submit" name="add_record" class="btn btn-success btn-md">
              <i class="bi bi-check-lg"></i> OK
            </button>

          </div>

        </form><!-- End General Form Elements -->

      </div>
    </div>

  </div>

</section>