<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php';

if (isset($_GET['acept_agree']) && $_GET['acept_agree'] == 'done') {
  $result = $user_function->aceptAgree($login_user_id);
  if($result){
    header('Location: withdrowal.php');
      exit();
  }
}

if (isset($_POST['save_payment']) && $_SESSION['FORM_SECRET'] == $_POST['API_secret']) {



  $save_acc_no = $_POST['acc_no'];
  $save_acc_name = $_POST['acc_name'];
  $save_acc_bank = $_POST['acc_bank'];
  $save_acc_branch = $_POST['acc_branch'];
  $save_acc_branch_code = $_POST['acc_branch_code'];


  $reguest_array = array(
    'acc_no' => $save_acc_no,
    'acc_name' => $save_acc_name,
    'acc_bank' => $save_acc_bank,
    'acc_branch' => $save_acc_branch,
    'acc_branch_code' => $save_acc_branch_code,
    'user_id' => $login_user_id
  );

  $result = $user_function->updatePament($reguest_array);

  if ($result) {
    $_SESSION['MSG'] = "<div class='sucees-msg' >Successfully updated your payment details. </div>";
    
  } else {
    $_SESSION['MSG'] = "<div class='error-msg' >Failed updated your payment details</div>";
  }
}

?>


<body id="main-body">
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
        <?php
        if (isset($_SESSION['MSG'])) {
          echo $_SESSION['MSG'];
          unset($_SESSION['MSG']);
        }
        ?>
        <div class="row">
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
              <div class="card-people mt-auto">
                <img src="../img/home-cover.png?v=1" alt="people">
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


          $sponserQ = "SELECT d1.`name` as f FROM `user_detail` d, `referral` r , `user_detail` d1 WHERE d.`referral_id` = r.`referral_id` AND r.`user_id` = d1.`user_id` AND d.`user_id` = '$login_user_id' ";
          $sponser = $db->getValueAsf($sponserQ);

          $refCountQ = "SELECT COUNT(d.`name`) AS f FROM `user_detail` d, `referral` r  WHERE d.`referral_id` = r.`referral_id`  AND r.`user_id` = '$login_user_id' ";
          $refCount = $db->getValueAsf($refCountQ);

          $netRefCountQ = "SELECT * FROM `user_detail` WHERE `network_referral_id`='$userRefId'";
          $netRefCountEx = $db->selectDB($netRefCountQ);
          $netRefCount = $netRefCountEx['rowCount'];

          $directCommissionQ = "SELECT SUM(`bonus_ammount`) AS f FROM `student_bouns` WHERE `user_id` = '$login_user_id' AND `bonus_type`='direct' AND `payment_status` = 1";
          $directCommission = $db->getValueAsf($directCommissionQ);

          $networkCommissionQ = "SELECT SUM(`bonus_ammount`) AS f FROM `student_bouns` WHERE `user_id` = '$login_user_id' AND `bonus_type`='network' AND `payment_status` = 1";
          $networkCommission = $db->getValueAsf($networkCommissionQ);

          $lastWeekCommissionQ = "SELECT SUM(`bonus_ammount`) AS f FROM student_bouns WHERE `user_id` = '$login_user_id' AND bonus_date >= NOW() - INTERVAL '7' DAY AND bonus_date < NOW() AND `payment_status` = 1";
          $lastWeekCommission = $db->getValueAsf($lastWeekCommissionQ);

          if (strlen($directCommission) < 1) {
            $directCommission = 0;
          }

          if (strlen($networkCommission) < 1) {
            $networkCommission = 0;
          }

          if (strlen($lastWeekCommission) < 1) {
            $lastWeekCommission = 0;
          }

          $totalEarning =  $directCommission + $networkCommission;

          ?>
          <div class="col-md-6 grid-margin transparent">
            <div class="row">
              <div class="col-md-12 mb-4 mb-lg-0 stretch-card transparent">
                <div class="card transparent">


                  <div class="card-body">
                    <p class="mb-4"><b>PERSONAL DETAILS</b></p>
                    <p><b>Name</b></p>
                    <p><?php echo $accountName; ?></p>
                    <p><b>Address</b></p>
                    <p><?php echo $resultAccounts['address'];; ?></p>
                    <p><b>Email/User ID</b></p>
                    <p><?php echo $resultAccounts['email'];; ?></p>
                    <p><b>Contact Number</b></p>
                    <p><?php echo $resultAccounts['mobile_number'];; ?></p>
                  </div>

                </div>
              </div>
            </div>
          </div>


        </div>
        <!--<div class="row">
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">My Group</p>
                <p class="font-weight-500">My Referral Code - <?php //echo $referalCode; ?> <button onclick="myFunction()">Copy</button> </p>
                <p class="font-weight-500" style=" display: inline-block;">My Referral Link - <span id="refLink"><//?php echo "https://www.3c.lk/register.php?ref=" . $referalCode; ?></span></p> <button onclick="myFunction()">Copy</button>
                <p class="font-weight-500">Sponser Name - <?php //echo $sponser; ?></p>
                <div class="d-flex flex-wrap mb-5">
                  <div class="mr-5 mt-3">
                    <p class="text-muted">Direct Referrals</p>
                    <h3 class="text-primary fs-30 font-weight-medium"><?php //echo $refCount; ?></h3>
                  </div>
                  <div class="mr-5 mt-3">
                    <p class="text-muted">Network Referrals</p>
                    <h3 class="text-primary fs-30 font-weight-medium"><?php //echo "N/A"; //$netRefCount; 
                                                                      ?></h3>
                  </div>
                  <div class="mr-5 mt-3">
                    <p class="text-muted">Direct Commission</p>
                    <h3 class="text-primary fs-30 font-weight-medium">$ <?php //echo $directCommission; ?></h3>
                  </div>
                  <div class="mr-5 mt-3">
                    <p class="text-muted">Network Commission</p>
                    <h3 class="text-primary fs-30 font-weight-medium">$ <?php //echo $networkCommission; ?></h3>
                  </div>
                  <div class="mr-5 mt-3">
                    <p class="text-muted">Last week Earnings</p>
                    <h3 class="text-primary fs-30 font-weight-medium">$ <?php //echo $lastWeekCommission; ?></h3>
                  </div>
                  <div class="mr-5 mt-3">
                    <p class="text-muted">Total Earnings</p>
                    <h3 class="text-primary fs-30 font-weight-medium">$ <?php //echo $totalEarning; ?></h3>
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
                  <p class="card-title">Best Earners of the Week</p>
                  <a href="#" class="text-info">View all</a>
                </div>

                <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>

              </div>
            </div>
          </div>
        </div> -->

        <!-- <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">My courses</p>
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table id="example" class="display expandable-table" style="width:100%">
                        <thead>
                          <tr>
                            <th>Course Name</th>
                            <th>Course Category</th>
                            <th>Course Demo</th>
                            <th>Course Video</th>
                            <th>Payment</th>


                          </tr>

                          <?php
                          // $queryCourses = "SELECT * FROM `course` c, `course_category` a, `student_course` s WHERE c.`category_id` = a.`category_id` AND c.`course_id` = s.`course_id` AND s.`student_id`='$login_user_id'";


                          // $execQueryCourses = $db->selectDB($queryCourses);

                          // foreach ($execQueryCourses['data'] as $resultCourses) {
                          //   $courseStataus = $resultCourses['status'];
                          //   $course_id = $resultCourses['course_id'];
                          //   $paymentStatusQ = "SELECT `status` AS f FROM `payment` WHERE `course_id` ='$course_id' AND `student_id` ='$login_user_id' ";
                          //   $paymentStatus = $db->getValueAsf($paymentStatusQ);
                          //   $videoUrl = "";
                          //   $payment = "Pending";
                          //   if ($courseStataus == 1) {
                          //     $videoUrl = '<a href="student_course_display.php?cid=' . $course_id . '" target="_blank">View</a>';
                          //     $payment = "Done";
                          //   }

                          ?>
                            <tr>
                              <td><?php //echo $resultCourses['course_name'];  ?></td>
                              <td><?php //echo $resultCourses['category'];  ?></td>
                              <td><a href="../single-course.php?cid=<?php //echo $course_id; ?>" target="_blank">View</a></td>
                              <td><?php //echo $videoUrl  ?></td>
                              <td><?php //echo $payment  ?></td>


                            </tr>
                          <?php //} ?>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div> -->


        <!-- payment Method-->

        <?php
        $acc_no = "";
        $acc_name = "";
        $acc_bank = "";
        $acc_branch = "";
        $acc_branch_code = "";


        $paymentMethodQ = "SELECT * FROM `payment_method` WHERE `user_id` = '$login_user_id' AND `status` = 1";
        $paymentMethodCount = $db->selectDB($paymentMethodQ)['rowCount'];

        if ($paymentMethodCount > 0) {
          $paymentMethodEx = $db->select1DB($paymentMethodQ);
          $acc_no = $paymentMethodEx['acc_no'];
          $acc_name = $paymentMethodEx['name'];
          $acc_bank = $paymentMethodEx['bank'];
          $acc_branch = $paymentMethodEx['branch'];
          $acc_branch_code = $paymentMethodEx['branch_code'];
        }
        ?>
        <div class="row">
          <div class="col-8">



            <form autocomplete="off" id="payment-method-form" action="?action=method_save" method="post" class="form-horizontal">


              <fieldset>



                <div class="control-group">
                  <label class="control-label" for="acc_no">Account Number</label>

                  <div class="controls form-group">

                    <input class="span4 form-control" id="acc_no" name="acc_no" value="<?php echo $acc_no; ?>" type="text">


                  </div>
                  <!-- /controls -->
                </div>
                <!-- /control-group -->

                <div class="control-group">
                  <label class="control-label" for="acc_name">Account Name</label>

                  <div class="controls form-group">

                    <input class="span4 form-control" id="acc_name" name="acc_name" value="<?php echo $acc_name; ?>" type="text">


                  </div>
                  <!-- /controls -->
                </div>
                <!-- /control-group -->

                <div class="control-group">
                  <label class="control-label" for="acc_bank">Bank</label>

                  <div class="controls form-group">

                    <input class="span4 form-control" id="acc_bank" name="acc_bank" value="<?php echo $acc_bank; ?>" type="text">


                  </div>
                  <!-- /controls -->
                </div>
                <!-- /control-group -->


                <div class="control-group">
                  <label class="control-label" for="acc_branch">Branch</label>

                  <div class="controls form-group">

                    <input class="span4 form-control" id="acc_branch" name="acc_branch" value="<?php echo $acc_branch; ?>" type="text">


                  </div>
                  <!-- /controls -->
                </div>
                <!-- /control-group -->

                <div class="control-group">
                  <label class="control-label" for="acc_branch_code">Branch Code</label>

                  <div class="controls form-group">

                    <input class="span4 form-control" id="acc_branch_code" name="acc_branch_code" value="<?php echo $acc_branch_code; ?>" type="text">


                  </div>
                  <!-- /controls -->
                </div>
                <!-- /control-group -->


                <div class="form-actions">
                  <input type="hidden" name="API_secret" value="<?php echo $form_secret; ?>">

                  <?php
                  $editIs = false;
                  $saveIs = false;
                  if ($paymentMethodCount > 0) {
                    if (isset($_GET['action'])) {
                      if ($_GET['action'] == 'method_edit') {
                        $saveIs = true;
                    } else {
                        $editIs = true;
                      }
                    } else {
                      $editIs = true;
                    }
                  } else {
                    if (isset($_GET['action'])) {
                      if ($_GET['action'] == 'method_edit') {
                        $saveIs = true;
                    }else{
                    $editIs = true;
                    }
                  }else{ 
                    $saveIs = true;
                  }
                  } ?>

                  <?php if ($saveIs) { 
                    ?>
                    <button type="submit" name="save_payment" id="save_payment" class="btn btn-primary site-btn">Save</button>
                    <?php }  if ($editIs) { 
                    ?>
                    <a href="?action=method_edit" class="btn btn-primary site-btn">Edit</a>
                    <?php } ?>
                    
                </div>
                <!-- /form-actions -->



              </fieldset>
            </form>
            <?php if ($isagreed == 0) { ?>
              <br>
              <a href="?acept=done" class="btn btn-danger site-btn" data-toggle="modal" data-target="#agrementModal">Activate Referal Center</a>
            <?php } ?>
          </div>


        </div>





      </div>
      <!-- Modal -->
      <div id="agrementModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
              <h4 class="modal-title">Terms & Conditions</h4>
            </div>
            <div class="modal-body">
              <p></p>
            </div>
            <div class="modal-footer">
              <a href="?acept_agree=done" class="btn btn-primary site-btn">I Agree</a>

              <button type="button" class="btn btn-danger site-btn" data-dismiss="modal">Close</button>
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

  <script>
    function myFunction() {

      // Get the span element by its ID
      var spanElement = document.getElementById('refLink');

      // Copy the text content of the span to the clipboard
      var textToCopy = spanElement.innerText || spanElement.textContent;

      // Create a temporary input element to copy the text
      var tempInput = document.createElement('input');
      tempInput.setAttribute('value', textToCopy);
      document.body.appendChild(tempInput);

      // Select the text in the input
      tempInput.select();
      tempInput.setSelectionRange(0, 99999); /* For mobile devices */

      // Copy the text to the clipboard
      document.execCommand('copy');

      // Remove the temporary input element
      document.body.removeChild(tempInput);

      // Alert the copied text
      alert("copied My Referel Link");
    }
  </script>
