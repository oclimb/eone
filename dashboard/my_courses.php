<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php'; 
?>


<body id="main-body">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php require_once 'header.php'; ?>
    <!-- partial -->
    

        <div class="row">
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
                            <th>Course View</th>
                            <!-- <th>Assignment</th> -->
                            <th>Payment</th>


                          </tr>

                          <?php
                          $queryCourses = "SELECT * FROM `course` c, `course_category` a, `student_course` s WHERE c.`category_id` = a.`category_id` AND c.`course_id` = s.`course_id` AND s.`student_id`='$login_user_id'";


                          $execQueryCourses = $db->selectDB($queryCourses);

                          foreach ($execQueryCourses['data'] as $resultCourses) {
                            $courseStataus= $resultCourses['status'];
                            $course_id = $resultCourses['course_id'];
                            $course_link = $resultCourses['course_link'];
                            $paymentStatusQ = "SELECT `status` AS f FROM `payment` WHERE `course_id` ='$course_id' AND `student_id` ='$login_user_id' ";
                            $paymentStatus = $db->getValueAsf($paymentStatusQ);
                            $videoUrl = "";
                            $payment = "Pending";
                            if ($courseStataus == 1) {
                              $videoUrl = '<a href="' . $course_link . '" target="_blank">View</a>';
                              $payment = "Done";
                            }

                          ?>
                            <tr>
                              <td><?php echo $resultCourses['course_name'];  ?></td>
                              <td><?php echo $resultCourses['category'];  ?></td>
                              <td><a href="../single-course.php?cid=<?php echo $course_id; ?>" target="_blank">View</a></td>
                              <td><?php echo $videoUrl  ?></td>
                              <!-- <td></td> -->
                              <td><?php echo $payment  ?></td>


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
  document.getElementById('main-body').addEventListener('contextmenu', function (e) {
    e.preventDefault(); // Prevent the default context menu
  });

  document.addEventListener('contextmenu', function(e) {
  e.preventDefault();
});
  
  document.addEventListener('keydown', function (e) {
    // Check if the user is pressing a combination of keys that opens developer tools
    if ((e.ctrlKey || e.metaKey) && (e.key === 'I' || e.key === 'i')) {
      e.preventDefault(); // Prevent the default behavior
    }
  });
  
  const detectDevTools = () => {
            const widthThreshold = 160;
            const heightThreshold = 160;

            if (window.outerWidth - window.innerWidth > widthThreshold || window.outerHeight - window.innerHeight > heightThreshold) {
                document.body.innerHTML = 'Page loading is disabled when DevTools are open.';
            }
        };
        setInterval(detectDevTools, 1000);
        
        
        document.addEventListener("contextmenu", function (e) {
            e.preventDefault();
        });

        
</script>
</html>