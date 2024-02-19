<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php'; 



if (isset($_GET['stid']) && $_SESSION['FORM_SECRET'] == $_GET['token'] ) {

  


    $result = $user_function->paymentAprovel($_GET['stid']);


    if ($result) {
      $_SESSION['MSG'] = "<div class='sucees-msg' >Successfully approved payment</div>";
    } else {
      $_SESSION['MSG'] = "<div class='error-msg' >Failed approve payment </div>";
    }
  
}

?>

  
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
                <?php
						if (isset($_SESSION['MSG'])) {
							echo $_SESSION['MSG'] . "<br>";
							unset($_SESSION['MSG']);
						}
						?>

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
                              <th>Course Name</th>
                              <th>Payment type</th>
                              <th>Payment Date</th>
                              <th>Approval </th>
                            </tr>

                            <?php
                            $queryStudents = "SELECT d.`name`,c.`course_name`,s.`payment_type`,s.`enrol_date`,s.`id` as stid FROM `student_course` s,`user_detail` d, `course` c WHERE s.`student_id`= d.user_id AND s.`course_id`=c.`course_id` AND s.`status` = 0 ORDER BY s.id DESC";
                            
                            $execQueryStudents = $db->selectDB($queryStudents);
                   
                            foreach ($execQueryStudents['data'] as $resultStudents) {

                            ?>
                              <tr>
                                <td><?php echo $resultStudents['name'];  ?></td>
                                <td><?php echo $resultStudents['course_name'];  ?></td>
                                <td><?php echo ucfirst($resultStudents['payment_type']);  ?></td>
                                <td><?php echo $resultStudents['enrol_date'];  ?></td>
                                <td><a href="?stid=<?php echo $resultStudents['stid'];  ?>&token=<?php echo $_SESSION['FORM_SECRET'];  ?>">Approval</a></td>
                                
                              </tr>
                            <?php } ?>
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

