<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php'; ?>


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
        $cid = $_GET['cid'];
        $paymentStatusQ = "SELECT `status` AS f FROM `student_course` WHERE `course_id` ='$cid' AND `student_id` ='$login_user_id' ";
        $paymentStatus = $db->getValueAsf($paymentStatusQ);

        if ($paymentStatus == 1 || $accountRole == 'Admin') {

          $querySearch = "SELECT * FROM `course` c , `content` t, `user_detail` d, `course_category` g WHERE c.`course_id` = t.`course_id` AND c.`user_id` = d.`user_id`
          AND c.`category_id` = g.`category_id` AND c.`course_id` = '$cid'";
          $resultVal = $db->select1DB($querySearch);


        ?>
          <div class="row">
            <div class="col-md-8 grid-margin stretch-card">

              <div class="card tale-bg" style="background: #f5f7ff !important;">


              <?php 

              $queryCoursesVideo = "SELECT * FROM `content` WHERE `course_id` = '$cid' ORDER BY `order` ASC";
              $execQueryCoursesVideo = $db->selectDB($queryCoursesVideo);
                   
              foreach ($execQueryCoursesVideo['data'] as $resultCoursesVideo) {
                $content_id = $resultCoursesVideo['content_id'];
                $upload_type = $resultCoursesVideo['upload_type'];
              ?>
                <br><br>
                <h4 class="font-weight-bold"><?php echo $resultCoursesVideo['video_name']; ?></h4>
                <div class="card-people mt-auto">
                  <?php if($upload_type == 0) {?>
                  <video width="100%" controls controlsList="nodownload" id="videolist<?php echo $content_id; ?>">
                    <source src="videos/<?php echo $resultCoursesVideo['file_path']; ?>" type="video/mp4">

                  </video>
                  <script>
  document.getElementById('videolist<?php echo $content_id; ?>').addEventListener('contextmenu', function (e) {
    e.preventDefault(); // Prevent the default context menu
  });
  
  
</script>
                  <?php }else{?>
                    <div style="width: 100%; height: 350px; position: relative;">
                    <iframe  id="videolist<?php echo $content_id; ?>" width="100%"  height="350px" src="<?php echo $resultCoursesVideo['file_path']; ?>" frameborder="0" scrolling="no" seamless="" allowfullscreen="allowfullscreen"></iframe>
                    <div style="width: 48px; height: 48px; position: absolute; right: 6px; top: 6px;">
                    <img src="images/videologo.png?v=1">
                  </div>
                    </div>

                    <script>
 document.getElementById('videolist<?php echo $content_id; ?>').onload = function() {
    var iframeDocument = document.getElementById('videolist<?php echo $content_id; ?>').contentDocument || document.getElementById('videolist<?php echo $content_id; ?>').contentWindow.document;

    iframeDocument.addEventListener('mousedown', function(e) {
      if (e.button === 2) {
        e.preventDefault();
      }
    });
  };
</script>
                    <?php } ?>
                  <div class="weather-info">
                    <div class="d-flex">

                    </div>
                  </div>
                </div>
              
          <?php } ?>

              </div>
            </div>
            
            <div class="col-md-4 grid-margin transparent">
              <div class="row">
                <div class="col-md-12 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card transparent">
                    <div class="card-body">
                      <p class="mb-4"><b>COURSE DETAILS</b></p>
                      <p><b>Course Name</b></p>
                      <p><?php echo $resultVal['name']; ?></p>
                      <p><b>Course Category</b></p>
                      <p><?php echo $resultVal['category']; ?></p>
                      <p><b>Assigment</b></p>
                      <p></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

        <?php
        } else {
          echo "<h1>Contact Admin<h1>";
        }
        ?>

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