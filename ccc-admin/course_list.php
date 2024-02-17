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
                  <p class="card-title">All Courses</p>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="example" class="display expandable-table" style="width:100%">
                          <thead>
                            <tr>
                              <th>Course Name</th>
                              <th>Category</th>
                              <th>Published on</th>
                              <th>Course Demo</th>
                              <th>Course Video</th>
                              <th>Assignment</th>
                              
                              <?php
                            $queryCourses = "SELECT * FROM `course` c, `course_category` a, `student_course` s WHERE c.`category_id` = a.`category_id` AND c.`course_id` = s.`course_id` AND s.`student_id`='$login_user_id'";

                              if($accountRole == 'Admin'){
                            $queryCourses = "SELECT * FROM `course` c, `course_category` a WHERE c.`category_id` = a.`category_id`";
                              }
                            $execQueryCourses = $db->selectDB($queryCourses);
                   
                            foreach ($execQueryCourses['data'] as $resultCourses) {
                            ?>
                              <tr>
                                <td><?php echo $resultCourses['course_name'];  ?></td>
                                <td><?php echo $resultCourses['category'];  ?></td>
                                <td><?php echo $resultCourses['create_date'];  ?></td>
                                <td><a href="../single-course.php?cid=<?php echo $resultCourses['course_id']; ?>" target="_blank">View</a></td>
                                <td><a href="student_course_display.php?cid=<?php echo $resultCourses['course_id']; ?>" target="_blank">View</a></td>
                                <td></td>
                                
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

