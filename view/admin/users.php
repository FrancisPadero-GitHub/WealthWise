<?php
include("../../dB/config.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>


<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Users</h5>
              <a href="addUser.php" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Add User
              </a>
          </div>

             
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b>Full Name</b>
                    </th>
                    <th>Mobile Number</th>
                    <th>Gender</th>
                    <th data-type="date" data-format="YYYY/DD/MM">Birthday</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query = "SELECT `firstName`, `lastName`, `phoneNumber`, `gender`, `birthday` FROM `users`";
                    $query_run = mysqli_query( $con, $query);

                    if(!$query_run){
                      die("Query Failed:" .mysqli_error($con));
                    }

                    if(mysqli_num_rows($query_run )>0){
                      foreach($query_run as $row){
                    ?>

                    <tr>
                        <td><?=$row['firstName'];?> <?=$row['lastName'];?></td>
                        <td><?=$row['phoneNumber'];?></td>
                        <td><?=$row['gender'];?></td>
                        <td><?=$row['birthday'];?></td>
                        <td><button class="btn btn-primary"><i class="bi bi-eye-fill"></i>View</button></td>
                    </tr>
                    <?php
                      }
                    }
                    ?>
                    
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

<?php
include("./includes/footer.php");
?>