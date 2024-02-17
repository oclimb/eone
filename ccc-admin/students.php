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
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <!--<i class="mdi mdi-calendar"></i> Today (10 Jan 2021)-->
                    </button>                    
                  </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
          
          
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Students</p>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="studentDetails" class="display expandable-table" style="width:100%">
                          <thead>
                            <tr>
                              <th>Student Name</th>
                              <!-- <th>Student Level</th> -->
                              <th>Student Since</th>
                              <th>Email</th>
                              <th>Phone Number</th>
                              <th>Total Earnings</th>
                              <th>Referral Code</th>
                              <th>Sponser</th>
                            </tr>

                            <?php
                            $queryStudents = "SELECT u.`user_id`,`name`,`reg_date`,`email`,`telephone_number` FROM `user` u, `user_detail` d , `role` r, `referral` f WHERE d.`user_id` =u.`user_id` AND f.`user_id` =d.`user_id` AND u.`role_id` =r.`role_id` AND r.`role_name` = 'Student'";
                            if ($accountRole != 'Admin') {
                              $referral_idQ = "SELECT `referral_id` AS f FROM `referral` WHERE `user_id` = '$login_user_id' ";
                              $referralID = $db->getValueAsf($referral_idQ);
                              $queryStudents = "SELECT u.`user_id`,`name`,`reg_date`,`email`,`telephone_number` FROM `user` u, `user_detail` d , `role` r, `referral` f WHERE d.`user_id` =u.`user_id` AND f.`referral_id` =d.`referral_id` AND u.`role_id` =r.`role_id` AND f.`referral_id` = '$referralID'";

                            }
                            $execQueryStudents = $db->selectDB($queryStudents);
                   
                            foreach ($execQueryStudents['data'] as $resultStudents) {

                              $re_user_id = $resultStudents['user_id'];
                              $sponserQ = "SELECT r.`referral_code` as f FROM `user_detail` d, `referral` r  WHERE r.`referral_id` = d.`referral_id` AND d.`user_id` = '$re_user_id' ";
                              $sponser = $db->getValueAsf($sponserQ);
                              $referral1Q = "SELECT r.`referral_code` as f FROM `user_detail` d, `referral` r  WHERE r.`user_id` = d.`user_id` AND d.`user_id` = '$re_user_id' ";
                              $referral1 = $db->getValueAsf($referral1Q);
                              if ($accountRole != 'Admin') {
                              $referralQ = "SELECT f1.`referral_code` as f FROM `user` u, `user_detail` d , `role` r, `referral` f, `referral` f1 WHERE d.user_id = f1.user_id AND d.`user_id` =u.`user_id` AND f.`referral_id` =d.`referral_id` AND u.`role_id` =r.`role_id` AND f.`referral_id` = '$referralID'";
                              $referral = $db->getValueAsf($referralQ);
                              }

                              $aprovelDateQ = "SELECT `approval_date` AS f FROM `student_course` WHERE `student_id` = '$re_user_id' AND `status` = 1 ORDER BY `id` ASC LIMIT 1";
                              $aprovelDate = $db->getValueAsf($aprovelDateQ);

                              $checkPaymentQ ="SELECT * FROM `student_course` WHERE `student_id` = '$re_user_id' AND `status` = 1 ";

                              $paymentEx = $db->selectDB($checkPaymentQ);
				                      if ($paymentEx['rowCount'] > 0) {
                            ?>
                              <tr>
                                <td><?php echo $resultStudents['name'];  ?></td>
                                <!-- <td><?php //echo $resultStudents['level_des'];  ?></td> -->
                                <td><?php echo $aprovelDate;  ?></td>
                                <td><?php echo $resultStudents['email'];  ?></td>
                                <td><?php echo $resultStudents['telephone_number'];  ?></td>
                                <td></td>
                                <td><?php echo $referral1;  ?></td>
                                <td><?php echo $sponser;  ?></td>
                              </tr>
                            <?php }
                          } ?>
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

