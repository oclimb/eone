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
                              <th>Name</th>
                              <th>Level 01 Referrals</th>
                              
                              <?php
                            $queryStudents = "SELECT * FROM `user` u,  `user_detail` d WHERE u.`user_id` = d.`user_id`";
                            
                            $execQueryStudents = $db->selectDB($queryStudents);
                   
                            foreach ($execQueryStudents['data'] as $resultStudents) {

                              $referral_id = $resultStudents['user_id'];

                              $firstLq = "SELECT * FROM `user_detail` d, `referral` r WHERE d.`network_referral_id` = r.`referral_id` AND r.`user_id` = '$referral_id' ORDER BY d.`network_date` ASC";
                              $firstLEx = $db->selectDB($firstLq);
                          
                              $lvel_peoples = "";
                              foreach ($firstLEx['data'] as $firstLRe) {
                                $lvel_peoples.=$firstLRe['name']." , ";
                              }
                              
                            ?>
                              <tr>
                                <td><?php echo $resultStudents['email'];  ?></td>
                                <td><?php echo $resultStudents['name'];  ?></td>
                                <td><?php echo $lvel_peoples;  ?></td>
                              </tr>
                            <?php } ?>
                              
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