</body>
<script>
  $(document).ready(function() {
    $('#payment-method-form').bootstrapValidator({
      framework: 'bootstrap',

      fields: {

        acc_no: {
          validators: {
            notEmpty: {
              message: 'This is a required',
            }
          }
        },
        acc_name: {
          validators: {
            notEmpty: {
              message: 'This is a required',
            }
          }
        },
        acc_bank: {
          validators: {
            notEmpty: {
              message: 'This is a required',
            }
          }
        },
        acc_branch: {
          validators: {
            notEmpty: {
              message: 'This is a required',
            }
          }
        },
        acc_branch_code: {
          validators: {
            notEmpty: {
              message: 'This is a required',
            }
          }
        }
      }
    });
  });
</script>
<script>
  // document.getElementById('main-body').addEventListener('contextmenu', function(e) {
  //   e.preventDefault(); // Prevent the default context menu
  // });

  // document.addEventListener('contextmenu', function(e) {
  //   e.preventDefault();
  // });

  // document.addEventListener('keydown', function(e) {
  //   // Check if the user is pressing a combination of keys that opens developer tools
  //   if ((e.ctrlKey || e.metaKey) && (e.key === 'I' || e.key === 'i')) {
  //     e.preventDefault(); // Prevent the default behavior
  //   }
  // });

  // const detectDevTools = () => {
  //   const widthThreshold = 160;
  //   const heightThreshold = 160;

  //   if (window.outerWidth - window.innerWidth > widthThreshold || window.outerHeight - window.innerHeight > heightThreshold) {
  //     document.body.innerHTML = 'Page loading is disabled when DevTools are open.';
  //   }
  // };
  // setInterval(detectDevTools, 1000);


  // document.addEventListener("contextmenu", function(e) {
  //   e.preventDefault();
  // });
</script>

</html>