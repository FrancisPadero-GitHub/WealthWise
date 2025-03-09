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
        <form>
          <div class="row mb-3">
            <!-- Amount -->
            <div class="col-md-4">
              <label for="inputNumber" class="form-label">Amount</label>
              <input type="number" class="form-control" id="inputNumber" required>
            </div>

            <!-- Category -->
            <div class="col-md-4">
              <label class="form-label">Category</label>
              <select class="form-select" name="category" aria-label="Default select example">
                <optgroup label="Daily Expenses">
                  <option value="1">Food and Drinks</option>
                  <option value="2">Shopping</option>
                  <option value="3">House Rent</option>
                  <option value="4">Transportation</option>
                </optgroup>
                <optgroup label="Assets">
                  <option value="5">Vehicle</option>
                  <option value="6">Life and Entertainment</option>
                  <option value="7">Communication & PC</option>
                </optgroup>
                <optgroup label="Financial">
                  <option value="8">Financial Expenses</option>
                  <option value="9">Investments</option>
                  <option value="10">Income</option>
                  <option value="11">Others</option>
                </optgroup>
              </select>
            </div>

            <!-- Transaction -->
            <div class="col-md-4">
              <label class="form-label">Transaction</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>Expense</option>
                <option value="1">Income</option>
              </select>
            </div>
          </div>




          <div class="row mb-3">
            <!-- Date -->
            <div class="col-md-6">
              <label for="inputDate" class="form-label">Date</label>
              <input type="date" class="form-control" id="inputDate">
            </div>

            <!-- Account -->
            <div class="col-md-6">
              <label class="form-label">Account</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>Cash</option>
                <option value="1">Credit</option>
              </select>
            </div>
          </div>


          <div class="row mb-3">
            <div class="col-12">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" style="height: 100px" maxlength="255"></textarea>
            </div>
          </div>


          <div class="col-sm-12 text-end">
            <button type="submit" class="btn btn-success btn-md">
              <i class="bi bi-check-lg"></i> OK
            </button>

          </div>

        </form><!-- End General Form Elements -->

      </div>
    </div>

  </div>

</section>