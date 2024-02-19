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
                
              </div>
            </div>
          </div>
          <div class="row">
            
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

             $referalCodeQ = "SELECT * FROM `referral` WHERE `user_id` = '$login_user_id' ";
             $referalCodeEx = $db->select1DB($referalCodeQ);
             $referalCode = $referalCodeEx['referral_code'];
             $userRefId = $referalCodeEx['referral_id'];
            ?>
            
            <div class="col-md-12 grid-margin transparent">
              <div class="row">
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="fs-30 mb-4"><?php echo $numOfStudents; ?></p>
                      <p class="fs-30 mb-4">My Total Earning</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                    <p class="fs-30 mb-4"><?php echo $numOfStudents; ?></p>
                    <p class="fs-30 mb-4">Available Balance</p>
                      
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                    <p class="fs-30 mb-4"><?php echo $numOfStudents; ?></p>
                    <p class="fs-30 mb-4">Total Withdrawal</p>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>

            <div class="col-md-12 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 grid-margin transparent">
                <p class="text-primary fs-30 font-weight-medium">Direct Sales Bonus</p>
                  </div>
                 <div class="col-md-4 mb-4 stretch-card transparent"> 
                  <div class="card card-light-blue">
                    <div class="card-body">
                    <p class="fs-30 ">61</p>
                    </div>
                  </div>
                </div>
                       
              </div>
              <div class="row">
                <div class="col-md-6 grid-margin transparent">
                <p class="text-primary fs-30 font-weight-medium">Startup Bonus</p>
                  </div>
                 <div class="col-md-4 mb-4 stretch-card transparent"> 
                  <div class="card card-light-blue">
                    <div class="card-body">
                    <p class="fs-30 ">61</p>
                    </div>
                  </div>
                </div>
                       
              </div>
              <div class="row">
                <div class="col-md-6 grid-margin transparent">
                <p class="text-primary fs-20 font-weight-medium">Team Bonus</p>
                  </div>
                 <div class="col-md-4 mb-4 stretch-card transparent"> 
                  <div class="card card-light-blue">
                    <div class="card-body">
                    <p class="fs-20 ">61</p>
                    </div>
                  </div>
                </div>
                       
              </div>
              
              <div class="row">
                <div class="col-md-6 mb-1 grid-margin transparent">
                <div class="row">
                <p class="text-primary fs-20 font-weight-medium">Level 03 Affiliat</p>
                
                <p class="text-primary-one fs-20 font-weight-500">Level 03 04 & 05</p>
                
                <div class="col-md-3 mb-1 stretch-card transparent"> 
                  <div class="card card-light-blue">
                    <div class="card-body">
                    <p class="fs-30 ">3/3</p>
                    </div>
                  </div>
                </div>
                </div>
                  </div>
                 <div class="col-md-4 mb-4 stretch-card transparent"> 
                  <div class="card card-light-blue">
                    <div class="card-body">
                    <p class="fs-30 ">61</p>
                    </div>
                  </div>
                </div>
                       
              </div>
              <div class="row">
                <div class="col-md-6 mb-1 grid-margin transparent">
                <div class="row">
                <p class="text-primary fs-30 font-weight-medium">Level 03 Affiliat</p>
                
                <div class="col-md-4 mb-1 stretch-card transparent"> 
                  <div class="card card-light-blue">
                    <div class="card-body">
                    <p class="fs-30 ">0/6</p>
                    </div>
                  </div>
                </div>
                </div>
                  </div>
                 <div class="col-md-4 mb-4 stretch-card transparent"> 
                  <div class="card card-light-blue">
                    <div class="card-body">
                    <p class="fs-30 ">61</p>
                    </div>
                  </div>
                </div>
                       
              </div>
              <div class="row">
                <div class="col-md-6 mb-1 grid-margin transparent">
                <div class="row">
                <p class="text-primary fs-30 font-weight-medium">Level 03 Affiliat</p>
                
                <div class="col-md-4 mb-1 stretch-card transparent"> 
                  <div class="card card-light-blue">
                    <div class="card-body">
                    <p class="fs-30 ">0/9</p>
                    </div>
                  </div>
                </div>
                </div>
                  </div>
                 <div class="col-md-4 mb-1 stretch-card transparent"> 
                  <div class="card card-light-blue">
                    <div class="card-body">
                    <p class="fs-30 ">61</p>
                    </div>
                  </div>
                </div>
                       
              </div>
                
            </div>
          </div>
          <div class="col-md-12 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 grid-margin transparent">
                <p class="font-weight-500">My Referral Code - <?php echo $referalCode; ?> <button onclick="myFunction()">
                Copy</button> </p>
                <p class="font-weight-500" style=" display: inline-block;">My Referral Link - <span id="refLink"><?php echo "https://www.3c.lk/register.php?ref=" . $referalCode; ?></span></p> <button onclick="myFunction()">Copy</button>
                
                  </div>
                  <div class="col-md-6 grid-margin transparent">
                           
                  <div class="form-actions">
                  <button type="submit" name="login_user" id="login_user" class="btn btn-primary site-btn">Withdraw</button>
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

