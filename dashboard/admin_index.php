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
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">New Registrations</p>
                  <p class="font-weight-500">New Student Registrations Current Week </p>
                  <div class="d-flex flex-wrap mb-5">
                    <div class="mr-5 mt-3">
                      <p class="text-muted">No of Registrations</p>
                      <h3 class="text-primary fs-30 font-weight-medium"><?php echo $numOfStudents; ?></h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Course Enrollments</p>
                      <h3 class="text-primary fs-30 font-weight-medium"><?php echo $numOfCourseEne;?></h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Course Completion</p>
                      <h3 class="text-primary fs-30 font-weight-medium">0</h3>
                    </div>
                    <div class="mt-3">
                      <p class="text-muted">Revenue</p>
                      <h3 class="text-primary fs-30 font-weight-medium">0</h3>
                    </div> 
                  </div>
                  <canvas id="order-chart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                 <div class="d-flex justify-content-between">
                  <p class="card-title">Course Enrollment Turnover</p>
                  <a href="#" class="text-info">View all</a>
                 </div>
                  <p class="font-weight-500">No of Couse Enrollments Month wise </p>
                  <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Best Earners of the Month</p>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="example" class="display expandable-table" style="width:100%">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Business type</th>
                              <th>Total Earning</th>
                              <th>Curren Month Earning</th>
                              <th>No of Referrals</th>
                              <th>Head Referral</th>
                              <th>Member Since</th>
                              <th></th>
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

