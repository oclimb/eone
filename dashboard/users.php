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
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="images/dashboard/main.svg" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php 
             $numOfStudentsQ = "SELECT COUNT(u.`user_id`) AS f FROM `user` u, `role` r WHERE u.`role_id` =r.`role_id` AND r.`role_name` = 'Student'";
             $numOfStudents = $db->getValueAsf($numOfStudentsQ);

             $numOfStudents30Q = "SELECT COUNT(u.`user_id`) AS f FROM `user` u, `role` r WHERE u.`role_id` =r.`role_id` AND r.`role_name` = 'Student' AND u.`reg_date` > NOW() - INTERVAL 30 DAY";
             $numOfStudents30 = $db->getValueAsf($numOfStudents30Q);

             $numOfLecQ = "SELECT COUNT(u.`user_id`) AS f FROM `user` u, `role` r WHERE u.`role_id` =r.`role_id` AND r.`role_name` = 'Lecture'";
             $numOfLec = $db->getValueAsf($numOfLecQ);

             $numOfCourseQ = "SELECT COUNT(`course_id`) AS f FROM `course`";
             $numOfCourse = $db->getValueAsf($numOfCourseQ);

             $numOfCourse30Q = "SELECT COUNT(`course_id`) AS f FROM `course` WHERE `create_date` > NOW() - INTERVAL 30 DAY";
             $numOfCourse30 = $db->getValueAsf($numOfCourse30Q);
             
             $numOfCourseEneQ = "SELECT COUNT(`id`) AS f FROM `student_course` ";
             $numOfCourseEne = $db->getValueAsf($numOfCourseEneQ);

             $numOfCourseEne30Q = "SELECT COUNT(`id`) AS f FROM `student_course` WHERE `enrol_date` > NOW() - INTERVAL 30 DAY ";
             $numOfCourseEne30 = $db->getValueAsf($numOfCourseEne30Q);
            ?>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Total Students</p>
                      <p class="fs-30 mb-2"><?php echo $numOfStudents; ?></p>
                      <p>Recent Registration - <?php echo $numOfStudents30; ?></p>
                       <p>(30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Lecturers</p>
                      <p class="fs-30 mb-2"><?php echo $numOfLec ?></p>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Number of Courses</p>
                      <p class="fs-30 mb-2"><?php echo $numOfCourse; ?></p>
                      <p>Recent Uplods - <?php echo $numOfCourse30; ?> </p>
                      <p>(30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Course Enrollments</p>
                      <p class="fs-30 mb-2"><?php echo $numOfCourseEne; ?></p>
                      <p>Recent Enrollments - <?php echo $numOfCourseEne30; ?></p>
                      <p>(30 days)</p>
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
                  <p class="card-title">All Users</p>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="example" class="display expandable-table" style="width:100%">
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
                            $queryStudents = "SELECT u.`user_id`,`name`,`reg_date`,`email`,`telephone_number` FROM `user` u, `user_detail` d , `referral` f WHERE d.`user_id` =u.`user_id` AND f.`user_id` =d.`user_id` ";
                            if ($accountRole != 'Admin') {
                              $referral_idQ = "SELECT `referral_id` AS f FROM `referral` WHERE `user_id` = '$login_user_id' ";
                              $referralID = $db->getValueAsf($referral_idQ);
                              $queryStudents = "SELECT u.`user_id`,`name`,`reg_date`,`email`,`telephone_number` FROM `user` u, `user_detail` d , `referral` f WHERE d.`user_id` =u.`user_id` AND f.`referral_id` =d.`referral_id`  AND f.`referral_id` = '$referralID'";

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
				                      //if ($paymentEx['rowCount'] > 0) {
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
                            <?php 
                            //}
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

