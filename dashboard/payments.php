<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php'; ?>

  
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php require_once 'header.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome <?php echo $accountName; ?></h3>                  
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  
                 </div>
                </div>
              </div>
            </div>
          </div>
          
            
            
         
         
          
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">All Users</p>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="example" class="display expandable-table" style="width:100%">
                          <thead>
                            <tr>
                              <th>User ID</th>
                              <th>Student/Lecturer</th>
                              <th>Total Earnings</th>
                              <th>Total Paid</th>
                              <th>Balance Payments</th>
                              <th>Last Payment Date</th>
                          

                              <?php
                            $queryCommision = "SELECT u.`user_id`,u.`name`,SUM(b.`bonus_ammount`) AS bonusAmount FROM `student_bouns` b,`user_detail` u WHERE b.`user_id`= u.`user_id` AND `payment_status` IN (1,2) GROUP BY b.`user_id`";
                            
                            $execQueryCommision = $db->selectDB($queryCommision);
                   
                            foreach ($execQueryCommision['data'] as $resultCommision) {
                              if($resultCommision['user_id'] != 4 ){
                            ?>
                              <tr>
                                <td><?php echo $resultCommision['user_id'];  ?></td>
                                <td><?php echo $resultCommision['name'];  ?></td>
                                <td><?php echo $resultCommision['bonusAmount'];  ?></td>
                                <td><?php //echo $resultCommision['email'];  ?></td>
                                <td><?php //echo $resultCommision['telephone_number'];  ?></td>
                                <td><?php //echo $resultCommision['telephone_number'];  ?></td>
                                
                              </tr>
                            <?php }
                           } ?>
                              
                            </tr>
                          </thead>
                      </table>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>

                
              </div>
            </div>
        </div>
        <!-- content-wrapper ends --> 
        <!-- partial:partials/_footer.html -->
        <?php require_once 'footer.php'; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

 
</body>

</html>

